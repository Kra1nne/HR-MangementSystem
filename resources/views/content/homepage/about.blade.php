@extends('layouts/homepagelayout')

@section('title', 'About Page')

@section('page-style')
    @vite(['resources/assets/css/about.css'])
@endsection
@section('content')
    <main class="min-vh-100">

        {{-- ════════════════════════════════════════════
         SECTION 1 – OBJECTIVE
    ════════════════════════════════════════════ --}}
        <section class="section-pad" style="background:#fff;">
            <div class="container">
                <div class="row align-items-center g-5">

                    {{-- LEFT – Text --}}
                    <div class="col-lg-6">

                        <h2 class="section-title mb-3">
                            Streamline Your Workforce,<br>Simplify Every Step
                        </h2>
                        <p class="section-sub mb-4">
                            Empathra is built to help organizations manage their people effortlessly — from
                            posting open roles and tracking applicants to onboarding new hires and managing
                            day-to-day employee operations. Our platform centralizes every HR workflow in one
                            place, so your team spends less time on paperwork and more time on what matters.
                        </p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2" style="color:#333;font-size:.95rem;">
                                <span class="feature-check">&#10003;</span> End-to-end employee lifecycle management
                            </li>
                            <li class="mb-2" style="color:#333;font-size:.95rem;">
                                <span class="feature-check">&#10003;</span> Smart applicant tracking and job posting tools
                            </li>
                            <li class="mb-2" style="color:#333;font-size:.95rem;">
                                <span class="feature-check">&#10003;</span> Real-time dashboards for HR teams and managers
                            </li>
                            <li class="mb-2" style="color:#333;font-size:.95rem;">
                                <span class="feature-check">&#10003;</span> Secure, compliant data handling at every step
                            </li>
                        </ul>
                        <div class="d-flex gap-3 flex-wrap">
                            <button class="btn-primary-c">Learn More</button>
                        </div>
                    </div>

                    {{-- RIGHT – Dashboard Illustration --}}
                    <div class="col-lg-6">
                        <div class="hero-img-wrap">
                            <svg width="100%" viewBox="0 0 540 320" xmlns="http://www.w3.org/2000/svg">
                                <rect width="540" height="320" fill="#e6f1fb" rx="18" />
                                <!-- Window chrome -->
                                <rect x="30" y="30" width="480" height="260" rx="12" fill="#fff"
                                    stroke="#b5d4f4" stroke-width="1.5" />
                                <rect x="30" y="30" width="480" height="44" rx="12" fill="#185fa5" />
                                <rect x="30" y="62" width="480" height="12" fill="#185fa5" />
                                <circle cx="55" cy="52" r="8" fill="#fff" opacity="0.3" />
                                <rect x="72" y="46" width="80" height="10" rx="4" fill="#fff"
                                    opacity="0.5" />
                                <rect x="400" y="46" width="50" height="10" rx="4" fill="#fff"
                                    opacity="0.3" />
                                <rect x="460" y="46" width="30" height="10" rx="4" fill="#7fb3ee"
                                    opacity="0.7" />
                                <!-- Stat cards -->
                                <rect x="48" y="92" width="100" height="56" rx="8" fill="#e6f1fb"
                                    stroke="#b5d4f4" stroke-width="1" />
                                <text x="98" y="117" text-anchor="middle" font-size="20" font-weight="700"
                                    fill="#185fa5">124</text>
                                <text x="98" y="133" text-anchor="middle" font-size="9" fill="#555">Employees</text>
                                <rect x="162" y="92" width="100" height="56" rx="8" fill="#e6f1fb"
                                    stroke="#b5d4f4" stroke-width="1" />
                                <text x="212" y="117" text-anchor="middle" font-size="20" font-weight="700"
                                    fill="#185fa5">38</text>
                                <text x="212" y="133" text-anchor="middle" font-size="9" fill="#555">Applicants</text>
                                <rect x="276" y="92" width="100" height="56" rx="8" fill="#e6f1fb"
                                    stroke="#b5d4f4" stroke-width="1" />
                                <text x="326" y="117" text-anchor="middle" font-size="20" font-weight="700"
                                    fill="#185fa5">12</text>
                                <text x="326" y="133" text-anchor="middle" font-size="9" fill="#555">Open Jobs</text>
                                <rect x="390" y="92" width="100" height="56" rx="8" fill="#e6f1fb"
                                    stroke="#b5d4f4" stroke-width="1" />
                                <text x="440" y="117" text-anchor="middle" font-size="20" font-weight="700"
                                    fill="#185fa5">7</text>
                                <text x="440" y="133" text-anchor="middle" font-size="9" fill="#555">New Hires</text>
                                <!-- Table header -->
                                <rect x="48" y="162" width="442" height="20" rx="4" fill="#f0f6fe" />
                                <text x="60" y="176" font-size="9" fill="#555" font-weight="600">Name</text>
                                <text x="180" y="176" font-size="9" fill="#555" font-weight="600">Department</text>
                                <text x="310" y="176" font-size="9" fill="#555" font-weight="600">Status</text>
                                <text x="410" y="176" font-size="9" fill="#555" font-weight="600">Date Hired</text>
                                <line x1="48" y1="183" x2="490" y2="183" stroke="#d0e4f8"
                                    stroke-width="0.8" />
                                <!-- Row 1 -->
                                <circle cx="60" cy="196" r="7" fill="#b5d4f4" />
                                <text x="72" y="200" font-size="9" fill="#333">Maria Santos</text>
                                <text x="180" y="200" font-size="9" fill="#333">Engineering</text>
                                <rect x="305" y="191" width="40" height="12" rx="5" fill="#d4f1e5" />
                                <text x="325" y="200" text-anchor="middle" font-size="8" fill="#0a6640">Active</text>
                                <text x="410" y="200" font-size="9" fill="#333">Jan 10, 2025</text>
                                <line x1="48" y1="207" x2="490" y2="207" stroke="#d0e4f8"
                                    stroke-width="0.8" />
                                <!-- Row 2 -->
                                <circle cx="60" cy="220" r="7" fill="#185fa5" />
                                <text x="72" y="224" font-size="9" fill="#333">James Reyes</text>
                                <text x="180" y="224" font-size="9" fill="#333">HR</text>
                                <rect x="305" y="215" width="52" height="12" rx="5" fill="#fdebd0" />
                                <text x="331" y="224" text-anchor="middle" font-size="8" fill="#7a4500">Applicant</text>
                                <text x="410" y="224" font-size="9" fill="#333">Mar 5, 2025</text>
                                <line x1="48" y1="231" x2="490" y2="231" stroke="#d0e4f8"
                                    stroke-width="0.8" />
                                <!-- Row 3 -->
                                <circle cx="60" cy="244" r="7" fill="#7fb3ee" />
                                <text x="72" y="248" font-size="9" fill="#333">Claire Bautista</text>
                                <text x="180" y="248" font-size="9" fill="#333">Marketing</text>
                                <rect x="305" y="239" width="40" height="12" rx="5" fill="#d4f1e5" />
                                <text x="325" y="248" text-anchor="middle" font-size="8" fill="#0a6640">Active</text>
                                <text x="410" y="248" font-size="9" fill="#333">Feb 22, 2025</text>
                            </svg>
                        </div>
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
                            <div class="team-img-area"
                                style="background:linear-gradient(135deg,#185fa5 0%,#0d2d56 100%);">
                                {{-- Replace src with actual photo: <img src="{{ asset('images/team/andrea.jpg') }}" ...> --}}
                                <svg width="120" height="180" viewBox="0 0 120 180">
                                    <ellipse cx="60" cy="65" rx="32" ry="34" fill="#7fb3ee"
                                        opacity="0.5" />
                                    <circle cx="60" cy="58" r="26" fill="#b5d4f4" />
                                    <ellipse cx="60" cy="140" rx="44" ry="38" fill="#7fb3ee"
                                        opacity="0.4" />
                                    <circle cx="60" cy="55" r="18" fill="#e6f1fb" />
                                    <ellipse cx="60" cy="130" rx="36" ry="30" fill="#b5d4f4"
                                        opacity="0.7" />
                                </svg>
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
                            <div class="team-img-area"
                                style="background:linear-gradient(135deg,#0d2d56 0%,#1a6fd4 100%);">
                                {{-- Replace src with actual photo: <img src="{{ asset('images/team/carlo.jpg') }}" ...> --}}
                                <svg width="120" height="180" viewBox="0 0 120 180">
                                    <ellipse cx="60" cy="65" rx="32" ry="34" fill="#185fa5"
                                        opacity="0.5" />
                                    <circle cx="60" cy="58" r="26" fill="#7fb3ee" />
                                    <ellipse cx="60" cy="140" rx="44" ry="38" fill="#185fa5"
                                        opacity="0.4" />
                                    <circle cx="60" cy="55" r="18" fill="#e6f1fb" />
                                    <ellipse cx="60" cy="130" rx="36" ry="30" fill="#7fb3ee"
                                        opacity="0.7" />
                                </svg>
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
                            <div class="team-img-area"
                                style="background:linear-gradient(135deg,#042c53 0%,#185fa5 100%);">
                                {{-- Replace src with actual photo: <img src="{{ asset('images/team/sofia.jpg') }}" ...> --}}
                                <svg width="120" height="180" viewBox="0 0 120 180">
                                    <ellipse cx="60" cy="65" rx="32" ry="34" fill="#378add"
                                        opacity="0.5" />
                                    <circle cx="60" cy="58" r="26" fill="#b5d4f4" />
                                    <ellipse cx="60" cy="140" rx="44" ry="38" fill="#378add"
                                        opacity="0.4" />
                                    <circle cx="60" cy="55" r="18" fill="#fff" />
                                    <ellipse cx="60" cy="130" rx="36" ry="30" fill="#b5d4f4"
                                        opacity="0.7" />
                                </svg>
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
