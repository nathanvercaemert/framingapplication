@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Glass
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/glasses/edit/{{ $glass->id }}" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <h5>Glass Type</h5>
                        <p>{{ $glass->glassType }}</p>
                        <div class="form-group">
                            <h5>
                                <label for="glassVendor">Vendor</label>
                            </h5>
                            <select class="form-control" name="glassVendor" id="glassVendor" style="{{ $errors->has('glassVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{ old('glassVendor') != null ? old('glassVendor') : $glass->glassVendor }}" selected hidden>{{ old('glassVendor') != null ? old('glassVendor') : $glass->glassVendor }}</option>
                                @foreach($vendors as $vendor)
                                    <option>{{ $vendor->vendor }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide a vendor.
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>
                                <label for="glassPrice">Glass Price</label>
                            </h5>
                            <input type="text" class="form-control" name="glassPrice" id="glassPrice" value="{{ old('glassPrice') != null ? old('glassPrice') : $glass->glassPrice }}" style="{{ $errors->has('glassPrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a glass price.
                            </div>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary" style="width:100%">Submit Edit</button>
                        </p>
                        <a class="btn btn-primary text-white" role="button" style="width:100%" data-toggle="modal" data-target="#deleteGlass" >Delete Glass</a>
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

@include('modals.glasses.delete')

@endsection
