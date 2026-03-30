@extends('layouts/contentNavbarLayout')

@section('title', 'DTR')
@section('page-script')
    @vite('resources/assets/js/face.js')
@endsection
@section('content')
    <main class="container">
        <div class="mt-5 text-center top-0">
            <div class="d-flex justify-content-start mb-2"><a href="{{ route('attendance-user') }}"
                    class="btn btn-primary btn-sm">Back</a>
            </div>
            <div
                class="card p-2 d-flex flex-column flex-lg-row 
            justify-content-between align-items-start align-items-center gap-3">
                <div class="col">
                    <div class="w-100 h-100">
                        <div class="mt-4 mx-auto" style="position: relative; display: inline-block;">
                            <video id="video" style="display: block;" autoplay muted></video>
                        </div>
                        <div id="status" class="mt-3">Loading...</div>
                    </div>
                </div>

                <div class="col w-100">

                    <div class="card shadow border-0 rounded-4">

                        <div class="card-header bg-primary text-white text-center rounded-top-4">
                            <h4 class="mb-0 fw-bold text-white">Today's Attendance</h4>
                        </div>

                        <div class="card-body">

                            <!-- Running Time -->
                            <div class="text-center mb-4 mt-3">
                                <div class="p-3 border rounded-3 bg-light">

                                    <div id="runningTime" class="fw-bold fs-3 text-primary">00:00:00</div>
                                </div>
                            </div>

                            <!-- Morning -->
                            <h6 class="text-uppercase text-muted mb-3">Morning</h6>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time In</small>
                                        <div id="first" class="fw-semibold fs-5"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time Out</small>
                                        <div id="second" class="fw-semibold fs-5"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Afternoon -->
                            <h6 class="text-uppercase text-muted mb-3">Afternoon</h6>

                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time In</small>
                                        <div id="third" class="fw-semibold fs-5"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time Out</small>
                                        <div id="fourth" class="fw-semibold fs-5"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>
@endsection
