@extends('layouts/contentNavbarLayout')

@section('title', 'Department')

@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Department</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Department List</a>
                </li>
            </ol>
        </nav>
        <section>
            <div class="d-flex justify-content-end mb-3 gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span> Department</button>
            </div>
            <div class="row g-4">

                <!-- Card 1 -->
                <a href="#" class="col-md-6 col-lg-4 col-sm-12 pointer">
                    <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:55px;height:55px;">
                                    <i class="ri-building-4-line fs-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">Finance Department</h5>

                                    <span class="badge bg-light text-dark border">
                                        Manager: <strong>John Doe</strong>
                                    </span>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">
                                The Finance Department is responsible for managing an organization’s money,
                                including budgeting, accounting, financial planning, and ensuring that funds
                                are used properly and efficiently.
                            </p>
                            {{-- <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-success-subtle text-success">Finance</span>
                                <span class="badge bg-light border text-dark">Full Time</span>
                                <span class="badge bg-light border text-dark">Onsite</span>
                            </div> --}}
                        </div>
                    </div>
                </a>
                <a href="#" class="col-md-6 col-lg-4 col-sm-12 pointer">
                    <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:55px;height:55px;">
                                    <i class="ri-building-4-line fs-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">Finance Department</h5>

                                    <span class="badge bg-light text-dark border">
                                        Manager: <strong>John Doe</strong>
                                    </span>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">
                                The Finance Department is responsible for managing an organization’s money,
                                including budgeting, accounting, financial planning, and ensuring that funds
                                are used properly and efficiently.
                            </p>
                            {{-- <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-success-subtle text-success">Finance</span>
                                <span class="badge bg-light border text-dark">Full Time</span>
                                <span class="badge bg-light border text-dark">Onsite</span>
                            </div> --}}
                        </div>
                    </div>
                </a>

            </div>
        </section>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Department</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="departmentNumber" class="form-label">Department Number</label>
                            <input id="departmentNumber" class="form-control form-control-sm" type="text"
                                placeholder="Enter the department number" />
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col mt-2">
                            <label for="name" class="form-label">Department Name</label>
                            <input id="name" class="form-control form-control-sm" type="text"
                                placeholder="Enter the department name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control h-px-100" id="Details" placeholder="Enter department details here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
