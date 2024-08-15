@if ($paginator->hasPages())
<style>
    .pagination .page-link {
    font-size: 12px; /* Ajusta el tamaño de la fuente según tu preferencia */
    padding: 5px 10px; /* Ajusta el relleno según tu preferencia */
}

.pagination .page-item.disabled .page-link {
    opacity: 0.5;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

</style>
    <ul class="pagination">
        {{-- Enlace a la primera página --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Enlaces a las páginas --}}
        @foreach ($elements[0] as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        {{-- Enlace a la última página --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif
