@extends('layouts/contentNavbarLayout')

@section('title', 'Details')

@section('page-script')
    @vite('resources/assets/js/candidate.js')
@endsection
@section('page-style')
    @vite(['resources/assets/css/offcanvas.css'])
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('recruitment-index') }}">Recruitment</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Description</a>
                </li>
            </ol>
        </nav>
        <div class="card nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base ri ri-pencil-line icon-sm me-1_5"></i>Details
                        </span>
                        <i class="icon-base ri ri-pencil-line icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base ri ri-user-add-line icon-sm me-1_5"></i>Candidates
                        </span>
                        <i class="icon-base ri ri-user-add-line icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <h3 class="fw-bold">Job Description</h3>
                    <div class="boder border-0 border-top"></div>
                    <div class="row">

                        <!-- LEFT CONTENT -->
                        <div class="col-lg-8">
                            <h4 class="fw-bold mb-3 mt-5">About</h4>
                            <p class="text-muted">
                                {{ $jobDetails->description }}
                            </p>

                            <h4 class="fw-bold mt-5 mb-3">What you’ll do</h4>
                            <p class="text-muted">Areas you could work on:</p>

                            <ul class="text-muted">
                                @foreach (explode("\n", $jobDetails->job_objective) as $objective)
                                    @if (trim($objective) != '')
                                        <li>{{ trim($objective) }}</li>
                                    @endif
                                @endforeach
                            </ul>

                            <h4 class="fw-bold mt-5 mb-3">Requirements:</h4>
                            <ul class="text-muted">
                                @foreach (explode("\n", $jobDetails->job_requirements) as $requirements)
                                    @if (trim($requirements) != '')
                                        <li>{{ trim($requirements) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!-- RIGHT SIDEBAR -->
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="info-card p-4">

                                <div>
                                    <small class="text-muted">Active until</small>
                                    <h6 class="fw-bold mt-1">{{ date_format($jobDetails->created_at, 'M. d Y') }}</h6>
                                </div>

                                <hr>

                                <div>
                                    <small class="text-muted">Work Arrangement</small>
                                    <h6 class="fw-bold mt-1">{{ $jobDetails->work_arrangement }}</h6>
                                </div>

                                <hr>

                                <div>
                                    <small class="text-muted">Job Type</small>
                                    <h6 class="fw-bold mt-1">{{ $jobDetails->job_type }}</h6>
                                </div>

                                <hr>

                                <div>
                                    <small class="text-muted">Location</small>
                                    <h6 class="fw-bold mt-1">{{ $jobDetails->location }}</h6>
                                </div>
                                <hr>

                                <div>
                                    <small class="text-muted">Salary Range</small>
                                    <h6 class="fw-bold mt-1">{{ $jobDetails->salary_range }}</h6>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <div
                        class="d-flex flex-column flex-lg-row 
            justify-content-between align-items-start align-items-lg-center 
            gap-3 mb-4">

                        <h3 class="fw-bold mb-0">Candidates</h3>

                        <div></div>
                    </div>
                    <div
                        class="d-flex flex-column flex-lg-row 
            justify-content-between align-items-start align-items-lg-center mb-3 gap-2">
                        <div>
                            <form action="{{ route('recruitment-description', $encrypted_id) }}" method="GET"
                                class="nav-item d-flex align-items-center gap-1">
                                <div class="input-group input-group-sm input-group-merge">
                                    <span class="input-group-text" id="basic-addon-search31">
                                        <i class="icon-base ri ri-search-line icon-20px"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control" placeholder="Search..."
                                        aria-label="Search..." aria-describedby="basic-addon-search31" />
                                </div>
                                <button class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                                <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>Add</button>
                        </div>
                    </div>
                    <div class="boder border-0 border-top"></div>
                    <!-- CANDIDATE GRID -->
                    <div class="row g-3 mt-4">

                        <!-- CARD -->
                        @foreach ($candidates as $candidate)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card shadow-sm rounded-4">
                                    <div class="card-body position-relative">

                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                            class="btn btn-secondary rounded-circle p-1 position-absolute top-0 end-0 m-2">
                                            <i class="ri-more-2-line"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end p-0">
                                            <li class="dropdown-item" style="cursor: pointer" data-bs-toggle="offcanvas"
                                                data-bs-target="#Details">
                                                Details
                                            </li>

                                            <li class="dropdown-item" style="cursor: pointer" data-bs-toggle="modal"
                                                data-bs-target="#ModalApplicants">
                                                Message
                                            </li>
                                        </ul>

                                        <div class="d-flex align-items-center gap-3 mb-3">

                                            <img src="https://i.pravatar.cc/100?img={{ $candidate->person->id }}"
                                                class="rounded-circle" width="50" height="50">

                                            <div>
                                                <h6 class="mb-0 fw-semibold">
                                                    {{ $candidate->person->firstname }} {{ $candidate->person->lastname }}
                                                </h6>

                                                <small class="text-muted">
                                                    {{ $candidate->email }}
                                                </small>
                                            </div>

                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center small text-muted">

                                            <span class="badge bg-primary-subtle text-primary">
                                                {{ $candidate->status }}
                                            </span>

                                            <div class="d-flex gap-3">
                                                {{-- extra buttons if needed --}}
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="pt-5 d-flex justify-content-end">
                        {{ $candidates->onEachSide(2)->links() }}
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary pb-4">
                        <h5 class="modal-title text-white" id="modalCenterTitle">New Candidates</h5>
                    </div>
                    <form id="dataCandidate" class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="job_id" value="{{ $jobDetails->id }}">
                            <div class="col-12 col-md-4">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input id="firstname" name="firstname" class="form-control form-control-sm"
                                    type="text" placeholder="Enter the firstname" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input id="lastname" name="lastname" class="form-control form-control-sm"
                                    type="text" placeholder="Enter the lastname" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="middlename" class="form-label">Middlename</label>
                                <input id="middlename" name="middlename" class="form-control form-control-sm"
                                    type="text" placeholder="Enter the middlename" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" class="form-control form-control-sm" type="text"
                                    placeholder="Enter the email" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="birthdate" class="form-label">Birthdate</label>
                                <input id="birthdate" name="birthdate" class="form-control form-control-sm"
                                    type="date" placeholder="Enter the birthdate" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="sex" class="form-label">Sex</label>
                                <select name="sex" id="sex" class="form-select form-select-sm">
                                    <Option value="Male">Male</Option>
                                    <Option value="Female">Female</Option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnSaveCandidate">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ModalApplicants" tabindex="-1" aria-hidden="true">
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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="Details" aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">Candidate Progress</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="col">
                    <ul class="timeline mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">12 Invoices have been paid</h6>
                                    <small class="text-body-secondary">12 min ago</small>
                                </div>
                                <p class="mb-2">Invoices have been paid to the company</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="badge bg-lighter rounded d-flex align-items-center">
                                        <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/icons/misc/pdf.png"
                                            alt="img" width="20" class="me-2" />
                                        <span class="h6 mb-0 text-body">invoices.pdf</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">Client Meeting</h6>
                                    <small class="text-body-secondary">45 min ago</small>
                                </div>
                                <p class="mb-2">Project meeting with john @10:15am</p>
                                <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                                alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div>
                                            <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                            <small>CEO of ThemeSelection</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">Create a new project for client</h6>
                                    <small class="text-body-secondary">2 Day Ago</small>
                                </div>
                                <p class="mb-2">6 team members in a project</p>
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <ul
                                                class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Vinnie Mostowy"
                                                    class="avatar pull-up">
                                                    <img class="rounded-circle"
                                                        src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar" />
                                                </li>
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Allen Rieske" class="avatar pull-up">
                                                    <img class="rounded-circle"
                                                        src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar" />
                                                </li>
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Julee Rossignol"
                                                    class="avatar pull-up">
                                                    <img class="rounded-circle"
                                                        src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                                        alt="Avatar" />
                                                </li>
                                                <li class="avatar">
                                                    <span class="avatar-initial rounded-circle pull-up"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="3 more">+3</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">Client Meeting</h6>
                                    <small class="text-body-secondary">45 min ago</small>
                                </div>
                                <p class="mb-2">Project meeting with john @10:15am</p>
                                <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                                alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div>
                                            <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                            <small>CEO of ThemeSelection</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    @endsection
