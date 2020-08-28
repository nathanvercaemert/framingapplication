<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportModel;
use App\Order;
use Carbon\Carbon;

class ReportModelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('reports.index');
    }

    public function create()
    {
        $nextReportNumber = ReportModel::nextReportNumber();
        $orders = json_encode([]);
        return view('reports.create',['orders' => $orders, 'nextReportNumber' => $nextReportNumber]);
    }

    public function addOrder()
    {
        $orderNumbers = Order::userOrders()->all();
        foreach ($orderNumbers as $index => $value){
            $orderNumbers[$index] = $value->orderNumber;
        }
        $orderNumber = request('orderNumber');
        $isValid = null;
        if (in_array($orderNumber, $orderNumbers)) {
            $isValid = 1;
        } else {
            $isValid = 0;
        }
        $return = array('isValid' => $isValid, 'orderNumber' => $orderNumber);
        return json_encode($return);
    }

    public function store()
    {
        if (request('isDateRange')) {
            $beginDate = Carbon::parse(request('beginDatepicker'));
            $endDate = Carbon::parse(request('endDatepicker'));
            $endDate = $endDate->addDays(1);
            $beginDate = $beginDate->format('Y-m-d H:i:s');
            $endDate = $endDate->format('Y-m-d H:i:s');
            $orders = Order::dateRangeOrders($beginDate, $endDate);
        } else {
            $orderNumberList = request('submitOrderList');
            if ($orderNumberList == null) {
                $orderNumbers = [];
            } else {
                $orderNumbers = explode(',', $orderNumberList);
            }
            $orders = Order::specificOrders($orderNumbers);
        }
        $orders = $orders->all();
        foreach ($orders as $index => $value){
            $orders[$index] = $value->id;
        }
        $orders = implode(',', $orders);
        $report = new ReportModel();
        $report->reportNumber = request('reportNumber');
        $report->reportOrderList = $orders;
        $report->reportIsDateRange = request('isDateRange');
        $report->reportIsSpecificOrders = request('isSpecificOrders');
        $report->user = auth()->user()->id;
        $report->save();
        return view('reports.index');
    }

    public function loadOrder()
    {
        $order = Order::userOrder(request('orderNumber'))->all();
        $order = $order[0];
        return $order;
    }
}
