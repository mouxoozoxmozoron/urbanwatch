@extends('frontend.layout.app')

@section('Content')
<br><br>
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="contact p-5">
            <div class="row g-4">
                <div class="col-lg-12">
                    <h1 class="mb-4">Create Account</h1>

                    <form id="registerForm">
                        <div class="row gx-4 gy-3">
                            <div class="col-md-6">
                                <input type="text" name="first_name" class="form-control py-3 px-4" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control py-3 px-4" placeholder="Last Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control py-3 px-4" placeholder="Phone Number" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control py-3 px-4" placeholder="Email Address" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="password" id="password" class="form-control py-3 px-4" placeholder="Password" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control py-3 px-4" placeholder="Confirm Password" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3">Create Account</button>
                            </div>

                            <!-- Login link section -->
                            <div class="col-12 text-center mt-3">
                                <p class="mb-0">
                                    Already have an account?
                                    <a href="{{ route('defaultlogin') }}" class="text-primary fw-bold">Login here</a>
                                </p>
                            </div>
                        </div>
                    </form>

                    <div id="registerMessage" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitButton = $(form).find('button[type="submit"]');
            const password = $('#password').val();
            const confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                showFlashMessage('error', 'Passwords do not match!');
                return;
            }

            submitButton.prop('disabled', true);
            startLoading();

            const formData = new FormData(form);

            $.ajax({
                url: "{{ route('create_account') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    stopLoading();
                    submitButton.prop('disabled', false);

                    if (data.status === 'success') {
                        showFlashMessage('success', data.message || 'Account created successfully! Redirecting to login...');
                        form.reset();
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 3000);
                    } else {
                        showFlashMessage('error', data.message || 'Registration failed. Please try again.');
                    }
                },
                error: function (xhr, status, error) {
                    stopLoading();
                    submitButton.prop('disabled', false);
                    showFlashMessage('error', 'An error occurred. Please try again!');
                    console.error(error);
                }
            });
        });

        function startLoading() {
            $('body').css('cursor', 'progress');
        }

        function stopLoading() {
            $('body').css('cursor', 'default');
        }
    });
</script>
@endpush

