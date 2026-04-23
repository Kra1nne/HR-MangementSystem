@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
    @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
    <div class="row gy-6">
        <!-- Congratulations card -->
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body text-nowrap">
                    <h5 class="card-title mb-0 flex-wrap text-nowrap">Welcome {{ Auth::user()->person->firstname }}! 🎉</h5>

                    <h4 class="text-primary mb-0 mt-2">{{ date('D, M. d', strtotime(now()->toDateString())) }}</h4>
                    <p class="mb-2" id="runningTime">00:00:00</p>
                    <a href="{{ route('attendance-check') }}" class="btn btn-sm btn-primary">Attendance</a>
                </div>
                <img src="{{ asset('assets/img/favicon/logo-removebg.png') }}"
                    class="position-absolute bottom-0 end-0 me-5 mb-5" width="150" alt="view sales">
            </div>
        </div>
        <!--/ Congratulations card -->

        <!-- Transactions -->
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">VoxSync Workforce System</h5>
                    </div>
                </div>
                <div class="card-body pt-lg-10">
                    <div class="row g-6">
                        <div class="col-md-3 col-sm-12 ">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <a href="{{ route('employee') }}" class="avatar-initial bg-primary rounded shadow-xs">
                                        <i class="ri-id-card-line ri-24px"></i>
                                    </a>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Employees</p>
                                    <h5 class="mb-0">{{ $employeeList->count() }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 ">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <a href="{{ route('job-posting') }}"
                                        class="avatar-initial bg-success rounded shadow-xs">
                                        <i class="ri-briefcase-line ri-24px"></i>
                                    </a>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Jobs</p>
                                    <h5 class="mb-0">{{ $jobList->count() }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 ">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <a href="{{ route('department-list') }}"
                                        class="avatar-initial bg-warning rounded shadow-xs">
                                        <i class="ri-profile-line ri-24px"></i>
                                    </a>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Departments</p>
                                    <h5 class="mb-0">{{ $listOfDepartment->count() }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 ">
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    <a href="{{ route('job-posting') }}" class="avatar-initial bg-info rounded shadow-xs">
                                        <i class="ri-team-line ri-24px"></i>
                                    </a>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-0">Applicants</p>
                                    <h5 class="mb-0">{{ $listOfApplicant->count() }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0 fw-semibold">Applicants Over Time</h5>
                    <span class="badge bg-primary rounded-pill">{{ $applicants->sum('total') }} Total</span>
                </div>
                <div class="card-body">
                    <div id="applicants-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {{-- Donut Chart --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-4 mb-5 border-bottom">
                    <h5 class="mb-0 fw-semibold">Application Status Breakdown</h5>
                </div>
                <div class="card-body py-5">
                    <div id="status-chart"></div>
                </div>
            </div>

        </div>
        <!-- Data Tables -->
        <div class="col-12">
            <div class="card overflow-hidden">
                <div class="table-responsive">
                    <h5 class="px-5 pt-4">Recent Applicants</h5>
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-truncate">User</th>
                                <th class="text-truncate">Email</th>
                                <th class="text-truncate">Date</th>
                                <th class="text-truncate">Position</th>
                                <th class="text-truncate">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applicantsList as $item)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-primary bg-opacity-25 text-white d-flex align-items-center justify-content-center fw-bold"
                                                style="width:42px;height:42px;flex-shrink:0;">
                                                {{ strtoupper(substr($item->candidate->person->firstname, 0, 1)) }}
                                                {{ strtoupper(substr($item->candidate->person->lastname, 0, 1)) }}
                                            </div>
                                            <div class="fw-semibold text-dark">
                                                {{ $item->candidate->person->firstname }}
                                                {{ $item->candidate->person->middlename }}
                                                {{ $item->candidate->person->lastname }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">{{ $item->email }}</td>
                                    <td class="text-truncate">{{ $item->applied_at }}</td>
                                    <td class="text-truncate">
                                        <span
                                            class="badge bg-label-secondary rounded-pill">{{ $item->jobposting->job_title }}</span>
                                    </td>
                                    <td><span
                                            class="{{ $item->statusBadge() }} rounded-pill">{{ Str::ucfirst($item->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Applicants</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        const applicantsData = @json($applicants);
        const statusData = @json($statusData);
    </script>

@endsection
