@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
    <main class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard-analytics') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Attendance Dashboard</a>
                </li>
            </ol>
        </nav>
        <section class="row g-4">

            <!-- Total Employees -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-primary border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Employees</h6>
                            <h3 class="fw-bold mb-0">120</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-group-line fs-4 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Present -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-primary border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Present</h6>
                            <h3 class="fw-bold mb-0">95</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-user-follow-line fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Absent -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-primary border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Absent</h6>
                            <h3 class="fw-bold mb-0">15</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-user-unfollow-line fs-4 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- On Leave -->
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card border-0 border-start border-primary border-4 shadow-sm h-100"
                    style="transition: all 0.3s ease;"
                    onmouseover="this.classList.replace('shadow-sm','shadow-lg'); this.style.transform='translateY(-5px)'"
                    onmouseout="this.classList.replace('shadow-lg','shadow-sm'); this.style.transform='translateY(0)'">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">On Leave</h6>
                            <h3 class="fw-bold mb-0">10</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-calendar-event-line fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
