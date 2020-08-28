<div class="modal fade" id="viewMoulding" tabindex="-1" role="dialog" aria-labelledby="viewMoulding" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewMouldingLabel">Select Moulding</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/mouldings/view/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="mouldingNumber">Moulding Number</label>
                        <input type="text" class="form-control" name="mouldingNumber" id="mouldingNumber" placeholder="1234" required>
                        <div class="invalid-feedback">
                            Please provide a moulding number to view.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">View Moulding</button>
                </div>
            </form>
    </div>
  </div>
</div>
