@extends('layouts/contentNavbarLayout')

@section('title', 'Register')

@section('content')
    <div class="px-4">
        <a href="{{ route('employee') }}" class="btn btn-outline-secondary btn-sm rounded-3">
            Back
        </a>
    </div>
    <section id="employeeDetailsSection" class="container-fluid py-4">
        <!-- Header -->
        <div class="bg-primary px-4 pt-4 pb-3 d-flex flex-wrap align-items-end gap-3 position-relative rounded-3">

            <div class="position-relative flex-shrink-0">
                <img id="employeeProfilePicture" src="https://i.pravatar.cc/150?img=12"
                    class="rounded-circle border border-3 border-white object-fit-cover" width="96" height="96">
            </div>

            <div class="pb-2 flex-grow-1">
                <p class="text-white-50 small mb-1 text-uppercase" style="letter-spacing:.07em;font-size:11px;">
                    Employee Profile
                </p>

                <h5 class="text-white fw-semibold mb-1" id="employeeName">
                    {{ $data->person->firstname }} {{ $data->person->middlename[0] }}. {{ $data->person->lastname }}
                </h5>

                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-white small" id="employeePosition">
                        {{ $data->latestTitle->title }}
                    </span>
                    <span class="text-white d-none d-sm-inline">·</span>
                    <span class="text-white small" id="employeeDepartment">
                        Employee
                    </span>
                </div>
            </div>

            <div class="pb-2 d-flex gap-2 flex-wrap">
                <span class="badge rounded-pill bg-success text-white border px-3 py-2">
                    {{ $data->status_request }}
                </span>
                <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                    {{ $data->emp_id }}
                </span>
            </div>
        </div>


        <!-- Content -->
        <div class="mt-4 px-2 px-md-4">
            <div class="row g-4">

                <!-- Personal Info -->
                <div class="col-12 col-lg-8">
                    <div class="border rounded-3 p-3 h-100">
                        <p class="text-muted small text-uppercase fw-semibold mb-3"
                            style="letter-spacing:.07em;font-size:11px;">
                            Personal Information
                        </p>

                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Full Name</p>
                                <p class="fw-semibold small mb-0" id="employeeFullName">
                                    {{ $data->person->firstname }} {{ $data->person->middlename[0] }}.
                                    {{ $data->person->lastname }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Email</p>
                                <p class="fw-semibold small mb-0 text-primary" id="employeeEmail">
                                    {{ $data->email }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Contact</p>
                                <p class="fw-semibold small mb-0" id="employeeContact">
                                    {{ $data->person->phone_number }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Date Hired</p>
                                <p class="fw-semibold small mb-0" id="employeeDateHired">
                                    {{ date('F d Y', strtotime($data->hire_date)) }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Birthday</p>
                                <p class="fw-semibold small mb-0" id="employeeBirthday">
                                    {{ date('F d Y', strtotime($data->hire_date)) }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Address</p>
                                <p class="fw-semibold small mb-0" id="employeeAddress">
                                    {{ $data->person->address }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Sex</p>
                                <p class="fw-semibold small mb-0" id="employeeAddress">
                                    {{ $data->person->sex }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-muted small mb-1">Blood type</p>
                                <p class="fw-semibold small mb-0" id="employeeAddress">
                                    {{ $data->person->blood_type }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Work Details -->
                <div class="col-12 col-lg-4">
                    <div class="border rounded-3 p-3 h-100">
                        <p class="text-muted small text-uppercase fw-semibold mb-3"
                            style="letter-spacing:.07em;font-size:11px;">
                            Work Details
                        </p>

                        <div class="d-flex flex-column gap-3">

                            <div>
                                <p class="text-muted small mb-1">Manager</p>
                                <p class="fw-semibold small mb-0" id="employeeManager">
                                    Maria Santos
                                </p>
                            </div>

                            <div>
                                <p class="text-muted small mb-1">Employment Type</p>
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3">
                                    {{ $data->status }}
                                </span>
                            </div>

                            <div>
                                <p class="text-muted small mb-1">Title</p>
                                <p class="fw-semibold small mb-0" id="employeeTitle">
                                    {{ $data->latestTitle->title }}
                                </p>
                            </div>

                            <div>
                                <p class="text-muted small mb-1">Salary</p>
                                <p class="fw-semibold small mb-0" id="employeeSalary">
                                    ₱{{ number_format($data->latestSalary->salary, 2) }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Stats -->
                <div class="col-12 col-md-3">
                    <div class="bg-light rounded-3 p-3 text-center">
                        <p class="text-muted small mb-1">Days Present</p>
                        <p class="fw-semibold fs-4 mb-0" id="statPresent">21</p>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="bg-light rounded-3 p-3 text-center">
                        <p class="text-muted small mb-1">Absences</p>
                        <p class="fw-semibold fs-4 mb-0 text-danger" id="statAbsent">1</p>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="bg-light rounded-3 p-3 text-center">
                        <p class="text-muted small mb-1">Leave Balance</p>
                        <p class="fw-semibold fs-4 mb-0" id="statLeave">9</p>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="bg-light rounded-3 p-3 text-center">
                        <p class="text-muted small mb-1">Years Working</p>
                        <p class="fw-semibold fs-4 mb-0" id="statYears">4</p>
                    </div>
                </div>


                <!-- Notes -->
                <div class="col-12 col-lg-8">
                    <div class="bg-warning-subtle border border-warning-subtle border-start border-4 rounded-3 p-3">
                        <p class="fw-semibold small text-warning-emphasis mb-1">Notes</p>
                        <p class="small text-warning-emphasis mb-0" id="employeeNotes">
                            Employee is currently under a 6-month probationary review.
                            Performance evaluation scheduled for June 2025.
                            No disciplinary records on file.
                        </p>
                    </div>
                </div>


                <!-- Face Registration -->
                <div class="col-12 col-lg-4">
                    <div
                        class="border rounded-3 p-3 text-center h-100 d-flex flex-column align-items-center justify-content-center gap-2">

                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-1"
                            style="width:48px;height:48px;">
                            <i class="bi bi-person-bounding-box fs-5 text-secondary"></i>
                        </div>

                        <p class="small text-muted mb-0">
                            Face ID not yet registered
                        </p>

                        <a href="{{ route('employee-faceRegistration', $employee_id) }}"
                            class="btn btn-primary btn-sm w-100 rounded-3" id="btnRegisterFace">
                            Register Face
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
