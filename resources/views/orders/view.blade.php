@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Order
                </div>
                <div class="card-body">
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
                    <p>
                        <a href="/orders/edit/{{$order->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Order</a>
                    </p>
                    <a href="/orders" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

<order-component ref="orderComponent"
                    :oldsecondmatnumber="{{$order->orderSecondMatNumber == -1 ? 0 : 1}}"
                    :oldthirdmatnumber="{{$order->orderThirdMatNumber == -1 ? 0 : 1}}"
                    :oldisframe="{{$order->orderType == 'Frame' ? 1 : 0}}"
></order-component>

@endsection
