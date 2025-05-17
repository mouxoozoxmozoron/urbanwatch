<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - InfraWATCH</title>
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

  <!-- Template Main CSS File -->
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">


  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


{{-- leaf let cdns links --}}

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>




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

    </style>



  <!-- ======= Header ======= -->
  @include('backend.components.header')
  <!-- ======= Header ======= -->


  <!-- ======= Sidebar ======= -->
    @include('backend.components.aside')
  <!-- End Sidebar-->


  <main id="main" class="main">
            <div id="loadingIndicator"></div>
            @yield('Content')
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
    @include('backend.components.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
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



function showFlashMessage(type, message) {
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


</script>
</body>

</html>
