@extends('backend.layout.app')

@section('Content')
<div class="pagetitle">
  <h1>InfraWatch Managers</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Mnagers</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">Consultant Admins</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
              + Add Admin
            </button>
          </div>

          <table class="table table-striped w-100">
            <thead>
              <tr>
                <th>#</th>
                <th>Admin Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($managers as $index => $manager)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $manager['first_name'] }} {{ $manager['last_name'] }}</td>
                <td>{{ $manager['email'] }}</td>
                <td>{{ $manager['phone'] }}</td>
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

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="needs-validation" id="addAdminForm" novalidate>
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addAdminModalLabel">Register New Admin</h5>
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
          <div class="col-md-6">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
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
      const form = document.getElementById('addAdminForm');
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

        fetch("{{ route('add.system_admin') }}", {
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
            showFlashMessage('success', data.message || 'Admin added successfully!');
            form.reset();
            form.classList.remove('was-validated');
            const modal = bootstrap.Modal.getInstance(document.getElementById('addAdminModal'));
            modal.hide();
            location.reload(); // Reload to see the new admin
          } else {
            showFlashMessage('error', data.message || 'Failed to add admin!');
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

