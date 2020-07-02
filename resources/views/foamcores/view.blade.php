@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Foamcore
                </div>
                <div class="card-body">
                    <h5>Foamcore Type</h5>
                    <p>{{ $foamcore->foamcoreType }}</p>
                    <h5>Vendor</h5>
                    <p>{{ $foamcore->foamcoreVendor }}</p>
                    <h5>Price</h5>
                    <p>{{ $foamcore->foamcorePrice }}</p>
                    <p>
                        <a href="/foamcores/edit/{{$foamcore->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Foamcore</a>
                    </p>
                    <a href="/foamcores" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
