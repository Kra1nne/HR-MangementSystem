@extends('layouts/homepagelayout')

@section('title', 'Home Page')

@section('content')
    <div class="gap-5 bg-white">
        <section class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="text-center text-lg-start mb-lg-0 w-75">
                        <img src="{{ asset('assets/img/backgrounds/landing1.png') }}" alt="Landing Background"
                            class="img-fluid cover mx-auto mx-lg-0" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold space-lettering-tight">
                        Smart HR Management Made Simple
                    </h1>
                    <p>This HR management system simplifies employment processes, supports employee workflows, and helps
                        teams
                        manage work efficiently. From hiring to daily operations, it centralizes data, improves
                        coordination,
                        and enhances overall workforce productivity.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-3">Get
                            Started</a>
                        <a href="{{ route('services-page') }}" class="btn btn-outline-primary btn-lg rounded-pill px-3">Our
                            Services</a>
                    </div>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-lg-4 mb-5 g-3 mt-2">
                <div class="col">
                    <div class="card p-1 h-100" style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                        <div class="d-flex align-items-center gap-2 p-2">
                            <div class="bg-light rounded p-3 p-lg-4 bg-light-primary text-primary flex-shrink-0">
                                <i class="ri-group-line fs-5 fs-lg-3"></i>
                            </div>
                            <div>
                                <span class="fw-bold fs-6 fs-md-5 fs-lg-4 d-block">1000+</span>
                                <p class="mb-0 small text-muted">Records Processed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-1 h-100" style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                        <div class="d-flex align-items-center gap-2 p-2">
                            <div class="bg-light rounded p-3 p-lg-4 bg-light-primary text-primary flex-shrink-0">
                                <i class="ri-cloud-line fs-5 fs-lg-3"></i>
                            </div>
                            <div>
                                <span class="fw-bold fs-6 fs-md-5 fs-lg-4 d-block">100%</span>
                                <p class="mb-0 small text-muted">Cloud-Based</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-1 h-100" style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                        <div class="d-flex align-items-center gap-2 p-2">
                            <div class="bg-light rounded p-3 p-lg-4 bg-light-primary text-primary flex-shrink-0">
                                <i class="ri-user-line fs-5 fs-lg-3"></i>
                            </div>
                            <div>
                                <span class="fw-bold fs-6 fs-md-5 fs-lg-4 d-block">1000+</span>
                                <p class="mb-0 small text-muted">Employees</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-1 h-100 style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'"">
                        <div class="d-flex align-items-center gap-2 p-2">
                            <div class="bg-light rounded p-3 p-lg-4 bg-light-primary text-primary flex-shrink-0">
                                <i class="ri-time-line fs-5 fs-lg-3"></i>
                            </div>
                            <div>
                                <span class="fw-bold fs-6 fs-md-5 fs-lg-4 d-block">24/7</span>
                                <p class="mb-0 small text-muted">HR System Access</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 container" id="services-section">
            <div class="d-flex flex-column justify-content-center">
                <div class="text-center">
                    <h3 class="fw-bold pt-5">Enterprise-wide people management solution</h3>
                    <p class="text-muted pt-5 fw-semibold">Explore the wide range of services we offer to streamline
                        your HR
                        processes
                        and
                        enhance
                        workforce management.</p>
                </div>
                <div class="row g-4 mt-5">
                    <a href="javascript::void(0)" style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'"
                        class="col-md-6 col-lg-4">
                        <div class="card h-100 p-4 text-center">
                            <i class="ri-shield-check-line fs-1 text-primary mb-3 mt-4"></i>
                            <h5 class="fw-bold mb-2">Employee Management</h5>
                            <p class="text-muted">
                                Efficiently manage employee records, track performance, and streamline HR processes with
                                our
                                comprehensive
                                employee management solutions.</p>
                            <div>
                                <img class="img-fluid cover w-50" src="{{ asset('assets/img/elements/Management.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </a>
                    <a href="javascript::void(0)" style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'"
                        class="col-md-6 col-lg-4">
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
                    </a>
                    <a href="javascript::void(0)" style="cursor: default; transition: all 0.3s ease;"
                        onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                        onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'"
                        class="col-md-6 col-lg-4">
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
                    </a>
                </div>
            </div>

        </section>
    </div>
    <div class="">
        <section class="container pt-5 d-flex flex-column align-items-center justify-content-center">
            <h3 class="fw-bold text-center">Simple Steps to Get Started </h3>
            <div class="row d-flex justify-content-center mt-4 pt-5">
                <div class="col-md-6 col-lg-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-user-follow-line fs-4 text-primary"></i>
                    </div>
                    <h5 class="mt-3 text-center">Create an Account</h5>
                    <p class="mt-3 text-center">
                        Register your organization or employee account to access HR tools, manage profiles,
                        and securely store workforce data.
                    </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-search-line fs-4 text-white"></i>
                    </div>
                    <h5 class="mt-3 text-center">Manage Employees</h5>
                    <p class="mt-3 text-center">
                        Add, update, and organize employee records, roles, and departments in one centralized
                        system.
                    </p>

                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-file-upload-line fs-4 text-primary"></i>
                    </div>
                    <h5 class="mt-3 text-center">Track Attendance & Performance</h5>
                    <p class="mt-3 text-center">
                        Monitor attendance, leave requests, and employee performance using real-time analytics
                        and reports.
                    </p>

                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-mail-check-line fs-4 text-white"></i>
                    </div>
                    <h5 class="text-center mt-3">Review Reports & Notifications</h5>
                    <p class="mt-3 text-center">
                        Receive system notifications, generate HR reports, and make informed decisions to
                        improve workforce productivity.
                    </p>

                </div>
            </div>
        </section>
    </div>
    <div class="bg-white">
        <div class="container py-5">
            <div class="row w-100 flex-column-reverse flex-md-row">

                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                    <div>
                        <h3 class="text-center fw-bolder mb-4">
                            {{ config('variables.templateName') }}
                        </h3>
                        <p class="text-start">
                            Empathra is a cloud-based HR management system that simplifies workforce operations.
                            It centralizes employee records, onboarding, attendance, and performance tracking in one
                            platform.
                            With real-time insights and secure access, it helps organizations manage teams more efficiently.
                        </p>
                        <ul class="list-unstyled small">
                            <li class="mb-2 d-flex align-items-center">
                                <i class="ri-check-line text-success me-2"></i>
                                Face recognition attendance
                            </li>

                            <li class="mb-2 d-flex align-items-center">
                                <i class="ri-check-line text-success me-2"></i>
                                Employee onboarding
                            </li>

                            <li class="mb-2 d-flex align-items-center">
                                <i class="ri-check-line text-success me-2"></i>
                                Attendance tracking
                            </li>

                            <li class="mb-2 d-flex align-items-center">
                                <i class="ri-check-line text-success me-2"></i>
                                Performance analytics
                            </li>

                            <li class="mb-2 d-flex align-items-center">
                                <i class="ri-check-line text-success me-2"></i>
                                Secure cloud storage
                            </li>

                            <li class="mb-2 d-flex align-items-center">
                                <i class="ri-check-line text-success me-2"></i>
                                24/7 platform access
                            </li>
                        </ul>

                        <div class="mt-3 d-flex justify-content-center">
                            <a href="#" class="btn btn-primary btn-sm px-4 rounded-pill">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                    <div class="w-100">
                        <img src="assets/img/elements/Web.jpg" class="img-fluid" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="bg-white pb-5">
        <div class="container">
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
    </div>
@endsection
