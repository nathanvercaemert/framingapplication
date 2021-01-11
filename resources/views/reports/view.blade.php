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
                            <h5>Date Created:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <a>{{substr($report->created_at, 0, 10)}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col w-50 text-right">
                            <h5>Report Type:</h5>
                        </div>
                        <div class="col w-50 text-left">
                            <a>{{$report->reportIsDateRange ? "Date Range" : "Specific Orders"}}</a>
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
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th scope="col">Vendor</th>
                            <th scope="col">Material</th>
                            <th scope="col">Identifier</th>
                            <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendors as $vendor=>$materialTypes)
                                <tr>
                                    <th scope="row">{{$vendor}}</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach($materialTypes as $materialType=>$materials)
                                    <tr>
                                        <th scope="row"></th>
                                        <td>{{ucfirst($materialType)}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach($materials as $material=>$quantity)
                                        <tr>
                                            <th scope="row"></th>
                                            <td></td>
                                            <td>{{ strlen($material) > 9 && substr($material, 0, 9) === "matNumber" || strlen($material) > 14 && substr($material, 0, 14) === "mouldingNumber" ? strlen($material) > 14 ? substr($material, 14) : substr($material, 9) : $material}}</td>
                                            <td class="border">{{$quantity}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <p >
                        <button :disabled="{{$report->isProcessed}} == 1"type="button" class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#processReport" style="width:100%">Process Report</button>
                    </p>
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
            reportviewid="{{$report->id}}"
></report-view-component>

@include('modals.reports.reportOrders')
@include('modals.reports.processReport')

@endsection
