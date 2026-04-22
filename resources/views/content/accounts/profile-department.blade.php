@extends('layouts/contentNavbarLayout')

@section('title', 'Register')


@section('page-script')
    @vite('resources/assets/js/profile.js')
@endsection

@section('content')
    <div class="px-4">
        <a href="{{ route('department-list') }}" class="btn btn-outline-secondary btn-sm rounded-3">
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

            <div class="pb-2 d-flex gap-2 align-items-center">
                <span class="badge rounded-pill bg-success text-white">
                    {{ $data->emp_id }}
                </span>
            </div>
        </div>

        <div class="mt-4 px-md-4">
            <div class="row g-4">

                <!-- Personal Info -->
                <div class="col-12 col-lg-8">
                    <div class="border rounded-3 h-100">
                        <div class="border-bottom p-3 mb-3">
                            <p class="text-dark small text-uppercase fw-bold mb-0">
                                Personal Information
                            </p>
                        </div>
                        <div class="row g-3 p-3">

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
                                    {{ $data->person->user->email }}
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
                    <div class="border rounded-3 h-100">
                        <div class="border-bottom p-3 mb-">
                            <p class="text-dark small text-uppercase fw-bold mb-0">
                                Current Work Details
                            </p>
                        </div>

                        <div class="d-flex flex-column gap-3 p-3">

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
                            <div>
                                <p class="text-muted small mb-1">Department</p>
                                <p class="fw-semibold small mb-0" id="employeeSalary">
                                    {{ $data->latestDepartment->department->dept_name ?? 'N\A' }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border rounded-3 h-100">

                        <!-- Header -->
                        <div class="border-bottom p-3 d-flex justify-content-between align-items-center">
                            <p class="text-dark small text-uppercase fw-bold mb-0">
                                Employee Experience
                            </p>

                            <!-- Add New -->
                            <button class="btn btn-sm btn-primary rounded-pill px-3">
                                <i class="ri-add-line"></i> Add Experience
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="p-3">

                            <!-- Timeline Wrapper -->
                            <div class="position-relative">

                                <!-- Vertical Line -->
                                <div style="position:absolute; left:6px; top:0; bottom:0; width:2px; background:#dee2e6;">
                                </div>

                                <!-- Experience Item -->
                                <div class="mb-4 position-relative ps-4">

                                    <!-- Dot -->
                                    <div
                                        style="position:absolute; left:0; top:1px; width:12px; height:12px; background:#0d6efd; border-radius:50%;">
                                    </div>

                                    <div class=" p-3 bg-white">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1 fw-bold">Junior Developer</h6>
                                            <small class="text-muted">Jan 2020 - Dec 2021</small>
                                        </div>

                                        <p class="mb-1 small text-muted">IT Department</p>
                                        <p class="mb-1 small text-muted">$30,000</p>
                                        <p class="mb-2 small">Worked on internal systems and bug fixes.</p>

                                        <div class="d-flex gap-2">
                                            <a href="#" class="text-primary"><i class="ri-edit-2-line"></i></a>
                                            <a href="#" class="text-danger"><i class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Experience Item -->
                                <div class="mb-4 position-relative ps-4">

                                    <div
                                        style="position:absolute; left:0; top:1px; width:12px; height:12px; background:#0d6efd; border-radius:50%;">
                                    </div>

                                    <div class="p-3 bg-white">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1 fw-bold">Software Developer</h6>
                                            <small class="text-muted">Jan 2022 - Jun 2023</small>
                                        </div>

                                        <p class="mb-1 small text-muted">Product Development</p>
                                        <p class="mb-2 small">Built APIs and handled backend services.</p>

                                        <div class="d-flex gap-2">
                                            <a href="#" class="text-primary"><i class="ri-edit-2-line"></i></a>
                                            <a href="#" class="text-danger"><i class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Update Employee</h5>
                </div>
                <form class="modal-body" id="UpadteEmployeeDetails">
                    @csrf
                    <input type="hidden" name="id" id="EmployeeID" value="{{ $employee_id }}">
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageTitle" class="form-label">Salary</label>
                            <input id="Employeesalary" name="salary" class="form-control form-control-sm"
                                type="number" placeholder="Enter the employee salary"
                                value="{{ $data->latestSalary->salary }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageTitle" class="form-label">Title</label>
                            <input id="Employeetitle" name="title" value="{{ $data->latestTitle->title }}"
                                class="form-control form-control-sm" type="text"
                                placeholder="Enter the employee title" />
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnDetailsUpdate">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
