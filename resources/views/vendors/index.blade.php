@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Vendors
                </div>
                <div class="card-body">
                    <p>
                        <a href="/vendors/list" class="btn btn-primary" role="button" style="width:100%">List Vendors</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewVendor" style="width:100%">View Vendor</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editVendor" style="width:100%">Edit Vendor</p>
                    <a href="/vendors/create" class="btn btn-primary" role="button" style="width:100%">Add New Vendor</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.vendors.edit')
@include('modals.vendors.view')

@endsection
