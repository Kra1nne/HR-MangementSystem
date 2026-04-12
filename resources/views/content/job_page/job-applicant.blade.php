@extends('layouts/contentNavbarLayout')

@section('title', 'Job Applicants')

@section('content')
    <div class="bg-white text-dark py-4">

        <!-- Header -->
        <div
            class="d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-start align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Job Applicants</h4>
                <p class="text-muted mb-0">Frontend Developer &mdash; Full Time</p>
            </div>
            <button class="btn btn-primary">
                <i class="ri ri-add-line me-1"></i> Add Applicant
            </button>
        </div>

        <section class="card">
            <div class="py-2 d-flex flex-column flex-md-row align-items-stretch gap-2 m-2">

                {{-- Filters --}}
                <form method="get" id="filterForm"
                    class="d-flex flex-column flex-md-row align-items-stretch gap-2 flex-grow-1">
                    <input type="hidden" name="search" value="">

                    <select name="work_setup" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                        <option value="">All Work Setups</option>

                    </select>

                    <select name="employment_type" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                        <option value="">All Employment Types</option>

                    </select>

                    <select name="dept_name" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                        <option value="">All Departments</option>

                    </select>
                </form>

                {{-- Search --}}
                <form method="get" class="d-flex align-items-stretch gap-2">
                    <input type="hidden" name="work_setup">
                    <input type="hidden" name="employment_type">
                    <input type="hidden" name="dept_name">

                    <input type="text" name="search" class="form-control form-control-sm border-0 border-bottom"
                        placeholder="Search" style="outline: none; box-shadow: none;"
                        onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                        onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..." />

                    <button type="submit" class="btn btn-primary btn-sm">Search</button>

                    <a href="#"
                        class="btn btn-outline-secondary btn-sm {{ $isSearch ? 'd-flex' : 'd-none' }} align-items-center"
                        id="closeMark">
                        <i class="ri-close-line text-danger"></i>
                    </a>
                </form>

            </div>
            <!-- Applicants Table -->
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0 bg-white text-dark">
                    <thead class="table-light text-dark">
                        <tr>
                            <th class="ps-3">Applicant</th>
                            <th>Position Applied</th>
                            <th>Gmail</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center fw-bold"
                                        style="width:42px;height:42px;flex-shrink:0;">AR</div>
                                    <div class="fw-semibold text-dark">Andrea Reyes</div>
                                </div>
                            </td>
                            <td class="text-dark">Frontend Developer</td>
                            <td>
                                <a href="mailto:andrea.reyes@gmail.com" class="text-dark text-decoration-none">
                                    <i class="bi bi-envelope me-1 text-primary"></i>andrea.reyes@gmail.com
                                </a>
                            </td>
                            <td class="text-dark">Apr 4, 2025</td>
                            <td><span class="badge bg-success">Interview</span></td>
                            <td class="text-center">
                                <a href="#" class="" title="View Profile"><i class="ri-eye-line"></i></a>
                                <a href="#" class="" title="Download CV"><i class="ri-download-line"></i></a>
                                <a href="#" class="" title="Send Message" data-bs-toggle="modal"
                                    data-bs-target="#sendMessageModal"
                                    onclick="document.getElementById('modalRecipient').value='andrea.reyes@gmail.com'">
                                    <i class="ri-mail-send-line"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end">
                <nav class="m-3">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link text-dark" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

        </section>

    </div>
@endsection
