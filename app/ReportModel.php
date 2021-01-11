<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Glass;
use App\Foamcore;
use App\MatModel;
use App\Moulding;

class ReportModel extends Model
{
    public static function userReports()
    {
        $user = auth()->user()->id;
        $reports = ReportModel::where('user', $user)->get();
        return $reports;
    }
    public static function nextReportNumber()
    {
        $user = auth()->user()->id;
        $maxReport = \DB::select(
            \DB::raw("
                SELECT MAX(CAST(reportNumber AS SIGNED)) reportNumber
                FROM report_models
                WHERE user = :user;
            "),
            array('user' => $user)
        );
        $maxReport = $maxReport[0]->reportNumber;
        return $maxReport + 1;
    }

    public static function getByNumber($reportNumber) {
        if ($reportNumber == -1) {
            return -1;
        }
        $user = auth()->user()->id;
        $report = \DB::select("SELECT * FROM report_models WHERE reportNumber = $reportNumber AND user = $user");
        foreach ($report as $index => $value){
            $report[$index] = ['reportId' => $value->id, 'isProcessed' => $value->isProcessed];
        }
        return $report;
    }

    public static function process($reportId) {
        \DB::table('report_models')->where('id', $reportId)->update(array('isProcessed' => 1, 'processed_at' => now()));
    }

    public static function reportContents($reportOrderList) {
        $user = auth()->user()->id;
        $reportOrderList = explode(",", $reportOrderList);
        $orders = Order::whereIn('id', $reportOrderList)->get();
        $nonVendorMaterials = ['glasses' => [], 'foamcores' => [], 'mouldings' => [], 'mats' => []];
        foreach($orders as $order) {
            $orderMouldingNumber = "mouldingNumber" . strval($order->attributes['orderMouldingNumber']);
            if ($orderMouldingNumber != "mouldingNumber-1") {
                if (in_array($orderMouldingNumber, array_keys($nonVendorMaterials['mouldings']), TRUE)) {
                    $nonVendorMaterials['mouldings'][$orderMouldingNumber] += 1;
                } else {
                    $nonVendorMaterials['mouldings'] = array_merge($nonVendorMaterials['mouldings'], array($orderMouldingNumber => 1));
                }
            }
            $orderFirstMatNumber = "matNumber" .strval($order->attributes['orderFirstMatNumber']);
            if ($orderFirstMatNumber != "matNumber-1") {
                if (in_array($orderFirstMatNumber, array_keys($nonVendorMaterials['mats']), TRUE)) {
                    $nonVendorMaterials['mats'][$orderFirstMatNumber] += 1;
                } else {
                    $nonVendorMaterials['mats'] = array_merge($nonVendorMaterials['mats'], array($orderFirstMatNumber => 1));
                }
            }
            $orderSecondMatNumber = "matNumber" .strval($order->attributes['orderSecondMatNumber']);
            if ($orderSecondMatNumber != "matNumber-1") {
                if (in_array($orderSecondMatNumber, array_keys($nonVendorMaterials['mats']), TRUE)) {
                    $nonVendorMaterials['mats'][$orderSecondMatNumber] += 1;
                } else {
                    $nonVendorMaterials['mats'] = array_merge($nonVendorMaterials['mats'], array($orderSecondMatNumber => 1));
                }
            }
            $orderThirdMatNumber = "matNumber" .strval($order->attributes['orderThirdMatNumber']);
            if ($orderThirdMatNumber != "matNumber-1") {
                if (in_array($orderThirdMatNumber, array_keys($nonVendorMaterials['mats']), TRUE)) {
                    $nonVendorMaterials['mats'][$orderThirdMatNumber] += 1;
                } else {
                    $nonVendorMaterials['mats'] = array_merge($nonVendorMaterials['mats'], array($orderThirdMatNumber => 1));
                }
            }
            $orderGlassType = strval($order->attributes['orderGlassType']);
            if ($orderGlassType != -1) {
                if (in_array($orderGlassType, array_keys($nonVendorMaterials['glasses']), TRUE)) {
                    $nonVendorMaterials['glasses'][$orderGlassType] += 1;
                } else {
                    $nonVendorMaterials['glasses'] = array_merge($nonVendorMaterials['glasses'], array($orderGlassType => 1));
                }
            }
            $orderFoamcoreType = strval($order->attributes['orderFoamcoreType']);
            if ($orderFoamcoreType != -1) {
                if (in_array($orderFoamcoreType, array_keys($nonVendorMaterials['foamcores']), TRUE)) {
                    $nonVendorMaterials['foamcores'][$orderFoamcoreType] += 1;
                } else {
                    $nonVendorMaterials['foamcores'] = array_merge($nonVendorMaterials['foamcores'], array($orderFoamcoreType => 1));
                }
            }
        }
        $vendors = [];
        foreach($nonVendorMaterials['glasses'] as $glass=>$quantity) {
            $vendor = Glass::where('glassType', $glass)->where('user', $user)->get()[0]->attributes['glassVendor'];
            if (!in_array($vendor, array_keys($vendors), TRUE)) {
                $vendors = array_merge($vendors, array($vendor => array('glasses' => [], 'foamcores' => [], 'mats' => [], 'mouldings' => [])));
            }
            $vendors[$vendor]['glasses'] = array_merge($vendors[$vendor]['glasses'], array($glass => $quantity));
        }
        foreach($nonVendorMaterials['foamcores'] as $foamcore=>$quantity) {
            $vendor = Foamcore::where('foamcoreType', $foamcore)->where('user', $user)->get()[0]->attributes['foamcoreVendor'];
            if (!in_array($vendor, array_keys($vendors), TRUE)) {
                $vendors = array_merge($vendors, array($vendor => array('glasses' => [], 'foamcores' => [], 'mats' => [], 'mouldings' => [])));
            }
            $vendors[$vendor]['foamcores'] = array_merge($vendors[$vendor]['foamcores'], array($foamcore => $quantity));
        }
        foreach($nonVendorMaterials['mats'] as $mat=>$quantity) {
            $vendor = MatModel::where('matNumber', substr($mat, 9))->where('user', $user)->get()[0]->attributes['matVendor'];
            if (!in_array($vendor, array_keys($vendors), TRUE)) {
                $vendors = array_merge($vendors, array($vendor => array('glasses' => [], 'foamecores' => [], 'mats' => [], 'mouldings' => [])));
            }
            $vendors[$vendor]['mats'] = array_merge($vendors[$vendor]['mats'], array($mat => $quantity));
        }
        foreach($nonVendorMaterials['mouldings'] as $moulding=>$quantity) {
            $vendor = Moulding::where('mouldingNumber', substr($moulding, 14))->where('user', $user)->get()[0]->attributes['mouldingVendor'];
            if (!in_array($vendor, array_keys($vendors), TRUE)) {
                $vendors = array_merge($vendors, array($vendor => array('glasses' => [], 'foamecores' => [], 'mats' => [], 'mouldings' => [])));
            }
            $vendors[$vendor]['mouldings'] = array_merge($vendors[$vendor]['mouldings'], array($moulding => $quantity));
        }
        foreach($vendors as $vendor=>$materialTypes) {
            foreach($materialTypes as $materialType=>$contents) {
                if ($contents == []) {
                    unset($vendors[$vendor][$materialType]);
                }
            }
        }
        return $vendors;
    }
}
