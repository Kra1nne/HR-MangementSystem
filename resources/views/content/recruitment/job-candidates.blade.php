@extends('layouts/contentNavbarLayout')

@section('title', 'Applicants')

@section('page-script')
    @vite('resources/assets/js/candidate.js')
@endsection
@section('content')
    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('recruitment-index') }}">Recruitment</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0);">Candidates</a>
                </li>
            </ol>
        </nav>
        <div class="card">
            <div class="nav-align-top nav-tabs-shadow">
                <div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="{{ route('recruitment-description') }}" type="button" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('recruitment-candidates') }}" type="button"
                                class="nav-link active">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
