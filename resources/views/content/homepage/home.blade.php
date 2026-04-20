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
                        VoxSync Workforce System
                    </h1>
                    <p>This HR management system simplifies employment processes, supports employee workflows, and helps
                        teams
                        manage work efficiently. From hiring to daily operations, it centralizes data, improves
                        coordination,
                        and enhances overall workforce productivity.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-3">Get
                            Started</a>
                        <a href="{{ route('job-page') }}" class="btn btn-outline-primary btn-lg rounded-pill px-3">Job
                            Vancies</a>
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
                                <span class="fw-bold fs-6 fs-md-5 fs-lg-4 d-block">24/7</span>
                                <p class="mb-0 small text-muted">Job Application</p>
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
        <section class=" container" id="services-section" style="padding: 80px 0;">
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
    <div style="padding: 50px 0;">
        <section class="container d-flex flex-column align-items-center justify-content-center">
            <h3 class="fw-bold text-center">Job Application Process</h3>
            <p class="text-muted text-center">Follow these simple steps to apply for a position in our organization.
            </p>
            <div class="row d-flex justify-content-center mt-4 pt-5">

                <div class="col-md-6 col-lg-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-search-line fs-4 text-primary"></i>
                    </div>
                    <h5 class="mt-3 text-center">Find a Job</h5>
                    <p class="mt-3 text-center">
                        Browse and search available job openings. Filter by position, department,
                        or employment type to find the role that fits you best.
                    </p>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-file-upload-line fs-4 text-white"></i>
                    </div>
                    <h5 class="mt-3 text-center">Submit Application</h5>
                    <p class="mt-3 text-center">
                        Complete the online application form and upload the required documents
                        such as your resume, certificates, and valid IDs.
                    </p>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-time-line fs-4 text-primary"></i>
                    </div>
                    <h5 class="mt-3 text-center">Wait for HR Response</h5>
                    <p class="mt-3 text-center">
                        Your application will be reviewed by our HR team. You will receive
                        updates and notifications regarding your application status.
                    </p>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-checkbox-circle-line fs-4 text-white"></i>
                    </div>
                    <h5 class="text-center mt-3">Get Accepted</h5>
                    <p class="mt-3 text-center">
                        Once approved, you will be officially onboarded into the system and
                        gain access to your employee account and HR tools.
                    </p>
                </div>

            </div>
        </section>
    </div>

    <div class="bg-white">
        <section class="container" id="jobs-section">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-6 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/backgrounds/recruiting.png') }}" alt="Job Postings"
                        class="img-fluid w-75" />
                </div>
                <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                    <h3 class="fw-bold">We're Hiring!</h3>
                    <p class="text-muted mt-3">
                        Ready to take the next step in your career? Discover exciting opportunities through our
                        integrated job board. Browse openings, apply in just a few clicks, and stay updated on
                        your application status — all from one seamless experience.
                    </p>
                    <ul class="list-unstyled small mt-2">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="ri-check-line text-success me-2"></i>
                            Browse open job positions anytime
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="ri-check-line text-success me-2"></i>
                            Submit applications online with ease
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="ri-check-line text-success me-2"></i>
                            Track your application status in real-time
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="ri-check-line text-success me-2"></i>
                            Get notified on hiring updates
                        </li>
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('job-page') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                            View Job Vacancies
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="bg-white" style="padding: 50px 0;">
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
