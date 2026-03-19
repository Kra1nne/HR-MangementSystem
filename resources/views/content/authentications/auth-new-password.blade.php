@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
    @vite(['resources/assets/css/auth.css'])
@endsection
@section('page-script')
    @vite('resources/assets/js/newpassword.js')
@endsection
@section('content')
    <div class="container-fluid p-0 vh-100">
        <div class="row g-0 h-100">

            {{-- ── LEFT: Login Form ── --}}
            <div class="col-md-6 d-flex flex-column column bg-white px-4 px-lg-5 py-4 h-100">

                <div class="d-flex flex-grow-1 justify-content-center align-items-center py-4">
                    <div class="my-auto w-100" style="max-width: 380px;">
                        <h1 class="fw-bold fs-3 mb-1">New Password.</h1>
                        <form id="formAuthentication">
                            @csrf

                            {{-- Email --}}
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="email" name="email_username"
                                    placeholder="Enter your email" value="{{ $data->email }}" disabled>
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" autofocus />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="ri-eye-off-line ri-20px"></i></span>
                                </div>
                            </div>
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Password Confirmation</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="ri-eye-off-line ri-20px"></i></span>
                                </div>
                            </div>
                        </form>
                        {{-- Submit --}}
                        <div class="d-grid mb-4">
                            <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                type="submit" id="NewPasswordBtn">
                                New Password
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                    <polyline points="12 5 19 12 12 19" />
                                </svg>
                            </button>
                        </div>
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
