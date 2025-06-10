@extends('backend.layout.app')


@section('Content')


    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->




    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

        <img
            src="{{ $user->profile_image ? asset($user->profile_image) : asset('assets/img/profile-img.jpg') }}"
            alt="Profile"
            class="rounded-circle">
`             <h2>{{ $user->first_name }} {{ "" }} {{ $user->last_name }}</h2>

              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>


              <div class="tab-content pt-2">



        <div class="tab-pane fade show active profile-overview" id="profile-overview">
        <h5 class="card-title">About</h5>
        <p class="small fst-italic">
            {{ $user->about ?? 'No additional details provided.' }}
        </p>

        <h5 class="card-title">Profile Details</h5>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Full Name</div>
            <div class="col-lg-9 col-md-8">{{ $user->first_name . ' ' . $user->last_name }}</div>
        </div>


        <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
        </div>
        </div>


        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
            <!-- Profile Edit Form -->
            <form id="editProfileForm" enctype="multipart/form-data">
                @csrf

                <!-- Full Name -->
                <div class="row mb-3">
                    <label for="firstName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="first_name" type="text" class="form-control" id="firstName" value="{{ $user->first_name }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="lastName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="last_name" type="text" class="form-control" id="lastName" value="{{ $user->last_name }}">
                    </div>
                </div>


                <!-- Phone -->
                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone" value="{{ $user->phone }}">
                    </div>
                </div>

                <!-- Email -->
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>




            <div class="tab-pane fade pt-3" id="profile-change-password">
            <!-- Change Password Form -->
            <form id="changePasswordForm">
                @csrf
                <div class="row mb-3">
                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                </div>
                </div>

                <div class="row mb-3">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                </div>
                </div>

                <div class="row mb-3">
                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                </div>
                </div>

                <div class="text-center">
                <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
            </div>


              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editProfileForm');
    const submitButton = form.querySelector('button[type="submit"]');
    const profileImageInput = document.getElementById('profileImage');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const removeImageBtn = document.getElementById('removeImage');
    const loadingIndicator = document.getElementById('loadingIndicator'); // Optional loading indicator

    // Preview selected image
    profileImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove selected image
    removeImageBtn.addEventListener('click', function () {
        profileImageInput.value = '';
        imagePreview.classList.add('d-none');
        previewImg.src = '{{ asset('assets/img/default-profile.jpg') }}'; // Reset to default profile image
    });

    // Handle form submission
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Disable button and optionally show loading indicator
        submitButton.disabled = true;

        const formData = new FormData(form);

        fetch("{{ route('updateprofile') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                submitButton.disabled = false;

                // Show flash message
                if (data.status === 'success') {
                    showFlashMessage('success', data.message || 'Profile updated successfully!');
                    window.location.reload();
                } else {
                    showFlashMessage('error', data.message || 'Failed to update profile.');
                }
            })
            .catch(error => {
                submitButton.disabled = false;
                showFlashMessage('error', 'An error occurred. Please try again!');
                console.error(error);
            });
    });
});




document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the form from submitting

    const currentPassword = document.getElementById('currentPassword').value.trim();
    const newPassword = document.getElementById('newPassword').value.trim();
    const renewPassword = document.getElementById('renewPassword').value.trim();

    if (!currentPassword || !newPassword || !renewPassword) {
        showFlashMessage('error', 'All fields are required.');
        return;
    }

    if (newPassword !== renewPassword) {
        showFlashMessage('error', 'New Password and Confirm Password do not match.');
        return;
    }

    // Submit the form data via AJAX
    fetch('updatepassword', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            currentPassword: currentPassword,
            newPassword: newPassword,
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showFlashMessage('success', data.message);
                window.location.reload();
            } else {
                showFlashMessage('error', data.message);
            }
        })
        .catch(error => {
            showFlashMessage('error', 'An error occurred while processing the request.');
        });
});


    </script>
@endsection
