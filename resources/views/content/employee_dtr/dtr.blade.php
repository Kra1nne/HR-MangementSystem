@extends('layouts/contentNavbarLayout')

@section('title', 'Employee')
@section('page-script')
    @vite('resources/assets/js/dtr.js')
@endsection
@section('content')
    <main>
        <div class="mt-2 mb-4">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="ModalClickAdd" data-bs-toggle="modal" data-bs-target="#Modal">
                    <span class="icon-base ri ri-add-line icon-16px me-1_5"></span>New Employee</button>
            </div>
        </div>
        <section class="card">
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-between m-2">

                <!-- Search -->
                <form action="{{ route('dtr-report') }}" method="get"
                    class="nav-item d-flex align-items-center gap-1 mb-2 mb-md-0">
                    <div class="input-group input-group-merge">
                        <input type="text" name="search" class="form-control-sm border-0 border-bottom w-100"
                            placeholder="Search" style="outline: none; box-shadow: none;"
                            onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                            onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..."
                            aria-describedby="basic-addon-search31" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" id="search">Search</button>
                    <button class="border-none btn-outline-dark {{ $isSearch ? 'd-block' : 'd-none' }}" id="closeMark"><i
                            class="ri-close-line text-danger"></i></button>
                </form>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Hire Date</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($employees as $item)
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary bg-opacity-25 text-white d-flex align-items-center justify-content-center fw-bold"
                                            style="width:42px;height:42px;flex-shrink:0;">
                                            {{ strtoupper(substr($item->person->firstname, 0, 1)) }}
                                            {{ strtoupper(substr($item->person->lastname, 0, 1)) }}
                                        </div>
                                        <div class="fw-semibold text-dark">
                                            {{ $item->person->firstname }} {{ $item->person->middlename }}
                                            {{ $item->person->lastname }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{ $item->emp_id }}</span>
                                </td>
                                <td>
                                    {{ $item->hire_date }}
                                </td>
                                <td>{{ $item->latestTitle->title }}</td>
                                <td>
                                    ₱ {{ number_format($item->latestSalary->salary, 2) }}
                                </td>
                                <td><span class="{{ $item->EmployeeBadge() }}">{{ $item->status }}</span></td>
                                <td class="text-center">
                                    <a href="javascript::void(0)" data-bs-toggle="modal"
                                        data-id="{{ $item->encrypted_id }}" id="PeviewDTR" data-bs-target="#Modal"><i
                                            class="ri-printer-line"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Employee Found</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="d-flex justify-content-end">
                    <div class="m-3">
                        {{ $employees->onEachSide(5)->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary pb-4">
                    <h5 class="modal-title text-white" id="modalCenterTitle">Print DTR</h5>
                </div>

                <form class="modal-body" target="_blank" action="{{ route('dtr-report-preview') }}" method="POST"
                    id="EmployeeMessageContent">
                    @csrf
                    <input type="hidden" name="id" id="idEmployee">

                    <!-- MONTH -->
                    <div class="row">
                        <div class="col mt-2">
                            <label for="month" class="form-label">Month</label>
                            <select id="month" name="month" class="form-control form-control-sm">
                                <option value="" disable selected>Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>

                    <!-- YEAR -->
                    <div class="row">
                        <div class="col mt-2">
                            <label for="year" class="form-label">Year</label>
                            <select id="year" name="year" class="form-control form-control-sm">
                                <option value="">Select Year</option>
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    for (let y = currentYear - 5; y <= currentYear + 5; y++) {
                                        document.write(`<option value="${y}">${y}</option>`);
                                    }
                                </script>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer mt-4 p-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnSaveMessage">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if (session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
