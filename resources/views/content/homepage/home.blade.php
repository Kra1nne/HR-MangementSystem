@extends('layouts/homepagelayout')

@section('title', 'Home Page')

@section('content')
    <main class="container gap-5">
        <section>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="text-center text-lg-start mb-lg-0 w-75">
                        <img src="{{ asset('assets/img/backgrounds/landing1.png') }}" alt="Landing Background"
                            class="img-fluid cover mx-auto mx-lg-0" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold space-lettering-tight">
                        Find a job that suits you interests and skills
                    </h1>
                    <p>This HR management system simplifies employment processes, supports employee workflows, and helps
                        teams
                        manage work efficiently. From hiring to daily operations, it centralizes data, improves
                        coordination,
                        and enhances overall workforce productivity.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('auth-register') }}" class="btn btn-primary btn-lg rounded-pill px-3">Get
                            Started</a>
                        <a href="#services-section" class="btn btn-outline-primary btn-lg rounded-pill px-3">Our
                            Services</a>
                    </div>
                </div>
            </div>
            <div class="row mb-5 gap-3 mt-2">
                <div class="col">
                    <div class="card p-1">
                        <div class="d-flex align-items-center gap-3 p-3">
                            <div class="bg-light rounded p-5 bg-light-primary text-primary">
                                <i class="ri-group-line fs-3"></i>
                            </div>
                            <div class="">
                                <span class="fw-bold fs-4 mt-2">1000+</span>
                                <p class="mb-0">Employees</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-1">
                        <div class="d-flex align-items-center gap-3 p-3">
                            <div class="bg-light rounded p-5 bg-light-primary text-primary">
                                <i class="ri-group-line fs-3"></i>
                            </div>
                            <div class="">
                                <span class="fw-bold fs-4 mt-2">1000+</span>
                                <p>Employees</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-1">
                        <div class="d-flex align-items-center gap-3 p-3">
                            <div class="bg-light rounded p-5 bg-light-primary text-primary">
                                <i class="ri-group-line fs-3"></i>
                            </div>
                            <div class="">
                                <span class="fw-bold fs-4 mt-2">1000+</span>
                                <p>Employees</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-1">
                        <div class="d-flex align-items-center gap-3 p-3">
                            <div class="bg-light rounded p-5 bg-light-primary text-primary">
                                <i class="ri-group-line fs-3"></i>
                            </div>
                            <div class="">
                                <span class="fw-bold fs-4 mt-2">1000+</span>
                                <p>Employees</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </secti>
            <section class="mt-5" id="services-section">
                <div class="d-flex flex-column justify-content-center">
                    <div class="text-center">
                        <h2 class="fw-bold pt-5">Our Services</h2>
                        <p class="text-muted pt-5 fw-semibold">Explore the wide range of services we offer to streamline
                            your HR
                            processes
                            and
                            enhance
                            workforce management.</p>
                    </div>
                    <div class="row g-4 mt-5">
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 p-4 text-center">
                                <i class="ri-shield-check-line fs-1 text-primary mb-3 mt-4"></i>
                                <h5 class="fw-bold mb-2">Employee Management</h5>
                                <p class="text-muted">
                                    Efficiently manage employee records, track performance, and streamline HR processes with
                                    our
                                    comprehensive
                                    employee management solutions.</p>
                                <div>
                                    <img class="img-fluid cover w-50"
                                        src="{{ asset('assets/img/elements/Management.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 p-4 text-center">
                                <i class="ri-calendar-check-line fs-1 text-primary mb-3 mt-4"></i>
                                <h5 class="fw-bold">Attendance Tracking</h5>
                                <p class="text-muted">Monitor employee attendance, manage leave requests, and ensure
                                    accurate
                                    timekeeping with our reliable
                                    attendance tracking system.</p>
                                <div>
                                    <img class="img-fluid cover w-50" src="{{ asset('assets/img/elements/Analytics.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 p-4 text-center">
                                <i class="ri-bar-chart-line fs-1 text-primary mb-3 mt-4"></i>
                                <h5 class="fw-bold">Performance Analytics</h5>
                                <p class="text-muted">Gain insights into employee performance, identify trends, and make
                                    data-driven
                                    decisions to
                                    enhance workforce productivity with our advanced performance analytics tools.</p>
                                <div>
                                    <img class="img-fluid cover w-50" src="{{ asset('assets/img/elements/Tracking.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <section class="pt-5">
                <h2 class="fw-bold pt-5 text-center">How To Use Our Platform</h2>
                <div class="row d-flex justify-content-center mt-4">
                    <div class="col-md-6 col-lg-3">
                        Description 1
                    </div>
                    <div class="col-md-6 col-lg-3">
                        Description 2
                    </div>
                    <div class="col-md-6 col-lg-3">
                        Description 3
                    </div>
                    <div class="col-md-6 col-lg-3">
                        Description 4
                    </div>
                </div>
            </section>
    </main>
@endsection
