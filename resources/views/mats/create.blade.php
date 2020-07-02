@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add New Mat
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="/mats" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <label for="matNumber">Mat Number</label>
                            <input type="text" class="form-control" name="matNumber" id="matNumber" placeholder="1234" value="{{old('matNumber')}}" style="{{ $errors->has('matNumber') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a mat number.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="matVendor">Vendor</label>
                            <select class="form-control" name="matVendor" id="matVendor" style="{{ $errors->has('matVendor') ? 'border-color:red' : '' }}" required>
                                <option value="{{old('matVendor')}}" seleted hidden>{{ old('matVendor') != null ? old('matVendor') : 'Vendor' }}</option>
                                @foreach($vendors as $vendor)
                                    <option>{{$vendor->vendor}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide a vendor.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="matPrice">Mat Price</label>
                            <input type="text" class="form-control" name="matPrice" id="matPrice" placeholder="15.00" value="{{old('matPrice')}}" style="{{ $errors->has('matPrice') ? 'border-color:red' : '' }}" required>
                            <div class="invalid-feedback">
                                Please provide a mat price.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%">Submit New Mat</button>
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
