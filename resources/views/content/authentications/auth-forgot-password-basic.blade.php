@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
    @vite(['resources/assets/css/auth.css'])
@endsection

@section('content')
    <div class="container-fluid p-0 vh-100">
        <div class="row g-0 h-100">

            {{-- ── LEFT: Login Form ── --}}
            <div class="col-md-6 d-flex flex-column column bg-white px-4 px-lg-5 py-4 h-100">

                <div class="d-flex flex-grow-1 justify-content-center align-items-center py-4">
                    <div class="my-auto w-100" style="max-width: 380px;">
                        <h1 class="fw-bold fs-3 mb-1">Forget password.</h1>
                        <p class="text-muted mb-4" style="font-size:14px;">
                            Go back to
                            <a href="{{ url('login') }}" class="text-primary text-decoration-none fw-medium">Sign in</a>
                        </p>
                        <p class="text-muted mb-4" style="font-size:14px;">
                            Don't have an account?
                            <a href="{{ url('register') }}" class="text-primary text-decoration-none fw-medium">Sign up</a>
                        </p>

                        <form id="formAuthentication">
                            @csrf

                            {{-- Email --}}
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="email" name="email_username"
                                    placeholder="Enter your email">
                                <label for="email">Email</label>
                            </div>
                            {{-- Submit --}}
                            <div class="d-grid mb-4">
                                <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                    type="submit" id="loginBtn">
                                    Reset Password
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                        {{-- Divider --}}
                    </div>
                </div>
            </div>

            {{-- ── RIGHT: Decorative Panel ── --}}
            <div class="col-md-6 chess-panel d-flex align-items-end p-5">

                {{-- Checkerboard --}}
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
