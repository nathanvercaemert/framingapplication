@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Orders
                </div>
                <div class="card-body">
                    <p>
                        <a href="/orders/list" class="btn btn-primary" role="button" style="width:100%">List Orders</a>
                    </p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#viewOrder" style="width:100%">View Order</p>
                    <p class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#editOrder" style="width:100%">Edit Order</p>
                    <a href="/orders/create" @click="resetCreateOrder" class="btn btn-primary" role="button" style="width:100%">Create Order</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.orders.view')
@include('modals.orders.edit')

@endsection
