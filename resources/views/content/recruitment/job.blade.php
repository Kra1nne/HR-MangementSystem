@extends('layouts/contentNavbarLayout')

@section('title', 'Job Requisition')

@section('page-script')
    @vite('resources/assets/js/candidate.js')
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('recruitment-index') }}">Recruitment</a>
                </li>
            </ol>
        </nav>
        <section>
            <div class="d-flex justify-content-end mb-3 gap-2">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">Filter</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0);">Active</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Expired</a></li>
                </ul>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>Creat New Job</button>
            </div>
            <div class="row g-4">
                <a href="{{ route('recruitment-description') }}" class="col-md-4 pointer">
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
                                <span class="badge bg-success-subtle text-success">Design</span>
                                <span class="badge bg-light text-dark border">Full Time</span>
                                <span class="badge bg-light text-dark border">Onsite</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('recruitment-description') }}" class="col-md-4">
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
                <a href="{{ route('recruitment-description') }}" class="col-md-4">
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
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Job</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="jobTitle" class="form-label">Title</label>
                            <input id="jobTitle" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job title" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="jobPosition" class="form-label">Position</label>
                            <input id="jobPosition" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job position" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="jobLocation" class="form-label">Location</label>
                            <input id="jobLocation" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job location" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="activeDate" class="form-label">Active Date</label>
                            <input id="activeDate" class="form-control form-control-sm" type="date" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="jobType" class="form-label">Job Type</label>
                            <select name="jobType" id="jobType" class="form-select">
                                <option selected disabled>Select Job Type</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Contract</option>
                                <option value="Temporary">Temporary</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                                <option value="Seasonal">Seasonal</option>
                                <option value="Commission-based">Commission-based</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="workArrangement" class="form-label">Work Arrangement</label>
                            <select name="workArrangement" id="workArrangement" class="form-select">
                                <option selected disabled>Select Work Arrangement</option>
                                <option value="On-site">On-site</option>
                                <option value="Remote">Remote (Work from home)</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Flexible Schedule">Flexible Schedule</option>
                                <option value="Field-based">Field-based</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobDescription" class="form-label">Description</label>
                            <textarea class="form-control h-px-90" id="jobDescription" placeholder="Enter job description here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobObjective" class="form-label">Objective</label>
                            <textarea class="form-control h-px-90" id="jobObjective" placeholder="Enter job objectives here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobRequirements" class="form-label">Requirements</label>
                            <textarea class="form-control h-px-90" id="jobRequirements" placeholder="Enter job requirements here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
