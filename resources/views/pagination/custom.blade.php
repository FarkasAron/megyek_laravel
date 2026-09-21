@if ($paginator->hasPages())
<nav id="paginator" aria-label="Lapozás">
    @if ($paginator->onFirstPage())
        <span class="page-link disabled">&laquo; Előző</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-link">&laquo; Előző</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="page-link disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-link current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-link">Következő &raquo;</a>
    @else
        <span class="page-link disabled">Következő &raquo;</span>
    @endif
</nav>
@endif
