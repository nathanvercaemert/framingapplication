<div class="modal fade" id="editAddOrder" tabindex="-1" role="dialog" aria-labelledby="editAddOrder" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAddOrderLabel">Add Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form>
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="editOrderNumber">Order Number</label>
                        <input type="text" class="form-control" name="editOrderNumber" id="editOrderNumber" placeholder="1234" v-model="editAddOrderNumber">
                        <div :hidden="editIsInvalid == 0">
                            <p></p>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">Order number <span id="editOrderNumberReportedError"></span> does not exist.</li>
                            </ul>
                        </div>
                        <div :hidden="editIsReported == 0">
                            <p></p>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">Order number <span id="editOrderNumberError"></span> has already been reported.</li>
                            </ul>
                        </div>
                        <div :hidden="editAlreadyInOrderList == 0">
                            <p></p>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">Order number <span id="editOrderNumberAlreadyError"></span> is already in the order list.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="editAddOrder">Add Order</button>
                </div>
                <p></p>
            </form>
    </div>
  </div>
</div>
