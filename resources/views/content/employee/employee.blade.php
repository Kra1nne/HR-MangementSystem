@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/employee.js')
@endsection
@section('content')
    <main>
        <div class="mt-2">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="ModalClickAdd" data-bs-toggle="modal" data-bs-target="#Modal">
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
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-between m-2">

                <!-- Search -->
                <form action="{{ route('employee') }}" method="get"
                    class="nav-item d-flex align-items-center gap-1 mb-2 mb-md-0">
                    <div class="input-group input-group-merge">
                        <input type="text" name="search" class="form-control-sm border-0 border-bottom w-100"
                            placeholder="Search" style="outline: none; box-shadow: none;"
                            onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                            onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..."
                            aria-describedby="basic-addon-search31" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>

                <div class="d-flex justify-content-center align-items-center px-5">
                    <a class="text-danger" href="#">
                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                    </a>
                    <a class="text-success" href="#" data-bs-target="#Modal" data-bs-toggle="modal">
                        <i class="icon-base ri ri-mail-send-line icon-18px me-1"></i>
                    </a>
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
                            <th>Hire Date</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($employees as $item)
                            <tr>
                                <th class="text-center p-1" style="width: 40px;">
                                    <input class="form-check-input m-0" type="checkbox">
                                </th>
                                <td>
                                    <span>{{ $item->emp_id }}</span>
                                </td>
                                <td>{{ $item->person->firstname }} {{ $item->person->middlename }}
                                    {{ $item->person->lastname }}</td>
                                <td>
                                    {{ $item->hire_date }}
                                </td>
                                <td>{{ $item->latestTitle->title }}</td>
                                <td>

                                </td>
                                <td>
                                    ₱ {{ number_format($item->latestSalary->salary, 2) }}
                                </td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a class="text-success" href="javascript::void(0)" data-bs-target="#ModalMessage"
                                        data-bs-toggle="modal"><i
                                            class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>

                                    <a class="text-success" id="ModalClickEdit" href="javascript::void(0)"
                                        data-bs-target="#Modal" data-bs-toggle="modal" data-id="{{ $item->emp_no }}"
                                        data-firstname="{{ $item->person->firstname }}"
                                        data-middlename="{{ $item->person->middlename }}"
                                        data-lastname="{{ $item->person->lastname }}"
                                        data-address="{{ $item->person->address }}"
                                        data-phone="{{ $item->person->phone_number }}"
                                        data-birthdate="{{ $item->person->birth_date }}"
                                        data-sex="{{ $item->person->sex }}"
                                        data-blood_type="{{ $item->person->blood_type }}"
                                        data-emp-id="{{ $item->emp_id }}" data-hire-date="{{ $item->hire_date }}"
                                        data-salary="{{ $item->latestSalary->salary }}"
                                        data-position="{{ $item->latestTitle->title }}"
                                        data-id-salary="{{ $item->latestSalary->id }}"
                                        data-id-title="{{ $item->latestTitle->id }}"
                                        data-status="{{ $item->status }}"><i
                                            class="icon-base ri ri-file-edit-line icon-18px me-1"></i></a>

                                    <a class="text-primary" href="{{ route('profile-index', $item->encrypted_id) }}"><i
                                            class="icon-base ri ri-information-line icon-18px me-1"></i></a>

                                    <a class="text-danger" href="javascript::void(0)" id="employeeDelete"><i
                                            class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Employee Found</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="m-3 d-flex justify-content-end">
                    {{ $employees->onEachSide(5)->links() }}
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="FormTitle"></h5>
                </div>
                <form id="dataEmployee" class="modal-body">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center border rounded pt-2">
                        <label class="form-label fw-bold">Personal Details</label>
                    </div>
                    <div class="row mt-3">
                        <input type="hidden" id="actionModal">
                        <input type="hidden" id="idNumber" name="idNumber">
                        <input type="hidden" id="id_salary" name="id_salary">
                        <input type="hidden" id="id_title" name="id_title">
                        <!-- Hire Date -->
                        <!-- First Name -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">First Name</label>
                            <input name="firstname" id="firstname" class="form-control form-control-sm" type="text"
                                placeholder="Enter first name" />
                        </div>

                        <!-- Middle Name -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Middle Name</label>
                            <input name="middlename" id="middlename" class="form-control form-control-sm" type="text"
                                placeholder="Enter middle name" />
                        </div>

                        <!-- Last Name -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Last Name</label>
                            <input name="lastname" id="lastname" class="form-control form-control-sm" type="text"
                                placeholder="Enter last name" />
                        </div>

                        <!-- Address -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Address</label>
                            <input name="address" id="address" class="form-control form-control-sm" type="text"
                                placeholder="Enter address" />
                        </div>

                        <!-- Phone Number -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Phone Number</label>
                            <input name="phone" id="phone" class="form-control form-control-sm" type="text"
                                placeholder="Enter phone number" />
                        </div>

                        <!-- Birth Date -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Birth Date</label>
                            <input name="birth_date" id="birth_date" class="form-control form-control-sm"
                                type="date" />
                        </div>

                        <!-- Sex -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Sex</label>
                            <select name="sex" id="sex" class="form-select form-select-sm">
                                <option value="" selected disabled>Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Blood Type</label>
                            <select name="blood_type" id="blood_type" class="form-select form-select-sm">
                                <option value="" selected disabled>Select Blood Type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center border mt-5 rounded pt-2">
                        <label class="form-label fw-bold">Recruitment Details</label>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Employee ID</label>
                            <input name="emp_id" id="emp_id" class="form-control form-control-sm" type="text"
                                placeholder="Enter Employee ID" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Hire Date</label>
                            <input name="hire_date" id="hire_date" class="form-control form-control-sm"
                                type="date" />
                        </div>

                        <!-- Salary -->
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Salary</label>
                            <input name="salary" id="salary" class="form-control form-control-sm" type="number"
                                placeholder="Enter salary" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Position</label>
                            <input name="position" id="position" class="form-control form-control-sm" type="text"
                                placeholder="Enter Position" />
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 mt-2">
                            <label class="form-label">Work Status</label>
                            <select name="status" id="Workstatus" class="form-select form-select-sm">
                                <option value="" selected disabled>Select Status</option>
                                <option value="Contractual">Contractual</option>
                                <option value="Regular">Regular</option>
                                <option value="Probationary">Probationary</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveEmployee">Save</button>
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
                    <button type="button" class="btn btn-primary" id="btnSaveMessage">Send Message</button>
                </div>
            </div>
        </div>
    </div>
@endsection
