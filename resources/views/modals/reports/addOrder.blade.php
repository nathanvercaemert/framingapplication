<div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addOrderLabel">Add Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form>
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="orderNumber">Order Number</label>
                        <input type="text" class="form-control" name="orderNumber" id="orderNumber" placeholder="1234" v-model="addOrderNumber">
                        <div :hidden="isInvalid == 0">
                            <p></p>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">Order number <span id="orderNumberError"></span> does not exist.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="addOrder">Add Order</button>
                </div>
                <p></p>
            </form>
    </div>
  </div>
</div>
