@if ($paginator->hasPages())
    <nav>
        <ul class="pagerList">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><span class="material-icons">&lt;前へ</span></span>
                </li>
            @else
                <li class="page__btn">
                    <a href="{{ $paginator->previousPageUrl() }}"><span class="material-icons">&lt;前へ</span></a>
                </li>
            @endif

			<li  class="page__dots"><span>{{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}</span></li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page__btn">
                    <a href="{{ $paginator->nextPageUrl() }}"><span class="material-icons">次へ&gt;</span></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><span class="material-icons">次へ&gt;</span></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
