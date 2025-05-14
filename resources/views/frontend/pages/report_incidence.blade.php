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
                                <input type="text" name="latitude" id="latitude" class="form-control py-3 px-4" placeholder="Latitude" readonly required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="longitude" id="longitude" class="form-control py-3 px-4" placeholder="Longitude" readonly required>
                            </div>
                            <div class="col-12">
                                <textarea name="description" rows="4" class="form-control py-3 px-4" placeholder="Description of the issue..." required></textarea>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Attach Images (Multiple allowed):</label>
                                <input type="file" id="imageInput" class="form-control" multiple accept="image/*">
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
    // ✅ Get coordinates on page load
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            $('#latitude').val(position.coords.latitude.toFixed(6));
            $('#longitude').val(position.coords.longitude.toFixed(6));
            console.log('coordinate captured');
        }, function (error) {
            alert('Failed to get your location. Please allow location access.');
        });
    } else {
        alert('Geolocation is not supported in your browser.');
    }

    // ✅ Image preview logic
    let imageFiles = [];

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

    // ✅ Dummy form handler
    $('#incidentForm').on('submit', function (e) {
        e.preventDefault();
        alert('Form submitted! (You can now hook to backend)');
        this.reset();
        imageFiles = [];
        renderImagePreviews();
    });
});
</script>
@endpush
