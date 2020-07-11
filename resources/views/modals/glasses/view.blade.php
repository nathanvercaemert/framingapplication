<div class="modal fade" id="viewGlass" tabindex="-1" role="dialog" aria-labelledby="viewGlass" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewGlassLabel">Select Glass</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/glasses/view/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="glassType">Glass</label>
                        <select class="form-control" name="glassType" id="glassType" required>
                            <option value="" seleted hidden>Glass</option>
                            @foreach($glasses as $glass)
                                <option>{{$glass->glassType}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose a glass to view.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">View Glass</button>
                </div>
            </form>
    </div>
  </div>
</div>
