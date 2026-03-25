@extends('layouts/blankLayout')

@section('title', '408 - Request Timeout')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="font-size: 6rem;line-height: 6rem;">408</h1>
        <h4 class="mb-2">Request Timeout ⏳</h4>
        <p class="mb-10 mx-2">Request took too long</p>

        <div class="d-flex justify-content-center mt-5">
            <a href="{{ url()->previous() }}" class="btn btn-primary my-6">Back to home</a>
        </div>
    </div>
@endsection
