@extends('layouts/homepagelayout')

@section('title', 'Services Page')

@section('content')
    <main class="min-vh-100">
        <section class="container mt-5">
            <div class="row g-4">
                <header>
                    <h4 class="fw-bold">Job Vacancies</h4>
                </header>

                <div class="d-flex flex-column flex-md-row align-items-stretch gap-2 m-2">

                    {{-- Filters --}}
                    <form method="get" id="filterForm"
                        class="d-flex flex-column flex-md-row align-items-stretch gap-2 flex-grow-1">
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <select name="work_setup" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                            <option value="">All Work Setups</option>
                            <option value="On-site" {{ request('work_setup') == 'On-site' ? 'selected' : '' }}>On-site
                            </option>
                            <option value="Remote" {{ request('work_setup') == 'Remote' ? 'selected' : '' }}>Remote
                            </option>
                            <option value="Hybrid" {{ request('work_setup') == 'Hybrid' ? 'selected' : '' }}>Hybrid
                            </option>
                        </select>

                        <select name="employment_type" class="form-select form-select-sm"
                            onchange="$('#filterForm').submit()">
                            <option value="">All Employment Types</option>
                            <option value="Full-time" {{ request('employment_type') == 'Full-time' ? 'selected' : '' }}>
                                Full-time</option>
                            <option value="Part-time" {{ request('employment_type') == 'Part-time' ? 'selected' : '' }}>
                                Part-time</option>
                            <option value="Contract" {{ request('employment_type') == 'Contract' ? 'selected' : '' }}>
                                Contract</option>
                            <option value="Internship" {{ request('employment_type') == 'Internship' ? 'selected' : '' }}>
                                Internship</option>
                        </select>

                        <select name="dept_name" class="form-select form-select-sm" onchange="$('#filterForm').submit()">
                            <option value="">All Departments</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->dept_name }}"
                                    {{ request('dept_name') == $dept->dept_name ? 'selected' : '' }}>
                                    {{ $dept->dept_name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    {{-- Search --}}
                    <form method="get" class="d-flex align-items-stretch gap-2">
                        <input type="hidden" name="work_setup" value="{{ request('work_setup') }}">
                        <input type="hidden" name="employment_type" value="{{ request('employment_type') }}">
                        <input type="hidden" name="dept_name" value="{{ request('dept_name') }}">

                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm border-0 border-bottom" placeholder="Search"
                            style="outline: none; box-shadow: none;"
                            onmouseover="this.style.boxShadow='none'; this.style.outline='none';"
                            onfocus="this.style.boxShadow='none'; this.style.outline='none';" aria-label="Search..." />

                        <button type="submit" class="btn btn-primary btn-sm">Search</button>

                        <a href="{{ route('job-page') }}"
                            class="btn btn-outline-secondary btn-sm {{ $isSearch ? 'd-flex' : 'd-none' }} align-items-center"
                            id="closeMark">
                            <i class="ri-close-line text-danger"></i>
                        </a>
                    </form>

                </div>

                @forelse ($jobs as $item)
                    <a href="{{ route('job-details', $item->encrypted_id) }}" class="col-md-4 pointer">
                        <div class="card h-100 w-100 shadow-sm border-0 rounded-4">
                            <div class="card-body">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-start alin-items-md-center mb-2">
                                    <span class="badge bg-light text-dark">
                                        {{ $item->updated_at == null ? $item->created_at->diffForHumans() : $item->updated_at->diffForHumans() }}
                                    </span>
                                    <span class="badge bg-success text-white">
                                        Open
                                    </span>
                                </div>
                                <h5 class="fw-bold">{{ $item->job_title }}</h5>
                                <p class="text-muted small">
                                    {{ Str::limit($item->description, 150, '...') }}
                                </p>
                                <p class="fw-thin small mb-2">
                                    Salary: ₱{{ number_format($item->salary, 2) }} monthly
                                </p>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <span class="badge bg-success-subtle text-success">{{ $item->dept_name }}</span>
                                    <span class="badge bg-light text-dark border">{{ $item->work_setup }}</span>
                                    <span class="badge bg-light text-dark border">{{ $item->employment_type }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div>
                            <i class="ri-briefcase-line fs-1 text-primary"></i>
                        </div>
                        <h5 class="lead mt-3">No Available Job Vacancies</h5>
                    </div>
                @endforelse
            </div>
            <div class="pt-5 d-flex justify-content-end">
                {{ $jobs->onEachSide(2)->links() }}
            </div>
        </section>
    </main>
@endsection
