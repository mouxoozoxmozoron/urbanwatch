@extends('frontend.layout.app')

@section('Content')


<!-- Carousel Start -->
<div class="container-fluid carousel-header vh-100 px-0">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="{{ asset('front/img/02_hero.jpg') }}" class="img-fluid" alt="Report Infrastructure Issues">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">CITIZEN POWER</h4>
                        <h1 class="display-1 text-capitalize text-white mb-4">Report Issues. Drive Change.</h1>
                        <p class="mb-5 fs-5">Empowering communities to monitor and report public infrastructure challenges — roads, water, electricity, and more.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#">Report Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="{{ asset('front/img/03_hero.jpg') }}" class="img-fluid" alt="View Reports on Map">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">REAL-TIME VISIBILITY</h4>
                        <h1 class="display-1 text-capitalize text-white mb-4">Track Infrastructure Gaps</h1>
                        <p class="mb-5 fs-5">Visualize reported issues on an interactive map to highlight areas in need of urgent attention.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#">Explore Reports</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="{{ asset('front/img/01_hero.jpg') }}" class="img-fluid" alt="Engage With Your Community">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">CITIZEN ENGAGEMENT</h4>
                        <h1 class="display-1 text-capitalize text-white mb-4">Strength in Numbers</h1>
                        <p class="mb-5 fs-5">Collaborate with community members and stakeholders to demand better infrastructure and accountability.</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#">Join InfraWatch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->






        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-xl-5">
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('front/img/04_hero.jpg') }}"
                                 class="img-fluid"
                                 style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                 alt="Image">
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <h5 class="text-uppercase text-primary">About Us</h5>
                        <h1 class="mb-4">Empowering Communities by Tracking Public Infrastructure Issues</h1>
                        <p class="fs-5 mb-4">
                            Our platform bridges the gap between citizens and local authorities by enabling easy reporting and tracking of public infrastructure issues.
                            From damaged roads to broken streetlights, we make resolution simple and effective.
                             </p>
                        <div class="tab-class bg-secondary p-4">
                            <ul class="nav d-flex mb-2">
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 text-center bg-white active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 150px;">About</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 mx-3 text-center bg-white" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 150px;">Mission</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 text-center bg-white" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 150px;">Vision</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane fade show p-0 active">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <div class="text-start my-auto">
                                                    <h5 class="text-uppercase mb-3">Who We Are</h5>
                                                    <p class="mb-4">
                                                        We are a team committed to leveraging technology to improve civic engagement and infrastructure management. Our system enables real-time reporting, tracking, and resolution of public issues — creating cleaner, safer, and more functional communities.
                                                    </p>
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Learn More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane fade show p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <div class="text-start my-auto">
                                                    <h5 class="text-uppercase mb-3">Our Mission</h5>
                                                    <p class="mb-4">
                                                        To empower citizens and local governments by offering a user-friendly platform that makes it easy to report and address public infrastructure challenges efficiently and transparently.
                                                    </p>
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Join Us</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane fade show p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <div class="text-start my-auto">
                                                    <h5 class="text-uppercase mb-3">Our Vision</h5>
                                                    <p class="mb-4">
                                                        To become the leading civic-tech platform for infrastructure accountability — where every reported issue leads to action, and every citizen becomes a stakeholder in a better tomorrow.
                                                    </p>
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Get Started</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->



                <!-- Services Start -->
        <div class="container-fluid service py-5 bg-light">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">What we do</h5>
                    <h1 class="mb-0">Our Commitment to Infrastructure Safety & Accountability</h1>
                </div>
                <div class="row g-4">
                    <!-- Service 1 -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="service-item">
                            <img src="{{ asset('front/img/06_hero.jpg') }}" class="img-fluid w-100" alt="Community Reporting">
                            <div class="service-link">
                                <a href="#" class="h4 mb-0">Hazard Reporting</a>
                            </div>
                        </div>
                        <p class="my-4">Empowering citizens to report infrastructure issues like damaged roads, faulty drainage, or unsafe buildings through a simple and accessible platform.</p>
                    </div>

                    <!-- Service 2 -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="service-item">
                            <img src="{{ asset('front/img/04_hero.jpg') }}" class="img-fluid w-100" alt="Real-time Monitoring">
                            <div class="service-link">
                                <a href="#" class="h4 mb-0">Infrastructure Monitoring</a>
                            </div>
                        </div>
                        <p class="my-4">Tracking and visualizing infrastructure health data in real-time using geolocation and user reports to ensure transparency and quick intervention.</p>
                    </div>

                    <!-- Service 3 -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="service-item">
                            <img src="{{ asset('front/img/05_hero.jpg') }}" class="img-fluid w-100" alt="Community Engagement">
                            <div class="service-link">
                                <a href="#" class="h4 mb-0">Community Engagement</a>
                            </div>
                        </div>
                        <p class="my-4">Connecting residents, local leaders, and institutions to work together, share updates, and build trust for infrastructure improvement initiatives.</p>
                    </div>

                    <!-- Service 4 -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="service-item">
                            <img src="{{ asset('front/img/02_hero.jpg') }}" class="img-fluid w-100" alt="Policy Advocacy">
                            <div class="service-link">
                                <a href="#" class="h4 mb-0">Policy Advocacy</a>
                            </div>
                        </div>
                        <p class="my-4">Advocating for transparency, data-driven decision-making, and increased public accountability in infrastructure development and maintenance.</p>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services End -->



        <!-- Participation Start -->
        <div class="container-fluid donation py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">Participation</h5>
                    <h1 class="mb-0">Together, we can build accountable infrastructure</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="donation-item">
                            <img src="{{ asset('front/img/service-3.jpg') }}" class="img-fluid w-100" alt="Infrastructure Watch Platform">
                            <div class="donation-content d-flex flex-column">
                                <h5 class="text-uppercase text-primary mb-4">INFRAWATCH</h5>
                                <a href="#" class="btn-hover-color display-6 text-white">Join the Movement</a>
                                <h4 class="text-white mb-4">Monitor Infrastructure Progress</h4>
                                <p class="text-white mb-4">
                                    Use the platform to track construction, report issues, and promote transparency in urban infrastructure development.
                                </p>
                                <div class="donation-btn d-flex align-items-center justify-content-start">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Report Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="donation-item">
                            <img src="{{ asset('front/img/service-2.jpg') }}" class="img-fluid w-100" alt="Image">
                            <div class="donation-content d-flex flex-column">
                                <h5 class="text-uppercase text-primary mb-4">Urban Ecosystem</h5>
                                <a href="#" class="btn-hover-color display-6 text-white">Stay Informed</a>
                                <h4 class="text-white mb-4">Track City Development</h4>
                                <p class="text-white mb-4">
                                    Receive updates on new projects, maintenance schedules, and how your feedback is shaping better infrastructure.
                                </p>
                                <div class="donation-btn d-flex align-items-center justify-content-start">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="donation-item">
                            <img src="{{ asset('front/img/donation-3.jpg') }}" class="img-fluid w-100" alt="Image">
                            <div class="donation-content d-flex flex-column">
                                <h5 class="text-uppercase text-primary mb-4">Community Voices</h5>
                                <a href="#" class="btn-hover-color display-6 text-white">Be a Watchdog</a>
                                <h4 class="text-white mb-4">Empower Local Insights</h4>
                                <p class="text-white mb-4">
                                    Your reports and stories help drive accountability. Be heard, be active, and let’s improve infrastructure together.
                                </p>
                                <div class="donation-btn d-flex align-items-center justify-content-start">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Share Your Story</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Explore More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Participation End -->



    <!-- Counter Start -->
    <div class="container-fluid counter py-5" style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, 0.4)), url('{{ asset('front/img/volunteers-bg.jpg') }}') center center; background-size: cover;">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Our Impact</h5>
                <p class="text-white mb-0">
                    Bridging the gap between citizens and local authorities by reporting, tracking, and resolving urban infrastructure issues efficiently.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-exclamation-triangle fa-4x text-white"></i>
                        <h3 class="text-white my-4">Issues Reported</h3>
                        <div class="counter-counting">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">4250</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-check-circle fa-4x text-white"></i>
                        <h3 class="text-white my-4">Cases Resolved</h3>
                        <div class="counter-counting text-center border-white w-100" style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">3120</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-users fa-4x text-white"></i>
                        <h3 class="text-white my-4">Active Users</h3>
                        <div class="counter-counting text-center border-white w-100" style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">980</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter-item text-center border p-5">
                        <i class="fas fa-city fa-4x text-white"></i>
                        <h3 class="text-white my-4">Cities Engaged</h3>
                        <div class="counter-counting text-center border-white w-100" style="border-style: dotted; font-size: 30px;">
                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">15</span>
                            <span class="h1 fw-bold text-primary">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Join With Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter End -->



        {{-- <!-- Causes Start -->
        <div class="container-fluid causes py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">Recent Causes</h5>
                    <h1 class="mb-4">The environment needs our protection</h1>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6 col-xl-3">
                        <div class="causes-item">
                            <div class="causes-img">
                                <img src="{{ asset('front/img/causes-4.jpg') }}" class="img-fluid w-100" alt="Image">
                                <div class="causes-link pb-2 px-3">
                                    <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                    <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                                </div>
                                <div class="causes-dination p-2">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                    <span>65%</span>
                                </div>
                            </div>
                            <div class="causes-content p-4">
                                <h4 class="mb-3">First environments activity of</h4>
                                <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="causes-item">
                            <div class="causes-img">
                                <img src="{{ asset('front/img/causes-2.jpg') }}" class="img-fluid w-100" alt="Image">
                                <div class="causes-link pb-2 px-3">
                                    <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                    <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                                </div>
                                <div class="causes-dination p-2">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span>75%</span>
                                </div>
                            </div>
                            <div class="causes-content p-4">
                                <h4 class="mb-3">Build school for poor children.</h4>
                                <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="causes-item">
                            <div class="causes-img">
                                <img src="{{ asset('front/img/causes-3.jpg') }}" class="img-fluid w-100" alt="Image">
                                <div class="causes-link pb-2 px-3">
                                    <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                    <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                                </div>
                                <div class="causes-dination p-2">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                    <span>85%</span>
                                </div>
                            </div>
                            <div class="causes-content p-4">
                                <h4 class="mb-3">Building clean-water system for rural poor.</h4>
                                <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="causes-item">
                            <div class="causes-img">
                                <img src="{{ asset('front/img/causes-1.jpg') }}" class="img-fluid w-100" alt="Image">
                                <div class="causes-link pb-2 px-3">
                                    <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                    <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                                </div>
                                <div class="causes-dination p-2">
                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                    <span>95%</span>
                                </div>
                            </div>
                            <div class="causes-content p-4">
                                <h4 class="mb-3">First environments activity of this summer.</h4>
                                <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Causes End -->


        <!-- Events Start -->
        <div class="container-fluid event py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">Upcoming Events</h5>
                    <h1 class="mb-0">Help today because tomorrow you may be the one who needs more helping!</h1>
                </div>
                <div class="event-carousel owl-carousel">
                    <div class="event-item">
                        <img src="{{ asset('front/img/events-1.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="event-content p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Grand Mahal, Dubai 2100.</span>
                                <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                            </div>
                            <h4 class="mb-4">How To Build A Cleaning Plan</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="event-item">
                        <img src="{{ asset('front/img/events-2.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="event-content p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Grand Mahal, Dubai 2100.</span>
                                <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                            </div>
                            <h4 class="mb-4">How To Build A Cleaning Plan</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="event-item">
                        <img src="{{ asset('front/img/events-3.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="event-content p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Grand Mahal, Dubai 2100.</span>
                                <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                            </div>
                            <h4 class="mb-4">How To Build A Cleaning Plan</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="event-item">
                        <img src="{{ asset('front/img/events-4.jpg') }}" class="img-fluid w-100" alt="Image">
                        <div class="event-content p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Grand Mahal, Dubai 2100.</span>
                                <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                            </div>
                            <h4 class="mb-4">How To Build A Cleaning Plan</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Events End -->

        <!-- Blog Start -->
        <div class="container-fluid blog py-5 mb-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                    <h5 class="text-uppercase text-primary">Latest News</h5>
                    <h1 class="mb-0">Help today because tomorrow you may be the one who needs more helping!
                    </h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6 col-xl-3">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset('front/img/blog-1.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="blog-info">
                                    <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                    <div class="d-flex">
                                        <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                        <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                    </div>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('front/img/blog-1.jpg') }}" data-lightbox="Blog-1" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                                </div>
                            </div>
                            <div class="text-dark border p-4 ">
                                <h4 class="mb-4">Save The Topic Forests</h4>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset('front/img/blog-2.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="blog-info">
                                    <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                    <div class="d-flex">
                                        <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                        <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                    </div>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('front/img/blog-2.jpg') }}" data-lightbox="Blog-2" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                                </div>
                            </div>
                            <div class="text-dark border p-4 ">
                                <h4 class="mb-4">Save The Topic Forests</h4>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset('front/img/blog-3.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="blog-info">
                                    <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                    <div class="d-flex">
                                        <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                        <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                    </div>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('front/img/blog-3.jpg') }}" data-lightbox="Blog-3" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                                </div>
                            </div>
                            <div class="text-dark border p-4 ">
                                <h4 class="mb-4">Save The Topic Forests</h4>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset('front/img/blog-4.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="blog-info">
                                    <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                    <div class="d-flex">
                                        <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                        <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                    </div>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('front/img/blog-4.jpg') }}" data-lightbox="Blog-4" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                                </div>
                            </div>
                            <div class="text-dark border p-4 ">
                                <h4 class="mb-4">Save The Topic Forests</h4>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->


        <!-- Gallery Start -->
        <div class="container-fluid gallery py-5 px-0">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Our work</h5>
                <h1 class="mb-4">We consider environment welfare</h1>
                <p class="mb-0">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
            </div>
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('front/img/gallery-2.jpg') }}" class="img-fluid w-100" alt="">
                        <div class="search-icon">
                            <a href="{{ asset('front/img/gallery-2.jpg') }}" data-lightbox="gallery-2" class="my-auto"><i class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                        </div>
                        <div class="gallery-content">
                            <div class="gallery-inner pb-5">
                                <a href="#" class="h4 text-white">Beauty Of Life</a>
                                <a href="#" class="text-white"><p class="mb-0">Gallery Name</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('front/img/gallery-3.jpg') }}" class="img-fluid w-100" alt="">
                        <div class="search-icon">
                            <a href="img/gallery-3.jpg" data-lightbox="gallery-3" class="my-auto"><i class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                        </div>
                        <div class="gallery-content">
                            <div class="gallery-inner pb-5">
                                <a href="#" class="h4 text-white">Beauty Of Life</a>
                                <a href="#" class="text-white"><p class="mb-0">Gallery Name</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('front/img/gallery-1.jpg') }}" class="img-fluid w-100" alt="">
                        <div class="search-icon">
                            <a href="{{ asset('front/img/gallery-1.jpg') }}" data-lightbox="gallery-1" class="my-auto"><i class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                        </div>
                        <div class="gallery-content">
                            <div class="gallery-inner pb-5">
                                <a href="#" class="h4 text-white">Beauty Of Life</a>
                                <a href="#" class="text-white"><p class="mb-0">Gallery Name</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('front/img/gallery-4.jpg') }}" class="img-fluid w-100" alt="">
                        <div class="search-icon">
                            <a href="img/gallery-4.jpg" data-lightbox="gallery-4" class="my-auto"><i class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                        </div>
                        <div class="gallery-content">
                            <div class="gallery-inner pb-5">
                                <a href="#" class="h4 text-white">Beauty Of Life</a>
                                <a href="#" class="text-white"><p class="mb-0">Gallery Name</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('front/img/gallery-5.jpg') }}" class="img-fluid w-100" alt="">
                        <div class="search-icon">
                            <a href="img/gallery-5.jpg" data-lightbox="gallery-5" class="my-auto"><i class="fas fa-search-plus btn-hover-color bg-white text-primary p-3"></i></a>
                        </div>
                        <div class="gallery-content">
                            <div class="gallery-inner pb-5">
                                <a href="#" class="h4 text-white">Beauty Of Life</a>
                                <a href="#" class="text-white"><p class="mb-0">Gallery Name</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End -->


        <!-- Volunteers Start -->
        <div class="container-fluid volunteer py-5 mt-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="volunteer-img">
                                    <img src="{{ asset('front/img/volunteers-1.jpg') }}" class="img-fluid w-100" alt="Image">
                                    <div class="volunteer-title">
                                        <h5 class="mb-2 text-white">Michel Brown</h5>
                                        <p class="mb-0 text-white">Communicator</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="volunteer-img">
                                    <img src="{{ asset('front/img/volunteers-3.jpg') }}" class="img-fluid w-100" alt="Image">
                                    <div class="volunteer-title">
                                        <h5 class="mb-2 text-white">Michel Brown</h5>
                                        <p class="mb-0 text-white">Communicator</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="volunteer-img">
                                    <img src="{{ asset('front/img/volunteers-2.jpg') }}" class="img-fluid w-100" alt="Image">
                                    <div class="volunteer-title">
                                        <h5 class="mb-2 text-white">Michel Brown</h5>
                                        <p class="mb-0 text-white">Communicator</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="volunteer-img">
                                    <img src="{{ asset('front/img/volunteers-4.jpg') }}" class="img-fluid w-100" alt="Image">
                                    <div class="volunteer-title">
                                        <h5 class="mb-2 text-white">Michel Brown</h5>
                                        <p class="mb-0 text-white">Communicator</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <h5 class="text-uppercase text-primary">Become a Volunteer?</h5>
                        <h1 class="mb-4">Join your hand with us for a better life and beautiful future.</h1>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.
                        </p>
                        <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> We are friendly to each other.</p>
                        <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> If you join with us,We will give you free training.</p>
                        <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> Its an opportunity to help poor Environments.</p>
                        <p class="text-dark"><i class=" fa fa-check text-primary me-2"></i> No goal requirements.</p>
                        <p class="text-dark mb-5"><i class=" fa fa-check text-primary me-2"></i> Joining is tottaly free. We dont need any money from you.</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Join With Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Volunteers End --> --}}


@endsection
