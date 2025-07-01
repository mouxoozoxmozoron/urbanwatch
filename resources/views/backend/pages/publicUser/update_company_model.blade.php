
<!-- Modal -->
<div class="modal fade" id="updatecompanymodel" tabindex="-1" aria-labelledby="updatecompanymodel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="needs-validation" id="updatecompanyform" novalidate>
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addCompanyModalLabel">Register New Company</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <input type="hidden" name="editCompanyId" id="editCompanyId">

          <div class="modal-body row g-3">
            <div class="col-md-6">
              <input type="text" class="form-control" name="company_name" placeholder="Company Name" required>
            </div>
            <div class="col-md-6">
              <select class="form-select" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($cocategories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <select class="form-select" name="admin" required>
                <option value="">Select Admin</option>
                @foreach($mangers as $man)
                <option value="{{ $man->id }}">{{ $man->email?? $man->first_name }}</option>
              @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" name="description" placeholder="Company description" required>
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
