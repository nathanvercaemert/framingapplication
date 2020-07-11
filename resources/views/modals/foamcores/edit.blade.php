<div class="modal fade" id="editFoamcore" tabindex="-1" role="dialog" aria-labelledby="editFoamcore" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFoamcoreLabel">Select Foamcore</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/foamcores/edit/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="foamcoreType">Foamcore Type</label>
                        <select class="form-control" name="foamcoreType" id="foamcoreType" required>
                            <option value="" seleted hidden>Foamcore Type</option>
                            @foreach($foamcores as $foamcore)
                                <option>{{$foamcore->foamcoreType}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose a foamcore type to edit.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Foamcore</button>
                </div>
            </form>
    </div>
  </div>
</div>
