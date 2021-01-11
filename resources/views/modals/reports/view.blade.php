<div class="modal fade" id="viewReport" tabindex="-1" role="dialog" aria-labelledby="viewReport" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewReportLabel">Select Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/reports/view/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="reportNumber">Report Number</label>
                        <input type="text" class="form-control" name="reportNumber" id="reportNumber" placeholder="1234" required>
                        <div class="invalid-feedback">
                            Please provide a report number to view.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">View Report</button>
                </div>
            </form>
    </div>
  </div>
</div>
