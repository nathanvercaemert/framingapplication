@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Moulding
                </div>
                <div class="card-body">
                    <h5>Moulding Number</h5>
                    <p>{{ $moulding->mouldingNumber }}</p>
                    <h5>Vendor</h5>
                    <p>{{ $moulding->mouldingVendor }}</p>
                    <h5>Price</h5>
                    <p>{{ $moulding->mouldingPrice }}</p>
                    <p>
                        <a href="/mouldings/edit/{{$moulding->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Moulding</a>
                    </p>
                    <a href="/mouldings" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
