@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Add New Vendor
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/vendors" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <label for="vendor">Vendor</label>
                            <input type="text" class="form-control" name="vendor" id="vendor" placeholder="Vendor" value="{{old('vendor')}}" style="{{ $errors->has('vendor') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a vendor.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vendorNotes">Notes</label>
                            <textarea type="text" class="form-control" name="vendorNotes" id="vendorNotes" placeholder="Notes">{{old('vendorNotes')}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%">Submit New Vendor</button>
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
