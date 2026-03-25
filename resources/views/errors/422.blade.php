@extends('layouts/blankLayout')

@section('title', '422 - Unprocessable Entity')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="font-size: 6rem;line-height: 6rem;">422</h1>
        <h4 class="mb-2">Unprocessable Entity 🧾</h4>
        <p class="mb-10 mx-2">Validation failed</p>

        <div class="d-flex justify-content-center mt-5">
            <a href="{{ url()->previous() }}" class="btn btn-primary my-6">Back to home</a>
        </div>
    </div>
@endsection
