@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Mouldings
                </div>
                <div class="card-body">
                    <p>
                        <a href="/mouldings/list" class="btn btn-primary" role="button" style="width:100%">List Mouldings</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewMoulding" style="width:100%">View Moulding</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editMoulding" style="width:100%">Edit Moulding</p>
                    <a href="/mouldings/create" class="btn btn-primary" role="button" style="width:100%">Add New Moulding</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.mouldings.view')
@include('modals.mouldings.edit')

@endsection
