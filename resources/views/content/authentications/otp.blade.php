@extends('layouts/blankLayout')

@section('title', 'OTP Page')

@section('page-style')
    @vite(['resources/assets/css/auth.css'])
@endsection
@section('page-script')
    @vite('resources/assets/js/otp.js')
@endsection
@section('content')
    <div class="container-fluid p-0 vh-100">
        <div class="row g-0 h-100">

            {{-- ── LEFT: Form ── --}}
            <div class="col-md-6 d-flex flex-column column bg-white px-4 px-lg-5 py-4 h-100">

                <div class="d-flex flex-grow-1 justify-content-center align-items-center py-4">
                    <div class="my-auto w-100" style="max-width: 380px;">

                        <h1 class="fw-bold fs-3 mb-1">OTP.</h1>
                        <p class="text-black mb-4" style="font-size:14px;">
                            Didn't recieve code?
                            <a href="#" id="resendOtp"
                                class="text-primary text-decoration-none fw-medium disabled-link opacity-25">
                                Resend OTP (<span id="timer"></span>s)
                            </a>
                        </p>
                        <form id="formAuthentication" method="post" action="{{ route('auth-verify-otp') }}">
                            @csrf
                            {{-- OTP INPUT --}}
                            <input type="hidden" name="id" id="id" value="{{ $id }}">
                            <div class="mb-4">
                                <label class="form-label">Enter OTP</label>
                                <div class="d-flex justify-content-between gap-2" id="otpInputs">
                                    @for ($i = 0; $i < 6; $i++)
                                        <input type="text" maxlength="1" class="form-control text-center otp-input"
                                            style="width: 45px; height: 50px; font-size: 20px;" name="otp[]">
                                    @endfor
                                </div>
                                @if ($errors->any())
                                    <div class="text-danger my-2">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid mb-4">
                                <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                    type="submit">
                                    Verify & Reset
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{-- ── RIGHT: Decorative Panel ── --}}
            <div class="col-md-6 chess-panel d-flex align-items-end p-5">

                <div class="chess-grid">
                    @php
                        $pattern = [[0, 1, 0, 1], [1, 0, 1, 0], [0, 1, 0, 1], [1, 0, 1, 0]];
                    @endphp
                    @foreach ($pattern as $row)
                        @foreach ($row as $cell)
                            <div class="chess-cell {{ $cell ? 'light' : '' }}"></div>
                        @endforeach
                    @endforeach
                </div>

                <div class="chess-overlay"></div>
            </div>
        </div>
    </div>

@endsection
