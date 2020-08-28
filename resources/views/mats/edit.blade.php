@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit Mat
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/mats/edit/{{ $mat->id }}" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <h5>Mat Number</h5>
                        <p>{{ $mat->matNumber }}</p>
                        <div class="form-group">
                            <h5>
                                <label for="matVendor">Vendor</label>
                            </h5>
                            <select class="form-control" name="matVendor" id="matVendor" requiredstyle="{{ $errors->has('matVendor') ? 'border-color:red' : '' }}" >
                                <option value="{{ old('matVendor') != null ? old('matVendor') : $mat->matVendor }}" selected hidden>{{ old('matVendor') != null ? old('matVendor') : $mat->matVendor }}</option>
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
                                <label for="matPrice">Mat Price</label>
                            </h5>
                            <input type="text" class="form-control" name="matPrice" id="matPrice" value="{{ old('matPrice') != null ? old('matPrice') : $mat->matPrice }}" style="{{ $errors->has('mouldingPrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a mat price.
                            </div>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary" style="width:100%">Submit Edit</button>
                        </p>
                        <a class="btn btn-primary text-white" role="button" style="width:100%" data-toggle="modal" data-target="#deleteMat" >Delete Mat</a>
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

@include('modals.mats.delete')

@endsection
