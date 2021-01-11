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
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order Number</th>
                            <th scope="col">Created</th>
                            <th scope="col">Report</th>
                            <th scope="col">Completed</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                <th scope="row">{{ $order->orderNumber }}</th>
                                <td>{{ substr($order->created_at, 0, 10)}}</td>
                                <td>{{ $order->isReported ? $order->reportNumber : 'Unreported'}}</td>
                                <td>{{ $order->isCompleted ? substr($order->completed_at, 0, 10) : 'Incomplete'}}</td>
                                <td>
                                    <a href="/orders/view/{{$order->id}}" class="btn btn-primary" role="button" style="width:100%">View</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
