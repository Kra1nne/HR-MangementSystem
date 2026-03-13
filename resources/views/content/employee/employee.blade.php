@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')

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
            <div class="d-flex flex-column flex-sm-row justify-content-between m-2">
                <div>

                </div>
                <div>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                        <span class="icon-base ri ri-filter-2-line icon-16px me-1_5"></span>Filter</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                        <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>New Employee</button>
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
                                <a class="text-success" href="#" data-bs-target="#Modal" data-bs-toggle="modal"><i
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
    </main>
@endsection
