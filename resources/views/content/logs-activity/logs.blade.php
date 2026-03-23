@extends('layouts/contentNavbarLayout')

@section('title', 'Logs Activity')

@section('content')
    <main class="mt-4">
        <section class="card">
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-between m-2 pb-2">

                <!-- Search -->
                <form action="" method="get" class="nav-item d-flex align-items-center gap-1 mb-2 mt-5 mb-md-0">
                    <div class="input-group input-group-merge">
                        <input type="text" name="search" class="form-control-sm border-1 w-100" placeholder="Search"
                            aria-label="Search..." aria-describedby="basic-addon-search31" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Action</th>
                            <th>Table</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($logsData as $item)
                            <tr>
                                <td>
                                    {{ $item->user->email }}
                                </td>
                                <td>
                                    {{ $item->action }}
                                </td>
                                <td>
                                    {{ $item->table_name }}
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>
                                    {{ $item->ip_address }}
                                </td>
                                <td>
                                    {{ date_format($item->created_at, 'm-d-Y H:i:s A') }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="m-3 d-flex justify-content-end">
                    {{ $logsData->onEachSide(5)->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
