<?php
if($t){
	$title = $t;
}
else{
	$title = (App::isLocale('ru'))? 'Мастер-класс' : 'Майстер-класи';
}
$description = $_description;
$keywords = $_keywords;

?>

@extends('layouts.app')

@if($meta_title)
    @section('title', $meta_title)
@else
    @section('title', $title)
@endif
@section('description', $description)
@section('keywords', $keywords)



@section('content')

	<section class="page-name">
      	<div class="container page-name__inner">
        	<h1 class="h2">
        		@if($t)
          			{{ $t }}
          		@else
          			{{ $title }}
          		@endif
        	</h1>
      	</div>
      	<section class="categories">
        	<div class="categories__inner container">
          		<ul class="categories__list">
           			@foreach($categorys_count as $ct)
           				<?php $cat = $ct['cat']; ?>
	            		<li class="categories__item">
                            @if($cat_stage_1 == 'all' AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                <a href="{{ route('master_catalog', [app()->getLocale(), $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND $cat_stage_1 != 'all' AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                <a href="{{ route('master_catalog_stage_2', [app()->getLocale(), $cat_stage_1, $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND isset($cat_stage_2) AND !isset($cat_stage_3))
                                <a href="{{ route('master_catalog_stage_3', [app()->getLocale(), $cat_stage_1, $cat_stage_2, $cat->slug]) }}" class="categories__link">
                            @endif
	                			<span class="categories__icon">
	                				<img src="/storage/{{ $cat['image'] }}" width="21" height="21">
	                			</span>
	                			<span class="categories__title">
	                  				{{ (App::isLocale('ru'))? $cat->name_ru : $cat->name_uk }}
	                			</span>
	                			<span class="categories__count">
	                  				{{ $ct['count'] }}
	                			</span>
	              			</a>
	            		</li>
            		@endforeach
          		</ul>
        	</div>
      	</section>
      	<div class="page-catalog">
            <div class="container page-catalog__inner">
                <section class="filter filter--no-js">
                    <div class="filter__fixed">
                        <button type="button" class="button button--filter-open">
                            {{ (App::isLocale('ru'))? 'Фильтр' : 'Фільтр' }}
                        </button>
                    </div>
                    <div class="filter__inner">
                        <form method="GET">
                            <button type="submit" class="send_filter" style="display: none;"></button>
                            <input type="hidden" name="order_filter" class="select_order_filter" value="{{ (isset($_GET['order_filter']))? $_GET['order_filter'] : '' }}">
                            <div class="filter__main">
                                <ul class="filter__tags">
                                    @if(isset($_GET['city_filter']))
                                        @if($_GET['city_filter'])
                                            <li>
                                                <button type="button" class="tag tag-city">
                                                    {{ $filter_city }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    @if(isset($_GET['group_filter_2']))
                                        @if($_GET['group_filter_2'])
                                            <li>
                                                <button type="button" class="tag tag-group-2">
                                                    {{ (App::isLocale('ru'))? 'В группе' : 'В группі' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    @if(isset($_GET['group_filter_1']))
                                        @if($_GET['group_filter_1'])
                                            <li>
                                                <button type="button" class="tag tag-group-1">
                                                    {{ (App::isLocale('ru'))? 'Индивидуально' : 'Індивідуально' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    @if(isset($_GET['cert_filter_1']))
                                        @if($_GET['cert_filter_1'])
                                            <li>
                                                <button type="button" class="tag tag-cert-1">
                                                    {{ (App::isLocale('ru'))? 'Сертификат' : 'Сертифікат' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    @if(isset($_GET['cert_filter_2']))
                                        @if($_GET['cert_filter_2'])
                                            <li>
                                                <button type="button" class="tag tag-cert-2">
                                                    {{ (App::isLocale('ru'))? 'Диплом' : 'Диплом' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    @if(isset($_GET['cert_filter_3']))
                                        @if($_GET['cert_filter_3'])
                                            <li>
                                                <button type="button" class="tag tag-cert-3">
                                                    {{ (App::isLocale('ru'))? 'Нет' : 'Ні' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    @if(isset($_GET['date_filter_1']))
                                        @if($_GET['date_filter_1'])
                                            <li>
                                                <button type="button" class="tag tag-date-1">
                                                    {{ (App::isLocale('ru'))? 'Дата с' : 'Дата з' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif

                                    @if(isset($_GET['date_filter_2']))
                                        @if($_GET['date_filter_2'])
                                            <li>
                                                <button type="button" class="tag tag-date-2">
                                                    {{ (App::isLocale('ru'))? 'Дата по' : 'Дата по' }}
                                                </button>
                                            </li>
                                        @endif
                                    @endif
                                    <?php
                                        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
                                        // и затем используем "левую" часть:
                                        $url_clear = 'https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
                                    ?>
                                    <li>
                                        <a href="{{ $url_clear }}" class="tag tag--reset">
                                            {{ (App::isLocale('ru'))? 'Очистить фильтр' : 'Очистити фільтр' }}
                                        </a>
                                    </li>
                                </ul>
                                <div class="filter__content">
                                    <fieldset class="filter__item">
                                        <legend>
                                            {{ (App::isLocale('ru'))? 'Город' : 'Місто' }}
                                        </legend>
                                        <select style="width:100%" class="cityFilter" name="city_filter">
											<option disabled selected>{{ (App::isLocale('ru'))? 'Выбрать город' : 'Обрати місто' }}</option>
											@foreach($regions as $region)
												<?php if(isset($_GET['city_filter'])): ?>
													<?php if($region->id == $_GET['city_filter']): ?>
														<option selected value="{{ $region->id }}">{{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}</option>
													<?php else: ?>
														<option value="{{ $region->id }}">{{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}</option>
													<?php endif; ?>
												<?php else: ?>
													<option value="{{ $region->id }}">{{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}</option>
												<?php endif; ?>
												@endforeach
										</select>
                                    </fieldset>
                                    <fieldset class="filter__item filter_form">
                                        <legend>
                                            Тип
                                        </legend>
                                        <p class="checkbox">
                                            <input type="checkbox" name="group_filter_2" id="filter_group" class="visually-hidden checkbox__input" value="2" {{ (isset($_GET['group_filter_2']))? ($_GET['group_filter_2'] == 2)? 'checked' : '' : '' }}>
                                            <label for="filter_group" class="checkbox__label">
                                                Онлайн
                                            </label>
                                        </p>
                                        <p class="checkbox">
                                            <input type="checkbox" name="group_filter_1" id="filter_individual" class="visually-hidden checkbox__input" value="1" {{ (isset($_GET['group_filter_1']))? ($_GET['group_filter_1'] == 1)? 'checked' : '' : '' }}>
                                            <label for="filter_individual" class="checkbox__label">
                                                Офлайн
                                            </label>
                                        </p>
                                    </fieldset>
                                    <fieldset class="filter__item filter_form">
                                    <legend>
                                        {{ (App::isLocale('ru'))? 'Документ об окончании:' : 'Документ про закінчення:' }}
                                    </legend>
                                    <p class="checkbox">
                                        <input type="checkbox" name="cert_filter_1" id="filter_certificate" class="visually-hidden checkbox__input" value="1" {{ (isset($_GET['cert_filter_1']))? ($_GET['cert_filter_1'] == 1)? 'checked' : '' : ''}}>
                                        <label for="filter_certificate" class="checkbox__label">
                                            {{ (App::isLocale('ru'))? 'Сертификат' : 'Сертифікат' }}
                                        </label>
                                    </p>
                                    <p class="checkbox">
                                        <input type="checkbox" name="cert_filter_2" id="filter_no" class="visually-hidden checkbox__input" value="2" {{ (isset($_GET['cert_filter_2']))? ($_GET['cert_filter_2'] == 2)? 'checked' : '' : '' }}>
                                        <label for="filter_no" class="checkbox__label">
                                            {{ (App::isLocale('ru'))? 'Нет' : 'Немає' }}
                                        </label>
                                    </p>
                                </fieldset>
                                <fieldset class="filter__item filter__item--date">
                                    <legend>
                                        Дата:
                                    </legend>
                                    <label for="date_1" class="visually-hidden">
                                        Дата
                                    </label>
                                    <input type="text" name="date_filter_1" class="input datetimepicker" id="date_1" value="{{ (isset($_GET['date_filter_1']))? $_GET['date_filter_1'] : ''}}">
                                    <label for="date_2" class="visually-hidden">
                                        Дата
                                    </label>
                                    <input type="text" name="date_filter_2" class="input datetimepicker" id="date_2" value="{{ (isset($_GET['date_filter_2']))? $_GET['date_filter_2'] : ''}}">
                                </fieldset>
                                <fieldset class="filter__item">
                                    <legend>
                                        {{ (App::isLocale('ru'))? 'Диапазон цен' : 'Діапазон цін' }}
                                    </legend>
                                    <div class="filter__slider slider">
                                        <div class="slider__top">
                                            <label for="filter_min_price" class="label">
                                                от
                                            </label>
                                            <input type="number" name="filter_min_price" min="0" max="{{ $max_price->price_about }}" class="input search-select" id="filter_min_price" value="{{ (isset($_GET['filter_min_price']))? $_GET['filter_min_price'] : '0' }}">
                                            <label for="filter_max_price" class="label">
                                                до
                                            </label>
                                            <input type="number" name="filter_max_price" min="0" max="{{ $max_price->price_about }}" class="input search-select" id="filter_max_price" value="{{ (isset($_GET['filter_max_price']))? $_GET['filter_max_price'] : $max_price->price_about }}">
                                            <span class="slider__currency">
                                                грн.
                                            </span>
                                        </div>
                                        <div class="slider__action">
                                            <div class="slider__progress"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="filter__action">
                                <p class="filter__info">
                                    @if(App::isLocale('ru'))
                                        Подобрано {{ $show }} курсов з {{ $count }}
                                    @else
                                        Підібрано {{ $show }} майстер-класів з {{ $count }}
                                    @endif
                                </p>
                                <button type="submit" class="button filter__submit">
                                    Применить
                                </button>
                                <div class="filter__mobile-navigation">
                                    <button type="button" class="filter__exit">
                                        <svg width="7" height="13">
                                            <use xlink:href="#icon-arrow-left-white"></use>
                                        </svg>
                                        Назад
                                    </button>
                                    <p class="filter__title">
                                        {{ (App::isLocale('ru'))? 'Фильтр' : 'Фільтр' }}
                                    </p>
                                    <button type="reset" class="filter__reset">
                                        Очистить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="popular-school filter__popular-school">
                    <p class="popular-school__title">
                        Популярные школы
                    </p>
                    <p class="popular-school__wrapper">
                        @foreach($schools_top as $sc)
                            <a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $sc->id]) }}">
                                {{ (App::isLocale('ru'))? $sc->name_ru : $sc->name_ua }}
                            </a>
                        @endforeach
                    </p>
                </div>
            </section>
            <section class="catalog">
                <div class="catalog__filter">
                    <div class="catalog__filter-top">
                        <p class="catalog__info">
                            <span class="catalog__hidden">
                                {{ (App::isLocale('ru'))? 'Подобрано' : 'Підібрано' }}
                            </span>
                            {{ $show }} {{ (App::isLocale('ru'))? 'курсов с' : 'курсів з' }} {{ $count }}
                        </p>
                        <div class="catalog__sorting">
                            <div class="sorting">
                                <form action="sorting.php" method="get">
                                    <div class="sorting__inner select_class">
                                        <button type="button" class="sorting__toggle select_btn close">
                                            @if(isset($_GET['order_filter']))
                                                <?php
                                                    switch ($_GET['order_filter']) {
                                                        case 1:
                                                            $text = (App::isLocale('ru'))? 'По рейтингу' : 'За рейтингом';
                                                            $icon = 'icon-star-yellow';
                                                            break;
                                                        case 2:
                                                            $text = (App::isLocale('ru'))? 'от дешевых к дорогим' : 'від дешевих до дорогих';
                                                            $icon = 'icon-arrow-top';
                                                            break;
                                                        case 3:
                                                            $text = (App::isLocale('ru'))? 'от дорогих к дешевым' : 'від дорогих до дешевих';
                                                            $icon = 'icon-arrow-bottom';
                                                            break;
                                                        default:
                                                            $text = (App::isLocale('ru'))? 'По рейтингу' : 'За рейтингом';
                                                            $icon = 'icon-star-yellow';
                                                            break;
                                                    }
                                                ?>
                                                <svg class="sorting__icon" width="17" height="15">
                                                    <use xlink:href="#{{ $icon }}"></use>
                                                </svg>
                                                <span class="sorting__selected select_val">
                                                    {{ $text }}
                                                </span>
                                                <svg width="13" height="7" class="sorting__arrow">
                                                    <use xlink:href="#icon-arrow"></use>
                                                </svg>
                                            @else
                                                <svg class="sorting__icon" width="17" height="15">
                                                    <use xlink:href="#icon-star-yellow"></use>
                                                </svg>
                                                <span class="sorting__selected select_val">
                                                    {{ (App::isLocale('ru'))? 'По рейтингу' : 'За рейтингом' }}
                                                </span>
                                                <svg width="13" height="7" class="sorting__arrow">
                                                    <use xlink:href="#icon-arrow"></use>
                                                </svg>
                                            @endif
                                        </button>
                                        <ul class="sorting__dropdown select_list">
                                            <li class="sorting__item">
                                                <button type="button" class="sorting__option select_option" data-in="order_filter" data-id="1">
                                                    <svg width="17" height="15">
                                                        <use xlink:href="#icon-star-yellow"></use>
                                                    </svg>
                                                    {{ (App::isLocale('ru'))? 'По рейтингу' : 'За рейтингом' }}
                                                </button>
                                            </li>
                                            <li class="sorting__item">
                                                <button type="button" class="sorting__option select_option" data-in="order_filter" data-id="2">
                                                    <svg width="17" height="15">
                                                        <use xlink:href="#icon-arrow-top"></use>
                                                    </svg>
                                                    {{ (App::isLocale('ru'))? 'от дешевых к дорогим' : 'від дешевих до дорогих' }}
                                                </button>
                                            </li>
                                            <li class="sorting__item">
                                                <button type="button" class="sorting__option select_option" data-in="order_filter" data-id="3">
                                                    <svg width="17" height="15">
                                                        <use xlink:href="#icon-arrow-bottom"></use>
                                                    </svg>
                                                    {{ (App::isLocale('ru'))? 'от дорогих к дешевым' : 'від дорогих до дешевих' }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <button type="button" class="button button--filter-open catalog__get-filter">
                            <svg width="16" height="15">
                                <use xlink:href="#icon-filter"></use>
                            </svg>
                            {{ (App::isLocale('ru'))? 'Фильтр' : 'Фільтр' }}
                        </button>
                        <div class="catalog__view">
                            <label class="view" aria-label="Показать плиткой">
                                <input type="radio" name="orientation" class="view__input visually-hidden" value="vertical" checked>
                                    <span class="view__icon">
                                        <svg width="21" height="21">
                                            <use xlink:href="#icon-vertical"></use>
                                        </svg>
                                    </span>
                            </label>
                            <label class="view" aria-label="Показать полосой">
                                <input type="radio" name="orientation" class="view__input visually-hidden" value="default">
                                <span class="view__icon">
                                    <svg width="21" height="21">
                                        <use xlink:href="#icon-tile"></use>
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="catalog__filter-bottom">
                        @if(isset($_GET['city_filter']))
                            @if($_GET['city_filter'])
                                <button type="button" class="tag tag-city">
                                    {{ $filter_city }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['group_filter_2']))
                            @if($_GET['group_filter_2'])
                                <button type="button" class="tag tag-group-2">
                                    {{ (App::isLocale('ru'))? 'В группе' : 'В группі' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['group_filter_1']))
                            @if($_GET['group_filter_1'])
                                <button type="button" class="tag tag-group-1">
                                    {{ (App::isLocale('ru'))? 'Индивидуально' : 'Індивідуально' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['cert_filter_1']))
                            @if($_GET['cert_filter_1'])
                                <button type="button" class="tag tag-cert-1">
                                    {{ (App::isLocale('ru'))? 'Сертификат' : 'Сертифікат' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['cert_filter_2']))
                            @if($_GET['cert_filter_2'])
                                <button type="button" class="tag tag-cert-2">
                                    {{ (App::isLocale('ru'))? 'Диплом' : 'Диплом' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['cert_filter_3']))
                            @if($_GET['cert_filter_3'])
                                <button type="button" class="tag tag-cert-3">
                                    {{ (App::isLocale('ru'))? 'Нет' : 'Ні' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['date_filter_1']))
                            @if($_GET['date_filter_1'])
                                <button type="button" class="tag tag-date-1">
                                    {{ (App::isLocale('ru'))? 'Дата с' : 'Дата з' }}
                                </button>
                            @endif
                        @endif

                        @if(isset($_GET['date_filter_2']))
                            @if($_GET['date_filter_2'])
                                <button type="button" class="tag tag-date-2">
                                    {{ (App::isLocale('ru'))? 'Дата по' : 'Дата по' }}
                                </button>
                            @endif
                        @endif
                        <?php
                            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
                            // и затем используем "левую" часть:
                            $url_clear = 'https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
                        ?>
                        <a href="{{ $url_clear }}" class="tag tag--reset">
                            {{ (App::isLocale('ru'))? 'Очистить фильтр' : 'Очистити фільтр' }}
                        </a>
                    </div>
                </div>
                <ul class="catalog__list catalog__list--vertical" id="list_item_course">
                    <!-- <li class="catalog__item">
                        <article class="product product--top">
                            <div class="product__picture">
                                <a href="#" class="product__img">
                                    <picture>
                                        <source type="image/webp" srcset="img/product-1.webp">
                                        <img src="img/product-1.jpg" width="280" height="155" alt="Курс по маникюру">
                                    </picture>
                                </a>
                            </div>
                            <div class="product__info-block">
                                <h6 class="product__name">
                                    <a href="#">
                                        Курс по маникюру
                                    </a>
                                </h6>
                                <p class="product__organization">
                                    Makeup house school
                                </p>
                                <div class="product__cities">
                                    <svg width="11" height="16">
                                        <use xlink:href="#icon-location"></use>
                                    </svg>
                                    <p>
                                        Киев,
                                    </p>
                                    <p class="product__cities__more">
                                        <a href="#">
                                            еще 3 города
                                        </a>
                                    </p>
                                </div>
                                <ul class="product__features">
                                    <li>
                                        <svg width="12" height="15">
                                            <use xlink:href="#icon-medal"></use>
                                        </svg>
                                        Выдаеться сертификат
                                    </li>
                                    <li>
                                        <svg width="12" height="15">
                                            <use xlink:href="#icon-group"></use>
                                        </svg>
                                        Группой / Индивид.
                                    </li>
                                </ul>
                                <div class="product__price">
                                    <p class="product__label-price">
                                        занятие:
                                    </p>
                                    <p class="product__sum">
                                        1800
                                        <span>
                                            грн
                                        </span>
                                        <span class="product__sale">
                                            -5%
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="product__actions">
                                <a href="#" class="like like--active like-small" aria-label="Добавить в избранное">
                                    <svg width="17" height="16">
                                        <use xlink:href="#icon-like"></use>
                                    </svg>
                                </a>
                                <a href="#" class="button product__buy">
                                    Подробнее
                                    <svg width="7" height="13">
                                        <use xlink:href="#icon-arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    </li> -->
                    @foreach($lists as $list)
                        <li class="catalog__item">
                            <article class="product">
                                <div class="product__picture">
                                    <a href="{{ route('master_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="product__img">
                                        <img src="{{ $list->img }}" width="280" height="155" alt="Курс по маникюру">
                                    </a>
                                </div>
                                <div class="product__info-block">
                                    <h6 class="product__name">
                                        <a href="{{ route('master_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}">
                                            {{ (App::isLocale('ru'))? $list->name_ru : $list->name_ua }}
                                        </a>
                                    </h6>
                                    <p class="product__organization">
                                        {{ Organization::getName($list->organization_id) }}
                                    </p>
                                    <div class="product__cities">
                                        <svg width="11" height="16">
                                            <use xlink:href="#icon-location"></use>
                                        </svg>
                                        <p>
                                            {{ Filia::gatNameRegionForCourse($list->regions) }}
                                        </p>
                                        <p class="product__cities__more">
                                            <a href="#">
                                                {{ Filia::getCountRegionsCourse($list->regions) }}
                                            </a>
                                        </p>
                                    </div>
                                    <ul class="product__features">
                                        <li>
                                            {{ date('d.m.Y', $list->date) }}
                                        </li>
                                    </ul>
                                    <div class="product__price">
                                        <p class="product__label-price">
                                            <?php
                                                switch ($list->od) {
                                                    case 1:
                                                        echo "курс:";
                                                        break;
                                                    case 2:
                                                        echo (App::isLocale('ru'))? 'час:' : 'година';
                                                        break;
                                                    case 3:
                                                        echo (App::isLocale('ru'))? 'занятие:' : 'заняття';
                                                        break;
                                                }
                                            ?>
                                        </p>
                                        <p class="product__sum">
                                            @if($list->price_type != 2)
                                                @if($list->price_type == 3) {{ (App::isLocale('ru'))? 'От' : 'Вiд' }} @endif {{ $list->price}}
                                                <span>
                                                    <?php
                                                        switch ($list->currency) {
                                                            case 1:
                                                                echo "грн.";
                                                                break;
                                                            case 2:
                                                                echo "$";
                                                                break;
                                                            case 3:
                                                                echo "€";
                                                                break;
                                                        }
                                                    ?>
                                                </span>
                                            @else
                                                {{ (App::isLocale('ru'))? 'Беcплатно' : 'Безкоштовно' }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="product__actions">
                                    @guest
                                        <a href="javascript:void(0);" class="like like-small {{ (isset($_COOKIE['Like-master-'.$list->id]))? 'like--active' : 'add_favorite' }} favorite_{{ $list->id }} " aria-label="Добавить в избранное" data-favorit="{{ $list->id }}" data-type="master">
                                    @else
                                        <a href="javascript:void(0);" class="like like-small favorite_{{ $list->id }} {{ (Favorite::checkAuthMaster($list->id) != 'no')? 'like--active favorite_true_' . Favorite::checkAuthMaster($list->id) : '' }} like-favorite {{ (Favorite::checkAuthMaster($list->id) != 'no')? 'action_delete' : 'action_add' }}" aria-label="Добавить в избранное" data-action="{{ (Favorite::checkAuthMaster($list->id) != 'no')? 'delete' : 'add' }}" data-id="{{ $list->id }}" data-like="{{ Favorite::checkAuthMaster($list->id) }}" data-lang="{{ App::getLocale() }}" data-type="master">
                                            <span class="data-like-{{ $list->id }}" style="display: none;">{{ Favorite::checkAuthMaster($list->id) }}</span>
                                    @endguest
                                        <svg width="17" height="16">
                                            <use xlink:href="#icon-like"></use>
                                        </svg>
                                    </a>
                                    <a href="{{ route('master_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="button product__buy">
                                        {{ (App::isLocale('ru'))? 'Подробнее' : 'Детальнiше' }}
                                        <svg width="7" height="13">
                                            <use xlink:href="#icon-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
                <?php if(isset($_GET["page"])): ?>
					<?php if($_GET["page"] != $lists->lastPage()): ?>
					<button type="button" class="clickMe button catalog__load-more">
						{{ (App::isLocale('ru'))? 'Показать еще' : 'Показати ще' }}
					</button>
					<?php endif; ?>
				<?php else: ?>
					<?php if($lists->total() > 1): ?>
					<button type="button" class="clickMe button catalog__load-more">
						{{ (App::isLocale('ru'))? 'Показать еще' : 'Показати ще' }}
					</button>
					<?php endif; ?>
				<?php endif; ?>
                {{ $lists->appends(request()->input())->links('vendor.pagination.pagination')}}
                <div class="catalog__seo-text">
                    <div class="catalog__text-wrapper">
                        <p>
                            {!! $desc !!}
                        </p>
                    </div>
                    <!-- <a href="#" class="catalog__open-text">
                        Читать дальше
                        <svg width="6" height="15">
                            <use xlink:href="#icon-light-gray-down"></use>
                        </svg>
                    </a> -->
                </div>
            </section>
        </div>
    </div>
</section>

<script type="text/javascript">
    window.onload = function() {
        $(".clickMe").click(function(){
            var strGET = window.location.search.replace( '?', '');
            var current_page = $('.pagination__item--active').text();
            var page = parseInt(current_page) + 1;
            var page_count = $('.pagination__item').length - 2;
            $.ajax({
                dataType: 'html',
                type:'GET',
                url: "{{ route('morePostsMaster', [app()->getLocale(), $id]) }}?page=" + page + "&" + strGET,
            }).done(function(data){
                console.log(data);


                if(page_count > parseInt(current_page)){
                    $('.pagination__item').removeClass('pagination__item--active');
                    $('.page-link-' + page).addClass('pagination__item--active');

                    $('#list_item_course').append(data);
                }
                //$("#morePosts").html(rows);
            });
        });
    };
</script>
<script type="text/javascript">
    window.onload = function() {
        $('.datetimepicker').datetimepicker({
            minTime:0,
            format:'d.m.Y',
            step:5,
            timepicker: false,
        });
    };
</script>

@endsection
