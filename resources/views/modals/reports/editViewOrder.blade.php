<div class="modal fade" id="editReportViewOrder" tabindex="-1" role="dialog" aria-labelledby="editReportViewOrder" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editReportViewOrderLabel">Order <span id="editReportViewOrderNumber"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>First Name:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderFirstName"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Last Name:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderLastName"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Email Address:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderEmail"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Phone Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a>(<span id="editReportViewOrderPhone1"></span>) <span id="editReportViewOrderPhone2"></span> - <span id="editReportViewOrderPhone3"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Order Type:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderType"></span></a>
                </div>
            </div>
            <div :hidden="editReportViewOrderIsFrame == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Moulding Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderMouldingNumber"></span></a>
                </div>
            </div>
            <div :hidden="editReportViewOrderIsFrame == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Glass Type:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderGlassType"></span></a>
                </div>
            </div>
            <div :hidden="editReportViewOrderIsFrame == 0 || editReportViewOrderFirstMatNumber == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Mat Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderFirstMatNumber"></span></a>
                </div>
            </div>
            <div :hidden="editReportViewOrderIsFrame == 0 || editReportViewOrderSecondMatNumber == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Mat Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderSecondMatNumber"></span></a>
                </div>
            </div>
            <div :hidden="editReportViewOrderIsFrame == 0 || editReportViewOrderThirdMatNumber == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Mat Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderThirdMatNumber"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Foamcore Type:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderFoamcoreType"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Width:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderWidth"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Height:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderHeight"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Notes:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="editReportViewOrderNotes"></span></a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" v-on:click="editRemoveOrder()" data-dismiss="modal">Remove Order</button>
        </div>
    </div>
  </div>
</div>
