@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Reports
                </div>
                <div class="card-body">
                    <p>
                        <a href="/reports/list" class="btn btn-primary" role="button" style="width:100%">List Reports</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewReport" style="width:100%">View Report</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editReport" style="width:100%">Edit Report</p>
                    <a href="/reports/create" v-on:click="resetOrderList" class="btn btn-primary" role="button" style="width:100%">Create Report</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.reports.view')
@include('modals.reports.edit')

@endsection
