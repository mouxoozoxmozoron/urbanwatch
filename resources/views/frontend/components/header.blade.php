        <!-- Navbar start -->
        <div class="container-fluid fixed-top px-0">
            <div class="container px-0">
                <div class="topbar">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-8">
                            <div class="topbar-info d-flex flex-wrap">
                                <a href="mailto:infrawatch@gmail.com" class="text-light me-4"><i class="fas fa-envelope text-white me-2"></i>InfraWatch@gmail.com</a>
                                <a href="tel:+255620806839" class="text-light"><i class="fas fa-phone-alt text-white me-2"></i>+255 620806839</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="topbar-icon d-flex align-items-center justify-content-end">
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-pinterest"></i></a>
                                <a href="#" class="btn-square text-white me-0"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="navbar navbar-light bg-light navbar-expand-xl">
                    <a href="{{ route('home') }}" class="navbar-brand ms-3">
                        <h1 class="text-primary display-5">InfraWatch</h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('about') }}" class="nav-item nav-link">About Us</a>
                            {{-- <a href="services.html" class="nav-item nav-link">Our Services</a> --}}
                            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact Us</a>

                                @auth
                                    @if (in_array(Auth::user()->user_type_id, [1, 2]))
                                        <a href="{{ route('dashboard') }}" class="nav-item nav-link">Dashboard</a>
                                    @endif
                                @endauth

                                @auth
                                <a href="{{ route('logout') }}" class="nav-item nav-link" title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                @endauth

                            </div>
                        <div class="d-flex align-items-center flex-nowrap pt-xl-0" style="margin-left: 15px;">
                            @if (Auth::check())
                                <a href="{{ route('report-incidence') }}" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Report Now</a>
                            @else
                                <a href="{{ route('defaultlogin') }}" class="btn-hover-bg btn btn-primary text-white py-2 px-4 me-3">Report Now</a>
                            @endif
                        </div>

                    </div>
                </nav>

            </div>
        </div>
        <!-- Navbar End -->
