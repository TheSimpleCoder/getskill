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
        <section class="categories">
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
                <form method="GET">
                    <input type="hidden" name="city_filter" class="select_city_filter region_selcted" value="{{ (isset($_GET['city_filter']))? $_GET['city_filter'] : '' }}">
                    <!-- <button type="submit" id="send_city_result" style="display: none;">Submit</button> -->
                </form>
                <div class="select-standard__body select_list">
                    <ul class="select-standard__list">
                        <li>
                            <input type="text" class="search-select input input--full-width" data-search="region">
                        </li>
                        @foreach($regions as $region)
                            <li class="list-search-region">
                                @if(!isset($cat_stage_1) AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                    <a href="{{ route('masters_region_all_slug', [app()->getLocale(), $region->slug]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                @endif
                                @if(isset($cat_stage_1) AND !isset($cat_stage_2) AND !isset($cat_stage_3))
                                    <a href="{{ route('masters_region_all_slug_stage_one', [app()->getLocale(), $region->slug, $cat_stage_1]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                @endif
                                @if(isset($cat_stage_1) AND isset($cat_stage_2) AND !isset($cat_stage_3))
                                    <a href="{{ route('masters_region_all_slug_stage_two', [app()->getLocale(), $region->slug, $cat_stage_1, $cat_stage_2]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                @endif
                                @if(isset($cat_stage_1) AND isset($cat_stage_2) AND isset($cat_stage_3))
                                    <a href="{{ route('masters_region_all_slug_stage_tree', [app()->getLocale(), $region->slug, $cat_stage_1, $cat_stage_2, $cat_stage_3]) }}" class="select-standard__option select_option send_city_result_btn" data-id="{{ $region->slug }}" data-in="city_filter">
                                @endif
                                    {{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <!-- Курсы офлайн подборка -->
        <section class="categories">
            <div class="categories__inner container">
                <!-- <h3>{{ (App::isLocale('ru'))? 'Курсы оффлайн' : 'Курси офлайн' }}</h3> -->
                <ul class="categories__list">
                    @foreach($category_master as $cat)
                        <li class="categories__item">
                            @if(!isset($cat_stage_1))
                                <a href="{{ route('masters_region_all_slug_stage_one', [app()->getLocale(), $slug, $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND !isset($cat_stage_2))
                                <a href="{{ route('masters_region_all_slug_stage_two', [app()->getLocale(), $slug, $cat_stage_1, $cat->slug]) }}" class="categories__link">
                            @endif
                            @if(isset($cat_stage_1) AND isset($cat_stage_2))
                                <a href="{{ route('masters_region_all_slug_stage_tree', [app()->getLocale(), $slug, $cat_stage_1, $cat_stage_2, $cat->slug]) }}" class="categories__link">
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
                                            Подробнее
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