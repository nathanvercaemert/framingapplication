<div class="modal fade" id="reportViewOrder" tabindex="-1" role="dialog" aria-labelledby="reportViewOrder" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="reportViewOrderLabel">Order <span id="reportViewOrderNumber"></span></h5>
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
                    <a><span id="reportViewOrderFirstName"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Last Name:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderLastName"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Email Address:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderEmail"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Phone Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a>(<span id="reportViewOrderPhone1"></span>) <span id="reportViewOrderPhone2"></span> - <span id="reportViewOrderPhone3"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Order Type:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderType"></span></a>
                </div>
            </div>
            <div :hidden="reportViewOrderIsFrame == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Moulding Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderMouldingNumber"></span></a>
                </div>
            </div>
            <div :hidden="reportViewOrderIsFrame == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Glass Type:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderGlassType"></span></a>
                </div>
            </div>
            <div :hidden="reportViewOrderIsFrame == 0 || reportViewOrderFirstMatNumber == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Mat Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderFirstMatNumber"></span></a>
                </div>
            </div>
            <div :hidden="reportViewOrderIsFrame == 0 || reportViewOrderSecondMatNumber == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Mat Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderSecondMatNumber"></span></a>
                </div>
            </div>
            <div :hidden="reportViewOrderIsFrame == 0 || reportViewOrderThirdMatNumber == 0" class="row">
                <div class="col w-50 text-right">
                    <h5>Mat Number:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderThirdMatNumber"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Foamcore Type:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderFoamcoreType"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Width:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderWidth"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Height:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderHeight"></span></a>
                </div>
            </div>
            <div class="row">
                <div class="col w-50 text-right">
                    <h5>Notes:</h5>
                </div>
                <div class="col w-50 text-left">
                    <a><span id="reportViewOrderNotes"></span></a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" v-on:click="removeOrder()" data-dismiss="modal">Remove Order</button>
        </div>
    </div>
  </div>
</div>
