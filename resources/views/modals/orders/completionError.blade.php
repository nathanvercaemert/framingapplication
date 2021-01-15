<div class="modal fade" id="completionError" tabindex="-1" role="dialog" aria-labelledby="completionError" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="completionErrorLabel">Completion Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100%">Close</button>
            </p>
            <!-- <a :disabled="{{$order->isReported}} == 0" href="" id="reportViewButton" name="reportViewButton" class="btn btn-primary" style="width:100%">View Report</a>
            <p></p> -->
            <div>
                <ul :hidden="{{$order->isReported}} == 1" class="list-group">
                    <li class="list-group-item list-group-item-secondary">Order cannot be completed before it is reported.</li>
                </ul>
                <ul :hidden="{{$order->isReported}} == 0" class="list-group">
                    <li class="list-group-item list-group-item-secondary">Order cannot be completed before its report is processed.</li>
                </ul>
            </div>
        </div>
    </div>
  </div>
</div>
