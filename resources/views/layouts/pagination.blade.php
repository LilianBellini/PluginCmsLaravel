<div class="separator separator-dashed border-gray-200 mb-n4"></div>
<div class="d-flex flex-stack flex-wrap pt-10">
    <div class="fs-6 fw-semibold text-gray-700">
        Affichage de {{ $items->firstItem() }} à {{ $items->lastItem() }} sur {{ $items->total() }} entrées
    </div>
    @if ($items->hasPages())
    <ul class="pagination">
        @if ($items->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link"><i class="previous"></i></span>
        </li>
        @else
        <li class="page-item">
            <a href="{{ $items->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
        </li>
        @endif

        @foreach ($items->links()->elements as $element)
        @if (is_string($element))
        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $items->currentPage())
        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @else
        <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($items->hasMorePages())
        <li class="page-item">
            <a href="{{ $items->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
        </li>
        @else
        <li class="page-item disabled">
            <span class="page-link"><i class="next"></i></span>
        </li>
        @endif
    </ul>
    @endif
</div>
