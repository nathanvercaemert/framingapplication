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
                    <report-view-component ref="reportViewComponent"
                                reportorders="{{$report->reportOrderList}}"
                                reportordersnonid="{{$viewOrders}}"
                                isdaterange="{{$report->reportIsDateRange}}"
                                daterangeend="{{$report->endDate}}"
                                reportviewid="{{$report->id}}"

                                createdate="{{substr($report->created_at, 0, 10)}}"
                                reporttype="{{$report->reportIsDateRange ? "Date Range" : "Specific Orders"}}"
                                daterangestart="{{$report->reportIsDateRange ? substr($report->beginDate, 0, 10) : 'Specific Orders'}}"
                                reportnotes="{{$report->reportNotes}}"
                                reportisprocessed="{{$report->isProcessed}}"

                                vendors="{{$vendors}}"
                    ></report-view-component>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.reports.reportOrders')
@include('modals.reports.processReport')

@endsection
