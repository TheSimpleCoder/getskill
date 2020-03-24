@if ($paginator->hasPages())
    <ul class="pagination catalog__pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled pagination__item pagination__item--prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="#" class="pagination__link">
                    <svg width="7" height="13">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                    Назад
                </a>
            </li>
        @else
            <li class="pagination__item pagination__item--prev">
                <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <svg width="7" height="13">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                    Назад
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled pagination__item" aria-disabled="true"><a href="javascript:void(0);" class="pagination__link">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination__item pagination__item--active page-link-{{ $page }}" aria-current="page">
                            <a href="javascript:void(0);" class="pagination__link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="pagination__item page-link-{{ $page }}">
                            <a href="{{ $url }}" class="pagination__link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination__item pagination__item--next">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="pagination__link">
                    {{ (App::isLocale('ru'))? 'Вперёд' : 'Вперед' }}
                    <svg width="7" height="13">
                        <use xlink:href="#icon-arrow-right"></use>
                    </svg>
                </a>
            </li>
        @else
            <li class="disabled pagination__item pagination__item--next" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a aria-hidden="true" href="javascript:void(0);" rel="next" aria-label="@lang('pagination.next')" class="pagination__link">
                    {{ (App::isLocale('ru'))? 'Вперёд' : 'Вперед' }}
                    <svg width="7" height="13">
                        <use xlink:href="#icon-arrow-right"></use>
                    </svg>
                </a>
            </li>
        @endif
    </ul>
@endif
