@extends('layouts/contentNavbarLayout')

@section('title', 'Department')

@section('page-script')
    @vite('resources/assets/js/department-details.js')
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Department</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('department-list') }}">Department List</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Employee List</a>
                </li>
            </ol>
        </nav>
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base ri ri-bar-chart-grouped-line icon-sm me-1_5"></i>Dashboard
                        </span>
                        <i class="icon-base ri ri-bar-chart-grouped-line icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base ri ri-user-add-line icon-sm me-1_5"></i>Employees
                        </span>
                        <i class="icon-base ri ri-user-add-line icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <div>
                        <div class="d-flex flex-column flex-sm-row justify-content-between m-2">
                            <div>
                                <h3 class="lead">{{ $departmentDetails->dept_name }}</h3>
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#Modal">
                                    <span class="icon-base ri ri-filter-2-line icon-16px me-1_5"></span>Filter</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#Modal">
                                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>New Employee</button>
                            </div>
                        </div>
                    </div>
                    <section class="card">
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Search -->
                            <div class="input-group input-group-merge w-50">
                                <input type="text" class="form-control border-0" placeholder="Search..."
                                    aria-label="Search..." aria-describedby="basic-addon-search31" />
                            </div>

                            <div class="d-flex justify-content-center align-items-center px-5">
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
                                        <th>Hire Date</th>
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
                                        <td>JohnDoe@gmail.com</td>
                                        <td>
                                            Processing
                                        </td>
                                        <td>
                                            Marketing
                                        </td>
                                        <td>
                                            8/20/2026
                                        </td>
                                        <td>
                                            <a class="text-success" href="#" data-bs-target="#Modal"
                                                data-bs-toggle="modal"><i
                                                    class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>
                                            <a class="text-primary" href="#"><i
                                                    class="icon-base ri ri-information-line icon-18px me-1"></i></a>
                                            <a class="text-danger" href="#" id="employeeDelete"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
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
