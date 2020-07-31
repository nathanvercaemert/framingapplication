@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Report
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/reports" novalidate>
                        {{ csrf_field() }}
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="beginDatepicker">Beginning:</label>
                            <div class="col w-50">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="beginDatepicker" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="beginDatepicker">Ending:</label>
                            <div class="col w-50">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="endDatepicker" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Please provide a mat number.
                        </div>
                        <p>
                            <button type="button" @click="hello" class="btn btn-primary" style="width:100%">Test</button>
                        </p>
                        <button type="submit" class="btn btn-primary" style="width:100%">Submit New Report</button>
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
            :variable0="0"
            :variable1="1"
></report-component>

@endsection
