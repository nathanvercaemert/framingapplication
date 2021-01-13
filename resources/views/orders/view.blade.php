@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form method="POST" action="/orders/complete/{{ $order->id }}" name="completeOrderForm" id="completeOrderForm">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div hidden id="orderNumber" value="{{$order->orderNumber}}"></div>
                        <div class="row">
                            <div class="col w-33 text-left">
                                Order: {{$order->orderNumber}}
                            </div>
                            <div class="col w-33 text-center">
                                Price: <span name="priceSpan" id="priceSpan"></span>
                            </div>
                            <div class="col w-33 text-right">
                                Report: {{$order->isReported ? $order->reportNumber : "Unreported"}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Date Created:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{substr($order->created_at, 0, 10)}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Date Completed:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->isCompleted ? substr($order->completed_at, 0, 10) : 'Incomplete'}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>First Name:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->customerFirst}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Last Name:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->customerLast}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Email Address:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->customerEmail}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Phone Number:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>({{$order->customerPhoneArea}}) {{$order->customerPhone3}} - {{$order->customerPhone4}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Order Type:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderType}}</a>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0" class="row">
                            <div class="col w-50 text-right">
                                <h5>Moulding Number:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderMouldingNumber}}</a>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0" class="row">
                            <div class="col w-50 text-right">
                                <h5>Glass Type:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderGlassType}}</a>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || {{$order->orderFirstMatNumber}} == -1" class="row">
                            <div class="col w-50 text-right">
                                <h5>Mat Number:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderFirstMatNumber}}</a>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || secondMatNumberIsVisible == 0" class="row">
                            <div class="col w-50 text-right">
                                <h5>Mat Number:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderSecondMatNumber}}</a>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || thirdMatNumberIsVisible == 0" class="row">
                            <div class="col w-50 text-right">
                                <h5>Mat Number:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderThirdMatNumber}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Foamcore Type:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderFoamcoreType}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Width:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderWidth}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Height:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderHeight}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50 text-right">
                                <h5>Notes:</h5>
                            </div>
                            <div class="col w-50 text-left">
                                <a>{{$order->orderNotes}}</a>
                            </div>
                        </div>
                        <div class="row" id="viewDrawingButtonRow">
                            <div class="col w-50 text-right">
                                <h5>Drawing:</h5>
                            </div>
                            <div class="col w-50">
                                <button type="button" class="btn btn-primary" style="width:100%" name="viewDrawingButton" id="viewDrawingButton">Show Drawing</button>
                            </div>
                        </div>
                        <div :hidden="canvasIsHidden == 1">
                            <p></p>
                            <div id="cContainer" style="position: relative;">
                                <canvas id="c" style="border: 5px solid #AAA;" width="100%" height="90vh"></canvas>
                            </div>
                        </div>
                        <p></p>
                        <p>
                            <button type="button" id="completionButton" v-on:click="completionFunction" class="btn btn-primary text-white" role="button" style="width:100%">{{$order->isCompleted ? 'Undo Completion' : 'Complete Order'}}</button>
                        </p>
                        <p>
                            <a href="/orders/edit/{{$order->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Order</a>
                        </p>
                        <a href="/orders" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<order-component ref="orderComponent"
                    :oldfirstmatnumber="{{$order->orderFirstMatNumber == -1 ? 0 : 1}}"
                    :oldsecondmatnumber="{{$order->orderSecondMatNumber == -1 ? 0 : 1}}"
                    :oldthirdmatnumber="{{$order->orderThirdMatNumber == -1 ? 0 : 1}}"
                    :oldisframe="{{$order->orderType == 'Frame' ? 1 : 0}}"
                    :isreported="{{$order->isReported}}"
                    :reportnumber="{{$order->reportNumber}}"
                    :price="{{$order->orderPrice}}"
></order-component>

<view-image-component ref="viewImageComponent"
></view-image-component>

@include('modals.orders.completionError')

@endsection
