<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>InfraWatch - Make our City safe</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
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

    </style>



        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <div id="loadingIndicator"></div>



    @include('frontend.components.header')

    @yield('Content')

      <!-- Footer Start -->
    @include('frontend.components.footer')
    <!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-4 text-center text-md-start mb-md-0">
                <span class="text-body"><i class="fas fa-copyright text-light me-2"></i>InfraWatch</span>, All rights reserved.
            </div>
            <div class="col-md-4 text-center">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="#" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-pinterest"></i></a>
                    <a href="#" class="btn-hover-color btn-square text-white me-0"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-end text-body">
                Designed & Developed by the infraWatch Team
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>


        @stack('scripts')


        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('front/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('front/lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('front/lib/lightbox/js/lightbox.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('front/js/main.js') }}"></script>


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
      </script>

    </body>

</html>
