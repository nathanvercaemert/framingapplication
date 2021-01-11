<div class="modal fade" id="processReport" tabindex="-1" role="dialog" aria-labelledby="processReport" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <h5 class="modal-title" id="processReportLabel">Process Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <form method="POST" action="/reports/process/{{ $report->id }}" >
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                <h5>Are you sure you want to process this report? This action cannot be undone.<h5>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100%">Close</button>
                <p></p>
                <button type="submit" class="btn btn-primary" style="width:100%">Process Report</button>
            </form>
        </div>
    </div>
  </div>
</div>
