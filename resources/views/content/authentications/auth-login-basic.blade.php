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
                <div class="mb-5">
                    <a href="/">
                        <i class="ri-arrow-left-s-line"></i>Back
                    </a>
                </div>

                <div class="d-flex flex-grow-1 justify-content-center align-items-center py-4">
                    <div class="my-auto w-100" style="max-width: 380px;">
                        <h1 class="fw-bold fs-3 mb-1">Welcome back.</h1>

                        <form id="formAuthentication" action="{{ route('login-process') }}" method="POST">
                            @csrf

                            {{-- Email --}}
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="email" name="email_username"
                                    placeholder="Enter your email" value="{{ old('email_username') }}">
                                <label for="email">Email</label>
                            </div>

                            {{-- Password --}}
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="••••••••••" value="{{ old('password') }}">
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer">
                                        <i class="ri-eye-off-line ri-20px"></i>
                                    </span>
                                </div>

                                @if ($errors->any())
                                    <div class="text-danger mt-1 mb-2">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                            </div>

                            {{-- Remember + Forgot --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                                    <label class="form-check-label text-muted" for="remember-me" style="font-size:13px;">
                                        Remember Me
                                    </label>
                                </div>

                                <a href="{{ url('forgot-password') }}" class="text-primary text-decoration-none fw-medium"
                                    style="font-size:13px;">
                                    Forgot Password?
                                </a>
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid mb-4">
                                <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                    type="submit">
                                    Login
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                        {{-- Divider --}}
                        <div class="divider-text mb-4">or</div>

                        {{-- Google --}}
                        <div class="row g-2 mb-4">
                            <div class="col-12">
                                <a href="{{ route('auth.google.redirect') }}"
                                    class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2">
                                    Google
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── RIGHT: Chess Panel with Logo ── --}}
            <div class="col-md-6 chess-panel">

                {{-- Chess Grid --}}
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

                {{-- Overlay --}}
                <div class="chess-overlay"></div>

                {{-- LOGO CONTENT --}}
                <div class="chess-content">
                    <div class="">
                        <img src="{{ asset('assets/img/favicon/Logo_noBG.png') }}" class="chess-logo" alt="Logo">
                        <h2 class="text-white fw-semibold mt-3 mb-1">VoxSync Workforce System</h2>
                        <p class="text-light small mb-0">Simple. Secure. Fast.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
