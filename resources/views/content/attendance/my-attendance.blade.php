@extends('layouts/contentNavbarLayout')

@section('title', 'My Attendance')

@section('content')
    <main class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Attendance</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">My Attendance</a>
                </li>
            </ol>
        </nav>
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
        <section class="card p-3 mt-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="mb-1">Today's Attendance</h5>
                    <small class="text-muted" id="liveTime"></small>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">
                        <i class="ri-login-circle-line"></i> Time In
                    </button>

                    <button class="btn btn-danger">
                        <i class="ri-logout-circle-line"></i> Time Out
                    </button>
                    <button class="btn btn-primary" title="Export Attendance">Export</button>
                </div>
            </div>
        </section>
        <section class="card p-3 mt-4">
            <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-calendar" aria-controls="navs-pills-justified-calendar"
                        aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base ri ri-calendar-todo-line icon-sm me-1_5"></i>Calendar
                        </span>
                        <i class="icon-base ri ri-calendar-todo-line icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i
                                class="icon-base ri ri-grid-line icon-sm me-1_5"></i>Table</span>
                        <i class="icon-base ri ri-grid-line icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-calendar" role="tabpanel">
                    <div class="row">
                        <div class="col">
                            <div id='calendar' style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">

                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay' // user can switch between the two
                }
            });
            calendar.render();
        });

        function formatDate(date) {
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];

            const month = months[date.getMonth()];
            const day = String(date.getDate()).padStart(2, '0');
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${month} ${day}, ${year} ${hours}:${minutes}:${seconds}`;
        }

        function updateTime() {
            $('#liveTime').text(formatDate(new Date()));
        }

        // Run when document is ready
        $(document).ready(function() {
            updateTime(); // run immediately
            setInterval(updateTime, 1000); // update every second
        });
    </script>
@endsection
