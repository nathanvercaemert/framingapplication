@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Foamcores
                </div>
                <div class="card-body">
                    <p>
                        <a href="/foamcores/list" class="btn btn-primary" role="button" style="width:100%">List Foamcores</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewFoamcore" style="width:100%">View Foamcore</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editFoamcore" style="width:100%">Edit Foamcore</p>
                    <a href="/foamcores/create" class="btn btn-primary" role="button" style="width:100%">Add New Foamcore</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.foamcores.view')
@include('modals.foamcores.edit')

@endsection
