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
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-1"
                    style="width:80px;height:80px;">
                    <i class="ri ri-user-line fs-1 text-white"></i>
                </div>
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

            <div class="pb-2 d-flex">
                <span class="badge rounded-pill bg-success text-white px-3 py-2">
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
                        <p class="text-dark small text-uppercase fw-bold mb-3" style="letter-spacing:.07em;font-size:11px;">
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
                        <p class="text-dark small text-uppercase fw-bold mb-3" style="letter-spacing:.07em;font-size:11px;">
                            Work Details
                        </p>

                        <div class="d-flex flex-column gap-3">

                            <div>
                                <p class="text-muted small mb-1">Employment Type</p>
                                <span class="badge {{ $data->EmployeeBadge() }} text-white rounded-pill px-3">
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
                <!-- Face Registration -->
                <div class="col-12 col-lg-4">
                    <div
                        class="border rounded-3 p-3 text-center h-100 d-flex flex-column align-items-center justify-content-center gap-2">

                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-1"
                            style="width:48px;height:48px;">
                            <i class="ri ri-user-line fs-5 text-white"></i>
                        </div>

                        @if ($data->face_descriptor == null)
                            <p class="small text-muted mb-0">
                                Face ID not yet registered
                            </p>
                            <a href="{{ route('employee-faceRegistration', $employee_id) }}"
                                class="btn btn-primary btn-sm w-100 rounded-3" id="btnRegisterFace">
                                Register Face
                            </a>
                        @else
                            <p class="small text-success mb-0">
                                Face ID registered
                            </p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
