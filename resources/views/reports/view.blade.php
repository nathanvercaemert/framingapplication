@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col w-50 text-left">
                            Report: {{$report->reportNumber}}
                        </div>
                        <div class="col w-50 text-right">
                            Date Processed: {{$report->isProcessed ? substr($report->processed_at, 0, 10) : 'Unprocessed'}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col w-50 text-right">
                            <h5>Date Reported:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <a>{{substr($report->created_at, 0, 10)}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col w-50 text-right">
                            <h5>Orders:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <button type="button" class="btn btn-primary" v-on:click="populateReportOrdersListGroup" data-toggle="modal" data-target="#reportOrderListModal" style="width:100%">View Orders</button>
                        </div>
                    </div>
                    <div :hidden="viewIsDateRange == 0" class="row">
                        <div class="col w-50 text-right">
                            <h5>Date Range Start:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <a>{{$report->reportIsDateRange ? substr($report->beginDate, 0, 10) : 'Specific Orders'}}</a>
                        </div>
                    </div>
                    <div :hidden="viewIsDateRange == 0" class="row">
                        <div class="col w-50 text-right">
                            <h5>Date Range End:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <a id="viewDateRangeEnd" name="viewDateRangeEnd"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col w-50 text-right">
                            <h5>Notes:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <a>{{$report->reportNotes}}<a>
                        </div>
                    </div>
                    <p>
                        <a href="/reports/edit/{{$report->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Report</a>
                    </p>
                    <a href="/reports" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

<report-view-component ref="reportViewComponent"
            reportorders="{{$report->reportOrderList}}"
            reportordersnonid="{{$viewOrders}}"
            isdaterange="{{$report->reportIsDateRange}}"
            daterangeend="{{$report->endDate}}"
></report-view-component>

@include('modals.reports.reportOrders')

@endsection
