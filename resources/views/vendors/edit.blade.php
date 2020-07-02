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
