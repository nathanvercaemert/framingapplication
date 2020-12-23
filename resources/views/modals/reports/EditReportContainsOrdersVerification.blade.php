<div class="modal fade" id="editReportContainsOrders" tabindex="-1" role="dialog" aria-labelledby="editReportContainsOrders" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editReportContainsOrdersLabel">Verify Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form>
                <div class="overflow-auto modal-body" >
                    <div class="form-group" >
                        <div>
                            <p>The specified date range contains some orders that have already been reported, and they will not be included.</p>
                        </div>
                        <div id="editOrderNumberVerificationList" class="list-group text-center">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="editVerificationSubmit">Edit Anyway</button>
                </div>
                <p></p>
            </form>
    </div>
  </div>
</div>
