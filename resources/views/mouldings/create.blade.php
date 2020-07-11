@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add New Moulding
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/mouldings" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <label for="mouldingNumber">Moulding Number</label>
                            <input type="text" class="form-control" name="mouldingNumber" id="mouldingNumber" placeholder="1234" value="{{old('mouldingNumber')}}" style="{{ $errors->has('mouldingNumber') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a moulding number.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mouldingVendor">Vendor</label>
                            <select class="form-control" name="mouldingVendor" id="mouldingVendor" style="{{ $errors->has('mouldingVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{old('mouldingVendor')}}" seleted hidden>{{ old('mouldingVendor') != null ? old('mouldingVendor') : 'Vendor' }}</option>
                                @foreach($vendors as $vendor)
                                    <option>{{$vendor->vendor}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide a vendor.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mouldingPrice">Moulding Price</label>
                            <input type="text" class="form-control" name="mouldingPrice" id="mouldingPrice" placeholder="15.00" value="{{old('mouldingPrice')}}" style="{{ $errors->has('mouldingPrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a moulding price.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%">Submit New Moulding</button>
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
