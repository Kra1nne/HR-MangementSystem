@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')
@section('page-script')
    @vite('resources/assets/js/face.js')
@endsection
@section('content')
    <main class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Attendance</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('attendance-user') }}">My Attendance</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Face Recognation</a>
                </li>
            </ol>
        </nav>
        <div class="mt-5 text-center top-0">
            <div class="d-flex justify-content-start"><a href="{{ route('attendance-user') }}"
                    class="btn btn-primary">Back</a>
            </div>
            <div class="card w-100 w-md-75 mt-4 mx-auto">
                <video id="video" style="height: 100%; width: 100%" autoplay muted></video>
            </div>
            <div id="status" class="mt-3"></div>
        </div>
    </main>
@endsection
