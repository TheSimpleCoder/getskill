<?php

$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')

	<section class="page-name">
      	<div class="container page-name__inner">
        	<h1 class="h2">
                <!-- @if(!isset($selected_region))
                    {{ $title }}
                @else
                    {{ (App::isLocale('ru'))? 'Курсы ' . $selected_region->name_ru : 'Курси ' . $selected_region->name_uk }}
                @endif -->

                {{ $title }}
        	</h1>
      	</div>
        <!-- Курсы офлайн подборка -->
        <section class="categories">
            <div class="categories__inner container">
                <!-- <h3>{{ (App::isLocale('ru'))? 'Курсы оффлайн' : 'Курси офлайн' }}</h3> -->
                <ul class="categories__list">
                    @foreach($category_offline as $cat)
                        <li class="categories__item">
                            @if(!isset($cat_stage_1))
                                <a href="{{ route('courses_region_all_slug_stage_one', [app()->getLocale(), $slug, $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND !isset($cat_stage_2))
                                <a href="{{ route('courses_region_all_slug_stage_two', [app()->getLocale(), $slug, $cat_stage_1, $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND isset($cat_stage_2))
                                <a href="{{ route('courses_region_all_slug_stage_tree', [app()->getLocale(), $slug, $cat_stage_1, $cat_stage_2, $cat->slug]) }}" class="categories__link">
                            @endif
                                <span class="categories__icon">
                                    <img src="/storage/{{ $cat['image'] }}" width="21" height="21">
                                </span>
                                <span class="categories__title">
                                    {{ (App::isLocale('ru'))? $cat->name_ru : $cat->name_uk }}
                                </span>
                                <span class="categories__count">
                                    {{ Course::getCountCourseCatFirst($cat->id, $slug) }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <div class="page-catalog">
            <div class="container page-catalog__inner">
                <section class="filter">
                    <div class="filter__inner">
                        <div class="filter__main">
                            <div class="filter__content">
                                <fieldset class="filter__item">
                                    <legend>
                                        {{ (App::isLocale('ru'))? 'Город' : 'Місто' }}
                                    </legend>
                                    <div class="select-standard select-standard--without-search select_class">
                                        <button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
                                            <span class="select-standard__title select_val">
                                                @if(!isset($selected_region))
                                                    {{ (App::isLocale('ru'))? 'Выбрать город' : 'Вибрати мiсто' }}
                                                @else
                                                    {{ (App::isLocale('ru'))? $selected_region->name_ru : $selected_region->name_uk }}
                                                @endif
                                            </span>
                                            <span class="select-standard__arrow">
                                                <svg width="13" height="7">
                                                    <use xlink:href="#icon-arrow"></use>
                                                </svg>
                                            </span>
                                        </button>
                                        <input type="hidden" name="city_filter" class="select_city_filter" value="">
                                        <div class="select-standard__body select_list">
                                            <ul class="select-standard__list">
                                                <li>
                                                    <input type="text" class="search-select input input--full-width" data-search="region">
                                                </li>
                                                @foreach($regions as $region)
                                                    <li class="list-search-region">
                                                        @if(!isset($cat_stage_1) AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                                            <a href="{{ route('courses_region_all_slug', [app()->getLocale(), $region->slug]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                                        @endif
                                                        @if(isset($cat_stage_1) AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                                            <a href="{{ route('courses_region_all_slug_stage_one', [app()->getLocale(), $region->slug, $cat_stage_1]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                                        @endif
                                                        @if(isset($cat_stage_1) AND isset($cat_stage_2) AND !isset($cat_stage_3))
                                                            <a href="{{ route('courses_region_all_slug_stage_two', [app()->getLocale(), $region->slug, $cat_stage_1, $cat_stage_2]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                                        @endif
                                                        @if(isset($cat_stage_1) AND isset($cat_stage_2) AND isset($cat_stage_3))
                                                            <a href="{{ route('courses_region_all_slug_stage_tree', [app()->getLocale(), $region->slug, $cat_stage_1, $cat_stage_2, $cat_stage_3]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                                        @endif
                                                            {{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}
                                                        </a>
                                                    </li>
                                                @endforeach                                                     
                                            </ul>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="popular-school filter__popular-school">
                        <p class="popular-school__title">
                            {{ (App::isLocale('ru'))? 'Популярные школы' : 'Популярні школи' }}
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
                    <ul class="catalog__list catalog__list--vertical" id="list_item_course">
                        @foreach($topCourse as $top)
                            <li class="catalog__item">
                                <article class="product product--top">
                                    <div class="product__picture">
                                        <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $top->id]) }}" class="product__img">
                                            <picture>
                                                <img src="{{ $top->logo_course }}" width="280" height="155" alt="{{ $top->name_ru }}">
                                            </picture>
                                        </a>
                                    </div>
                                    <div class="product__info-block">
                                        <h6 class="product__name">
                                            <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $top->id]) }}">
                                                {{ (App::isLocale('ru'))? $top->name_ru : $top->name_ua }}
                                            </a>
                                        </h6>
                                        <p class="product__organization">
                                            {{ Organization::getName($top->organization_id) }}
                                        </p>
                                        <div class="product__cities">
                                            <svg width="11" height="16">
                                                <use xlink:href="#icon-location"></use>
                                            </svg>
                                            <p>
                                                {{ Filia::gatNameRegionForCourse($top->regions) }}
                                            </p>
                                            <p class="product__cities__more">
                                                <a href="#">
                                                    {{ Filia::getCountRegionsCourse($top->regions) }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="product__rating">
                                            {{ Rate::getRateForCourse($top->id) }}
                                            <svg width="17" height="15">
                                                <use xlink:href="#icon-star"></use>
                                            </svg>
                                        </div>
                                        <ul class="product__features">
                                            <li>
                                                <?php
                                                    if($top->finish == 1){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-medal"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Выдается сертификат' : 'Видається сертифікат';
                                                    }elseif($top->finish == 2){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-medal"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Выдается диплом' : 'Видається диплом';
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($top->group_info == 1){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-group"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Индивидуально' : 'Індивідуально';
                                                    }elseif($top->group_info == 2){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-group"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Группой' : 'Групою';
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                        <div class="product__price">
                                            <p class="product__label-price">
                                                <?php
                                                    switch ($top->od) {
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
                                                @if($top->price == 1 OR $top->price == 3)
                                                    @if($top->sale != 0 AND $top->sale < $top->price_course)
                                                        @if($top->price == 3) {{ (App::isLocale('ru'))? 'От' : 'Вiд' }} @endif {{ $top->sale }}
                                                    @else
                                                        @if($top->price == 3) {{ (App::isLocale('ru'))? 'От' : 'Вiд' }} @endif {{ $top->price_course }}
                                                    @endif
                                                    <span>
                                                        <?php
                                                            switch ($top->currency) {
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
                                                    @if($top->sale != 0 AND $top->sale < $top->price_course)
                                                        <span class="product__sale">
                                                            {{ Course::getSaleCourse($top->id) }}%
                                                        </span>
                                                    @endif
                                                @endif
                                                @if($top->price == 2)
                                                    {{ (App::isLocale('ru'))? 'Беcплатно' : 'Безкоштовно' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="product__actions">
                                        @guest
                                            <a href="javascript:void(0);" class="like like-small {{ (isset($_COOKIE['Like-course-'.$top->id]))? 'like--active' : 'add_favorite' }} favorite_{{ $top->id }} " aria-label="Добавить в избранное" data-favorit="{{ $top->id }}" data-type="course">
                                        @else
                                            <a href="javascript:void(0);" class="like like-small favorite_{{ $top->id }} {{ (Favorite::checkAuth($top->id) != 'no')? 'like--active favorite_true_' . Favorite::checkAuth($top->id) : '' }} like-favorite {{ (Favorite::checkAuth($top->id) != 'no')? 'action_delete' : 'action_add' }}" aria-label="Добавить в избранное" data-action="{{ (Favorite::checkAuth($top->id) != 'no')? 'delete' : 'add' }}" data-id="{{ $top->id }}" data-like="{{ Favorite::checkAuth($top->id) }}" data-lang="{{ App::getLocale() }}">
                                                <span class="data-like-{{ $top->id }}" style="display: none;">{{ Favorite::checkAuth($top->id) }}</span>
                                        @endguest
                                            <svg width="17" height="16">
                                                <use xlink:href="#icon-like"></use>
                                            </svg>
                                        </a>
                                        <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $top->id]) }}" class="button product__buy">
                                            {{ (App::isLocale('ru'))? 'Подробнее' : 'Детальніше' }}
                                            <svg width="7" height="13">
                                                <use xlink:href="#icon-arrow-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                        @foreach($lists as $list)
                            <li class="catalog__item">
                                <article class="product">
                                    <div class="product__picture">
                                        <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="product__img">
                                            <img src="{{ $list->logo_course }}" width="280" height="155" alt="Курс по маникюру">
                                        </a>
                                    </div>
                                    <div class="product__info-block">
                                        <h6 class="product__name">
                                            <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}">
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
                                        <div class="product__rating">
                                            {{ Rate::getRateForCourse($list->id) }}
                                            <svg width="17" height="15">
                                                <use xlink:href="#icon-star"></use>
                                            </svg>
                                        </div>
                                        <ul class="product__features">
                                            <li>
                                                <?php
                                                    if($list->finish == 1){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-medal"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Выдается сертификат' : 'Видається сертифікат';
                                                    }elseif($list->finish == 2){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-medal"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Выдается диплом' : 'Видається диплом';
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($list->group_info == 1){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-group"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Индивидуально' : 'Індивідуально';
                                                    }elseif($list->group_info == 2){
                                                        echo '<svg width="12" height="15">
                                                                <use xlink:href="#icon-group"></use>
                                                            </svg>';
                                                        echo (App::isLocale('ru'))? 'Группой' : 'Групою';
                                                    }
                                                ?>
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
                                                @if($list->price == 1 OR $list->price == 3)
                                                    @if($list->sale != 0 AND $list->sale < $list->price_course)
                                                        @if($list->price == 3) {{ (App::isLocale('ru'))? 'От' : 'Вiд' }} @endif {{ $list->sale }}
                                                    @else
                                                        @if($list->price == 3) {{ (App::isLocale('ru'))? 'От' : 'Вiд' }} @endif {{ $list->price_course }}
                                                    @endif
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
                                                    @if($list->sale != 0 AND $list->sale < $list->price_course)
                                                        <span class="product__sale">
                                                            {{ Course::getSaleCourse($list->id) }}%
                                                        </span>
                                                    @endif
                                                @endif
                                                @if($list->price == 2)
                                                    {{ (App::isLocale('ru'))? 'Беcплатно' : 'Безкоштовно' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="product__actions">
                                        @guest
                                            <a href="javascript:void(0);" class="like like-small {{ (isset($_COOKIE['Like-course-'.$list->id]))? 'like--active' : 'add_favorite' }} favorite_{{ $list->id }} " aria-label="Добавить в избранное" data-favorit="{{ $list->id }}" data-type="course">
                                        @else
                                            <a href="javascript:void(0);" class="like like-small favorite_{{ $list->id }} {{ (Favorite::checkAuth($list->id) != 'no')? 'like--active favorite_true_' . Favorite::checkAuth($list->id) : '' }} like-favorite {{ (Favorite::checkAuth($list->id) != 'no')? 'action_delete' : 'action_add' }}" aria-label="Добавить в избранное" data-action="{{ (Favorite::checkAuth($list->id) != 'no')? 'delete' : 'add' }}" data-id="{{ $list->id }}" data-like="{{ Favorite::checkAuth($list->id) }}" data-lang="{{ App::getLocale() }}">
                                                <span class="data-like-{{ $list->id }}" style="display: none;">{{ Favorite::checkAuth($list->id) }}</span>
                                        @endguest
                                            <svg width="17" height="16">
                                                <use xlink:href="#icon-like"></use>
                                            </svg>
                                        </a>
                                        <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="button product__buy">
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
                    {{ $lists->links('vendor.pagination.pagination')}}
                </section>
            </div>
        </div>
    </section>

@endsection