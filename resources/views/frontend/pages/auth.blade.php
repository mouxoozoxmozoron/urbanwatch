@extends('frontend.layout.app')


@section('Content')
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="contact p-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="mb-4 text-center">Login</h1>

                    <form id="loginForm">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control py-3 px-4" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control py-3 px-4" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">
                            Don't have an account?
                            <a href="{{ route('account') }}" class="text-primary fw-bold">Register here</a>
                        </p>
                    </div>

                    <div id="loginMessage" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitButton = $(form).find('button[type="submit"]');

            submitButton.prop('disabled', true);
            startLoading();

            const formData = new FormData(form);

            $.ajax({
                url: "{{ route('defaultauth') }}",
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
                        showFlashMessage('success', data.message || 'Login successful. Redirecting...');
                        setTimeout(() => {
                            if (data.user_type !== 1 && data.user_type !== 2) {
                                window.location.href = "{{ route('report-incidence') }}";
                            } else {
                                window.location.href = "{{ route('dashboard') }}";
                            }
                        }, 2000);
                    } else {
                        showFlashMessage('danger', data.message || 'Invalid credentials. Please try again.');
                    }
                },
                error: function (xhr) {
                    stopLoading();
                    submitButton.prop('disabled', false);
                    showFlashMessage('danger', 'An error occurred. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        });

        function showFlashMessage(type, message) {
            const msgBox = `
                <div class="alert alert-${type}" role="alert">
                    ${message}
                </div>
            `;
            $('#loginMessage').html(msgBox);
        }

        function startLoading() {
            $('body').css('cursor', 'progress');
        }

        function stopLoading() {
            $('body').css('cursor', 'default');
        }
    });
</script>
@endpush
