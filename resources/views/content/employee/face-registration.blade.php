@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/face-register.js')
@endsection
@section('content')
    <main>
        <div class="px-4">
            <a href="{{ route('employee') }}">
                Back
            </a>
        </div>
        <section class="container">
            <div class="mx-auto text-center">
                <div class="mt-4 d-flex justify-content-center">
                    <video id="video" style="width: 75%; height: auto; border-radius: 10px; display: block;" autoplay
                        muted>
                    </video>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                    <button class="btn btn-primary btn-sm" type="button" id="btnRegister"
                        data-id="{{ $id }}">Register</button>
                </div>

                <div class="badge badge-success">
                    <p id="status" class="mt-3"></p>
                </div>
            </div>
        </section>

    </main>
@endsection
