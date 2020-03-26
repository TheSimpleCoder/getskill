<?php
if($t){
    $title = $t;
}
else{
    $title = (App::isLocale('ru')? 'Школы' : 'Школи');
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
                                <a href="{{ route('school_list', [app()->getLocale(), $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND $cat_stage_1 != 'all' AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                <a href="{{ route('school_list_stage_2', [app()->getLocale(), $cat_stage_1, $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND isset($cat_stage_2) AND !isset($cat_stage_3))
                                <a href="{{ route('school_list_stage_3', [app()->getLocale(), $cat_stage_1, $cat_stage_2, $cat->slug]) }}" class="categories__link">
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
                        <form method="get" class="filter_form">
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
                                    @if(isset($_GET['five_stars_5']))
                                        <li>
                                            <button type="button" class="tag tag-star-5">
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                            </button>
                                        </li>
                                    @endif
                                    @if(isset($_GET['five_stars_4']))
                                        <li>
                                            <button type="button" class="tag tag-star-4">
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                            </button>
                                        </li>
                                    @endif
                                    @if(isset($_GET['five_stars_3']))
                                        <li>
                                            <button type="button" class="tag tag-star-3">
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                            </button>
                                        </li>
                                    @endif
                                    @if(isset($_GET['five_stars_2']))
                                        <li>
                                            <button type="button" class="tag tag-star-2">
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                            </button>
                                        </li>
                                    @endif
                                    @if(isset($_GET['five_stars_1']))
                                        <li>
                                            <button type="button" class="tag tag-star-1">
                                                <svg width="17" height="14">
                                                    <use xlink:href="#icon-rationg-star"></use>
                                                </svg>
                                            </button>
                                        </li>
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
                                    <fieldset class="filter__item">
                                        <legend>
                                            Рейтинг
                                        </legend>
                                        <div class="checkbox rating__school-filter">
                                            <input type="checkbox" name="five_stars_5" id="five_stars_5" class="visually-hidden checkbox__input" {{ (isset($_GET['five_stars_5']))? 'checked' : '' }}>
                                            <label for="five_stars_5" class="checkbox__label"></label>
                                            <div class="school__rating school--filter">
                                                <div class="rating school__rating-stars">
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p class="school__reviews-count">
                                                    {{ Rate::getRateSchoolCountStar(5) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="checkbox rating__school-filter">
                                            <input type="checkbox" name="five_stars_4" id="five_stars_4" class="visually-hidden checkbox__input" {{ (isset($_GET['five_stars_4']))? 'checked' : '' }}>
                                            <label for="five_stars_4" class="checkbox__label"></label>
                                            <div class="school__rating school--filter">
                                                <div class="rating school__rating-stars">
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p class="school__reviews-count">
                                                    {{ Rate::getRateSchoolCountStar(4) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="checkbox rating__school-filter">
                                            <input type="checkbox" name="five_stars_3" id="five_stars_3" class="visually-hidden checkbox__input" {{ (isset($_GET['five_stars_3']))? 'checked' : '' }}>
                                            <label for="five_stars_3" class="checkbox__label"></label>
                                            <div class="school__rating school--filter">
                                                <div class="rating school__rating-stars">
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p class="school__reviews-count">
                                                    {{ Rate::getRateSchoolCountStar(3) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="checkbox rating__school-filter">
                                            <input type="checkbox" name="five_stars_2" id="five_stars_2" class="visually-hidden checkbox__input" {{ (isset($_GET['five_stars_2']))? 'checked' : '' }}>
                                            <label for="five_stars_2" class="checkbox__label"></label>
                                            <div class="school__rating school--filter">
                                                <div class="rating school__rating-stars">
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p class="school__reviews-count">
                                                    {{ Rate::getRateSchoolCountStar(2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="checkbox rating__school-filter">
                                            <input type="checkbox" name="five_stars_1" id="five_stars_1" class="visually-hidden checkbox__input" {{ (isset($_GET['five_stars_1']))? 'checked' : '' }}>
                                            <label for="five_stars_1" class="checkbox__label"></label>
                                            <div class="school__rating school--filter">
                                                <div class="rating school__rating-stars">
                                                    <div class="rating__star rating__star--active">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="rating__star">
                                                        <svg width="17" height="15">
                                                            <use xlink:href="#icon-rationg-star"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p class="school__reviews-count">
                                                    {{ Rate::getRateSchoolCountStar(1) }}
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!-- <fieldset class="filter__item">
                                        <legend>
                                            Диапазон цен
                                        </legend>
                                        <div class="filter__slider slider">
                                            <div class="slider__top">
                                                <label for="filter_min_price" class="label">
                                                    от
                                                </label>
                                                <input type="number" name="filter_min_price" min="0" max="1200" class="input" id="filter_min_price" value="800">
                                                <label for="filter_max_price" class="label">
                                                    до
                                                </label>
                                                <input type="number" name="filter_max_price" min="0" max="1200" class="input" id="filter_max_price" value="1000">
                                                <span class="slider__currency">
                                                    грн.
                                                </span>
                                            </div>
                                            <div class="slider__action">
                                                <button type="button" class="slider__handle slider__handle--left" aria-label="Цена от цена" style="left: 17px;"></button>
                                                <button type="button" class="slider__handle slider__handle--right" aria-label="Цена до цена" style="right: 17px;"></button>
                                                <div class="slider__progress">
                                                    <div class="slider__line" style="width: 82%; left: 22px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset> -->
                                </div>
                                <div class="filter__action">
                                    <p class="filter__info">
                                        {{ (App::isLocale('ru'))? 'Подобрано' : 'Підібрано' }} {{ $show }} {{ (App::isLocale('ru'))? 'школ с' : 'шкiл з' }} {{ $count }}
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
                </section>
                <section class="catalog">
                    <div class="catalog__filter">
                        <div class="catalog__filter-top">
                            <p class="catalog__info">
                                <span class="catalog__hidden">
                                    {{ (App::isLocale('ru'))? 'Подобрано' : 'Підібрано' }}
                                </span>
                                {{ $show }} {{ (App::isLocale('ru'))? 'школ с' : 'шкіл з' }} {{ $count }}
                            </p>
                            <div class="catalog__sorting">
                                <div class="sorting">
                                    <form method="get">
                                        <div class="sorting__inner select_class">
                                            <button type="button" class="sorting__toggle select_btn close">
                                                @if(isset($_GET['order_filter']))
                                                    <?php
                                                        switch ($_GET['order_filter']) {
                                                            case 1:
                                                                $text = 'По рейтингу';
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
                                                                $text = 'По рейтингу';
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
                                                        По рейтингу
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
                                                        По рейтингу
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
                                    <input type="radio" name="orientation" class="view__input visually-hidden" value="vertical" checked="">
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
                            @if(isset($_GET['five_stars_5']))
                                <button type="button" class="tag tag-star-5">
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                </button>
                            @endif
                            @if(isset($_GET['five_stars_4']))
                                <button type="button" class="tag tag-star-4">
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                </button>
                            @endif
                            @if(isset($_GET['five_stars_3']))
                                <button type="button" class="tag tag-star-3">
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                </button>
                            @endif
                            @if(isset($_GET['five_stars_2']))
                                <button type="button" class="tag tag-star-2">
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                </button>
                            @endif
                            @if(isset($_GET['five_stars_1']))
                                <button type="button" class="tag tag-star-1">
                                    <svg width="17" height="14">
                                        <use xlink:href="#icon-rationg-star"></use>
                                    </svg>
                                </button>
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
                        @foreach($lists as $list)
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
                                        {{ (App::isLocale('ru'))? 'цены' : 'цiни' }}:
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
                                    {{ (App::isLocale('ru'))? 'Подробнее' : 'Детальніше' }}
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
                url: "{{ route('morePostsSchool', [app()->getLocale(), $id]) }}?page=" + page + "&" + strGET,
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

@endsection
