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
    // Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
    // ===== PROFILE FORM HANDLER =====
    const profileForm = document.getElementById('editProfileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleProfileUpdate(this);
        });

        // Image preview
        const profileImageInput = document.getElementById('profileImage');
        if (profileImageInput) {
            profileImageInput.addEventListener('change', handleImagePreview);
        }

        // Remove image
        const removeImageBtn = document.getElementById('removeImage');
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', handleRemoveImage);
        }
    }

    // ===== PASSWORD FORM HANDLER =====
    const passwordForm = document.getElementById('changePasswordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handlePasswordChange(this);
        });
    }
});

// Profile form handler
function handleProfileUpdate(form) {
    const submitButton = form.querySelector('button[type="submit"]');
    const formData = new FormData(form);

    // Validation
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        showFlashMessage('error', 'Please fill all required fields');
        return;
    }

    submitButton.disabled = true;

    fetch("{{ route('updateprofile') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: formData
    })
    .then(handleResponse)
    .then(data => {
        submitButton.disabled = false;
        if (data.status === 'success') {
            showFlashMessage('success', data.message || 'Profile updated successfully!');
            window.location.reload();
        } else {
            showFlashMessage('error', data.message || 'Failed to update profile');
        }
    })
    .catch(error => {
        submitButton.disabled = false;
        showFlashMessage('error', 'An error occurred. Please try again!');
        console.error('Profile Update Error:', error);
    });
}

// Password form handler
function handlePasswordChange(form) {
    const currentPassword = document.getElementById('currentPassword').value.trim();
    const newPassword = document.getElementById('newPassword').value.trim();
    const renewPassword = document.getElementById('renewPassword').value.trim();
    const submitButton = form.querySelector('button[type="submit"]');

    // Validation
    if (!currentPassword || !newPassword || !renewPassword) {
        showFlashMessage('error', 'All fields are required.');
        return;
    }

    if (newPassword !== renewPassword) {
        showFlashMessage('error', 'New Password and Confirm Password do not match.');
        return;
    }

    submitButton.disabled = true;

    fetch('updatepassword', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify({
            currentPassword: currentPassword,
            newPassword: newPassword,
        }),
    })
    .then(handleResponse)
    .then(data => {
        submitButton.disabled = false;
        if (data.status === 'success') {
            showFlashMessage('success', data.message);
            window.location.reload();
        } else {
            showFlashMessage('error', data.message);
        }
    })
    .catch(error => {
        submitButton.disabled = false;
        showFlashMessage('error', 'An error occurred while processing the request.');
        console.error('Password Change Error:', error);
    });
}

// ===== HELPER FUNCTIONS =====
function handleImagePreview(e) {
    const file = e.target.files[0];
    const previewImg = document.getElementById('previewImg');
    const imagePreview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            imagePreview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
}

function handleRemoveImage() {
    const profileImageInput = document.getElementById('profileImage');
    const previewImg = document.getElementById('previewImg');
    const imagePreview = document.getElementById('imagePreview');

    profileImageInput.value = '';
    imagePreview.classList.add('d-none');
    previewImg.src = '{{ asset('assets/img/default-profile.jpg') }}';
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

function handleResponse(response) {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
}
</script>
@endsection
