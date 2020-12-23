<div class="modal fade" id="reportContainsOrders" tabindex="-1" role="dialog" aria-labelledby="reportContainsOrders" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportContainsOrdersLabel">Verify Submit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form>
                <div class="modal-body">
                    <div class="form-group" >
                        <div>
                            <p>The specified date range contains some orders that have already been reported, and they will not be included.</p>
                        </div>
                        <div id="orderNumberVerificationList" class="list-group text-center">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="verificationSubmit">Submit Anyway</button>
                </div>
                <p></p>
            </form>
    </div>
  </div>
</div>
