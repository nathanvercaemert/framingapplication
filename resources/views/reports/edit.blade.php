@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit Report: {{$report->reportNumber}}
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/reports/edit/{{ $report->id }}" name="editReportForm" id="editReportForm" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-row text-right mb-2" v-on:change="editReportTypeChange" >
                            <label class="col w-50">Report Type:</label>
                            <div class="col w-50">
                                <div class="form-check text-left" >
                                    <input disabled class="form-check-input" type="radio" name="editReportTypes" id="editReportTypesDateRange" :value="editIsDateRange == 1" :checked="editIsDateRange == 1">
                                    <label class="form-check-label" for="editReportTypesDateRange">
                                        Date Range
                                    </label>
                                </div>
                                <div class="form-check text-left">
                                    <input disabled class="form-check-input" type="radio" name="editReportTypes" id="editReportTypesSpecificOrders" :value="editIsSpecificOrders == 1" :checked="editIsSpecificOrders == 1">
                                    <label class="form-check-label" for="editReportTypesSpecificOrders">
                                        Specific Orders
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="list-group">
                                <div class="form-row mb-2">
                                    <div class="col w-50"></div>
                                    <div class="col w-50">
                                        <li class="list-group-item list-group-item-secondary">Type can not be edited.</li>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div :hidden="editIsDateRange == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="editBeginDatepicker">Beginning:</label>
                            <div class="col w-50">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="editBeginDatepicker" name="editBeginDatepicker" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :hidden="editIsDateRange == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="editEndDatepicker">Ending:</label>
                            <div class="col w-50">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="editEndDatepicker" name="editEndDatepicker" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :hidden="editIsDateRange == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="buttonToPopulateDateRangeOrders">To Be Reported:</label>
                            <div class="col w-50 text-left">
                                <button type="button" class="btn btn-primary" name="buttonToPopulateDateRangeOrders" id="buttonToPopulateDateRangeOrders" v-on:click="populateEditDateRangeOrders" data-toggle="modal" data-target="#editDateRangeOrdersModal" style="width:100%">View Orders</button>
                            </div>
                        </div>
                        <div :hidden="editIsSpecificOrders == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="test">Orders:</label>
                            <div class="col w-50 text-left">
                                <div :hidden="editOrderListCount == 0" id="editOrderList" class="list-group">
                                </div>
                                <p :hidden="editOrderListCount == 0">
                                </p>
                                <button :hidden="editIsSpecificOrders == 0" type="button" class="btn btn-primary" v-on:click="editResetAddOrderModal" data-toggle="modal" data-target="#editAddOrder" style="width:100%">Add Order</button>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="editReportNotes">Notes:</label>
                            <div class="col w-50">
                                <textarea type="text" class="form-control" name="editReportNotes" id="editReportNotes" value="{{ old('editReportNotes') != null ? old('editReportNotes') : $report->reportNotes }}">{{ old('editReportNotes') != null ? old('editReportNotes') : $report->reportNotes }}</textarea>
                            </div>
                        </div>
                        <input hidden type="text" name="editUnreportCheckList" id="editUnreportCheckList">
                        <input hidden type="text" name="editSubmitOrderList" id="editSubmitOrderList">
                        <input hidden type="text" name="editIsDateRange" id="editIsDateRange">
                        <input hidden type="text" name="editIsSpecificOrders" id="editIsSpecificOrders">
                        <input hidden type="text" :value="{{$report->reportNumber}}" name="editReportNumber" id="editReportNumber">
                        <input hidden type="text" value=-1 name="editDateRangeOrders" id="editDateRangeOrders">
                        <button type="button" id="editSubmitButton" v-on:click="editSubmitFunction" class="btn btn-primary" style="width:100%">Submit Edit</button>
                    </form>
                    @if ($errors->any())
                        <p></p>
                        <div>
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<edit-report-component ref="editReportComponent"
            :editorders="{{$editOrders}}"
            isdaterange="{{$report->reportIsDateRange}}"
            isspecificorders="{{$report->reportIsSpecificOrders}}"
            daterangeend="{{ old('editEndDatepicker') != null ? old('editEndDatepicker') : $report->endDate }}"
            daterangebegin="{{ old('editBeginDatepicker') != null ? old('editBeginDatepicker') : $report->beginDate }}"
            reportnumber="{{$report->reportNumber}}"
></edit-report-component>

@include('modals.reports.editAddOrder')
@include('modals.reports.editViewOrder')
@include('modals.reports.editReportContainsOrdersVerification')
@include('modals.reports.editDateRangeOrders')

@endsection
