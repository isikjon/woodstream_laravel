@if ($paginator->hasPages())
    <div class="catalog-pagination">
        <div class="catalog-pagination__info">
            Показано {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} из {{ $paginator->total() }} результатов
        </div>
        
        <div class="catalog-pagination__nav">
            @if ($paginator->onFirstPage())
                <span class="catalog-pagination__prev catalog-pagination__prev--disabled">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Предыдущая
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="catalog-pagination__prev">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Предыдущая
                </a>
            @endif

            <div class="catalog-pagination__pages">
                @php
                    $elements = $paginator->getUrlRange(1, $paginator->lastPage());
                @endphp
                
                @if($paginator->currentPage() > 3)
                    <a href="{{ $paginator->url(1) }}" class="catalog-pagination__page">1</a>
                    @if($paginator->currentPage() > 4)
                        <span class="catalog-pagination__dots">...</span>
                    @endif
                @endif

                @for($i = max(1, $paginator->currentPage() - 2); $i <= min($paginator->lastPage(), $paginator->currentPage() + 2); $i++)
                    @if($i == $paginator->currentPage())
                        <span class="catalog-pagination__page catalog-pagination__page--active">{{ $i }}</span>
                    @else
                        <a href="{{ $paginator->url($i) }}" class="catalog-pagination__page">{{ $i }}</a>
                    @endif
                @endfor

                @if($paginator->currentPage() < $paginator->lastPage() - 2)
                    @if($paginator->currentPage() < $paginator->lastPage() - 3)
                        <span class="catalog-pagination__dots">...</span>
                    @endif
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="catalog-pagination__page">{{ $paginator->lastPage() }}</a>
                @endif
            </div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="catalog-pagination__next">
                    Следующая
                    <img src="{{ asset('images/icons/arrow_right.svg') }}" alt="">
                </a>
            @else
                <span class="catalog-pagination__next catalog-pagination__next--disabled">
                    Следующая
                    <img src="{{ asset('images/icons/arrow_right.svg') }}" alt="">
                </span>
            @endif
        </div>
    </div>
@endif
