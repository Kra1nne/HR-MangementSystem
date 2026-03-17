@extends('layouts/contentNavbarLayout')

@section('title', 'Department')

@section('page-script')
    @vite('resources/assets/js/department.js')
@endsection
@section('content')
    <main>
        <section>
            <div class="d-flex justify-content-end mb-3 gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span> Department</button>
            </div>
            <div class="row g-4">

                <!-- Card 1 -->
                @foreach ($departments as $item)
                    <a href="{{ route('department-details', $item->dept_no) }}" class="col-md-6 col-lg-4 col-sm-12 pointer">
                        <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center"
                                        style="width:55px;height:55px;">
                                        <i class="{{ $item->icon }} fs-3"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold mb-1">{{ $item->dept_name }}</h5>

                                        <span class="badge bg-light text-dark border">
                                            Manager: <strong>John Doe</strong>
                                        </span>
                                    </div>
                                </div>
                                <p class="text-muted small mb-3">
                                    {{ Str::words($item->details, 15, '...') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>
        </section>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">New Department</h5>
                </div>
                <form id="dataDepartment" class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="departmentIcon" class="form-label">Icon</label>
                            <select name="departmentIcon" id="departmentIcon" class="form-select">
                                <option value="" selected disabled>Select Icon</option>
                                <option value="ri-building-line">🏢</option>
                                <option value="ri-home-office-line">🏠</option>
                                <option value="ri-team-line">👥</option>
                                <option value="ri-user-line">👤</option>
                                <option value="ri-group-line">👨‍👩‍👧</option>
                                <option value="ri-briefcase-line">💼</option>
                                <option value="ri-folder-line">📁</option>
                                <option value="ri-archive-line">🗄</option>
                                <option value="ri-file-list-line">📄</option>
                                <option value="ri-task-line">✅</option>
                                <option value="ri-computer-line">💻</option>
                                <option value="ri-database-2-line">🗄</option>
                                <option value="ri-server-line">🖥</option>
                                <option value="ri-code-s-slash-line">💻</option>
                                <option value="ri-bug-line">🐞</option>
                                <option value="ri-bank-line">🏦</option>
                                <option value="ri-money-dollar-circle-line">💰</option>
                                <option value="ri-wallet-3-line">👛</option>
                                <option value="ri-secure-payment-line">💳</option>
                                <option value="ri-user-heart-line">❤️</option>
                                <option value="ri-user-settings-line">⚙️</option>
                                <option value="ri-user-search-line">🔍</option>
                                <option value="ri-book-open-line">📚</option>
                                <option value="ri-graduation-cap-line">🎓</option>
                                <option value="ri-school-line">🏫</option>
                                <option value="ri-hospital-line">🏥</option>
                                <option value="ri-heart-pulse-line">❤️</option>
                                <option value="ri-medicine-bottle-line">💊</option>
                                <option value="ri-customer-service-2-line">🎧</option>
                                <option value="ri-chat-1-line">💬</option>
                                <option value="ri-phone-line">📞</option>
                                <option value="ri-shield-check-line">🛡</option>
                                <option value="ri-lock-line">🔒</option>
                                <option value="ri-alarm-warning-line">🚨</option>
                                <option value="ri-truck-line">🚚</option>
                                <option value="ri-store-2-line">🏬</option>
                                <option value="ri-shopping-cart-line">🛒</option>
                                <option value="ri-settings-3-line">⚙️</option>
                                <option value="ri-bar-chart-box-line">📊</option>
                                <option value="ri-pie-chart-line">📈</option>
                                <option value="ri-line-chart-line">📉</option>
                                <option value="ri-lightbulb-line">💡</option>
                                <option value="ri-earth-line">🌍</option>
                                <option value="ri-calendar-line">📅</option>
                            </select>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col mt-2">
                            <label for="name" class="form-label">Department Name</label>
                            <input id="name" name="name" class="form-control form-control-sm" type="text"
                                placeholder="Enter the department name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control h-px-100" id="details" name="details" placeholder="Enter department details here..."></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
