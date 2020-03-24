@foreach($data as $list)
    <li class="catalog__item">
        <article class="product-school">
            <div class="product-school__picture">
                <a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="product-school__img">
                    <picture>
                        <img src="{{ $list->url_logo }}" width="280" height="155" alt="Школа красоты Kodiy School">
                    </picture>
                </a>
            </div>
            <div class="product-school__info-block">
                <h6 class="product-school__name">
                    <a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $list->id]) }}">
                        {{ (App::isLocale('ru'))? $list->name_ru : $list->name_ua }}
                    </a>
                </h6>
                <div class="school__rating">
                    <div class="school__rating-status">
                        {{ Rate::getRateSchool($list->id) }}
                    </div>
                    <div class="rating school__rating-stars">
                        <div class="rating__star {{ (Rate::getRateSchool($list->id) >= 1)? 'rating__star--active' : '' }}">
                            <svg width="17" height="15">
                                <use xlink:href="#icon-rationg-star"></use>
                            </svg>
                        </div>
                        <div class="rating__star {{ (Rate::getRateSchool($list->id) >= 2)? 'rating__star--active' : '' }}">
                            <svg width="17" height="15">
                                <use xlink:href="#icon-rationg-star"></use>
                            </svg>
                        </div>
                        <div class="rating__star {{ (Rate::getRateSchool($list->id) >= 3)? 'rating__star--active' : '' }}">
                            <svg width="17" height="15">
                                <use xlink:href="#icon-rationg-star"></use>
                            </svg>
                        </div>
                        <div class="rating__star {{ (Rate::getRateSchool($list->id) >= 4)? 'rating__star--active' : '' }}">
                            <svg width="17" height="15">
                                <use xlink:href="#icon-rationg-star"></use>
                            </svg>
                        </div>
                        <div class="rating__star {{ (Rate::getRateSchool($list->id) >= 5)? 'rating__star--active' : '' }}">
                            <svg width="17" height="15">
                                <use xlink:href="#icon-rationg-star"></use>
                            </svg>
                        </div>
                    </div>
                    <p class="school__reviews-count">
                        {{ Rate::getCountRateSchool($list->id) }}
                    </p>
                </div>
                <div class="product-school__cities">
                    <svg width="11" height="16">
                        <use xlink:href="#icon-location"></use>
                    </svg>
                <p>
                {{ Filia::gatNameRegionForSchool($list->id) }}
            </p>
            <p class="product-school__cities__more">
                <a href="#">
                    {{ Filia::getCountRegionsSchool($list->id) }}
                </a>
            </p>
        </div>
        <p class="product__organization">
            {{ Course::where('organization_id', $list->id)->where('status', 1)->count() }} курсов
        </p>
        <div class="product-school__price">
            <p class="product-school__label-price">
                цены:
            </p>
            <p class="product-school__sum">
                от {{ Course::minPrice($list->id) }}
                <span>
                    грн
                </span>
            </p>
        </div>
    </div>
    <div class="product-school__actions">
        <a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="button product-school__buy">
            Подробнее
            <svg width="7" height="13">
                <use xlink:href="#icon-arrow-right"></use>
            </svg>
        </a>
    </div>
</article>
</li>
@endforeach