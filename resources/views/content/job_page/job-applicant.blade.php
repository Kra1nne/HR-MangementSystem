@extends('layouts/contentNavbarLayout')

@section('title', 'Job Applicants')
@section('page-script')
    @vite('resources/assets/js/job_applicants.js')
@endsection
@section('content')
    <div class="bg-white text-dark py-4">

        <!-- Header -->
        <div
            class="d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-start align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Job Applicants</h4>
                <p class="text-muted mb-0">{{ $jobPostingDetaiils->job_title }} &mdash;
                    {{ $jobPostingDetaiils->employment_type }}</p>
            </div>
            <div>
                <button data-bs-toggle="modal" data-bs-target="#Modal" class="btn btn-primary">
                    <i class="ri ri-add-line me-1"></i> Applicant
                </button>
                <button data-bs-toggle="modal" data-bs-target="#AssessmentModal" class="btn btn-primary">
                    <i class="ri-draft-line"></i> Assessment
                </button>
            </div>
        </div>

        <section class="card">
            <div class="py-2 d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 m-2">
                <form method="get" action="{{ route('job-posting-applicants', $id) }}"
                    class="d-flex align-items-stretch gap-2">
                    <input type="text" name="search" class="form-control form-control-sm border-0 border-bottom"
                        placeholder="Search" style="outline: none; box-shadow: none;"
                        onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                        onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..." />
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>

                    <a href="{{ route('job-posting-applicants', $id) }}"
                        class="btn btn-outline-secondary btn-sm {{ $isSearch ? 'd-flex' : 'd-none' }} align-items-center"
                        id="closeMark">
                        <i class="ri-close-line text-danger"></i>
                    </a>
                </form>
            </div>
            @forelse ($jobPosting as $item)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-sm-row flex-column">
                                <div class="rounded-circle bg-primary bg-opacity-25 text-white d-flex align-items-center justify-content-center fw-bold m-2"
                                    style="width:60px;height:60px;flex-shrink:0;">
                                    {{ strtoupper(substr($item->candidate->person->firstname, 0, 1)) }}
                                    {{ strtoupper(substr($item->candidate->person->lastname, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="mb-0">
                                            {{ $item->candidate->person->firstname ?? '' }}
                                            {{ $item->person->middlename ?? '' }}
                                            {{ $item->candidate->person->lastname ?? '' }}
                                        </h5>
                                    </div>

                                    <div class="text-muted small">{{ $item->candidate->person->address }}</div>
                                    <div class="text-muted small mt-1 d-flex flex-wrap flex-sm-row flex-column gap-3">
                                        @if ($item->candidate->person->sex == 'Famale')
                                            <span><i class="ri-women-line"></i>
                                                {{ $item->candidate->person->sex }}</span>
                                        @else
                                            <span><i class="ri-men-line"></i>
                                                {{ $item->candidate->person->sex }}</span>
                                        @endif

                                        <span><i
                                                class="ri ri-phone-line"></i>{{ $item->candidate->person->phone_number }}</span>
                                        <span><i class="ri-mail-line"></i>
                                            {{ $item->email }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end justify-content-between">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                <div class="dropdown-menu p-1">
                                    <a href="javascript:void(0)" id="AcceptBtn"
                                        data-firstname="{{ $item->candidate->person->firstname }}"
                                        data-lastname="{{ $item->candidate->person->lastname }}"
                                        data-email="{{ $item->email }}" data-position="{{ $item->position }}"
                                        data-id="{{ $item->application_id }}" class="dropdown-item">
                                        <i class="bi ri-check-line"></i> Accept
                                    </a>
                                    <a href="javascript:void(0)" id="ShortlistBtn" data-id="{{ $item->application_id }}"
                                        class="dropdown-item">
                                        <i class="ri-pass-pending-line"></i> Shortlist
                                    </a>
                                    <a href="javascript:void(0)" id="RejectBtn" data-id="{{ $item->application_id }}"
                                        data-firstname="{{ $item->candidate->person->firstname }}"
                                        data-lastname="{{ $item->candidate->person->lastname }}"
                                        data-email="{{ $item->email }}" data-position="{{ $item->position }}"
                                        class="dropdown-item">
                                        <i class="ri ri-close-line"></i> Reject
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-1 small mt-3">
                            @if ($item->status == 'accepted')
                                <span class="badge bg-success">Accepted</span>
                            @elseif ($item->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @elseif ($item->status == 'shortlist')
                                <span class="badge bg-dark">Shortlisted</span>
                            @else
                                <span class="badge bg-primary">
                                    {{ $item->latestApplicationLogs->event_type ?? 'Under Review' }}
                                </span>
                                <span class="{{ $item->latestApplicationLogs?->remarksBadge ?? 'badge bg-secondary' }}">
                                    {{ ucfirst($item->latestApplicationLogs?->remarks ?? 'ongoing') }}
                                </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                            <div class="d-flex flex-wrap gap-3 small">
                                <div>
                                    <span>Applied: <strong>{{ $item->created_at->diffForHumans() }}</strong></span>

                                </div>

                            </div>
                            <div class="d-flex gap-3 small">
                                @if ($item->latestApplicationLogs?->remarks === null && $item->applicationLogs->count() > 0)
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Feedback"
                                        class="text-decoration-none feedbackApplicant"
                                        data-id="{{ $item->application_id }}"
                                        data-firstname="{{ $item->candidate->person->firstname }}"
                                        data-lastname="{{ $item->candidate->person->lastname }}">
                                        <i class="ri-feedback-line"></i> Feedback
                                    </a>
                                @endif
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ModalMessage"
                                    class="text-decoration-none mailApplicant" data-email="{{ $item->email }}">
                                    <i class="ri-mail-send-line"></i> Mail
                                </a>
                                <a href="javascript:void(0)" data-documents='@json($item->applicationDocuments)'
                                    data-logs='@json($item->applicationLogs)'
                                    data-time="{{ $item->created_at->diffForHumans() }}" data-bs-toggle="offcanvas"
                                    data-bs-target="#applicantView" class="text-decoration-none view-applicant">
                                    <i class="ri ri-eye-line"></i> View
                                </a>
                            </div>

                        </div>


                    </div>
                </div>
            @empty
                <div class="card m-2 p-5">
                    <div class="text-center">
                        No Applicants found
                    </div>
                </div>
            @endforelse
        </section>
        <div class="d-flex justify-content-end mt-5">
            <div>
                {{ $jobPosting->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
    {{-- offcanvas for details --}}
    <div class="offcanvas offcanvas-end p-5" tabindex="-1" id="applicantView" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Application Logs</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="col">
                <ul class="timeline mb-0">
                    <li class="timeline-item timeline-item-transparent mb-3">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">Applied the Job Posting</h6>
                                <small class="text-body-secondary" id="applicantsTime"></small>
                            </div>
                            <p class="mb-2">Applicants submitted documents</p>
                            <div class="d-flex flex-column align-items-start gap-2 mb-2" id="documentsContainer">

                            </div>
                        </div>
                    </li>
                    <div id="timelineRecords">
                    </div>
                </ul>
            </div>
        </div>
    </div>

    {{-- modal for adding applicants --}}
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Job Application Form</h5>
                </div>
                <form id="applicationForm" enctype="multipart/form-data" class="modal-body">
                    @csrf

                    <!-- PERSONAL DETAILS -->
                    <h5 class="fw-semibold mb-3 text-primary">Personal Details</h5>
                    <input type="text" name="job_id" value="{{ $id }}" hidden>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control rounded-3"
                                placeholder="Enter first name" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control rounded-3"
                                placeholder="Enter last name" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control rounded-3"
                                placeholder="Enter middle name" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control rounded-3">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sex</label>
                            <select name="sex" id="sex" class="form-select rounded-3">
                                <option value="" selected disabled>Select sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
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
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>

                    <!-- CONTACT DETAILS -->
                    <h5 class="fw-semibold mb-3 text-primary">Contact Details</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control rounded-3"
                                placeholder="Enter email" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control rounded-3"
                                placeholder="Enter phone number" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" id="address" rows="3" class="form-control rounded-3"
                                placeholder="Enter your address"></textarea>
                        </div>
                    </div>

                    <!-- FILE UPLOAD -->
                    <h5 class="fw-semibold mb-3 text-primary">Attachments</h5>
                    <div class="mb-4">
                        <div class="mb-3">
                            <label class="form-label">Upload Resume / CV</label>
                            <input type="file" name="resume" id="resume" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Certificates (Optional)</label>
                            <input type="file" name="certificates[]" id="certificates" class="form-control rounded-3"
                                multiple>
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

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for assessment --}}
    <div class="modal fade" id="AssessmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Applicant Assessment Form</h5>
                </div>
                <form class="modal-body" id="assessmentData">
                    @csrf
                    <input type="text" name="job_id" value="{{ $id }}" hidden>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Assessment Type</label>
                            <select id="assessmentType" name="assessmentType" class="form-select form-select-sm">
                                <option value="" selected disabled>Select Assessment Type</option>
                                <option value="Phone Interview">Phone Interview</option>
                                <option value="Video Interview">Video Interview</option>
                                <option value="In-Person Interview">In-Person Interview</option>
                                <option value="Aptitude Test">Aptitude Test</option>
                                <option value="Technical Test">Technical Test</option>
                                <option value="Personality Assessment">Personality Assessment</option>
                                <option value="Skills Assessment">Skills Assessment</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Schedule</label>
                            <input type="datetime-local" name="schedule" id="schedule"
                                class="form-control form-sm rounded-3" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Location/Platform Use</label>
                            <input type="text" name="platform" id="platform" class="form-control form-sm rounded-3"
                                placeholder="Enter the location or platform use" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Instruction/Requirements</label>
                            <textarea name="instruction" id="instruction" rows="3" class="form-control rounded-3"
                                placeholder="Enter the instruction or requirements"></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="assessmentApplicantBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal for mail --}}
    <div class="modal fade" id="ModalMessage" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Message</h5>
                </div>
                <form class="modal-body" id="ApplicantMessageContent">
                    @csrf
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageRecipents" class="form-label">Recipents</label>
                            <input id="messageRecipents" name="messageRecipents" class="form-control form-control-sm"
                                type="text" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="messageTitle" class="form-label">Title</label>
                            <input id="messageTitle" name="messageTitle" class="form-control form-control-sm"
                                type="text" placeholder="Enter the message title" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="message" class="form-label">Messages</label>
                            <textarea class="form-control h-px-100" id="messageContent" name="messageContent"
                                placeholder="Enter message here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnMailApplicant">Send Message</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal for assessment --}}
    <div class="modal fade" id="Feedback" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Applicant Feedback</h5>
                </div>
                <form class="modal-body" id="EmployeeFeedback">
                    @csrf
                    <input type="text" name="applicant_id" id="applicant_id" hidden>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="applicantname" class="form-label">Applicant Name</label>
                            <input id="applicantname" name="applicantname" class="form-control form-control-sm"
                                type="text" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="score" class="form-label">Score</label>
                            <input id="score" name="score" class="form-control form-control-sm" type="number"
                                placeholder="Enter the message title" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="remarks" class="form-label">Remarks</label>
                            <select name="remarks" id="remarks" class="form-select rounded-3">
                                <option value="" selected disabled>Select remarks</option>
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control h-px-100" id="comment" name="comment" placeholder="Enter message here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnFeedbackApplicant">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
