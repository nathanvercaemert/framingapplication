<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportModel;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    public function view($id)
    {
        if ( $id == -1 ) {
            $report = request('reportNumber');
            try {
                $report = ReportModel::where('reportNumber', $report)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('reports.oops');
            }
        } else {
            $report = ReportModel::find($id);
        }
        $viewOrders = implode(",", Order::idsToOrderNumbers($report->reportOrderList));
        return view('reports.view',['report' => $report, 'viewOrders' => $viewOrders]);
    }


    public function list()
    {
        $reports = ReportModel::userReports();
        $reports = array('reports'=>$reports);
        return view('reports.list')->with($reports);
    }

    public function create()
    {
        $nextReportNumber = ReportModel::nextReportNumber();
        $orders = json_encode([]);
        return view('reports.create',['orders' => $orders, 'nextReportNumber' => $nextReportNumber]);
    }

    public function edit($id)
    {
        if ( $id == -1 ) {
            $reportNumber = request('reportNumber');
            try {
                $report = ReportModel::where('reportNumber', $reportNumber)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('reports.oops');
            }
        } else {
            $report = ReportModel::find($id);
        }
        $editOrders = Order::idsToOrderNumbers($report->reportOrderList);
        $editOrders = json_encode($editOrders);
        return view('reports.edit',['editOrders' => $editOrders, 'report' => $report]);
    }

    public function addOrder()
    {
        $orderNumbers = Order::userOrders()->all();
        $reportedOrderNumbers = Order::userReportedOrders()->all();
        foreach ($orderNumbers as $index => $value){
            $orderNumbers[$index] = $value->orderNumber;
        }
        foreach ($reportedOrderNumbers as $index => $value){
            $reportedOrderNumbers[$index] = $value->orderNumber;
        }
        $orderNumber = request('orderNumber');
        $isValid = null;
        $isReported = null;
        if (in_array($orderNumber, $orderNumbers)) {
            $isValid = 1;
            if (in_array($orderNumber, $reportedOrderNumbers)) {
                $isReported = 1;
            }
        } else {
            $isReported = 0;
            $isValid = 0;
        }
        $return = array('isValid' => $isValid, 'isReported' => $isReported, 'orderNumber' => $orderNumber);
        return json_encode($return);
    }

    public function update($id)
    {
        $report = ReportModel::find($id);
        $unreport = request('editUnreportCheckList');

        $beginDate = null;
        $endDate = null;
        if (request('editIsDateRange')) {
            $isDateRange = true;
            $beginDate = Carbon::parse(request('editBeginDatepicker'));
            $endDate = Carbon::parse(request('editEndDatepicker'));
            $endDate = $endDate->addDays(1);
            $beginDateFormatted = $beginDate->format('Y-m-d H:i:s');
            $endDateFormatted = $endDate->format('Y-m-d H:i:s');
            $orders = Order::dateRangeOrders($beginDateFormatted, $endDateFormatted);
            $orderNumbers = [];
            foreach ($orders as $index => $value){
                $orderNumbers[] = strval($value->id);
            }
        } else {
            $isDateRange = false;
            $orderNumberList = request('editSubmitOrderList');
            if ($orderNumberList == null) {
                $orderNumbers = [];
            } else {
                $orderNumbers = explode(',', $orderNumberList);
            }
            $orders = Order::specificOrders($orderNumbers);
        }

        // Validation
        if ($isDateRange) {
            $emptyReportError = 'The specified date range does not contain any unreported orders.';
        } else {
            $emptyReportError = 'Report must contain at least one order.';
        }
        $validator = Validator::make(['orderNumbers' => $orderNumbers], [
            'orderNumbers' => 'required',
        ], $messages = [
            'required' => $emptyReportError,
        ]);
        if ($validator->fails()) {
            $oldInputModified = request()->all();
            if ($isDateRange) {
                $oldInputModified["editEndDatepicker"] = $endDate->format('m/d/Y');
            }
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput($oldInputModified);
        }

        $orders = $orders->all();
        foreach ($orders as $index => $value){
            $orders[$index] = $value->id;
        }
        $orders = implode(',', $orders);

        $report->reportNumber = request('editReportNumber');
        $report->reportOrderList = $orders;
        $report->reportIsDateRange = request('editIsDateRange');
        $report->beginDate = $beginDate;
        $report->endDate = $endDate;
        $report->reportIsSpecificOrders = request('editIsSpecificOrders');
        $report->user = auth()->user()->id;
        $report->isProcessed = 0;
        $report->processed_at = null;
        $report->reportNotes = request('editReportNotes');
        $unreport = Order::orderNumbersToIds($unreport);
        $unreport = implode(",", array_diff($unreport, explode(",",$orders)));
        $report->save();
        Order::reportOrders($orders, $report->reportNumber);
        Order::unreportOrders($unreport);
        $redirectString = '/reports/view/' . strval($report->id);
        return redirect($redirectString);
    }

    public function store()
    {
        $beginDate = null;
        $endDate = null;
        if (request('isDateRange')) {
            $isDateRange = true;
            $beginDate = Carbon::parse(request('beginDatepicker'));
            $endDate = Carbon::parse(request('endDatepicker'));
            $endDate = $endDate->addDays(1);
            $beginDateFormatted = $beginDate->format('Y-m-d H:i:s');
            $endDateFormatted = $endDate->format('Y-m-d H:i:s');
            $orders = Order::dateRangeOrders($beginDateFormatted, $endDateFormatted);
            $orderNumbers = [];
            foreach ($orders as $index => $value){
                $orderNumbers[] = strval($value->id);
            }
        } else {
            $isDateRange = false;
            $orderNumberList = request('submitOrderList');
            if ($orderNumberList == null) {
                $orderNumbers = [];
            } else {
                $orderNumbers = explode(',', $orderNumberList);
            }
            $orders = Order::specificOrders($orderNumbers);
        }

        // Validation
        if ($isDateRange) {
            $emptyReportError = 'The specified date range does not contain any unreported orders.';
        } else {
            $emptyReportError = 'Report must contain at least one order.';
        }
        $validator = Validator::make(['orderNumbers' => $orderNumbers], [
            'orderNumbers' => 'required',
        ], $messages = [
            'required' => $emptyReportError,
        ]);
        if ($validator->fails()) {
            return redirect('reports/create')
                        ->withErrors($validator)
                        ->withInput();
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
        $report->beginDate = $beginDate;
        $report->endDate = $endDate;
        $report->reportIsSpecificOrders = request('isSpecificOrders');
        $report->user = auth()->user()->id;
        $report->isProcessed = 0;
        $report->processed_at = null;
        $report->reportNotes = request('reportNotes');
        $report->save();
        Order::reportOrders($orders, $report->reportNumber);
        $redirectString = '/reports/view/' . strval($report->id);
        return redirect($redirectString);
    }

    public function loadOrder()
    {
        $order = Order::userOrder(request('orderNumber'))->all();
        $order = $order[0];
        return $order;
    }

    public function verifyDateRangeContainsOrder()
    {
        $reportNumber = request('reportNumber');
        $beginDate = Carbon::parse(request('beginDatepicker'));
        $endDate = Carbon::parse(request('endDatepicker'));
        $endDate = $endDate->addDays(1);
        $orders = Order::dateRangeOrdersVerification($reportNumber, $beginDate, $endDate);
        $orderNumbers = [];
        foreach ($orders as $index => $value){
            $orderNumbers[] = strval($value->id);
        }
        $orderNumbers = implode(",", $orderNumbers);
        $orderNumbers = Order::idsToOrderNumbers($orderNumbers);
        $return = array('orderNumbers' => $orderNumbers);
        return json_encode($return);
    }

    public function dateRangeOrdersInReport() {
        $reportNumber = request('reportNumber');
        $beginDate = Carbon::parse(request('beginDate'));
        $endDate = Carbon::parse(request('endDate'));
        $endDate = $endDate->addDays(1);
        $orders = Order::dateRangeOrdersInReport($reportNumber, $beginDate, $endDate);
        foreach ($orders as $index => $value){
            $orders[$index] = ['orderNumber' => strval($value->orderNumber), 'isReported' => $value->isReported];
        }
        $return = array('orders' => $orders);
        return json_encode($return);
    }
}
