<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Moulding;
use App\MatModel;
use App\Glass;
use App\Foamcore;
use Illuminate\Validation\Rule;

class Order extends Model
{
    public static function userOrders()
    {
        $user = auth()->user()->id;
        return Order::where('user', $user)->get()->reverse();
    }

    public static function userWorkingOrders()
    {
        $user = auth()->user()->id;
        // The following query doesn't account for whether or not the report is processed
        return Order::where('user', $user)->where('isCompleted', 0)->where('isReported', 1)->get();
    }

    public static function userReportedOrders()
    {
        $user = auth()->user()->id;
        return Order::where('user', $user)->where('isReported', 1)->get();
    }

    public static function userOrder($orderNumber)
    {
        $user = auth()->user()->id;
        $matchThese = ['user' => $user, 'orderNumber' => $orderNumber];
        return Order::where('user', $user)->where($matchThese)->get();
    }

    public static function dateRangeOrders($beginDate, $endDate)
    {
        $user = auth()->user()->id;
        return Order::whereBetween('created_at', [$beginDate, $endDate])->where('user', $user)->where('isReported', 0)->get();
    }

    public static function dateRangeOrdersUpdate($beginDate, $endDate, $reportNumber)
    {
        $user = auth()->user()->id;
        return Order::whereBetween('created_at', [$beginDate, $endDate])->where('user', $user)->where('isReported', 0)->orWhere('user', $user)->whereBetween('created_at', [$beginDate, $endDate])->where('isReported', 1)->where('reportNumber', $reportNumber)->get();
    }

    public static function dateRangeOrdersInReport($reportNumber, $beginDate, $endDate)
    {
        $user = auth()->user()->id;
        return Order::whereBetween('created_at', [$beginDate, $endDate])->where('user', $user)->where('isReported', 0)->orWhere('reportNumber', $reportNumber)->whereBetween('created_at', [$beginDate, $endDate])->where('user', $user)->get();
    }

    public static function dateRangeOrdersVerification($reportNumber,$beginDate, $endDate)
    {
        $user = auth()->user()->id;
        return Order::whereBetween('created_at', [$beginDate, $endDate])->where('user', $user)->where('isReported', 1)->where('reportNumber', '!=', $reportNumber)->get();
    }

    public static function specificOrders($orderNumbers)
    {
        $user = auth()->user()->id;
        return Order::where('user', $user)->whereIn('orderNumber', $orderNumbers)->get();
    }

    public static function orderNumbers()
    {
        $user = auth()->user()->id;
        $orderNumbers = Order::select('orderNumber')->where('user', $user)->get();
        $orderNumbersRefined = null;
        foreach ($orderNumbers as &$orderNumber) {
            $orderNumbersRefined[] = $orderNumber->attributes['orderNumber'];
        }
        return $orderNumbersRefined;
    }

