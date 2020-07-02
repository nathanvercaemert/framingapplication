<div class="modal fade" id="deleteGlass" tabindex="-1" role="dialog" aria-labelledby="deleteGlass" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteGlassLabel">Delete Glass</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form method="POST" action="/glasses/delete/{{ $glass->id }}">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100%">Close</button>
                    </p>
                    <button type="submit" class="btn btn-primary" style="width:100%">Confirm Delete</button>
                </div>
            </form>
    </div>
  </div>
</div>
