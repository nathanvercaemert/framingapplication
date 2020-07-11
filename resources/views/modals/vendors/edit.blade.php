<div class="modal fade" id="editVendor" tabindex="-1" role="dialog" aria-labelledby="editVendor" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editVendorLabel">Select Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/vendors/edit/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="vendor">Vendor</label>
                        <select class="form-control" name="vendor" id="vendor" required>
                            <option value="" seleted hidden>Vendor</option>
                            @foreach($vendors as $vendor)
                                <option>{{$vendor->vendor}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose a vendor to edit.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Vendor</button>
                </div>
            </form>
    </div>
  </div>
</div>
