@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Vendor
                </div>
                <div class="card-body">
                    <h5>Vendor</h5>
                    <p>{{ $vendor->vendor }}</p>
                    <h5>Notes</h5>
                    <p>{{ $vendor->vendorNotes }}</p>
                    <p>
                        <a href="/vendors/edit/{{$vendor->id}}" class="btn btn-primary text-white" role="button" style="width:100%">Edit Vendor</a>
                    </p>
                    <a href="/vendors" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
