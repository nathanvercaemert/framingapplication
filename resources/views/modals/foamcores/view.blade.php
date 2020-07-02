<div class="modal fade" id="viewFoamcore" tabindex="-1" role="dialog" aria-labelledby="viewFoamcore" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewFoamcoreLabel">Select Foamcore</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form class="needs-validation" method="GET" action="/foamcores/view/-1" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="foamcoreType">Foamcore</label>
                        <select class="form-control" name="foamcoreType" id="foamcoreType" required>
                            <option value="" seleted hidden>Foamcore</option>
                            @foreach($foamcores as $foamcore)
                                <option>{{$foamcore->foamcoreType}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose a foamcore to view.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">View Foamcore</button>
                </div>
            </form>
    </div>
  </div>
</div>

<script>
// JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
