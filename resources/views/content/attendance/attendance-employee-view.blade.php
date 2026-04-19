@extends('layouts/contentNavbarLayout')

@section('title', 'DTR View')

@section('page-script')
    @vite('resources/assets/js/attendance-employee.js')
@endsection
@section('content')
    <main class="container mt-5">
        <section class="row g-4">

        </section>
        <section class="card p-3 mt-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="mb-1">{{ $employeeData->name }}</h5>
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

                <form class="modal-body pt-2">
                    @csrf
                    <div class="d-flex justify-content-end">
                        <i class="ri-edit-2-line cursor-pointer text-secondary" id="EditOn" title="Edit"></i>
                    </div>
                    <div id="att-modal-logs"></div>

                    <div class="d-flex justify-content-between mt-3 pt-3 border-top small text-muted">
                        <span>Total hours worked</span>
                        <span id="att-modal-hours" class="fw-medium text-dark"></span>
                    </div>
                </form>
                <div class="d-flex justify-content-end p-3" id="btnDisplay">
                </div>
            </div>
        </div>
    </div>
@endsection
