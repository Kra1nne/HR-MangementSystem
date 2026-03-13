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
            <div
                class="d-flex flex-column flex-lg-row 
            justify-content-between align-items-start align-items-lg-center mb-3 gap-2">
                <div>
                    <form action="{{ route('recruitment-index') }}" method="GET"
                        class="nav-item d-flex align-items-center gap-1">
                        <div class="input-group input-group-sm input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31">
                                <i class="icon-base ri ri-search-line icon-20px"></i>
                            </span>
                            <input type="text" name="search" class="form-control" placeholder="Search..."
                                aria-label="Search..." aria-describedby="basic-addon-search31" />
                        </div>
                        <button class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                        <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>Creat New Job</button>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($jobs as $item)
                    <a href="{{ route('recruitment-description', $item->encrypted_id) }}" class="col-md-4 pointer">
                        <div class="card h-100 w-100 shadow-sm border-0 rounded-4">
                            <div class="card-body">
                                <span
                                    class="badge {{ $item->active_date->isPast() ? 'bg-danger text-white' : 'bg-primary text-white' }} mb-3">
                                    Active until: <strong>{{ date_format($item->active_date, 'M. d Y') }}</strong>
                                </span>

                                <h5 class="fw-bold">{{ $item->title }}</h5>
                                <p class="text-muted small">
                                    {{ Str::words($item->description, 15, '...') }}
                                </p>

                                <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 mt-3 align-items-start">
                                    <span class="badge bg-light border text-primary">{{ $item->job_type }}</span>
                                    <span class="badge bg-light border text-primary">{{ $item->work_arrangement }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="pt-5 d-flex justify-content-end">
                {{ $jobs->onEachSide(2)->links() }}
            </div>
        </section>

    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Job</h5>
                </div>
                <form id="dataJob" class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="jobTitle" class="form-label">Title</label>
                            <input id="jobTitle" name="title" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job title" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="jobPosition" class="form-label">Position</label>
                            <input id="jobPosition" name="position" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job position" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-4">
                            <label for="jobLocation" class="form-label">Location</label>
                            <input id="jobLocation" name="location" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job location" />
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="activeDate" class="form-label">Active Date</label>
                            <input id="activeDate" name="date" class="form-control form-control-sm" type="date" />
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="jobType" class="form-label">Department</label>
                            <select name="dept" id="dept" class="form-select form-select-sm">
                                <option selected disabled>Select the department</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->dept_no }}">{{ $item->dept_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-4">
                            <label for="jobType" class="form-label">Job Type</label>
                            <select name="jobType" id="jobType" class="form-select form-select-sm">
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

                        <div class="col-12 col-md-4">
                            <label for="workArrangement" class="form-label">Work Arrangement</label>
                            <select name="workArrangement" id="workArrangement" class="form-select form-select-sm">
                                <option selected disabled>Select Work Arrangement</option>
                                <option value="On-site">On-site</option>
                                <option value="Remote">Remote (Work from home)</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Flexible Schedule">Flexible Schedule</option>
                                <option value="Field-based">Field-based</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="workArrangement" class="form-label">Salary Range</label>
                            <input id="salary_range" name="salary_range" class="form-control form-control-sm"
                                type="text" placeholder="Enter Salary Range.." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobDescription" class="form-label">Description</label>
                            <textarea class="form-control h-px-90" id="jobDescription" name="description"
                                placeholder="Enter job description here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobObjective" class="form-label">Objective</label>
                            <textarea class="form-control h-px-90" id="jobObjective" name="objective"
                                placeholder="Enter job objectives here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobRequirements" class="form-label">Requirements</label>
                            <textarea class="form-control h-px-90" id="jobRequirements" name="requirements"
                                placeholder="Enter job requirements here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
