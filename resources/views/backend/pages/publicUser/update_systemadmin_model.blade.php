<div class="modal fade" id="editsytemadminmodel" tabindex="-1" aria-labelledby="editsytemadminmodel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="needs-validation" id="updateadminform" novalidate>
          @csrf

          <input type="hidden" name="admin_id" id="admin_id">

          <div class="modal-header">
            <h5 class="modal-title" id="editsytemadminmodel">Update Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body row g-3">
            <div class="col-md-6">
              <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
            </div>
            <div class="col-md-6">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" name="phone" placeholder="Phone" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
