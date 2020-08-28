@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit Foamcore
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/foamcores/edit/{{ $foamcore->id }}" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <h5>Foamcore Type</h5>
                        <p>{{ $foamcore->foamcoreType }}</p>
                        <div class="form-group">
                            <h5>
                                <label for="foamcoreVendor">Vendor</label>
                            </h5>
                            <select class="form-control" name="foamcoreVendor" id="foamcoreVendor" style="{{ $errors->has('foamcoreVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{ old('foamcoreVendor') != null ? old('foamcoreVendor') : $foamcore->foamcoreVendor }}" selected hidden>{{ old('foamcoreVendor') != null ? old('foamcoreVendor') : $foamcore->foamcoreVendor }}</option>
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
                                <label for="foamcorePrice">Foamcore Price</label>
                            </h5>
                            <input type="text" class="form-control" name="foamcorePrice" id="foamcorePrice" value="{{ old('foamcorePrice') != null ? old('foamcorePrice') : $foamcore->foamcorePrice }}" style="{{ $errors->has('foamcorePrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a foamcore price.
                            </div>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary" style="width:100%">Submit Edit</button>
                        </p>
                        <a class="btn btn-primary text-white" role="button" style="width:100%" data-toggle="modal" data-target="#deleteFoamcore" >Delete Foamcore</a>
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

@include('modals.foamcores.delete')

@endsection
