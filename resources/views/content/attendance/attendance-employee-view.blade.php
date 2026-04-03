@extends('layouts/contentNavbarLayout')

@section('title', 'DTR View')

@section('page-script')
    @vite('resources/assets/js/attendance-employee.js')
@endsection
@section('content')
    <main class="container mt-5">
        <section class="row g-4">

            <!-- Total Hours Worked -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-info border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Hours Worked (This Month)</h6>
                            <h3 class="fw-bold mb-0">160 hrs</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-time-line fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Present -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-success border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Days Present</h6>
                            <h3 class="fw-bold mb-0">20</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-user-follow-line fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Absent -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-danger border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Days Absent</h6>
                            <h3 class="fw-bold mb-0">2</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-user-unfollow-line fs-4 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-warning border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Leave Days</h6>
                            <h3 class="fw-bold mb-0">1</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-calendar-event-line fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="card p-3 mt-4">
            <div class="row">
                <div class="col">
                    <div id='calendar' style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </section>
    </main>
    <!-- Modal -->
    <div id="att-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 p-3">

                <div class="modal-header border-0 pb-0">
                    <h6 id="att-modal-date" class="modal-title fw-medium"></h6>
                    <button type="button" class="btn-close" id="att-modal-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pt-2">
                    <div id="att-modal-logs"></div>

                    <div class="d-flex justify-content-between mt-3 pt-3 border-top small text-muted">
                        <span>Total hours worked</span>
                        <span id="att-modal-hours" class="fw-medium text-dark"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
