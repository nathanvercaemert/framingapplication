<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Moulding;
use App\MatModel;
use Illuminate\Validation\Rule;

class Order extends Model
{
    public static function userOrders()
    {
        $user = auth()->user()->id;
        return Order::where('user', $user)->get();
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
                SELECT MAX(orderNumber) orderNumber
                FROM orders
                WHERE user = :user;
            "),
            array('user' => $user)
        );
        $maxOrder = $maxOrder[0]->orderNumber;
        return $maxOrder + 1;
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

}
