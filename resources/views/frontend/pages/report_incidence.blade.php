@extends('frontend.layout.app')

@section('Content')
<br><br>
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="contact p-5">
            <div class="row g-4">
                <div class="col-lg-12">
                    <h1 class="mb-4">Report Public Infrastructure Condition</h1>
                    <p class="mb-4">Please fill out the form below to report any public infrastructure issue for tracking and maintenance. Attach relevant images if available.</p>

                    <form id="incidentForm">
                        <div class="row gx-4 gy-3">
                            <div class="col-md-6">
                                <input type="text" name="tittle" class="form-control py-3 px-4" placeholder="Incident Title" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="user_name" class="form-control py-3 px-4" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control py-3 px-4" placeholder="Phone Number" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="region" class="form-control py-3 px-4" placeholder="Region" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="district" class="form-control py-3 px-4" placeholder="District" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="ward" class="form-control py-3 px-4" placeholder="Ward" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="latitude" id="latitude" class="form-control py-3 px-4" placeholder="Latitude" required hidden>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="longitude" id="longitude" class="form-control py-3 px-4" placeholder="Longitude" required hidden>
                            </div>
                            <div class="col-12">
                                <textarea name="description" rows="4" class="form-control py-3 px-4" placeholder="Description of the issue..." required></textarea>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Attach Images (Multiple allowed):</label>
                                <input type="file" id="imageInput" class="form-control" name="attachments[]" multiple accept="image/*">

                                <div id="imagePreview" class="row mt-3"></div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3">Submit Report</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function () {
        let imageFiles = [];
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                $('#latitude').val(position.coords.latitude.toFixed(6)).prop('disabled', true);
                $('#longitude').val(position.coords.longitude.toFixed(6)).prop('disabled', true);
                console.log('Coordinates captured');
            }, function (error) {
                alert('Failed to get your location. Please allow location access.');
            });
        } else {
            alert('Geolocation is not supported in your browser.');
        }

        // ✅ Image preview logic
        $('#imageInput').on('change', function (e) {
            imageFiles = Array.from(e.target.files);
            renderImagePreviews();
        });

        function renderImagePreviews() {
            $('#imagePreview').empty();

            imageFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = $(`
                        <div class="col-md-3 position-relative mb-3">
                            <img src="${e.target.result}" class="img-fluid border rounded">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" data-index="${index}">&times;</button>
                        </div>
                    `);

                    preview.find('button').click(function () {
                        const i = $(this).data('index');
                        imageFiles.splice(i, 1);
                        renderImagePreviews();
                    });

                    $('#imagePreview').append(preview);
                };
                reader.readAsDataURL(file);
            });
        }

        // Form submission with AJAX
        $('#incidentForm').on('submit', function (e) {
            e.preventDefault();
            const form = this;
            const submitButton = $(form).find('button[type="submit"]');

            if (!form.checkValidity()) {
                $(form).addClass('was-validated');
                return;
            }

            submitButton.prop('disabled', true);
            startLoading();

            const formData = new FormData(form);

            // Append latitude and longitude manually (in case they are disabled)
            formData.set('latitude', $('#latitude').val());
            formData.set('longitude', $('#longitude').val());

            // Append all selected images
            imageFiles.forEach((file, index) => {
                formData.append('images[]', file);
            });

            $.ajax({
                url: "{{ route('report_incidence') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    stopLoading();
                    submitButton.prop('disabled', false);

                    if (data.status === 'success') {
                        showFlashMessage('success', data.message || 'Report submitted successfully!');
                        form.reset();
                        $('#imagePreview').empty();
                    } else {
                        showFlashMessage('error', data.message || 'Failed to submit report.');
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
    });
</script>
@endpush
