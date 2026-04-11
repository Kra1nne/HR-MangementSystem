@extends('layouts/homepagelayout')

@section('title', 'Message')

@section('content')
    <main class="d-flex align-items-center justify-content-center py-4">
        <section class="p-5 container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9">

                    {{-- Card Wrapper --}}
                    <div class="card shadow-sm border-0 overflow-hidden">
                        <div class="row g-0">

                            {{-- Image --}}
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center bg-light">
                                <img src="{{ asset('assets/img/backgrounds/success.png') }}" alt="Application submitted"
                                    class="img-fluid p-4" style="max-height: 300px; object-fit: contain;">
                            </div>

                            {{-- Content --}}
                            <div
                                class="col-12 col-md-7 p-4 p-lg-5 d-flex flex-column align-items-center text-center justify-content-center">

                                {{-- Icon --}}
                                <div class="mb-4">
                                    <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center mx-auto"
                                        style="width: 64px; height: 64px;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="10" stroke="#198754"
                                                stroke-width="1.5" />
                                            <path d="M7.5 12L10.5 15L16.5 9" stroke="#198754" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- Heading --}}
                                <h1 class="fs-4 fw-medium mb-3">Application received!</h1>

                                {{-- Messages --}}
                                <p class="text-secondary mb-3" style="line-height: 1.7;">
                                    Thank you for submitting your application. We've successfully received it
                                    and will review your details shortly.
                                </p>

                                <p class="text-secondary mb-4" style="font-size: 0.9rem; line-height: 1.7;">
                                    A confirmation email has been sent to your Gmail inbox. Please check your
                                    email — including your spam or promotions folder — for next steps.
                                </p>

                                {{-- Gmail Notice --}}
                                <div
                                    class="bg-body-secondary border rounded-3 p-3 d-flex align-items-center gap-3 mb-4 text-start w-100">
                                    <div class="flex-shrink-0 text-primary">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <rect x="2" y="4" width="20" height="16" rx="2"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path d="M2 8l10 6 10-6" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fw-medium mb-0" style="font-size: 0.85rem;">Check your Gmail</p>
                                        <p class="text-secondary mb-0" style="font-size: 0.78rem;">
                                            We sent a confirmation to your registered email address.
                                        </p>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="d-flex flex-wrap justify-content-center gap-3">
                                    <a href="https://mail.google.com" target="_blank"
                                        class="btn btn-primary d-inline-flex align-items-center gap-2">
                                        Open Gmail
                                    </a>
                                    <a href="{{ route('job-page') }}" class="btn btn-outline-secondary">
                                        Back to Job Posting
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
