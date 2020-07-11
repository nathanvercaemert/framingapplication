@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Vendor
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/vendors/edit/{{ $vendor->id }}" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <h5>Vendor</h5>
                        <p>{{ $vendor->vendor }}</p>
                        <div class="form-group">
                            <h5>
                                <label for="vendorNotes">Notes</label>
                            </h5>
                            <textarea type="text" class="form-control" name="vendorNotes" id="vendorNotes">{{ $vendor->vendorNotes }}</textarea>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary" style="width:100%">Submit Edit</button>
                        </p>
                        <a class="btn btn-primary text-white" role="button" style="width:100%" data-toggle="modal" data-target="#deleteVendor" >Delete Vendor</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.vendors.delete')

@endsection
