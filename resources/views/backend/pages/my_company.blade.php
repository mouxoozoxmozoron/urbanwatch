@extends('backend.layout.app')

@section('Content')

<div class="pagetitle">
  <h1>InfraWatch Consultant</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item">Reports</li>
      <li class="breadcrumb-item active">InfraWatch Consultant</li>
    </ol>
  </nav>
</div><!-- End Page Title -->




<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">InfraWatch Consultant</h5>

            {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                + Add Company
            </button> --}}
        </div>

          <table class="table table-striped w-100">
            <thead>
              <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Issues No</th>
                <th>Admin</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($companies as $index => $company)
              <tr>
                <td>{{ $index + 1 }}</td>

                {{-- Company Name --}}
                <td>
                    <a href="{{ route('compay-incidences', $company->id) }}">
                        {{ strtoupper($company['name']) }}
                    </a>
                </td>
                <td>{{ $company->bases->name}}</td>

                {{-- Description --}}
                <td>{{ $company['description'] }}</td>

                <td>{{ $company->incidences->count() }}</td>

                {{-- Manager --}}
                <td>
                  @php
                    $manager = $company['manager'] ?? null;
                  @endphp
                  @if ($manager)
                    {{ $manager['first_name'] }} {{ $manager['last_name'] }}<br>
                    <small class="text-muted">{{ $manager['phone'] }}</small>
                  @else
                    <span class="text-muted">No Manager</span>
                  @endif
                </td>

                {{-- Status --}}
                <td>
                  @php
                    $statusValue = $company['status'];
                    $statusName = match($statusValue) {
                      1 => 'Active',
                      0 => 'Inactive',
                      default => 'Unknown'
                    };
                    $badgeClass = match($statusValue) {
                      1 => 'bg-success',
                      0 => 'bg-danger',
                      default => 'bg-secondary'
                    };
                  @endphp
                  <span class="badge {{ $badgeClass }}">{{ $statusName }}</span>
                </td>

                {{-- Actions --}}
                <td>
                  <a href="#" title="View" class="text-info me-2"><i class="bi bi-eye"></i></a>
                  <a href="#" title="Edit" class="text-primary me-2"><i class="bi bi-pencil-square"></i></a>
                  <a href="#" title="Delete" class="text-danger me-2"><i class="bi bi-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>





<!-- Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="needs-validation" id="addCompanyForm" novalidate>
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addCompanyModalLabel">Register New Company</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
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




@endsection

<script>
    function startLoading() {
      const loader = document.getElementById('loadingIndicator');
      loader.style.width = '0%';
      loader.style.display = 'block';
      setTimeout(() => {
        loader.style.width = '100%';
      }, 50);
    }

    function stopLoading() {
      const loader = document.getElementById('loadingIndicator');
      setTimeout(() => {
        loader.style.width = '100%';
        setTimeout(() => {
          loader.style.display = 'none';
          loader.style.width = '0%';
        }, 300);
      }, 300);
    }

    function showFlashMessage(type, message) {
      const flashMessage = document.createElement('div');
      flashMessage.className = `flash-message ${type} show`;
      flashMessage.innerText = message;
      document.body.appendChild(flashMessage);

      setTimeout(() => {
        flashMessage.classList.remove('show');
        setTimeout(() => {
          flashMessage.remove();
        }, 500);
      }, 4000);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('addCompanyForm');
      const submitButton = form.querySelector('button[type="submit"]');

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (!form.checkValidity()) {
          form.classList.add('was-validated');
          return;
        }

        submitButton.disabled = true;
        startLoading();

        const formData = new FormData(form);

        fetch("{{ route('addconsultant') }}", {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: formData
        })
        .then(res => res.json())
        .then(data => {
          stopLoading();
          submitButton.disabled = false;

          if (data.status === 'success') {
            showFlashMessage('success', data.message || 'Company added!');
            form.reset();
            form.classList.remove('was-validated');
            const modal = bootstrap.Modal.getInstance(document.getElementById('addCompanyModal'));
            modal.hide();
            location.reload(); // Reload to see the new company
          } else {
            showFlashMessage('error', data.message || 'Failed to add company!');
          }
        })
        .catch(err => {
          stopLoading();
          submitButton.disabled = false;
          showFlashMessage('error', 'An error occurred. Please try again.');
          console.error(err);
        });
      });
    });
    </script>


