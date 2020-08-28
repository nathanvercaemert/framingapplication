@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Mats
                </div>
                <div class="card-body">
                    <p>
                        <a href="/mats/list" class="btn btn-primary" role="button" style="width:100%">List Mats</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewMat" style="width:100%">View Mat</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editMat" style="width:100%">Edit Mat</p>
                    <a href="/mats/create" class="btn btn-primary" role="button" style="width:100%">Add New Mat</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.mats.view')
@include('modals.mats.edit')

@endsection
