@extends('layouts/contentNavbarLayout')

@section('title', 'Job Details')
@section('page-script')
    @vite('resources/assets/js/job-details.js')
@endsection
@section('content')
    <main class="min-vh-100 mt-5">
        <div
            class="d-flex flex-column flex-md-row align-items-md-center align-items-start justify-content-start justify-content-md-between">
            <h3 class="fw-bold">Job Description</h3>
            <div class="d-flex align-items-end gap-4">
                <a title="Delete Job Posting" id="deleteJob" data-id="{{ $details->id }}" href="javascript::void(0)"><i
                        class="ri-delete-bin-6-line text-danger"></i></a>
                @if ($details->status == 'open')
                    <a href="javascript:void(0)" data-id="{{ $id }}" id="urlLinks" title="Copy link">
                        <i class="ri-links-line"></i>
                    </a>
                    <a href="{{ route('job-posting-applicants', $id) }}" class="text-decoration-none"
                        title="View Applicants">
                        <i class="ri-user-line"></i>
                        <span class="badge bg-primary">{{ $details->applicants->count() ?? 0 }}</span>
                    </a>
                @else
                    <a title="Update Job Posting" href="javascript::void(0)" data-bs-toggle="modal"
                        data-bs-target="#Modal"><i class="ri-edit-2-line"></i></a>
                    <a title="Open Job Posting" href="javascript::void(0)" data-id="{{ $details->id }}" id="OpenJob"><i
                            class="ri-briefcase-line"></i></a>
                @endif
            </div>
        </div>
        <div class="boder border-0 border-top"></div>
        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-lg-8">
                <h4 class="fw-bold mb-3 mt-5">About</h4>
                <p class="text-muted">
                    {{ $details->description }}
                </p>

                <h4 class="fw-bold mt-5 mb-3">What you’ll do</h4>
                <p class="text-muted">Areas you could work on:</p>

                <ul class="text-muted">
                    @foreach (explode("\n", $details->objectives) as $objective)
                        @if (trim($objective) != '')
                            <li>{{ trim($objective) }}</li>
                        @endif
                    @endforeach
                </ul>

                <h4 class="fw-bold mt-5 mb-3">Requirements:</h4>
                <ul class="text-muted">
                    @foreach (explode("\n", $details->requirements) as $requirements)
                        @if (trim($requirements) != '')
                            <li>{{ trim($requirements) }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="info-card p-4">
                    <div>
                        <h5 class="fw-bold mt-1">{{ $details->job_title }}</h5>
                    </div>

                    <hr>

                    <div>
                        <small class="text-muted">Department</small>
                        <h6 class="fw-bold mt-1">{{ $details->dept_name }}</h6>
                    </div>

                    <hr>

                    <div>
                        <small class="text-muted">Position</small>
                        <h6 class="fw-bold mt-1">{{ $details->position }}</h6>
                    </div>

                    <hr>

                    <div>
                        <small class="text-muted">Monthl Salary</small>
                        <h6 class="fw-bold mt-1">₱{{ number_format($details->salary, 2) }}</h6>
                    </div>

                    <hr>


                    <div>
                        <small class="text-muted">Job Type</small>
                        <h6 class="fw-bold mt-1">{{ $details->employment_type }}</h6>
                    </div>
                    <hr>
                    <div>
                        <small class="text-muted">Work Setup</small>
                        <h6 class="fw-bold mt-1">{{ $details->work_setup }}</h6>
                    </div>

                    <hr>

                    <div>
                        <small class="text-muted">Location</small>
                        <h6 class="fw-bold mt-1">{{ $details->location }}</h6>
                    </div>

                    <hr>

                    <div>
                        <small class="text-muted">Until</small>
                        <h6 class="fw-bold mt-1 {{ $details->closing_date->isPast() ? 'text-danger' : 'text-dark' }}">
                            {{ $details->closing_date->isPast() ? 'Closed' : date('M d, Y', strtotime($details->closing_date)) }}
                        </h6>
                    </div>

                </div>
            </div>

        </div>

    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Update Job</h5>
                </div>

                <form class="modal-body" id="jobPostingData">
                    @csrf
                    <input type="hidden" value="{{ $details->id }}" name="id">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="jobTitle" class="form-label">Title</label>
                            <input id="jobTitle" value="{{ $details->job_title }}" name="jobTitle"
                                class="form-control form-control-sm" type="text" placeholder="Enter the job title" />
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="jobPosition" class="form-label">Position</label>
                            <input id="jobPosition" name="jobPosition" value="{{ $details->position }}"
                                class="form-control form-control-sm" type="text" placeholder="Enter the job position" />
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="jobLocation" class="form-label">Location</label>
                            <input id="jobLocation" name="jobLocation" value="{{ $details->location }}"
                                class="form-control form-control-sm" type="text" placeholder="Enter the job location" />
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="activeDate" class="form-label">Active Date</label>
                            <input id="activeDate" name="activeDate"
                                value="{{ $details->closing_date->toDateString() }}" class="form-control form-control-sm"
                                type="date" />
                        </div>
                    </div>

                    <div class="row mt-2">
                        <!-- Job Type -->
                        <div class="col-12 col-md-6">
                            <label for="jobType" class="form-label">Job Type</label>
                            <select name="jobType" id="jobType" class="form-select">
                                <option value="Full-time"
                                    {{ $details->employment_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time"
                                    {{ $details->employment_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ $details->employment_type == 'Contract' ? 'selected' : '' }}>
                                    Contract</option>
                                <option value="Temporary"
                                    {{ $details->employment_type == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                <option value="Freelance"
                                    {{ $details->employment_type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Internship"
                                    {{ $details->employment_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Seasonal" {{ $details->employment_type == 'Seasonal' ? 'selected' : '' }}>
                                    Seasonal</option>
                                <option value="Commission-based"
                                    {{ $details->employment_type == 'Commission-based' ? 'selected' : '' }}>
                                    Commission-based</option>
                            </select>
                        </div>

                        <!-- Work Arrangement -->
                        <div class="col-12 col-md-6">
                            <label for="workArrangement" class="form-label">Work Arrangement</label>
                            <select name="workArrangement" id="workArrangement" class="form-select">
                                <option value="On-site" {{ $details->work_setup == 'On-site' ? 'selected' : '' }}>On-site
                                </option>
                                <option value="Remote" {{ $details->work_setup == 'Remote' ? 'selected' : '' }}>Remote
                                </option>
                                <option value="Hybrid" {{ $details->work_setup == 'Hybrid' ? 'selected' : '' }}>Hybrid
                                </option>
                                <option value="Flexible Schedule"
                                    {{ $details->work_setup == 'Flexible Schedule' ? 'selected' : '' }}>Flexible Schedule
                                </option>
                                <option value="Field-based" {{ $details->work_setup == 'Field-based' ? 'selected' : '' }}>
                                    Field-based</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <!-- Department -->
                        <div class="col-12 col-md-6">
                            <label for="department" class="form-label">Department</label>
                            <select name="department" id="department" class="form-select">
                                @foreach ($departments as $item)
                                    <option value="{{ $item->dept_no }}"
                                        {{ $details->dept_no == $item->dept_no ? 'selected' : '' }}>
                                        {{ $item->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Salary -->
                        <div class="col-12 col-md-6">
                            <label for="salary" class="form-label">Salary</label>
                            <input id="Jobsalary" value="{{ $details->salary }}" name="salary"
                                class="form-control form-control-sm" type="number" placeholder="Enter the job salary" />
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobDescription" class="form-label">Description</label>
                            <textarea class="form-control h-px-90" id="jobDescription" name="jobDescription"
                                placeholder="Enter job description here...">{{ $details->description }}</textarea>
                        </div>
                    </div>

                    <!-- Objective -->
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobObjective" class="form-label">Objective</label>
                            <textarea class="form-control h-px-90" id="jobObjective" name="jobObjective"
                                placeholder="Enter job objectives here...">{{ $details->objectives }}</textarea>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="row">
                        <div class="col mt-2">
                            <label for="jobRequirements" class="form-label">Requirements</label>
                            <textarea class="form-control h-px-90" id="jobRequirements" name="jobRequirements"
                                placeholder="Enter job requirements here...">{{ $details->requirements }}</textarea>
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
