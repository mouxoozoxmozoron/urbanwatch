<div class="container-fluid footer bg-dark text-body py-5">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Newsletter Section -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="mb-4 text-white">InfraWatch</h4>
                    <p class="mb-4">
                        InfraWatch is a digital platform committed to building smarter, safer cities through citizen-driven reporting, real-time infrastructure monitoring, and data-driven insights. We empower communities and city authorities with tools to detect, track, and resolve urban challenges efficiently.
                    </p>
                </div>
            </div>


            <!-- Our Services -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Core Services</h4>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Infrastructure Monitoring</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Smart City Analytics</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Real-Time Reporting</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Field Data Collection</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Alert & Notification System</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> GIS & Mapping Integration</a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Quick Links</h4>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Home</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Report an Issue</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Live Dashboard</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> About Us</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Contact</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> FAQs</a>
                </div>
            </div>


            <!-- Gallery Section -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="mb-4 text-white">Join Us</h4>
                    <div class="row g-2">
                        <div class="position-relative mx-auto">
                            <form id="subscriptionform">
                                @csrf
                            <input name="email" class="form-control border-0 bg-secondary w-100 py-3 ps-4 pe-5" type="email" required placeholder="Enter your email">
                            <button type="submit" class="btn-hover-bg btn btn-primary position-absolute top-0 end-0 py-2 mt-2 me-2">Join Us</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function () {
        // Form submission with AJAX
        $('#subscriptionform').on('submit', function (e) {
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

            $.ajax({
                url: "{{ route('subscribe') }}",
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
                        showFlashMessage('success', data.message || 'information saved successfully!');
                        form.reset();
                    } else {
                        showFlashMessage('error', data.message || 'Failed to create subscription.');
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
