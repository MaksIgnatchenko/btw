@if ($paginator->hasPages())
    <div class="pagination-wr">
        <div class="container">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="pagination__item disabled">
                        <span class="pagination__link pagination__link--btn pagination__link--btn-prev">Previous</span>
                    </li>
                @else
                    <li class="pagination__item">
                        <a class="pagination__link pagination__link--btn pagination__link--btn-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="pagination__item disabled">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination__item pagination__item--active">
                                    <span class="pagination__link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="pagination__item">
                                    <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination__item">
                        <a class="pagination__link pagination__link--btn pagination__link--btn-next" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="pagination__item disabled">
                        <span class="pagination__link pagination__link--btn pagination__link--btn-next">Next</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
