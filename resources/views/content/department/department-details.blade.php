@extends('layouts/contentNavbarLayout')

@section('title', 'Department')

@section('page-script')
    @vite('resources/assets/js/department-details.js')
@endsection
@section('content')
    <main class="mt-3">
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
                            <div class="gap-2">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#Modal">
                                    <span class="icon-base ri ri-filter-2-line icon-16px me-1_5"></span>Filter</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#ModalAddEmployee">
                                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>New Employee</button>
                            </div>
                        </div>
                    </div>
                    <section>
                        <div class="d-flex flex-column flex-md-row align-items-start justify-content-between m-2">

                            <!-- Search -->
                            <form action="{{ route('department-details', $departmentDetails->encrypted_id) }}"
                                method="get" class="nav-item d-flex align-items-center gap-1 mb-2 mb-md-0">
                                <div class="input-group input-group-merge">
                                    <input type="text" name="search"
                                        class="form-control-sm border-0 border-bottom w-100" placeholder="Search"
                                        style="outline: none; box-shadow: none;"
                                        onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                                        onfocus="this.style.boxShadow='none'; this.style.outline='none';"
                                        aria-label="Search..." aria-describedby="basic-addon-search31" />
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
                                            <input class="form-check-input m-0" type="checkbox" id="employeeSelectAll">
                                        </th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Salary</th>
                                        <th>Position</th>
                                        <th>Hire Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($departmentEmployee as $item)
                                        <tr>
                                            <th class="text-center p-1 employee-container" style="width: 40px;">
                                                <input class="form-check-input m-0 employee-department-checkbox"
                                                    type="checkbox" value="{{ $item->id_no }}">
                                            </th>
                                            <td>
                                                <span>{{ $item->emp_id }}</span>
                                            </td>
                                            <td>{{ $item->person->firstname }} {{ $item->person->middlename[0] ?? '' }}
                                                {{ $item->person->lastname }}</td>
                                            <td>
                                                ₱ {{ number_format($item->latestSalary->salary, 2) }}
                                            </td>
                                            <td>
                                                {{ $item->latestTitle->title }}
                                            </td>
                                            <td>
                                                {{ date('F m Y', strtotime($item->hire_date)) }}
                                            </td>
                                            <td>
                                                <a class="text-success" href="javascript::void(0)" data-bs-target="#Modal"
                                                    data-bs-toggle="modal"><i
                                                        class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>
                                                <a class="text-primary" href="javascript::void(0)"><i
                                                        class="icon-base ri ri-information-line icon-18px me-1"></i></a>
                                                <a class="text-danger" href="javascript::void(0)" id="employeeDelete"><i
                                                        class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="7">No Employees Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <div class="p-3">
                                    <span id="selectedCountEmployees">0 selected</span>
                                </div>
                                <div class="m-3">
                                    {{ $departmentEmployee->onEachSide(5)->links() }}
                                </div>
                            </div>
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
    <div class="modal fade" id="ModalAddEmployee" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="modal-header bg-primary border-0 px-4 py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <h5 class="modal-title text-white fw-bold mb-0">Add New Employee</h5>
                            <small class="text-white text-opacity-75">Select employees</small>
                        </div>
                    </div>
                </div>

                {{-- Search + Select All --}}
                <div class="px-4 py-3 border-bottom d-flex align-items-center gap-3">
                    <div class="input-group input-group-sm flex-grow-1">
                        <span class="input-group-text border-end-0">
                            <i class="ri re-search-line text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0 text-black"
                            placeholder="Search employees...">
                    </div>
                    <div class="form-check mb-0 text-nowrap">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label small fw-medium text-muted">Select All</label>
                    </div>
                </div>

                {{-- Body --}}
                <form id="employeeFormData">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $departmentDetails->dept_no }}">
                    <div class="modal-body px-4 py-2" style="max-height: 340px; overflow-y: auto;">

                        <div id="noResults" class="text-center text-muted py-4 d-none">
                            No matching employees found
                        </div>
                        @foreach ($employees as $item)
                            <div class="employee-row">
                                <label class="d-flex align-items-center gap-3 p-2 rounded-3 w-100 mb-1"
                                    style="cursor: pointer;"
                                    data-name="{{ strtolower($item->person->firstname . ' ' . $item->person->lastname) }}">

                                    <input class="form-check-input mt-0 flex-shrink-0 employee-checkbox" type="checkbox"
                                        name="employee[]" value="{{ $item->emp_no }}">

                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="fw-medium text-dark lh-sm">
                                            {{ $item->person->firstname }}
                                            {{ isset($item->person->middlename[0]) ? $item->person->middlename[0] . '.' : '' }}
                                            {{ $item->person->lastname }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $item->latestTitle->title }}
                                        </small>
                                    </div>

                                    <span class="badge bg-success-subtle text-success rounded-pill">Active</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                </form>
                <div class="modal-footer border-top px-4 py-3 d-flex justify-content-between">
                    <small class="text-muted fw-medium" id="selectedCount">0 selected</small>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" id="btnAddEmployee" class="btn btn-primary btn-sm">
                            Add Employees
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
