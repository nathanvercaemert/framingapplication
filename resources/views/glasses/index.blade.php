@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Glasses
                </div>
                <div class="card-body">
                    <p>
                        <a href="/glasses/list" class="btn btn-primary" role="button" style="width:100%">List Glasses</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewGlass" style="width:100%">View Glass</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editGlass" style="width:100%">Edit Glass</p>
                    <a href="/glasses/create" class="btn btn-primary" role="button" style="width:100%">Add New Glass</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.glasses.edit')
@include('modals.glasses.view')

@endsection
