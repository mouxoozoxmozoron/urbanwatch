<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>InfraWatch / Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>


    <style>
        /* Loading Indicator */
    #loadingIndicator {
        position: fixed;
        top: 0;
        left: 0;
        height: 4px;
        width: 0%;
        background-color: rgb(230, 31, 31);
        z-index: 9999;
        transition: width 0.3s ease-in-out;
    }

    /* Flash Message */
    .flash-message {
        position: fixed;
        bottom: 80px;
        right: 20px;
        min-width: 300px;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        color: #fff;
        font-size: 16px;
        z-index: 9999;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s, transform 0.5s;
    }

    .flash-message.show {
        opacity: 1;
        transform: translateY(0);
    }

    .flash-message.success {
        background-color: green;
    }

    .flash-message.warning {
        background-color: orange;
    }

    .flash-message.error {
        background-color: red;
    }


    #login-logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
    }

    #login-logo {
        width: 200px;
        height: auto;
    }


    </style>

  <main>
        <div id="loadingIndicator"></div>

    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <div id="login-logo-container">
                    <a href="{{ url('/') }}">
                        {{-- <img src="{{ asset('backend/assets/img/logoo5.jpg') }}" alt="Logo" id="login-logo"> --}}
                    </a>
                </div>

                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>

                    <p class="text-center small">Enter your Email & password to login</p>
                  </div>

                 <form class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-12">
                    <label for="yourPassword" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="yourUsername" placeholder="example@gmail.com" required>
                    <div class="invalid-feedback">Please enter your email!</div>
                </div>
                <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" placeholder="..." required>
                    <div class="invalid-feedback">Please enter your password!</div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </div>
                <div class="col-12">
                    <p class="small mb-0">Forgot password? <a href="#">Reset</a></p>
                </div>
            </form>

                </div>
              </div>
            <div class="credits">
                Copy &copy; {{ date('Y') }} <a href="" target="_blank">InfraWatch</a>
            </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('backend/assets/js/main.js') }}"></script>

<script>
    //custom loading indicatoor
    function startLoading() {
    const loader = document.getElementById('loadingIndicator');
    loader.style.width = '0%'; // Reset
    loader.style.display = 'block'; // Ensure visible
    setTimeout(() => {
        loader.style.width = '100%';
    }, 50); // Start animation after slight delay
}

function stopLoading() {
    const loader = document.getElementById('loadingIndicator');
    setTimeout(() => {
        loader.style.width = '100%';
        setTimeout(() => {
            loader.style.display = 'none';
            loader.style.width = '0%'; // Reset for next use
        }, 300); // Optional fade-out delay
    }, 300);
}



//custom flash message\
function showFlashMessage(type, message) {
    // Create flash message container
    const flashMessage = document.createElement('div');
    flashMessage.className = `flash-message ${type} show`;
    flashMessage.innerText = message;

    // Append to the body
    document.body.appendChild(flashMessage);

    // Remove after 4 seconds
    setTimeout(() => {
        flashMessage.classList.remove('show');
        setTimeout(() => {
            flashMessage.remove();
        }, 500); // Wait for animation to complete
    }, 4000);
}





//login form processing
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.needs-validation');
    const submitButton = form.querySelector('button[type="submit"]');
    const loadingIndicator = document.getElementById('loadingIndicator');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        submitButton.disabled = true;
        startLoading();

        const formData = new FormData(form);

        // Perform AJAX request
        fetch("{{ route('authentication') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                stopLoading();
                submitButton.disabled = false;

                // Show flash message based on response
                if (data.status === 'success') {
                    showFlashMessage('success', data.message || 'Logged in successfully!');
                    // Redirect to dashboard after success
                    window.location.href = "{{ route('dashboard') }}";
                } else {
                    showFlashMessage('error', data.message || 'Login failed!');
                }
            })
            .catch(error => {
                stopLoading();
                submitButton.disabled = false;
                showFlashMessage('error', 'An error occurred. Please try again!');
                console.error(error);
            });
    });
});

</script>
</body>

</html>
