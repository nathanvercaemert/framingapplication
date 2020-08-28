@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Mat
                </div>
                <div class="card-body">
                    <h5>Mat Number</h5>
                    <p>{{ $mat->matNumber }}</p>
                    <h5>Vendor</h5>
                    <p>{{ $mat->matVendor }}</p>
                    <h5>Price</h5>
                    <p>{{ $mat->matPrice }}</p>
                    <p>
                        <a href="/mats/edit/{{$mat->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Mat</a>
                    </p>
                    <a href="/mats" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
