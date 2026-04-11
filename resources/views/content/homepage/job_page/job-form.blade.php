@extends('layouts/homepagelayout')

@section('title', 'Job Form')

@section('content')
    <main class="min-vh-100 mt-5">
        <section class="container">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                    ← Back
                </a>
            </div>

            <!-- Form -->
            <div>
                <div>

                    <h3 class="mb-4 text-center fw-bold">Job Application Form</h3>

                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- PERSONAL DETAILS -->
                        <h5 class="fw-semibold mb-3 text-primary">Personal Details</h5>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control rounded-3"
                                    placeholder="Enter first name" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control rounded-3"
                                    placeholder="Enter last name" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="last_name" class="form-control rounded-3"
                                    placeholder="Enter last name" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control rounded-3">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select rounded-3">
                                    <option selected disabled>Select gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Prefer not to say</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Blood Type</label>
                                <select name="blood_type" id="blood_type" class="form-select form-select-sm">
                                    <option value="" selected disabled>Select Blood Type</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>

                        <!-- CONTACT DETAILS -->
                        <h5 class="fw-semibold mb-3 text-primary">Contact Details</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-3"
                                    placeholder="Enter email" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control rounded-3"
                                    placeholder="Enter phone number" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" rows="3" class="form-control rounded-3" placeholder="Enter your address"></textarea>
                            </div>
                        </div>

                        <!-- FILE UPLOAD -->
                        <h5 class="fw-semibold mb-3 text-primary">Attachments</h5>
                        <div class="mb-4">
                            <div class="mb-3">
                                <label class="form-label">Upload Resume / CV</label>
                                <input type="file" name="resume" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Certificates (Optional)</label>
                                <input type="file" name="certificates[]" class="form-control rounded-3" multiple>
                            </div>
                        </div>

                        <!-- PRIVACY NOTICE / CONSENT -->
                        <div class="alert alert-light border rounded-3 mb-4">
                            <h6 class="fw-semibold mb-2">Data Privacy & Consent</h6>
                            <p class="small mb-3 text-muted">
                                By submitting this application, you agree that the personal information you provided
                                will be collected, processed, and stored for recruitment and employment purposes.
                                All data will be handled confidentially and in accordance with applicable data
                                protection laws.
                            </p>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="consent" id="consentCheck" required>
                                <label class="form-check-label small" for="consentCheck">
                                    I hereby certify that the information provided is true and correct, and I give my
                                    consent to the processing of my personal data for this application.
                                </label>
                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-3">
                                Submit Application
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </section>
    </main>
@endsection
