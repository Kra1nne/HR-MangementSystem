@extends('layouts/homepagelayout')

@section('title', 'Contact Page')

@section('content')
    <main class="min-vh-100">
        <section class="container">
            <div class="py-5">
                <div class="row">
                    <div class="col-md-12 col-lg-6 d-flex align-items-center justify-content-center mb-5">
                        <div class="w-75 px-4 px-lg-5">
                            <img src="{{ asset('assets/img/elements/Contact.png') }}" class="img-fluid cover" alt="">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card p-5 w-75 rounded shadow-xl">
                            <h3 class="text-center mt-5 fw-bolder">Contact Info</h3>
                            <div class="row px-sm-1">
                                <div class="col-md-6 mt-2">
                                    <label for="firstname" class="fw-bolder text-black mb-2">First Name</label>
                                    <input type="text" class="form-control" placeholder="Your name">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="lastname" class="fw-bolder text-black mb-2">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Your last name">
                                </div>
                            </div>
                            <div class="row px-sm-1 pt-4">
                                <div class="col-md-12 mt-2">
                                    <label for="message" class="fw-bolder text-black mb-2">Message</label>
                                    <textarea name="Your Message" class="form-control no-resize" style="resize: none;" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row px-0 px-md-2 pt-5">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <button class=" btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container my-4">
            <div class="row">
                <div class="col-12">
                    <div class="shadow rounded" style="overflow:hidden; border-radius:12px;">
                        <iframe src="https://www.google.com/maps?q=Tomas+Oppus,+Leyte,+Philippines&output=embed"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
