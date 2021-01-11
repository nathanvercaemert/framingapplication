<div class="modal fade" id="deleteReport" tabindex="-1" role="dialog" aria-labelledby="deleteReport" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteReportLabel">Delete Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form method="POST" action="/reports/delete/{{ $report->id }}">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100%">Close</button>
                    </p>
                    <button :disabled="{{$report->isProcessed}} == 1" type="submit" class="btn btn-primary" style="width:100%">Confirm Delete</button>
                    <p></p>
                    <div>
                        <ul :hidden="{{$report->isProcessed}} == 0" class="list-group">
                            <li class="list-group-item list-group-item-secondary">Report cannot be deleted because it has been processed.</li>
                        </ul>
                    </div>
                </div>
            </form>
    </div>
  </div>
</div>
