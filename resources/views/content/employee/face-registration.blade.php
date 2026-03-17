@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/face-register.js')
@endsection
@section('content')
    <main>
        <div class="px-4">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm rounded-3">
                Back
            </a>
        </div>
        <section class="container">
            <div class="mx-auto text-center">
                <div class="mt-4 d-flex justify-content-center">
                    <video id="video" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px;" autoplay
                        muted>
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
