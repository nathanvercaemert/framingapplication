@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Moulding
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/mouldings/edit/{{ $moulding->id }}" novalidate>
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <h5>Moulding Number</h5>
                        <p>{{ $moulding->mouldingNumber }}</p>
                        <div class="form-group">
                            <h5>
                                <label for="mouldingVendor">Vendor</label>
                            </h5>
                            <select class="form-control" name="mouldingVendor" id="mouldingVendor" style="{{ $errors->has('mouldingVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{ old('mouldingVendor') != null ? old('mouldingVendor') : $moulding->mouldingVendor }}" selected hidden>{{ old('mouldingVendor') != null ? old('mouldingVendor') : $moulding->mouldingVendor }}</option>
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
                                <label for="mouldingPrice">Moulding Price</label>
                            </h5>
                            <input type="text" class="form-control" name="mouldingPrice" id="mouldingPrice" value="{{ old('mouldingPrice') != null ? old('mouldingPrice') : $moulding->mouldingPrice }}" style="{{ $errors->has('mouldingPrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a moulding price.
                            </div>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary" style="width:100%">Submit Edit </button>
                        </p>
                        <a class="btn btn-primary text-white" role="button" style="width:100%" data-toggle="modal" data-target="#deleteMoulding" >Delete Moulding</a>
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

@include('modals.mouldings.delete')

<script>
// JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@endsection
