<div class="modal fade" id="viewMat" tabindex="-1" role="dialog" aria-labelledby="viewMat" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewMatLabel">Select Mat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/mats/view/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="matNumber">Mat Number</label>
                        <input type="text" class="form-control" name="matNumber" id="matNumber" placeholder="1234" required>
                        <div class="invalid-feedback">
                            Please provide a mat number to view.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">View Mat</button>
                </div>
            </form>
    </div>
  </div>
</div>
