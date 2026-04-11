@extends('layouts/homepagelayout')

@section('title', 'Job Details')

@section('content')
    <main class="min-vh-100 mt-5">
        <div class="container">
            <div class="my-4">
                <a href="{{ route('job-page') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back
                </a>
            </div>
            <div
                class="d-flex flex-column flex-md-row align-items-md-center align-items-start justify-content-start justify-content-md-between">
                <h3 class="fw-bold">Job Description</h3>
                <a href="{{ route('job-form', $jobID) }}"><i class="ri-edit-2-line"></i></a>
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
                            <h6 class="fw-bold mt-1">{{ date('M d, Y', strtotime($details->closing_date)) }}</h6>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
