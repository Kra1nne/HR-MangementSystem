@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/employee.js')
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Employee</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Employee List</a>
                </li>
            </ol>
        </nav>
        <div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>New Employee</button>
            </div>
            <div class="my-2">
                <h5 class="d-flex justify-content-end align-items-center">
                    <!-- Filter button for small screens -->
                    <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                        Filters
                    </button>
                </h5>

                <!-- Filters Row -->
                <div class="card p-3 collapse d-lg-block" id="filterCollapse">
                    <div class="row g-3">
                        <!-- Department -->
                        <div class="col-lg-3 col-md-6">
                            <label for="department" class="form-label">Department</label>
                            <select id="department" class="form-select">
                                <option selected>Choose department...</option>
                                <option value="1">HR</option>
                                <option value="2">IT</option>
                                <option value="3">Marketing</option>
                                <option value="4">Finance</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-3 col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select">
                                <option selected>Choose status...</option>
                                <option value="current">Currently Hired</option>
                                <option value="former">No Longer in Company</option>
                            </select>
                        </div>

                        <!-- Job Title -->
                        <div class="col-lg-3 col-md-6">
                            <label for="jobTitle" class="form-label">Job Title</label>
                            <select id="jobTitle" class="form-select">
                                <option selected>Choose Job Title...</option>
                                <option value="dev">Dev</option>
                                <option value="hr">HR</option>
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <div class="col-lg-3 col-md-6 d-flex align-items-end">
                            <button type="button" class="btn btn-primary w-100 btn-lg">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="card">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Search -->
                <div class="input-group input-group-merge w-50">
                    <input type="text" class="form-control border-0" placeholder="Search..." aria-label="Search..."
                        aria-describedby="basic-addon-search31" />
                </div>

                <div style="display: none !important;" class="d-flex justify-content-center align-items-center px-5">
                    <a class="text-danger" href="#"><i
                            class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i></a>
                    <a class="text-success" href="#" data-bs-target="#Modal" data-bs-toggle="modal"><i
                            class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;">
                                <input class="form-check-input m-0" type="checkbox">
                            </th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Hire Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <th class="text-center p-1" style="width: 40px;">
                                <input class="form-check-input m-0" type="checkbox">
                            </th>
                            <td>
                                <span>1002</span>
                            </td>
                            <td>John Doew</td>
                            <td>
                                JohnDoe@gmail.com
                            </td>
                            <td>Manager</td>
                            <td>
                                Marketing
                            </td>
                            <td>
                                8/20/2026
                            </td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <a class="text-success" href="#" data-bs-target="#ModalMessage"
                                    data-bs-toggle="modal"><i class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>
                                <a class="text-primary" href="javascript::void(0)" data-bs-toggle="modal"
                                    data-bs-target="#ModalEmployeeDetails"><i
                                        class="icon-base ri ri-information-line icon-18px me-1"></i></a>
                                <a class="text-danger" href="#" id="employeeDelete"><i
                                        class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Employee</h5>
                </div>
                <form id="dataDepartment" class="modal-body">
                    @csrf
                    <div class="row ">
                        <div class="col mt-2">
                            <label for="name" class="form-label">Department Name</label>
                            <input id="name" name="name" class="form-control form-control-sm" type="text"
                                placeholder="Enter the department name" />
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col mt-2">
                            <label for="name" class="form-label">Department Manager</label>
                            <select name="manager" class="form-select" id="manager">
                                <option value="" selected disabled>Select Manager</option>
                                <option value="1">John Doew</option>
                                <option value="2">Kimmy Dot</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control h-px-100" id="details" name="details"
                                placeholder="Enter department details here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalMessage" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Message</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageRecipents" class="form-label">Recipents</label>
                            <input id="messageRecipents" class="form-control form-control-sm" type="text"
                                placeholder="Enter the Recipents" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageTitle" class="form-label">Title</label>
                            <input id="messageTitle" class="form-control form-control-sm" type="text"
                                placeholder="Enter the message title" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="message" class="form-label">Messages</label>
                            <textarea class="form-control h-px-100" id="messageContent" placeholder="Enter message here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEmployeeDetails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="bg-primary px-4 pt-4 pb-0 d-flex flex-wrap align-items-end gap-3 position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal"></button>

                    <div class="position-relative flex-shrink-0">
                        <img id="employeeProfilePicture" src="https://i.pravatar.cc/150?img=12"
                            class="rounded-circle border border-3 border-white object-fit-cover" width="96"
                            height="96">
                    </div>

                    <div class="pb-4 flex-grow-1">
                        <p class="text-white-50 small mb-1 text-uppercase" style="letter-spacing:.07em;font-size:11px;">
                            Employee Profile
                        </p>

                        <h5 class="text-white fw-semibold mb-1" id="employeeName">
                            Juan dela Cruz
                        </h5>

                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="text-white small" id="employeePosition">
                                Senior Software Engineer
                            </span>
                            <span class="text-white d-none d-sm-inline">·</span>
                            <span class="text-white small" id="employeeDepartment">
                                Information Technology
                            </span>
                        </div>
                    </div>

                    <div class="pb-4 d-flex gap-2 flex-wrap">
                        <span id="employeeStatus"
                            class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                            Active
                        </span>
                        <span
                            class="badge rounded-pill bg-primary text-white border border-white border-opacity-25 px-3 py-2">
                            EMP-00142
                        </span>
                    </div>
                </div>


                <!-- Body -->
                <div class="modal-body p-4">
                    <div class="row g-3">

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
                                            Juan dela Cruz
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <p class="text-muted small mb-1">Email</p>
                                        <p class="fw-semibold small mb-0 text-primary" id="employeeEmail">
                                            juan.delacruz@company.ph
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <p class="text-muted small mb-1">Contact</p>
                                        <p class="fw-semibold small mb-0" id="employeeContact">
                                            +63 917 123 4567
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <p class="text-muted small mb-1">Date Hired</p>
                                        <p class="fw-semibold small mb-0" id="employeeDateHired">
                                            March 1, 2021
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <p class="text-muted small mb-1">Birthday</p>
                                        <p class="fw-semibold small mb-0" id="employeeBirthday">
                                            July 14, 1993
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <p class="text-muted small mb-1">Address</p>
                                        <p class="fw-semibold small mb-0" id="employeeAddress">
                                            Quezon City, Metro Manila
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
                                        <span
                                            class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3">
                                            Regular
                                        </span>
                                    </div>

                                    <div>
                                        <p class="text-muted small mb-1">Schedule</p>
                                        <p class="fw-semibold small mb-0" id="employeeSchedule">
                                            Mon–Fri, 8am–5pm
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
                            <div
                                class="bg-warning-subtle border border-warning-subtle border-start border-4 rounded-3 p-3">
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

                                <a href="{{ route('employee-faceRegistration') }}"
                                    class="btn btn-primary btn-sm w-100 rounded-3" id="btnRegisterFace">
                                    Register Face
                                </a>

                            </div>
                        </div>

                    </div>
                </div>


                <!-- Footer -->
                <div class="modal-footer border-top justify-content-end px-4">
                    <button class="btn btn-outline-secondary btn-sm rounded-3" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
