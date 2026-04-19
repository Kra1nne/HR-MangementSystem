@extends('layouts/homepagelayout')

@section('title', 'About Page')

@section('page-style')
    @vite(['resources/assets/css/about.css'])
@endsection
@section('content')
    <main class="min-vh-100">
        <section class="section-pad">
            <div class="container">
                <div class="row mt-5 align-items-center">

                    <!-- TEXT (LEFT on desktop, BELOW on mobile) -->
                    <div class="col-12 col-lg-6 order-2 order-lg-1 text-center text-lg-start">

                        <h2 class="section-title mb-3">
                            Streamline Your Workforce,<br>Simplify Every Step
                        </h2>

                        <p class="section-sub mb-4">
                            Empathra is built to help organizations manage their people effortlessly —
                            from posting open roles and tracking applicants to onboarding new hires.
                        </p>

                        <ul class="list-unstyled mb-4 text-start">
                            <li class="mb-2">
                                <span class="feature-check">&#10003;</span> End-to-end employee lifecycle
                            </li>
                            <li class="mb-2">
                                <span class="feature-check">&#10003;</span> Smart applicant tracking
                            </li>
                            <li class="mb-2">
                                <span class="feature-check">&#10003;</span> Employee management system
                            </li>
                            <li class="mb-2">
                                <span class="feature-check">&#10003;</span> Attendance tracking and monitoring
                            </li>
                            <li class="mb-2">
                                <span class="feature-check">&#10003;</span> Real-time dashboards
                            </li>
                            <li class="mb-2">
                                <span class="feature-check">&#10003;</span> Secure data handling
                            </li>
                        </ul>

                        <div>

                            <a href="#" class="btn btn-primary px-4 py-2">Get Started</a>
                        </div>

                    </div>

                    <!-- IMAGE (RIGHT on desktop, TOP on mobile) -->
                    <div class="col-12 col-lg-6 order-1 order-lg-2 text-center mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/backgrounds/about-people.png') }}" alt="Landing Background"
                            class="img-fluid d-block mx-auto" />
                    </div>

                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════
         SECTION 2 – MISSION / VISION / DATA PRIVACY
    ════════════════════════════════════════════ --}}
        <section class="section-pad">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Mission, Vision &amp; Data Privacy</h2>
                    <p class="section-sub mx-auto mt-2" style="max-width:560px;">
                        We are guided by a clear purpose — to simplify HR for everyone while keeping your
                        data secure and your organization compliant.
                    </p>
                </div>

                <div class="row g-4">

                    {{-- Mission --}}
                    <div class="col-md-4">
                        <div class="card-custom">
                            <div class="card-icon">
                                <i class="ri-crosshair-line fs-4 text-primary"></i>
                            </div>
                            <div class="card-title-c">Our Mission</div>
                            <p class="card-text-c">
                                To empower HR professionals and organizations with a unified platform that makes
                                managing employees, tracking applicants, and posting jobs effortless — saving time,
                                reducing errors, and building stronger teams from day one.
                            </p>
                            <div class="card-tags">&#10003; Efficiency &nbsp; &#10003; Accuracy &nbsp; &#10003;
                                People-first</div>
                        </div>
                    </div>

                    {{-- Vision (featured) --}}
                    <div class="col-md-4">
                        <div class="card-custom">
                            <div class="card-icon">
                                <i class="ri-eye-line fs-4 text-primary"></i>
                            </div>
                            <div class="card-title-c">Our Vision</div>
                            <p class="card-text-c">
                                To become the leading HR management platform across Southeast Asia — where every
                                organization, regardless of size, can access enterprise-grade tools to manage their
                                workforce with clarity, fairness, and transparency.
                            </p>
                            <div class="card-tags">&#10003; Inclusive &nbsp; &#10003; Scalable &nbsp; &#10003; Transparent
                            </div>
                        </div>
                    </div>

                    {{-- Data Privacy --}}
                    <div class="col-md-4">
                        <div class="card-custom">
                            <div class="card-icon">
                                <i class="ri-shield-keyhole-line fs-4 text-primary"></i>
                            </div>
                            <div class="card-title-c">Data Privacy</div>
                            <p class="card-text-c">
                                We treat your employee and applicant data with the highest standard of care.
                                All information is encrypted, access-controlled, and handled in compliance with
                                the Data Privacy Act. We never sell or share personal data with third parties.
                            </p>
                            <div class="card-tags">&#10003; Encrypted &nbsp; &#10003; Compliant &nbsp; &#10003; Secure
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════
         SECTION 3 – TEAM
    ════════════════════════════════════════════ --}}
        <section class="section-pad" style="background:#fff;">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge-pill">Our creative team</span>
                    <h2 class="section-title">Team Behind Empthra</h2>
                    <p class="section-sub mx-auto mt-2" style="max-width:560px;">
                        Meet the dedicated professionals driving our success and delivering exceptional
                        HR solutions for your organization.
                    </p>
                </div>

                <div class="row g-4">

                    {{-- Team Member 1 --}}
                    <div class="col-md-4">
                        <div class="team-card">
                            <div class="team-img-area" style="background:linear-gradient(135deg,#185fa5 0%,#0d2d56 100%);">
                                <img src="{{ asset('assets/img/teams/Ryan.png') }}" class="img-fluid cover mx-auto mx-lg-0">
                            </div>
                            <button class="arrow-btn" aria-label="View profile">&#8599;</button>
                            <div class="team-info">
                                <div class="team-name">Andrea M.</div>
                                <div class="team-role">Founder &amp; CEO</div>
                                <div class="team-desc">
                                    Visionary leader with 12 years in HR tech and enterprise systems management.
                                </div>
                                <div>
                                    <span class="social-btn">f</span>
                                    <span class="social-btn">in</span>
                                    <span class="social-btn">@</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Team Member 2 --}}
                    <div class="col-md-4">
                        <div class="team-card">
                            <div class="team-img-area" style="background:linear-gradient(135deg,#185fa5 0%,#0d2d56 100%);">
                                <img src="{{ asset('assets/img/teams/Ryan.png') }}" class="img-fluid cover mx-auto mx-lg-0">
                            </div>
                            <button class="arrow-btn" aria-label="View profile">&#8599;</button>
                            <div class="team-info">
                                <div class="team-name">Carlo D.</div>
                                <div class="team-role">Head of Engineering</div>
                                <div class="team-desc">
                                    Full-stack engineer architecting scalable, secure HR platforms since 2016.
                                </div>
                                <div>
                                    <span class="social-btn">f</span>
                                    <span class="social-btn">in</span>
                                    <span class="social-btn">@</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Team Member 3 --}}
                    <div class="col-md-4">
                        <div class="team-card">
                            <div class="team-img-area" style="background:linear-gradient(135deg,#042c53 0%,#185fa5 100%);">
                                <img src="{{ asset('assets/img/teams/Ryan.png') }}" class="img-fluid cover mx-auto mx-lg-0">
                            </div>
                            <button class="arrow-btn" aria-label="View profile">&#8599;</button>
                            <div class="team-info">
                                <div class="team-name">Sofia B.</div>
                                <div class="team-role">HR Product Lead</div>
                                <div class="team-desc">
                                    Bridging HR expertise and product design to create tools people actually use.
                                </div>
                                <div>
                                    <span class="social-btn">f</span>
                                    <span class="social-btn">in</span>
                                    <span class="social-btn">@</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /.row --}}

                <div class="text-center mt-5 d-flex gap-3 justify-content-center flex-wrap">
                    <button class="btn-primary-c">Join Our Team</button>
                </div>

            </div>
        </section>

    </main>

@endsection
