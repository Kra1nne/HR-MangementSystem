@extends('layouts/blankLayout')

@section('title', 'Error - Pages')

@section('page-style')
    <!-- Page -->
    @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection


@section('content')
    <!-- Error -->
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="font-size: 6rem;line-height: 6rem;">404</h1>
        <h4 class="mb-2">Page Not Found 🙄</h4>
        <p class="mb-10 mx-2">we couldn't find the page you are looking for</p>
        <div class="d-flex justify-content-center mt-5">
            <div class="d-flex flex-column align-items-center">
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary text-center my-6">Back to home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Error -->
@endsection
