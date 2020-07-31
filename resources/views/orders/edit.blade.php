@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Order: {{$order->orderNumber}}
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/orders/edit/{{ $order->id }}" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerFirst">First Name</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="customerFirst" id="customerFirst" value="{{ old('customerFirst') != null ? old('customerFirst') : $order->customerFirst }}" style="{{ $errors->has('customerFirst') ? 'border-color:red' : '' }}">
                                <div class="invalid-feedback">
                                    Please provide a first name.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerLast">Last Name</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="customerLast" id="customerLast" value="{{ old('customerLast') != null ? old('customerLast') : $order->customerLast }}" style="{{ $errors->has('customerLast') ? 'border-color:red' : '' }}">
                                <div class="invalid-feedback">
                                    Please provide a last name.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerEmail">Email</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="customerEmail" id="customerEmail" value="{{ old('customerEmail') != null ? old('customerEmail') : $order->customerEmail }}" style="{{ $errors->has('customerEmail') ? 'border-color:red' : '' }}">
                                <div class="invalid-feedback">
                                    Please provide an email address.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerPhoneArea">Phone</label>
                            <div class="col w-50">
                                <div class="row">
                                    <div class="col" style="padding-right:0">
                                        <input type="text" class="form-control" name="customerPhoneArea" id="customerPhoneArea" value="{{ old('customerPhoneArea') != null ? old('customerPhoneArea') : $order->customerPhoneArea }}" style="{{ $errors->has('customerPhoneArea') ? 'border-color:red' : '' }}">
                                    </div>
                                    <div class="col" style="padding:0">
                                        <input type="text" class="form-control" name="customerPhone3" id="customerPhone3" value="{{ old('customerPhone3') != null ? old('customerPhone3') : $order->customerPhone3 }}" style="{{ $errors->has('customerPhone3') ? 'border-color:red' : '' }}">
                                    </div>
                                    <div class="col" style="padding-left:0">
                                        <input type="text" class="form-control" name="customerPhone4" id="customerPhone4" value="{{ old('customerPhone4') != null ? old('customerPhone4') : $order->customerPhone4 }}" style="{{ $errors->has('customerPhone4') ? 'border-color:red' : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderType">Order Type</label>
                            <div class="col w-50">
                                <select :disabled="{{$order->isReported}} == 1" v-on:change="orderTypeChange" class="form-control" name="orderType" id="orderType" style="{{ $errors->has('orderType') ? 'border-color:red' : '' }}" required>
                                    <option value="{{ old('orderType') != null ? old('orderType') : $order->orderType }}" seleted hidden>{{ old('orderType') != null ? old('orderType') : $order->orderType }}</option>
                                    <option>Frame</option>
                                    <option>Mount</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select an order type.
                                </div>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderMouldingNumber">Moulding Number</label>
                            <div class="col w-50">
                                <input :disabled="isFrame == 0 || {{$order->isReported}} == 1" type="text" class="form-control" name="orderMouldingNumber" id="orderMouldingNumber" placeholder="1234" value="{{ old('orderMouldingNumber') != null ? old('orderMouldingNumber') : ($order->orderMouldingNumber == -1 ? '' : $order->orderMouldingNumber) }}" style="{{ $errors->has('orderMouldingNumber') ? 'border-color:red' : '' }}" :required="isFrame == 1">
                                <div class="invalid-feedback">
                                    Please provide a moulding number.
                                </div>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderGlassType">Glass Type</label>
                            <div class="col w-50">
                                <select :disabled="isFrame == 0 || {{$order->isReported}} == 1"  class="form-control" name="orderGlassType" id="orderGlassType" style="{{ $errors->has('orderGlassType') ? 'border-color:red' : '' }}" :required="isFrame == 1">
                                    <option value="{{ old('orderGlassType') != null ? old('orderGlassType') : ($order->orderGlassType == -1 ? '' : $order->orderGlassType)}}" seleted hidden>{{ old('orderGlassType') != null ? old('orderGlassType') : ($order->orderGlassType == -1 ? 'Glass Type' : $order->orderGlassType) }}</option>
                                    @foreach($glasses as $glass)
                                        <option>{{$glass->glassType}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a glass type.
                                </div>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="firstMatNumber">Mat Number</label>
                            <div class="col w-50">
                                <div class="input-group">
                                    <input :disabled="isFrame == 0 || {{$order->isReported}} == 1" type="text" class="form-control" name="firstMatNumber" id="firstMatNumber" placeholder="1234" value="{{old('firstMatNumber') != null ? old('firstMatNumber') : ($order->orderFirstMatNumber == -1 ? '' : $order->orderFirstMatNumber)}}" style="{{ $errors->has('firstMatNumber') ? 'border-color:red' : '' }}" :required="secondMatNumberIsVisible == 1">
                                    <div :hidden="secondMatNumberIsVisible == 1" class="input-group-append">
                                        <button @click="removeFirstMat" class="btn btn-outline-secondary" type="button">X</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a mat number.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || secondMatNumberIsVisible == 1 || thirdMatNumberIsVisible == 1" class="form-row mb-2">
                            <div class="col w-50">
                            </div>
                            <div class="col w-50">
                                <button :disabled="{{$order->isReported}} == 1" type="button" @click="showSecondMatNumber" class="btn btn-primary" style="width:100%">Add Second Mat</button>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || secondMatNumberIsVisible == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="secondMatNumber">Mat Number</label>
                            <div class="col w-50">
                                <div class="input-group">
                                    <input :disabled="isFrame == 0 || secondMatNumberIsVisible == 0 || {{$order->isReported}} == 1" type="text" class="form-control" name="secondMatNumber" id="secondMatNumber" value="{{ old('secondMatNumber') != null ? old('secondMatNumber') : ($order->orderSecondMatNumber == -1 ? '' : $order->orderSecondMatNumber)}}" style="{{ $errors->has('secondMatNumber') ? 'border-color:red' : '' }}" :required="secondMatNumberIsVisible == 1">
                                    <div :hidden="thirdMatNumberIsVisible == 1" class="input-group-append">
                                        <button @click="hideSecondMatNumber" class="btn btn-outline-secondary" type="button">X</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a mat number.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || secondMatNumberIsVisible == 0 || thirdMatNumberIsVisible == 1" class="form-row mb-2">
                            <div class="col w-50">
                            </div>
                            <div class="col w-50">
                                <button :disabled="{{$order->isReported}} == 1" type="button" @click="showThirdMatNumber" class="btn btn-primary" style="width:100%">Add Third Mat</button>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || thirdMatNumberIsVisible == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="thirdMatNumber">Mat Number</label>
                            <div class="col w-50">
                                <div class="input-group">
                                    <input :disabled="isFrame == 0 || thirdMatNumberIsVisible == 0 || {{$order->isReported}} == 1" type="text" class="form-control" name="thirdMatNumber" id="thirdMatNumber" value="{{ old('thirdMatNumber') != null ? old('thirdMatNumber') : ($order->orderThirdMatNumber == -1 ? '' : $order->orderThirdMatNumber)}}" style="{{ $errors->has('thirdMatNumber') ? 'border-color:red' : '' }}" :required="thirdMatNumberIsVisible == 1">
                                    <div class="input-group-append">
                                        <button :disabled="{{$order->isReported}} == 1" @click="hideThirdMatNumber" class="btn btn-outline-secondary" type="button">X</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a mat number.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderFoamcoreType">Foamcore Type</label>
                            <div class="col w-50">
                                <select :disabled="{{$order->isReported}} == 1" class="form-control" name="orderFoamcoreType" id="orderFoamcoreType" style="{{ $errors->has('orderFoamcoreType') ? 'border-color:red' : '' }}" required>
                                    <option value="{{ old('orderFoamcoreType') != null ? old('orderFoamcoreType') : $order->orderFoamcoreType }}" seleted hidden>{{ old('orderFoamcoreType') != null ? old('orderFoamcoreType') : $order->orderFoamcoreType }}</option>
                                    @foreach($foamcores as $foamcore)
                                        <option>{{$foamcore->foamcoreType}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a foamcore type.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderWidth">Width</label>
                            <div class="col w-50">
                                <input :disabled="{{$order->isReported}} == 1" type="text" class="form-control" name="orderWidth" id="orderWidth" value="{{ old('orderWidth') != null ? old('orderWidth') : $order->orderWidth }}" style="{{ $errors->has('orderWidth') ? 'border-color:red' : '' }}" required>
                                <div class="invalid-feedback">
                                    Please provide a width.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderHeight">Height</label>
                            <div class="col w-50">
                                <input :disabled="{{$order->isReported}} == 1"type="text" class="form-control" name="orderHeight" id="orderHeight" value="{{ old('orderHeight') != null ? old('orderHeight') : $order->orderHeight }}" style="{{ $errors->has('orderHeight') ? 'border-color:red' : '' }}" required>
                                <div class="invalid-feedback">
                                    Please provide a height.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderNotes">Notes</label>
                            <div class="col w-50">
                                <textarea type="text" class="form-control" name="orderNotes" id="orderNotes" value="{{ old('orderNotes') != null ? old('orderNotes') : $order->orderNotes }}">{{ old('orderNotes') != null ? old('orderNotes') : $order->orderNotes }}</textarea>
                                <div class="invalid-feedback">
                                    Please provide a height.
                                </div>
                            </div>
                        </div>
                        <!-- Passing javascript variables (and other variables) to request -->
                        <div hidden>
                            <input type ="text" :value="firstMatPresent" name="firstMatPresent" id="firstMatPresent">
                        </div>
                        <div hidden>
                            <input type ="text" :value="isFrame" name="isFrame" id="isFrame">
                        </div>
                        <div hidden>
                            <input type ="text" :value="secondMatNumberIsVisible" name="secondMatNumberIsVisible" id="secondMatNumberIsVisible">
                        </div>
                        <div hidden>
                            <input type ="text" :value="thirdMatNumberIsVisible" name="thirdMatNumberIsVisible" id="thirdMatNumberIsVisible">
                        </div>
                        <div hidden>
                            <input type ="text" :value="{{$order->orderNumber}}" name="orderNumber" id="orderNumber">
                        </div>
                        <div hidden>
                            <input type ="text" :value="{{$order->isReported}}" name="isReported" id="isReported">
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary" style="width:100%">Submit Edit</button>
                        </p>
                        <a class="btn btn-primary text-white" role="button" style="width:100%" data-toggle="modal" data-target="#deleteOrder">Delete Order</a>
                    </form>
                    @if ($errors->any())
                        <p></p>
                        <div>
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.orders.delete')

<order-component ref="orderComponent"
                    :oldsecondmatnumber="{{old('secondMatNumber') == null ? ($order->orderSecondMatNumber == -1 ? 0 : 1) : 1}}"
                    :oldthirdmatnumber="{{old('thirdMatNumber') == null ? ($order->orderThirdMatNumber == -1 ? 0 : 1) : 1}}"
                    :oldisframe="{{old('isFrame') == null ? ($order->orderType == 'Frame' ? 1 : 0) : old('isFrame')}}"
></order-component>

@endsection
