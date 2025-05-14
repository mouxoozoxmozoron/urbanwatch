@extends('frontend.layout.app')

@section('Content')

</br>
</br>
<!-- Contact Start -->
<div class="container-fluid bg-light py-5">
    <div class="container py-5">
        <div class="contact p-5">
            <div class="row g-4">
                <div class="col-xl-5">
                    <h1 class="mb-4">Get in touch with InfraWatch</h1>
                    <p class="mb-4">
                        Feel free to reach out to us with any questions, concerns, or partnership opportunities. InfraWatch is dedicated to monitoring infrastructure developments with transparency and integrity.
                    </p>
                    <form>
                        <div class="row gx-4 gy-3">
                            <div class="col-xl-6">
                                <input type="text" class="form-control bg-white border-0 py-3 px-4" placeholder="Your First Name">
                            </div>
                            <div class="col-xl-6">
                                <input type="email" class="form-control bg-white border-0 py-3 px-4" placeholder="Your Email">
                            </div>
                            <div class="col-xl-6">
                                <input type="text" class="form-control bg-white border-0 py-3 px-4" placeholder="Your Phone">
                            </div>
                            <div class="col-xl-6">
                                <input type="text" class="form-control bg-white border-0 py-3 px-4" placeholder="Subject">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0 py-3 px-4" rows="7" cols="10" placeholder="Your Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn-hover-bg btn btn-primary w-100 py-3 px-5" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-7">
                    <div>
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="bg-white p-4">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                                    <h4>Address</h4>
                                    <p class="mb-0">Ardhi University, Dar es Salaam, Tanzania</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="bg-white p-4">
                                    <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                    <h4>Email</h4>
                                    <p class="mb-0">infrawatch@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="bg-white p-4">
                                    <i class="fa fa-phone-alt fa-2x text-primary mb-2"></i>
                                    <h4>Phone</h4>
                                    <p class="mb-0">+255 620 806 839</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d987.6657119789745!2d39.214022674095965!3d-6.766229971173592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4ef582b1d3fb%3A0x9e959f2f92ce2aba!2sArdhi%20University%20Tanzania!5e1!3m2!1sen!2stz!4v1747249368107!5m2!1sen!2stz"
                                        width="100%"
                                        height="412"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
