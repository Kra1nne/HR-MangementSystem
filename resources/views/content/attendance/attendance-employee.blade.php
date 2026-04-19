@extends('layouts/contentNavbarLayout')

@section('title', 'Employee DTR')

@section('content')
    <main class="mt-4">
        <section class="card">
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-start m-2">

                <!-- Search -->
                <form action="{{ route('attendance-employee') }}" method="get"
                    class="nav-item d-flex align-items-center gap-1 mb-2 mb-md-0">
                    <div class="input-group input-group-merge">
                        <input type="text" name="search" class="form-control-sm border-0 border-bottom w-100"
                            placeholder="Search" style="outline: none; box-shadow: none;"
                            onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                            onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..."
                            aria-describedby="basic-addon-search31" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
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
                                    <a class="text-primary"
                                        href="{{ route('attendance-employee-view', $item->encrypted_id) }}"><i
                                            class="icon-base ri ri-information-line icon-18px me-1"></i></a>

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
@endsection
