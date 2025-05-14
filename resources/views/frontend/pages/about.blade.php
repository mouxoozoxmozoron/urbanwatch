@extends('frontend.layout.app')

@section('Content')

</br>

</br>
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
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{ route('report-incidence') }}">Get Involved</a>
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
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{ route('contact') }}">Join Us</a>
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
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="{{ route('report-incidence') }}">Get Started</a>
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

        @endsection


















