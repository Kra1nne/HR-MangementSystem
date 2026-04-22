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
                            <i class="icon-base ri ri-bar-chart-grouped-line icon-sm me-1_5"></i>Menu
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
                <div class="tab-pane fade show" id="navs-top-home" role="tabpanel">
                    <div class="d-flex justify-content-center align-items-center text-white"
                        style="height: 150px; background: linear-gradient(135deg, #2b147f, #0a409d);">
                    </div>
                    <div class="py-4 px-2">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                            <div>
                                <h3 class="fw-bold mb-1 text-dark">
                                    {{ $departmentDetails->dept_name }}
                                </h3>
                            </div>
                            <div>
                                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Hr')
                                    <a href="javascript:void(0)" data-id="{{ $departmentDetails->dept_no }}"
                                        id="deleteDepartment" class="text-danger">
                                        <i class="ri-delete-bin-5-line"></i>
                                    </a>
                                    <a href="javascript:void(0)" id="updateDepartment" data-bs-toggle="modal"
                                        data-bs-target="#ModalEdit" data-id="{{ $departmentDetails->dept_no }}"
                                        data-name="{{ $departmentDetails->dept_name }}"
                                        data-details="{{ $departmentDetails->details }}"
                                        data-icon="{{ $departmentDetails->icon }}" class="text-primary">
                                        <i class="ri-edit-2-line"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <!-- Description -->
                        <div>
                            <h6 class="fw-bold text-uppercase text-secondary mb-3" style="letter-spacing: 1px;">
                                Description
                            </h6>

                            <div class="text-muted lh-lg">
                                @foreach (explode("\n", $departmentDetails->details) as $description)
                                    @if (trim($description) != '')
                                        <p class="mb-2">{{ trim($description) }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Info Row -->
                        <div class="row text-center mb-4 g-3 mt-5">
                            <div class="col-md-4">
                                <div class="border-end h-100">
                                    <div class="text-muted small">Manager</div>
                                    <div class="fw-semibold fs-5 mt-1 text-dark">
                                        {{ $departmentDetails->latestManager->employee->person->firstname ?? ' ' }}
                                        {{ $departmentDetails->latestManager->employee->person->lastname ?? 'No Manager' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border-end h-100">
                                    <div class="text-muted small">Employees</div>
                                    <div class="fw-semibold fs-5 mt-1 text-dark">
                                        {{ $departmentDetails->department_employees->count() ?? 0 }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <div class="text-muted small">Created</div>
                                    <div class="fw-semibold fs-5 mt-1 text-dark">
                                        {{ date('M d, Y', strtotime($departmentDetails->created_at)) }}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <div>
                        <div class="d-flex flex-column flex-sm-row justify-content-between m-2">
                            <div>
                                <h3 class="lead">{{ $departmentDetails->dept_name }}</h3>
                            </div>
                            <div class="gap-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#ModalAddEmployee">
                                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>Employee</button>
                                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Hr')
                                    <button type="button" class="btn btn-outline-primary mt-1" data-bs-toggle="modal"
                                        data-bs-target="#ModalAddManeger">
                                        <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>Manager</button>
                                @endif
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
                                <button class="border-none btn-outline-dark {{ $isSearch ? 'd-block' : 'd-none' }}"
                                    id="closeMark"><i class="ri-close-line text-danger"></i></button>
                            </form>

                            <div class="d-flex justify-content-center align-items-center px-5" id="options">
                                <a class="text-success" href="javascript:void(0)" data-bs-target="#Modal"
                                    data-department="{{ $departmentDetails->dept_name }}" id="MessageAll"
                                    data-bs-toggle="modal">
                                    <i class="icon-base ri ri-megaphone-line icon-18px me-1"></i>
                                </a>
                            </div>

                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
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
                                                <a class="text-primary" href="javascript:void(0)"
                                                    id="ModalPersonalMessage" data-bs-target="#Modal"
                                                    data-id="{{ $item->id_no }}"
                                                    data-fullname="{{ $item->person->firstname }} {{ $item->person->middlename }} {{ $item->person->lastname }}"
                                                    data-bs-toggle="modal"><i
                                                        class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>
                                                <a class="text-primary"
                                                    href="{{ route('department-profile-index', Crypt::encryptString($item->emp_no)) }}"><i
                                                        class="icon-base ri ri-information-line icon-18px me-1"></i></a>
                                                <a class="text-danger" href="javascript:void(0)" id="employeeDelete"
                                                    data-id="{{ $item->emp_no }}"><i
                                                        class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6">No Employees Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <div class="p-3">
                                    <span id="selectedCountEmployees"></span>
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
                <form class="modal-body" id="EmployeeMessageData">
                    @csrf
                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="id" id="idEmployee">
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageRecipents" class="form-label">Recipents</label>
                            <input id="messageRecipents" name="messageRecipents[]" class="form-control form-control-sm"
                                type="text" placeholder="Enter the Recipents" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageTitle" class="form-label">Title</label>
                            <input id="messageTitle" name="messageTitle" class="form-control form-control-sm"
                                type="text" placeholder="Enter the message title" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="message" class="form-label">Messages</label>
                            <textarea class="form-control h-px-100" name="messageContent" id="messageContent"
                                placeholder="Enter message here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnSaveMessage">Send Message</button>
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
    <div class="modal fade" id="ModalAddManeger" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="modal-header bg-primary border-0 px-4 py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <h5 class="modal-title text-white fw-bold mb-0">Assign New Manager</h5>
                            <small class="text-white text-opacity-75">Select a new manager replacement</small>
                        </div>
                    </div>
                </div>

                {{-- Search + Select All --}}
                <div class="px-4 py-3 border-bottom d-flex align-items-center gap-3">
                    <div class="input-group input-group-sm flex-grow-1">
                        <span class="input-group-text border-end-0">
                            <i class="ri re-search-line text-muted"></i>
                        </span>
                        <input type="text" id="searchInputManager" class="form-control border-start-0 ps-0 text-black"
                            placeholder="Search employees...">
                    </div>
                </div>

                {{-- Body --}}
                <form id="ManagerFormData">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $departmentDetails->dept_no }}">
                    <div class="modal-body px-4 py-2" style="max-height: 340px; overflow-y: auto;">

                        <div id="noResultsManager" class="text-center text-muted py-4 d-none">
                            No matching employees found
                        </div>
                        @foreach ($manager as $item)
                            <div class="employee-row">
                                <label class="d-flex align-items-center gap-3 p-2 rounded-3 w-100 mb-1"
                                    style="cursor: pointer;"
                                    data-name="{{ strtolower($item->person->firstname . ' ' . $item->person->lastname) }}">
                                    <input class="form-check-input mt-0 flex-shrink-0 employee-checkbox" type="radio"
                                        name="employee" value="{{ $item->emp_no }}">
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
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" id="btnAddManager" class="btn btn-primary btn-sm">
                            Submit
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Update Department</h5>
                </div>
                <form id="dataDepartment" class="modal-body">
                    @csrf
                    <input type="hidden" name="dept_no" id="dept_no">
                    <div class="row">
                        <div class="col">
                            <label for="departmentIcon" class="form-label">Icon</label>
                            <select name="departmentIcon" id="departmentIcon" class="form-select">
                                <option value="" selected disabled>Select Icon</option>
                                <option value="ri-building-line">🏢</option>
                                <option value="ri-home-office-line">🏠</option>
                                <option value="ri-team-line">👥</option>
                                <option value="ri-user-line">👤</option>
                                <option value="ri-group-line">👨‍👩‍👧</option>
                                <option value="ri-briefcase-line">💼</option>
                                <option value="ri-folder-line">📁</option>
                                <option value="ri-archive-line">🗄</option>
                                <option value="ri-file-list-line">📄</option>
                                <option value="ri-task-line">✅</option>
                                <option value="ri-computer-line">💻</option>
                                <option value="ri-database-2-line">🗄</option>
                                <option value="ri-server-line">🖥</option>
                                <option value="ri-code-s-slash-line">💻</option>
                                <option value="ri-bug-line">🐞</option>
                                <option value="ri-bank-line">🏦</option>
                                <option value="ri-money-dollar-circle-line">💰</option>
                                <option value="ri-wallet-3-line">👛</option>
                                <option value="ri-secure-payment-line">💳</option>
                                <option value="ri-user-heart-line">❤️</option>
                                <option value="ri-user-settings-line">⚙️</option>
                                <option value="ri-user-search-line">🔍</option>
                                <option value="ri-book-open-line">📚</option>
                                <option value="ri-graduation-cap-line">🎓</option>
                                <option value="ri-school-line">🏫</option>
                                <option value="ri-hospital-line">🏥</option>
                                <option value="ri-heart-pulse-line">❤️</option>
                                <option value="ri-medicine-bottle-line">💊</option>
                                <option value="ri-customer-service-2-line">🎧</option>
                                <option value="ri-chat-1-line">💬</option>
                                <option value="ri-phone-line">📞</option>
                                <option value="ri-shield-check-line">🛡</option>
                                <option value="ri-lock-line">🔒</option>
                                <option value="ri-alarm-warning-line">🚨</option>
                                <option value="ri-truck-line">🚚</option>
                                <option value="ri-store-2-line">🏬</option>
                                <option value="ri-shopping-cart-line">🛒</option>
                                <option value="ri-settings-3-line">⚙️</option>
                                <option value="ri-bar-chart-box-line">📊</option>
                                <option value="ri-pie-chart-line">📈</option>
                                <option value="ri-line-chart-line">📉</option>
                                <option value="ri-lightbulb-line">💡</option>
                                <option value="ri-earth-line">🌍</option>
                                <option value="ri-calendar-line">📅</option>
                            </select>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col mt-2">
                            <label for="name" class="form-label">Department Name</label>
                            <input id="name" name="name" class="form-control form-control-sm" type="text"
                                placeholder="Enter the department name" />
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
                    <button type="submit" class="btn btn-primary" id="btnSaveEdit">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
