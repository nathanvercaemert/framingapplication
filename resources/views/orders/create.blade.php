@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col w-50 text-left">
                            Create Order: {{$nextOrderNumber}}
                        </div>
                        <div class="col w-50 text-right">
                            Price: <span name="priceSpan" id="priceSpan"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/orders" novalidate>
                        {{ csrf_field() }}
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerFirst">First Name</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="customerFirst" id="customerFirst" placeholder="John" value="{{old('customerFirst')}}" style="{{ $errors->has('customerFirst') ? 'border-color:red' : '' }}">
                                <div class="invalid-feedback">
                                    Please provide a first name.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerLast">Last Name</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="customerLast" id="customerLast" placeholder="Doe" value="{{old('customerLast')}}" style="{{ $errors->has('customerLast') ? 'border-color:red' : '' }}">
                                <div class="invalid-feedback">
                                    Please provide a last name.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerEmail">Email</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="customerEmail" id="customerEmail" placeholder="johndoe@gmail.com" value="{{old('customerEmail')}}" style="{{ $errors->has('customerEmail') ? 'border-color:red' : '' }}">
                                <div class="invalid-feedback">
                                    Please provide an email address.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="customerPhoneArea">Phone</label>
                            <div class="col w-50">
                                <div class="row" style="margin: auto">
                                    <div style="width:30%">
                                        <input type="text" class="form-control" name="customerPhoneArea" id="customerPhoneArea" placeholder="123" value="{{old('customerPhoneArea')}}" style="{{ $errors->has('customerPhoneArea') ? 'border-color:red' : '' }}">
                                    </div>
                                    <div style="width:30%">
                                        <input type="text" class="form-control" name="customerPhone3" id="customerPhone3" placeholder="456" value="{{old('customerPhone3')}}" style="{{ $errors->has('customerPhone3') ? 'border-color:red' : '' }}">
                                    </div>
                                    <div style="width:40%">
                                        <input type="text" class="form-control" name="customerPhone4" id="customerPhone4" placeholder="7890" value="{{old('customerPhone4')}}" style="{{ $errors->has('customerPhone4') ? 'border-color:red' : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderType">Order Type</label>
                            <div class="col w-50">
                                <select v-on:change="orderTypeChange" class="form-control" name="orderType" id="orderType" style="{{ $errors->has('orderType') ? 'border-color:red' : '' }}" required>
                                    <option value="{{ old('orderType') != null ? old('orderType') : 'Frame' }}" seleted hidden>{{ old('orderType') != null ? old('orderType') : 'Frame' }}</option>
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
                                <input :disabled="isFrame == 0" type="text" class="form-control" name="orderMouldingNumber" id="orderMouldingNumber" placeholder="1234" value="{{old('orderMouldingNumber')}}" style="{{ $errors->has('orderMouldingNumber') ? 'border-color:red' : '' }}" :required="isFrame == 1">
                                <div class="invalid-feedback">
                                    Please provide a moulding number.
                                </div>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderGlassType">Glass Type</label>
                            <div class="col w-50">
                                <select :disabled="isFrame == 0"  class="form-control" name="orderGlassType" id="orderGlassType" style="{{ $errors->has('orderGlassType') ? 'border-color:red' : '' }}" :required="isFrame == 1">
                                    <option value="{{old('orderGlassType')}}" seleted hidden>{{ old('orderGlassType') != null ? old('orderGlassType') : 'Glass Type' }}</option>
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
                                    <input :disabled="isFrame == 0" @change="firstMatChange" type="text" class="form-control" name="firstMatNumber" id="firstMatNumber" placeholder="1234" value="{{old('firstMatNumber')}}" style="{{ $errors->has('firstMatNumber') ? 'border-color:red' : '' }}" :required="secondMatNumberIsVisible == 1">
                                    <div :hidden="secondMatNumberIsVisible == 1" class="input-group-append">
                                        <button @click="removeFirstMat" name="firstMatRemoveButton" id="firstMatRemoveButton" class="btn btn-outline-secondary" type="button">X</button>
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
                                <button type="button" @click="showSecondMatNumber" class="btn btn-primary" style="width:100%">Add Second Mat</button>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || secondMatNumberIsVisible == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="secondMatNumber">Mat Number</label>
                            <div class="col w-50">
                                <div class="input-group">
                                    <input :disabled="isFrame == 0 || secondMatNumberIsVisible == 0" type="text" class="form-control" name="secondMatNumber" id="secondMatNumber" placeholder="1234" value="{{old('secondMatNumber')}}" style="{{ $errors->has('secondMatNumber') ? 'border-color:red' : '' }}" :required="secondMatNumberIsVisible == 1">
                                    <div :hidden="thirdMatNumberIsVisible == 1" class="input-group-append">
                                        <button @click="hideSecondMatNumber" name="secondMatRemoveButton" id="secondMatRemoveButton" class="btn btn-outline-secondary" type="button">X</button>
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
                                <button type="button" @click="showThirdMatNumber" class="btn btn-primary" style="width:100%">Add Third Mat</button>
                            </div>
                        </div>
                        <div :hidden="isFrame == 0 || thirdMatNumberIsVisible == 0" class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="thirdMatNumber">Mat Number</label>
                            <div class="col w-50">
                                <div class="input-group">
                                    <input :disabled="isFrame == 0 || thirdMatNumberIsVisible == 0" type="text" class="form-control" name="thirdMatNumber" id="thirdMatNumber" placeholder="1234" value="{{old('thirdMatNumber')}}" style="{{ $errors->has('thirdMatNumber') ? 'border-color:red' : '' }}" :required="thirdMatNumberIsVisible == 1">
                                    <div class="input-group-append">
                                        <button @click="hideThirdMatNumber" name="thirdMatRemoveButton" id="thirdMatRemoveButton" class="btn btn-outline-secondary" type="button">X</button>
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
                                <select class="form-control" name="orderFoamcoreType" id="orderFoamcoreType" style="{{ $errors->has('orderFoamcoreType') ? 'border-color:red' : '' }}" required>
                                    <option value="{{old('orderFoamcoreType')}}" seleted hidden>{{ old('orderFoamcoreType') != null ? old('orderFoamcoreType') : 'Foamcore Type' }}</option>
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
                                <input type="text" class="form-control" name="orderWidth" id="orderWidth" placeholder="36" value="{{old('orderWidth')}}" style="{{ $errors->has('orderWidth') ? 'border-color:red' : '' }}" required>
                                <div class="invalid-feedback">
                                    Please provide a width.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderHeight">Height</label>
                            <div class="col w-50">
                                <input type="text" class="form-control" name="orderHeight" id="orderHeight" placeholder="24" value="{{old('orderHeight')}}" style="{{ $errors->has('orderHeight') ? 'border-color:red' : '' }}" required>
                                <div class="invalid-feedback">
                                    Please provide a height.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2">
                            <label class="col w-50 col-form-label" for="orderNotes">Notes</label>
                            <div class="col w-50">
                                <textarea type="text" class="form-control" name="orderNotes" id="orderNotes" placeholder="Notes">{{old('orderNotes')}}</textarea>
                            </div>
                        </div>
                        <div class="form-row text-right mb-2" id="drawingButtonRow">
                            <label class="col w-50 col-form-label" for="drawingButton">Drawing</label>
                            <div class="col w-50">
                                <button type="button" class="btn btn-primary" style="width:100%" name="drawingButton" id="drawingButton">Show Drawing</button>
                            </div>
                        </div>
                        <div :hidden="canvasIsHidden == 1">
                            <div class="form-row">
                                <div class="col float-left">
                                    <button type="button" class="btn btn-primary" name="drawingModeButton" id="drawingModeButton">Enter Drawing Mode</button>
                                </div>
                                <div :hidden="isDrawingMode == 1" class="col input-group float-right">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary" type="button" id="textButton" >Add Text</button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Input Text" id="canvasInputText" onkeydown="return event.key != 'Enter';">
                                </div>
                            </div>
                            <div id="cContainer" style="position: relative;">
                                <canvas id="c" style="" width="100%" height="90vh" @change="updateCanvasJSON"></canvas>
                            </div>
                            <div class="form-row" >
                                <div :hidden="isDrawingMode == 0" class="col float-left">
                                    <button type="button" class="btn btn-primary col float-right" name="eraserButton" id="eraserButton">Eraser</button>
                                </div>
                                <div :hidden="isDrawingMode == 0" class="col float-left">
                                    <button type="button" class="btn btn-primary col float-right" name="pencilButton" id="pencilButton">Pencil</button>
                                </div>
                                <div :hidden="isDrawingMode == 0" class="col float-right">
                                    <button type="button" class="btn btn-primary col float-right" name="undoButton" id="undoButton">Undo</button>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <!-- Passing javascript variables to request -->
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
                            <input type ="text" :value="{{$nextOrderNumber}}" name="orderNumber" id="orderNumber">
                        </div>
                        <div hidden>
                            <input type ="text" :value="canvasJSON" name="canvasJSON" id="canvasJSON">
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%; position:relative">Submit Order</button>
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

<order-component ref="orderComponent"
                    :oldfirstmatnumber="{{old('firstMatNumber') == null ? 0 : 1}}"
                    :oldsecondmatnumber="{{old('secondMatNumber') == null ? 0 : 1}}"
                    :oldthirdmatnumber="{{old('thirdMatNumber') == null ? 0 : 1}}"
                    :oldisframe="{{old('isFrame') == null ? 1 : old('isFrame')}}"
                    :reportnumber="-2"
                    :price="0"
></order-component>

<price-update-component ref="priceUpdateComponent"
                            :priceupdatetest="0"
                            :isediting="0"
></price-update-component>

<create-image-component ref="createImageComponent"
                            :createimagetest="0"
                            :isold="{{old('orderNumber') != null ? 1 : 0}}"
                            :isediting="0"
></create-image-component>

@endsection
