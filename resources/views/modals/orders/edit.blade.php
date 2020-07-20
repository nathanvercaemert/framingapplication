<div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-labelledby="editOrder" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOrderLabel">Select Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/orders/edit/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="orderNumber">Order Number</label>
                        <input type="text" class="form-control" name="orderNumber" id="orderNumber" placeholder="1234" required>
                        <div class="invalid-feedback">
                            Please provide an order number to edit.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Order</button>
                </div>
            </form>
    </div>
  </div>
</div>
