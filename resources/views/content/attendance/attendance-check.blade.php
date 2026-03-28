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
                class="d-flex flex-column flex-lg-row 
            justify-content-between align-items-start align-items-center gap-3">
                <div class="col">
                    <div class="card p-2 border-0 rounded-4 w-100 h-100">
                        <div class="mt-4 mx-auto" style="position: relative; display: inline-block;">
                            <video id="video" style="height: 100%; width: 100%; display: block;" autoplay muted></video>

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
                                        {{-- <div class="fw-semibold fs-5">
                                            {{ !empty($DTRToday[0]->time) ? date('h:i:s', strtotime($DTRToday[0]->time)) : '--:--' }}
                                        </div> --}}
                                        <div id="first"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time Out</small>
                                        {{-- <div class="fw-semibold fs-5">
                                            {{ !empty($DTRToday[1]->time) ? date('h:i:s', strtotime($DTRToday[1]->time)) : '--:--' }}
                                        </div> --}}
                                        <div id="second"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Afternoon -->
                            <h6 class="text-uppercase text-muted mb-3">Afternoon</h6>

                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time In</small>
                                        {{-- <div class="fw-semibold fs-5">
                                            {{ !empty($DTRToday[2]->time) ? date('h:i:s', strtotime($DTRToday[2]->time)) : '--:--' }}
                                        </div> --}}
                                        <div id="third"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-3 border rounded-3 bg-light">
                                        <small class="text-muted">Time Out</small>
                                        {{-- <div class="fw-semibold fs-5">
                                            {{ !empty($DTRToday[3]->time) ? date('h:i:s', strtotime($DTRToday[3]->time)) : '--:--' }}
                                        </div> --}}
                                        <div id="fourth"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>
@endsection
