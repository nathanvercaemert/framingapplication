@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Add New Glass
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/glasses" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <label for="glassType">Glass Type</label>
                            <input type="text" class="form-control" name="glassType" id="glassType" placeholder="Conservation" value="{{old('glassType')}}" style="{{ $errors->has('glassType') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a glass type.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="glassVendor">Vendor</label>
                            <select class="form-control" name="glassVendor" id="glassVendor" style="{{ $errors->has('glassVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{old('glassVendor')}}" seleted hidden>{{ old('glassVendor') != null ? old('glassVendor') : 'Vendor' }}</option>
                                @foreach($vendors as $vendor)
                                    <option>{{$vendor->vendor}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide a vendor.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="glassPrice">Glass Price</label>
                            <input type="text" class="form-control" name="glassPrice" id="glassPrice" placeholder="15.00" value="{{old('glassPrice')}}" style="{{ $errors->has('glassPrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a glass price.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%">Submit New Glass</button>
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

@endsection
