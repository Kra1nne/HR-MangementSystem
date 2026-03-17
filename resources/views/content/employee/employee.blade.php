@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/employee.js')
@endsection
@section('content')
    <main>
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
                                <a class="text-primary" href="{{ route('profile-index') }}"><i
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Employee</h5>
                </div>
                <form id="dataDepartment" class="modal-body">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center border rounded pt-2">
                        <label class="form-label fw-bold">Personal Details</label>
                    </div>
                    <div class="row mt-3">
                        <!-- Hire Date -->

                        <!-- First Name -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">First Name</label>
                            <input name="firstname" class="form-control form-control-sm" type="text"
                                placeholder="Enter first name" />
                        </div>

                        <!-- Middle Name -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Middle Name</label>
                            <input name="middlename" class="form-control form-control-sm" type="text"
                                placeholder="Enter middle name" />
                        </div>

                        <!-- Last Name -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Last Name</label>
                            <input name="lastname" class="form-control form-control-sm" type="text"
                                placeholder="Enter last name" />
                        </div>

                        <!-- Address -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Address</label>
                            <input name="address" class="form-control form-control-sm" type="text"
                                placeholder="Enter address" />
                        </div>

                        <!-- Phone Number -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Phone Number</label>
                            <input name="phone_number" class="form-control form-control-sm" type="text"
                                placeholder="Enter phone number" />
                        </div>

                        <!-- Birth Date -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Birth Date</label>
                            <input name="birth_date" class="form-control form-control-sm" type="date" />
                        </div>

                        <!-- Sex -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Sex</label>
                            <select name="sex" class="form-select form-select-sm">
                                <option value="" selected disabled>Select Sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center border mt-5 rounded pt-2">
                        <label class="form-label fw-bold">Recruitment Details</label>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Hire Date</label>
                            <input name="hire_date" class="form-control form-control-sm" type="date" />
                        </div>

                        <!-- Salary -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Salary</label>
                            <input name="salary" class="form-control form-control-sm" type="number"
                                placeholder="Enter salary" />
                        </div>
                        <!-- From Date -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Date</label>
                            <input name="date" class="form-control form-control-sm" type="date" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Position</label>
                            <input name="position" class="form-control form-control-sm" type="text"
                                placeholder="Enter Position" />
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Work Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="" selected disabled>Select Status</option>
                                <option value="contractual">Contractual</option>
                                <option value="regular">Regular</option>
                                <option value="probationary">Probationary</option>
                                <option value="other">Other</option>
                            </select>
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
@endsection
