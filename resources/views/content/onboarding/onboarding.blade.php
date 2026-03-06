@extends('layouts/contentNavbarLayout')

@section('title', 'Onboarding')

@section('page-style')
    @vite(['resources/assets/css/offcanvas.css'])
@endsection
@section('page-script')
    @vite('resources/assets/js/onboarding.js')
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Onboarding</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Onboarding List</a>
                </li>
            </ol>
        </nav>
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
                    <a class="text-primary" href="#"><i class="icon-base ri ri-mail-send-line icon-18px me-1"></i></a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;">
                                <input class="form-check-input m-0" type="checkbox">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Documents</th>
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
                                <span>Tours Project</span>
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
                                <a class="text-primary" href="#" data-bs-toggle="offcanvas"
                                    data-bs-target="#requiremetsView" aria-controls="offcanvasEnd"><i
                                        class="icon-base ri ri-eye-line icon-18px me-1"></i></a>
                                <a class="text-danger" href="#" id="onboaringDelete"><i
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="requiremetsView" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Submitted Documents</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
                                                data-bs-placement="top" title="Vinnie Mostowy" class="avatar pull-up">
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
                                                data-bs-placement="top" title="Julee Rossignol" class="avatar pull-up">
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
