@extends('layouts/homepagelayout')

@section('title', 'Services Page')

@section('content')
    <main class="min-vh-100">
        <section class="container mt-5">
            <div class="row g-4">
                <header>
                    <h4 class="fw-bold">Job Vacancies</h4>
                </header>
                <div class="d-flex flex-column flex-md-row align-items-start justify-content-between m-2">
                    <div>

                    </div>
                    <form method="get" class="nav-item d-flex align-items-center gap-1 mb-2 mb-md-0">
                        <div class="input-group input-group-merge">
                            <input type="text" name="search" class="form-control-sm border-0 border-bottom w-100"
                                placeholder="Search" style="outline: none; box-shadow: none;"
                                onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                                onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..."
                                aria-describedby="basic-addon-search31" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" id="search">Search</button>
                        <button class="border-none btn-outline-dark {{ $isSearch ? 'd-block' : 'd-none' }}"
                            id="closeMark"><i class="ri-close-line text-danger"></i></button>
                    </form>
                </div>
                {{-- <div class="d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <i class="ri-briefcase-line fs-1 text-primary"></i>
                    </div>
                    <h5 class="lead mt-3">No Available Job Vacancies</h5>
                </div> --}}
                <a href="javascript::void(0)" class="col-md-4 pointer">
                    <div class="card h-100 w-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <span class="badge bg-light text-dark mb-3">
                                Active until: <strong>Jan 31, 2024</strong>
                            </span>

                            <h5 class="fw-bold">UI/UX Designer</h5>
                            <p class="text-muted small">
                                Gathering and evaluating user requirements, in collaboration with product managers and
                                engineers
                            </p>

                            <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 mt-3 align-items-start">
                                <span class="badge bg-success-subtle text-success">Department</span>
                                <span class="badge bg-light text-dark border">Full Time</span>
                                <span class="badge bg-light text-dark border">Onsite</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript::void(0)" class="col-md-4">
                    <div class="card h-100 w-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <span class="badge bg-light text-dark mb-3">
                                Active until: <strong>Jan 31, 2024</strong>
                            </span>

                            <h5 class="fw-bold">Junior Frontend Developer</h5>
                            <p class="text-muted small">
                                A front-end developer is basically a web developer who has a specialization in creating user
                                interfaces for applications
                            </p>

                            <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 mt-3 align-items-start">
                                <span class="badge bg-primary-subtle text-primary">Development</span>
                                <span class="badge bg-light text-dark border">Full Time</span>
                                <span class="badge bg-light text-dark border">Remote</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript::void(0)" class="col-md-4">
                    <div class="card h-100 w-100 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <span class="badge bg-light text-dark mb-3">
                                Active until: <strong>Jan 31, 2024</strong>
                            </span>

                            <h5 class="fw-bold">Motion Graphic Designer</h5>
                            <p class="text-muted small">
                                We are currently hiring a Motion Graphics Designer who will work closely with the marketing
                                team, video producers
                            </p>

                            <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 mt-3 align-items-start">
                                <span class="badge bg-light text-dark border">Full Time</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </main>
@endsection
