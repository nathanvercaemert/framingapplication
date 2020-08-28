@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Add New Foamcore
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/foamcores" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <label for="foamcoreType">Foamcore Type</label>
                            <input type="text" class="form-control" name="foamcoreType" id="foamcoreType" placeholder="Thick"  value="{{old('foamcoreType')}}" style="{{ $errors->has('foamcoreType') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a foamcore type.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foamcoreVendor">Vendor</label>
                            <select class="form-control" name="foamcoreVendor" id="foamcoreVendor" style="{{ $errors->has('foamcoreVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{old('foamcoreVendor')}}" seleted hidden>{{ old('foamcoreVendor') != null ? old('foamcoreVendor') : 'Vendor' }}</option>
                                @foreach($vendors as $vendor)
                                    <option>{{$vendor->vendor}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide a vendor.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foamcorePrice">Foamcore Price</label>
                            <input type="text" class="form-control" name="foamcorePrice" id="foamcorePrice" placeholder="15.00"  value="{{old('foamcorePrice')}}" style="{{ $errors->has('foamcorePrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a foamcore price.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%">Submit New Foamcore</button>
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
