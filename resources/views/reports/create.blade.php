@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Create Report: {{$nextReportNumber}}
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/reports" name="reportForm" id="reportForm" novalidate>
                        {{ csrf_field() }}
                        <div class="form-row text-right mb-2" v-on:change="reportTypeChange" >
                            <label class="col w-50">Report Type:</label>
                            <div class="col w-50">
                                <div class="form-check text-left" >
                                    <input class="form-check-input" type="radio" name="reportTypes" id="reportTypesDateRange" value="1" checked>
                                    <label class="form-check-label" for="reportTypesDateRange">
                                        Date Range
                                    </label>
                                </div>
                                <div class="form-check text-left">
                                    <input class="form-check-input" type="radio" name="reportTypes" id="reportTypesSpecificOrders" value="0">
                                    <label class="form-check-label" for="reportTypesSpecificOrders">
                                        Specific Orders
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div :hidden="isDateRange == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="beginDatepicker">Beginning:</label>
                            <div class="col w-50">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="beginDatepicker" name="beginDatepicker" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :hidden="isDateRange == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="endDatepicker">Ending:</label>
                            <div class="col w-50">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="endDatepicker" name="endDatepicker" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :hidden="isSpecificOrders == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="test">Orders:</label>
                            <div class="col w-50 text-left">
                                <div :hidden="orderListCount == 0" id="orderList" class="list-group">
                                </div>
                                <p :hidden="orderListCount == 0">
                                </p>
                                <button :hidden="isSpecificOrders == 0" type="button" class="btn btn-primary" v-on:click="resetAddOrderModal" data-toggle="modal" data-target="#addOrder" style="width:100%">Add Order</button>
                            </div>
                        </div>
                        <input hidden type="text" name="submitOrderList" id="submitOrderList">
                        <input hidden type="text" name="isDateRange" id="isDateRange">
                        <input hidden type="text" name="isSpecificOrders" id="isSpecificOrders">
                        <input hidden type ="text" :value="{{$nextReportNumber}}" name="reportNumber" id="reportNumber">
                        <button type="button" id="submitButton" v-on:click="submitFunction" class="btn btn-primary" style="width:100%">Submit New Report</button>
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

<report-component ref="reportComponent"
            :orders="{{$orders}}"
            :variable0="0"
            :variable1="1"
></report-component>

@include('modals.reports.addOrder')
@include('modals.reports.viewOrder')

@endsection
