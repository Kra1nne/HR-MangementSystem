<nav aria-label="breadcrumb">
    <ol class="breadcrumb align-items-center mb-0">

        @foreach ($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">

                @if (!$loop->last)
                    <a href="{{ $breadcrumb['link'] }}" class="text-decoration-none">
                        {{ $breadcrumb['name'] }}
                    </a>
                @else
                    <span>
                        {{ $breadcrumb['name'] }}
                    </span>
                @endif

            </li>

            {{-- Separator (Remix Icon) --}}
            @if (!$loop->last)
                <li class="mx-2 text-muted d-flex align-items-center">
                    <i class="ri-arrow-right-s-line"></i>
                </li>
            @endif
        @endforeach

    </ol>
</nav>
