{{-- File: resources/views/vendor/pagination/ajax-custom.blade.php --}}
@if ($paginator->hasPages())
<ul class="pagination" role="navigation">
    {{-- Previous Page Link (Panah Kiri «) --}}
    @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link" aria-hidden="true">«</span>
        </li>
    @else
        <li class="page-item">
            {{-- Tambahkan kelas 'ajax-link' jika Anda ingin menargetkannya lebih spesifik di JS --}}
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a>
        </li>
    @endif

    {{-- Pagination Elements (Nomor Halaman) --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Page Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item">
                        {{-- Tambahkan kelas 'ajax-link' jika Anda ingin menargetkannya lebih spesifik di JS --}}
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link (Panah Kanan ») --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a>
        </li>
    @else
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link" aria-hidden="true">»</span>
        </li>
    @endif
</ul>
@endif