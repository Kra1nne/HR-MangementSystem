@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/face-register.js')
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Employee</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('employee') }}">Employee List</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Registration</a>
                </li>
            </ol>
        </nav>
        <section class="container">
            <div class="mx-auto text-center">
                <div class="mt-4 d-flex justify-content-center">
                    <video id="video" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px;"
                        autoplay muted>
                    </video>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                    <button class="btn btn-primary">Register</button>
                </div>

                <p id="status"></p>
            </div>
        </section>

    </main>
@endsection
