@extends('layouts/contentNavbarLayout')

@section('title', 'Job Posting')
@section('page-script')
    @vite('resources/assets/js/job_posting.js')
@endsection
@section('content')
    <main class="min-vh-100">
        <section class="container mt-5">
            <div class="row g-4">
                <header>
                    <h4 class="fw-bold">Job Vacancies</h4>
                </header>

                <div class="d-flex flex-column flex-md-row align-items-stretch gap-2 m-2">

                    {{-- Filters --}}
                    <form method="get" id="filterForm"
                        class="d-flex flex-column flex-md-row align-items-stretch gap-2 flex-grow-1">
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <select name="work_setup" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                            <option value="">All Work Setups</option>
                            <option value="On-site" {{ request('work_setup') == 'On-site' ? 'selected' : '' }}>On-site
                            </option>
                            <option value="Remote" {{ request('work_setup') == 'Remote' ? 'selected' : '' }}>Remote
                            </option>
                            <option value="Hybrid" {{ request('work_setup') == 'Hybrid' ? 'selected' : '' }}>Hybrid
                            </option>
                        </select>

                        <select name="employment_type" class="form-select form-select-sm"
                            onchange="$('#filterForm').submit()">
                            <option value="">All Employment Types</option>
                            <option value="Full-time" {{ request('employment_type') == 'Full-time' ? 'selected' : '' }}>
                                Full-time</option>
                            <option value="Part-time" {{ request('employment_type') == 'Part-time' ? 'selected' : '' }}>
                                Part-time</option>
                            <option value="Contract" {{ request('employment_type') == 'Contract' ? 'selected' : '' }}>
                                Contract</option>
                            <option value="Internship" {{ request('employment_type') == 'Internship' ? 'selected' : '' }}>
                                Internship</option>
                        </select>

                        <select name="dept_name" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                            <option value="">All Departments</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->dept_name }}"
                                    {{ request('dept_name') == $dept->dept_name ? 'selected' : '' }}>
                                    {{ $dept->dept_name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    {{-- Search --}}
                    <form method="get" class="d-flex align-items-stretch gap-2">
                        <input type="hidden" name="work_setup" value="{{ request('work_setup') }}">
                        <input type="hidden" name="employment_type" value="{{ request('employment_type') }}">
                        <input type="hidden" name="dept_name" value="{{ request('dept_name') }}">

                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm border-0 border-bottom" placeholder="Search"
                            style="outline: none; box-shadow: none;"
                            onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                            onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..." />

                        <button type="submit" class="btn btn-primary btn-sm">Search</button>

                        <a href="{{ route('job-posting') }}"
                            class="btn btn-outline-secondary btn-sm {{ $isSearch ? 'd-flex' : 'd-none' }} align-items-center"
                            id="closeMark">
                            <i class="ri-close-line text-danger"></i>
                        </a>
                    </form>

                </div>

                @forelse ($jobs as $item)
                    <a href="{{ route('job-posting-view', $item->encrypted_id) }}" class="col-md-4 pointer">
                        <div class="card h-100 w-100 shadow-sm border-0 rounded-4">
                            <div class="card-body">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-start alin-items-md-center mb-2">
                                    <span
                                        class="badge {{ $item->closing_date->isPast() ? 'bg-danger text-white' : 'bg-light text-dark' }} ">
                                        {{ $item->closing_date->isPast() ? 'Closed' : $item->created_at->diffForHumans() }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        Until {{ date('M d, Y', strtotime($item->closing_date)) }}
                                    </span>
                                </div>
                                <h5 class="fw-bold">{{ $item->job_title }}</h5>
                                <p class="text-muted small">
                                    {{ Str::limit($item->description, 150, '...') }}
                                </p>
                                <p class="fw-thin small mb-2">
                                    Salary: ₱{{ number_format($item->salary, 2) }} monthly
                                </p>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <span class="badge bg-success-subtle text-success">{{ $item->dept_name }}</span>
                                    <span class="badge bg-light text-dark border">{{ $item->work_setup }}</span>
                                    <span class="badge bg-light text-dark border">{{ $item->employment_type }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div>
                            <i class="ri-briefcase-line fs-1 text-primary"></i>
                        </div>
                        <h5 class="lead mt-3">No Available Job Vacancies</h5>
                    </div>
                @endforelse
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
                <form class="modal-body" id="jobPostingData">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="jobTitle" class="form-label">Title</label>
                            <input id="jobTitle" name="jobTitle" class="form-control form-control-sm" type="text"
                                placeholder="Enter the job title" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="jobPosition" class="form-label">Position</label>
                            <input id="jobPosition" name="jobPosition" class="form-control form-control-sm"
                                type="text" placeholder="Enter the job position" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="jobLocation" class="form-label">Location</label>
                            <input id="jobLocation" name="jobLocation" class="form-control form-control-sm"
                                type="text" placeholder="Enter the job location" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="activeDate" class="form-label">Active Date</label>
                            <input id="activeDate" name="activeDate" class="form-control form-control-sm"
                                type="date" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="jobType" class="form-label">Job Type</label>
                            <select name="jobType" id="jobType" class="form-select">
                                <option value="" selected disabled>Select Job Type</option>
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
                                <option value="" selected disabled>Select Work Arrangement</option>
                                <option value="On-site">On-site</option>
                                <option value="Remote">Remote (Work from home)</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Flexible Schedule">Flexible Schedule</option>
                                <option value="Field-based">Field-based</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="Department" class="form-label">Department</label>
                            <select name="department" id="department" class="form-select">
                                <option value="" selected disabled>Select Department</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->dept_no }}">{{ $item->dept_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="salary" class="form-label">Salary</label>
                            <input id="Jobsalary" name="salary" class="form-control form-control-sm" type="number"
                                placeholder="Enter the job salary" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobDescription" class="form-label">Description</label>
                            <textarea class="form-control h-px-90" id="jobDescription" name="jobDescription"
                                placeholder="Enter job description here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobObjective" class="form-label">Objective</label>
                            <textarea class="form-control h-px-90" id="jobObjective" name="jobObjective"
                                placeholder="Enter job objectives here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobRequirements" class="form-label">Requirements</label>
                            <textarea class="form-control h-px-90" id="jobRequirements" name="jobRequirements"
                                placeholder="Enter job requirements here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="BtnSubmit">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