    public static function nextOrderNumber()
    {
        $user = auth()->user()->id;
        $maxOrder = \DB::select(
            \DB::raw("
                SELECT MAX(CAST(orderNumber AS SIGNED)) orderNumber
                FROM orders
                WHERE user = :user;
            "),
            array('user' => $user)
        );
        $maxOrder = $maxOrder[0]->orderNumber;
        return $maxOrder + 1;
    }

    public static function idsToOrderNumbers($editOrders) {
        if ($editOrders == "") {
            return [];
        }
        $editOrders = \DB::select("SELECT orderNumber FROM orders WHERE id IN($editOrders)");
        foreach ($editOrders as $index => $value){
            $editOrders[$index] = $value->orderNumber;
        }
        return $editOrders;
    }

    public static function orderNumbersToIds($orders) {
        if ($orders == "") {
            return [];
        }
        $user = auth()->user()->id;
        $orders = \DB::select("SELECT id FROM orders WHERE orderNumber IN($orders) AND user = $user");
        foreach ($orders as $index => $value){
            $orders[$index] = $value->id;
        }
        return $orders;
    }

    public static function reportOrders($orders, $reportNumber) {
        $orderIDs = explode(',', $orders);
        \DB::table('orders')->whereIn('id', $orderIDs)->update(array('reportNumber' => $reportNumber));
        \DB::table('orders')->whereIn('id', $orderIDs)->update(array('isReported' => 1));
    }

    public static function unreportOrders($orders) {
        $orderIDs = explode(',', $orders);
        \DB::table('orders')->whereIn('id', $orderIDs)->update(array('reportNumber' => -1));
        \DB::table('orders')->whereIn('id', $orderIDs)->update(array('isReported' => 0));
    }

    public static function completionFunction($id) {
        $now = now();
        \DB::statement("
            UPDATE orders
                SET isCompleted =
                    CASE WHEN isCompleted = 0 THEN 1
                    ELSE 0 END,
                completed_at =
                    CASE WHEN isCompleted = 1 THEN '$now'
                    ELSE null END
                WHERE id = $id
        ");
    }

    public static function validationArray($isReported, $isFrame, $secondMatNumberIsVisible, $thirdMatNumberIsVisible, $firstMatPresent)
    {
        $validationArray = [
            'customerFirst' => ['required'],
            'customerLast' => ['required'],
            'customerEmail' => ['required', 'email:rfc'],
            'customerPhoneArea' => ['required', 'digits:3'],
            'customerPhone3' => ['required', 'digits:3'],
            'customerPhone4' => ['required', 'digits:4'],
        ];
        if (!$isReported) {
            $validationArray += [
                'orderWidth' => ['required', 'numeric'],
                'orderHeight' => ['required', 'numeric'],
                'orderFoamcoreType' => ['required'],
            ];
            if ($isFrame) {
                $mouldingNumbers = Moulding::mouldingNumbers();
                $matNumbers = MatModel::matNumbers();
                $validationArray += [
                    'orderMouldingNumber' => ['required', 'numeric', Rule::in($mouldingNumbers)],
                    'orderGlassType' => ['required'],
                ];
                if ($firstMatPresent) {
                    $validationArray += [
                        'firstMatNumber' => ['required', 'numeric', Rule::in($matNumbers)],
                    ];
                }
                if ($secondMatNumberIsVisible) {
                    $validationArray += [
                        'secondMatNumber' => ['required', 'numeric', Rule::in($matNumbers)]
                    ];
                    if ($thirdMatNumberIsVisible) {
                        $validationArray += [
                            'thirdMatNumber' => ['required', 'numeric', Rule::in($matNumbers)],
                        ];
                    }
                }
            }
        }
        return $validationArray;
    }

    public static function validationCommentsArray($isReported, $isFrame, $secondMatNumberIsVisible, $thirdMatNumberIsVisible, $firstMatPresent)
    {
        $validationCommentsArray = [
            'customerPhoneArea.required' => 'An area code is required.',
            'customerPhoneArea.digits' => 'The area code must be three digits.',
            'customerPhone3.required' => 'The first three digits of the phone number are required.',
            'customerPhone3.digits' => 'The first three digits of the phone number must be exactly three digits.',
            'customerPhone4.required' => 'The last four digits of the phone number are required.',
            'customerPhone4.digits' => 'The last part of the phone number must be exactly four digits.',
        ];
        if ($isFrame) {
            $validationCommentsArray += [
                'orderMouldingNumber.in' => 'The moulding number must exist.',
            ];
            if ($firstMatPresent) {
                $validationCommentsArray += [
                    'firstMatNumber.in' => 'The mat number must exist.',
                    'firstMatNumber.numeric' => 'The mat number must be a number.',
                    'firstMatNumber.required' => 'The mat number is required.',
                ];
            }
            if ($secondMatNumberIsVisible) {
                $validationCommentsArray += [
                    'firstMatNumber.required' => 'The mat number is required.',
                    'secondMatNumber.required' => 'The mat number is required.',
                    'secondMatNumber.in' => 'The mat number must exist.',
                    'secondMatNumber.numeric' => 'The mat number must be a number.',
                ];
                if ($thirdMatNumberIsVisible) {
                    $validationCommentsArray += [
                        'thirdMatNumber.required' => 'The mat number is required.',
                        'thirdMatNumber.in' => 'The mat number must exist.',
                        'thirdMatNumber.numeric' => 'The mat number must be a number.',
                    ];
                }
            }
        }
        return $validationCommentsArray;
    }

    public static function price($height, $width, $mouldingNumber, $firstMat, $secondMat, $thirdMat, $glassType, $foamcoreType) {
        $perimeterFeet = 2 * ($height + $width) / 12;
        $areaFeet = ($height / 12) * ($width / 12);
        $user = auth()->user()->id;
        $price = 0;
        if ($mouldingNumber && $mouldingNumber != -1) {
            $moulding = Moulding::where('user', $user)->where('mouldingNumber', $mouldingNumber)->get();
            if ($moulding->count() > 0) {
                $mouldingPrice = $moulding[0]->attributes['mouldingPrice'];
                $price += $mouldingPrice * $perimeterFeet;
            }
        }
        if ($firstMat && $firstMat != -1) {
            $mat = MatModel::where('user', $user)->where('matNumber', $firstMat)->get();
            if ($mat->count() > 0) {
                $matPrice = $mat[0]->attributes['matPrice'];
                $price += $matPrice * $areaFeet;
            }
        }
        if ($secondMat && $secondMat != -1) {
            $mat = MatModel::where('user', $user)->where('matNumber', $secondMat)->get();
            if ($mat->count() > 0) {
                $matPrice = $mat[0]->attributes['matPrice'];
                $price += $matPrice * $areaFeet;
            }
        }
        if ($thirdMat && $thirdMat != -1) {
            $mat = MatModel::where('user', $user)->where('matNumber', $thirdMat)->get();
            if ($mat->count() > 0) {
                $matPrice = $mat[0]->attributes['matPrice'];
                $price += $matPrice * $areaFeet;
            }
        }
        if ($glassType && $glassType != -1) {
            $glass = Glass::where('user', $user)->where('glassType', $glassType)->get();
            if ($glass->count() > 0) {
                $glassPrice = $glass[0]->attributes['glassPrice'];
                $price += $glassPrice * $areaFeet;
            }
        }
        if ($foamcoreType && $foamcoreType != -1) {
            $foamcore = Foamcore::where('user', $user)->where('foamcoreType', $foamcoreType)->get();
            if ($foamcore->count() > 0) {
                $foamcorePrice = $foamcore[0]->attributes['foamcorePrice'];
                $price += $foamcorePrice * $areaFeet;
            }
        }
        return $price;
    }

    public static function search($customerEmail, $customerPhoneArea, $customerPhone3, $customerPhone4) {
        return Order::where('customerEmail', $customerEmail)->orWhere('customerPhoneArea', $customerPhoneArea)->where('customerPhone3', $customerPhone3)->where('customerPhone4', $customerPhone4)->get();
    }
}
