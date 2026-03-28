@extends('layouts/contentNavbarLayout')

@section('title', 'DTR')

@section('content')
    <main class="container mt-5">
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
                            <h3 class="fw-bold mb-0">{{ $totalEmployee }}</h3>
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
                            <h3 class="fw-bold mb-0">{{ $presentCount }}</h3>
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
                            <h3 class="fw-bold mb-0">{{ $totalAbsent }}</h3>
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
                            <h3 class="fw-bold mb-0">0</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="ri-calendar-event-line fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="nav-align-top nav-tabs-shadow">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-home" aria-controls="navs-justified-home"
                                aria-selected="true">
                                <span class="d-none d-sm-inline-flex align-items-center">
                                    <i class="icon-base ri ri-user-follow-line icon-sm me-1_5"></i>Present
                                </span>
                                <i class="icon-base ri ri-user-follow-line icon-sm d-sm-none"></i>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                                aria-selected="false">
                                <span class="d-none d-sm-inline-flex align-items-center"><i
                                        class="icon-base ri ri-user-unfollow-line icon-sm me-1_5"></i>Absent</span>
                                <i class="icon-base ri ri-user-unfollow-line icon-sm d-sm-none"></i>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages"
                                aria-selected="false">
                                <span class="d-none d-sm-inline-flex align-items-center"><i
                                        class="icon-base ri ri-user-heart-line icon-sm me-1_5"></i>On Leave</span>
                                <i class="icon-base ri ri-user-heart-line icon-sm d-sm-none"></i>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee #</th>
                                            <th>Department</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($Present as $item)
                                            <tr>
                                                <td>{{ $item->firstname }} {{ $item->middlename ?? '' }}
                                                    {{ $item->lastname }}</td>
                                                <td>{{ $item->emp_id }}</td>
                                                <td>{{ $item->dept_name }}</td>
                                                <td>{{ $item->sex }} </td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>
                                                    <span class="badge bg-success text-white">
                                                        Present
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="6">No Employee</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="m-3">
                                    {{ $Present->onEachSide(5)->links() }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee #</th>
                                            <th>Department</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($Absent as $item)
                                            <tr>
                                                <td>{{ $item->firstname }} {{ $item->middlename ?? '' }}
                                                    {{ $item->lastname }}</td>
                                                <td>{{ $item->emp_id }}</td>
                                                <td>{{ $item->dept_name }}</td>
                                                <td>{{ $item->sex }} </td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>
                                                    <span class="badge bg-danger text-white">
                                                        Absent
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="6">No Employee</td>
                                            </tr>
                                        @endforelse
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="m-3">
                                    {{ $Absent->onEachSide(5)->links() }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee #</th>
                                            <th>Department</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr class="text-center">
                                            <td colspan="6">No employee on leave</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
