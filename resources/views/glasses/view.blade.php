@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Glass
                </div>
                <div class="card-body">
                    <h5>Glass Type</h5>
                    <p>{{ $glass->glassType }}</p>
                    <h5>Vendor</h5>
                    <p>{{ $glass->glassVendor }}</p>
                    <h5>Price</h5>
                    <p>{{ $glass->glassPrice }}</p>
                    <p>
                        <a href="/glasses/edit/{{$glass->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Glass</a>
                    </p>
                    <a href="/glasses" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
