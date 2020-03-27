<?php
$title = (App::isLocale('ru'))? 'Поиск' : 'Пошук';
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
        		{{ $title }}
        	</h1>
      	</div>
      	<div class="page-catalog">
            <div class="container page-catalog__inner">
                <section class="filter filter--no-js">
                    <div class="filter__fixed">
                        <button type="button" class="button button--filter-open">
                            Фильтр
                        </button>
                    </div>
                    <div class="filter__inner">
                        <form method="GET">
                            <button type="submit" class="send_filter" style="display: none;"></button>
                            <input type="hidden" name="order_filter" class="select_order_filter" value="{{ (isset($_GET['order_filter']))? $_GET['order_filter'] : '' }}">
                            <input type="hidden" name="search" value="{{ $search }}">
                            <div class="filter__main">
                                <ul class="filter__tags">
                                    <li>
                                        <button type="button" class="tag">
                                            Винница
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="tag">
                                            Индивидуально
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="tag">
                                            Cертификат
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="tag">
                                            от 800 до 15 000 грн
                                        </button>
                                    </li>
                                </ul>
                                <div class="filter__content">
                                    <fieldset class="filter__item">
                                        <legend>
                                            Город
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
                                            <input type="checkbox" name="filter_course_online" id="filter_course_online" class="visually-hidden checkbox__input" value="1" {{ (isset($_GET['filter_course_online']))? ($_GET['filter_course_online'] == 1)? 'checked' : '' : '' }}>
                                            <label for="filter_course_online" class="checkbox__label">
                                                Онлайн курси
                                            </label>
                                        </p>
                                        <p class="checkbox">
                                            <input type="checkbox" name="filter_course_offline" id="filter_course_offline" class="visually-hidden checkbox__input" value="2" {{ (isset($_GET['filter_course_offline']))? ($_GET['filter_course_offline'] == 2)? 'checked' : '' : '' }}>
                                            <label for="filter_course_offline" class="checkbox__label">
                                                Офлайн курси
                                            </label>
                                        </p>
                                        <p class="checkbox">
                                            <input type="checkbox" name="filter_course_master" id="filter_course_master" class="visually-hidden checkbox__input" value="3" {{ (isset($_GET['filter_course_master']))? ($_GET['filter_course_master'] == 3)? 'checked' : '' : '' }}>
                                            <label for="filter_course_master" class="checkbox__label">
                                                Мастер-классы
                                            </label>
                                        </p>
                                    </fieldset>
                                    <!-- <fieldset class="filter__item filter_form">
                                        <legend>
                                            {{ (App::isLocale('ru'))? 'Тип курсов' : 'Тип курсiв' }}
                                        </legend>
                                        <p class="checkbox">
                                            <input type="checkbox" name="type_course_1" id="type_course_1" class="visually-hidden checkbox__input" value="1" {{ (isset($_GET['type_course_1']))? ($_GET['type_course_1'] == 1)? 'checked' : '' : '' }}>
                                            <label for="type_course_1" class="checkbox__label">
                                                {{ __('cabinet/organization/course.Individual') }}
                                            </label>
                                        </p>
                                        <p class="checkbox">
                                            <input type="checkbox" name="type_course_2" id="type_course_2" class="visually-hidden checkbox__input" value="2" {{ (isset($_GET['type_course_2']))? ($_GET['type_course_2'] == 2)? 'checked' : '' : '' }}>
                                            <label for="type_course_2" class="checkbox__label">
                                                {{ (App::isLocal('ru'))? 'В группе' : 'У групі' }}
                                            </label>
                                        </p>
                                    </fieldset> -->
                                    <!-- <fieldset class="filter__item filter_form">
                                        <legend>
                                            {{ (App::isLocale('ru'))? 'Тип мастер-класса' : 'Тип мастер-класу' }}
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
                                    </fieldset> -->
                                    <!-- <fieldset class="filter__item filter_form">
                                    <legend>
                                        Документ об окончании:
                                    </legend>
                                    <p class="checkbox">
                                        <input type="checkbox" name="cert_filter_1" id="filter_certificate" class="visually-hidden checkbox__input" value="1" {{ (isset($_GET['cert_filter_1']))? ($_GET['cert_filter_1'] == 1)? 'checked' : '' : ''}}>
                                        <label for="filter_certificate" class="checkbox__label">
                                            Сертификат
                                        </label>
                                    </p>
                                    <p class="checkbox">
                                        <input type="checkbox" name="cert_filter_2" id="filter_diploma" class="visually-hidden checkbox__input" value="2" {{ (isset($_GET['cert_filter_2']))? ($_GET['cert_filter_2'] == 2)? 'checked' : '' : ''}}>
                                        <label for="filter_diploma" class="checkbox__label">
                                            Диплом (Курсы)
                                        </label>
                                    </p>
                                    <p class="checkbox">
                                        <input type="checkbox" name="cert_filter_3" id="filter_no" class="visually-hidden checkbox__input" value="3" {{ (isset($_GET['cert_filter_3']))? ($_GET['cert_filter_3'] == 3)? 'checked' : '' : '' }}>
                                        <label for="filter_no" class="checkbox__label">
                                            Нет
                                        </label>
                                    </p>
                                </fieldset> -->
                                <!-- <fieldset class="filter__item filter_form_date">
                                    <legend>
                                        Дата {{ (App::isLocale('ru'))? 'мастер-класса' : 'мастер-класу' }}:
                                    </legend>
                                    <p class="checkbox">
                                        <input type="date" name="date_filter_1" id="date_1" class="" value="{{ (isset($_GET['date_filter_1']))? $_GET['date_filter_1'] : ''}}">
                                        <label for="date_1" class="checkbox__label">
                                            {{ (App::isLocale('ru'))? 'З' : 'С' }}
                                        </label>
                                    </p>
                                    <p class="checkbox">
                                        <input type="date" name="date_filter_2" id="date_2" class="" value="{{ (isset($_GET['date_filter_2']))? $_GET['date_filter_2'] : ''}}">
                                        <label for="date_2" class="checkbox__label">
                                            {{ (App::isLocale('ru'))? 'До' : 'По' }}
                                        </label>
                                    </p>
                                </fieldset> -->
                                <fieldset class="filter__item">
                                    <legend>
                                        Диапазон цен
                                    </legend>
                                    <div class="filter__slider slider">
                                        <div class="slider__top">
                                            <label for="filter_min_price" class="label">
                                                от
                                            </label>
                                            <input type="number" name="filter_min_price" min="0" max="{{ $max_price->price_about }}" class="input" id="filter_min_price" value="{{ (isset($_GET['filter_min_price']))? $_GET['filter_min_price'] : '0' }}">
                                            <label for="filter_max_price" class="label">
                                                до
                                            </label>
                                            <input type="number" name="filter_max_price" min="0" max="{{ $max_price->price_about }}" class="input" id="filter_max_price" value="{{ (isset($_GET['filter_max_price']))? $_GET['filter_max_price'] : $max_price->price_about }}">
                                            <span class="slider__currency">
                                                грн.
                                            </span>
                                        </div>
                                        <div class="slider__action">
                                            <div class="slider__progress">
                                                <div class="slider__line"></div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="filter__action">
                                <p class="filter__info">
                                    Подобрано {{ $show }} курсов / мастер-классов
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
                                        Фильтр
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
                                Подобрано
                            </span>
                            {{ $show }} курсов / мастер-классов
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
                                                            $text = 'За рейтингом';
                                                            $icon = 'icon-star-yellow';
                                                            break;
                                                        case 2:
                                                            $text = 'от дешевых к дорогим';
                                                            $icon = 'icon-arrow-top';
                                                            break;
                                                        case 3:
                                                            $text = 'от дорогих к дешевым';
                                                            $icon = 'icon-arrow-bottom';
                                                            break;
                                                        default:
                                                            $text = 'За рейтингом';
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
                                                    За рейтингом
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
                                                    За рейтингом
                                                </button>
                                            </li>
                                            <li class="sorting__item">
                                                <button type="button" class="sorting__option select_option" data-in="order_filter" data-id="2">
                                                    <svg width="17" height="15">
                                                        <use xlink:href="#icon-arrow-top"></use>
                                                    </svg>
                                                    от дешевых к дорогим
                                                </button>
                                            </li>
                                            <li class="sorting__item">
                                                <button type="button" class="sorting__option select_option" data-in="order_filter" data-id="3">
                                                    <svg width="17" height="15">
                                                        <use xlink:href="#icon-arrow-bottom"></use>
                                                    </svg>
                                                    от дорогих к дешевым
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
                            Фильтр
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
                        <!-- Тип записей -->
                        @if(isset($_GET['filter_course_online']))
                            <button type="button" class="tag tag-course-online">
                                {{ (App::isLocale('ru'))? 'Онлайн курсы' : 'Онлайн курси' }}
                            </button>
                        @endif
                        @if(isset($_GET['filter_course_offline']))
                            <button type="button" class="tag tag-course-offline">
                                {{ (App::isLocale('ru'))? 'Офлайн курсы' : 'Офлайн курси' }}
                            </button>
                        @endif
                        @if(isset($_GET['filter_course_master']))
                            <button type="button" class="tag tag-course-master">
                                {{ (App::isLocale('ru'))? 'Мастер-классы' : 'Мастер-класи' }}
                            </button>
                        @endif

                        <!-- Тип курсов -->
                        @if(isset($_GET['type_course_1']))
                            @if($_GET['type_course_1'])
                                <button type="button" class="tag tag-filter-1">
                                    {{ (App::isLocale('ru'))? 'Тип курса: индивидуально' : 'Тип курсу: iндивiдуально' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['type_course_2']))
                            @if($_GET['type_course_2'])
                                <button type="button" class="tag tag-filter-2">
                                    {{ (App::isLocale('ru'))? 'Тип курса: в группе' : 'Тип курсу: в групi' }}
                                </button>
                            @endif
                        @endif

                        <!-- Тип мастер-классов -->
                        @if(isset($_GET['group_filter_2']))
                            @if($_GET['group_filter_2'])
                                <button type="button" class="tag tag-group-2">
                                    {{ (App::isLocale('ru'))? 'Тип мастер-класса: онлайн' : 'Тип мастер-класу: онлайн' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['group_filter_1']))
                            @if($_GET['group_filter_1'])
                                <button type="button" class="tag tag-group-1">
                                    {{ (App::isLocale('ru'))? 'Тип мастер-класса: офлайн' : 'Тип мастер-класу: офлайн' }}
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
                                    {{ (App::isLocale('ru'))? 'Диплом (Курсы)' : 'Диплом (Курси)' }}
                                </button>
                            @endif
                        @endif
                        @if(isset($_GET['cert_filter_3']))
                            @if($_GET['cert_filter_3'])
                                <button type="button" class="tag tag-cert-3">
                                    {{ (App::isLocale('ru'))? 'Нет' : 'Нi' }}
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
                        <a href="{{ $url_clear }}?search={{ $search }}&filter_course_online=1&filter_course_offline=2&filter_course_master=3" class="tag tag--reset">
                            Очистить фильтр
                        </a>
                    </div>
                </div>
                <ul class="catalog__list catalog__list--vertical">
                    @foreach($courses as $list)
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
                                                    echo (App::isLocale('ru'))? 'Выдаеться сертификат' : 'Видається сертифікат';
                                                }elseif($list->finish == 2){
                                                    echo '<svg width="12" height="15">
                                                            <use xlink:href="#icon-medal"></use>
                                                        </svg>';
                                                    echo (App::isLocale('ru'))? 'Выдаеться диплом' : 'Видається диплом';
                                                }
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                                if($list->group_info == 1){
                                                    echo '<svg width="12" height="15">
                                                            <use xlink:href="#icon-medal"></use>
                                                        </svg>';
                                                    echo (App::isLocale('ru'))? 'Индивидуально' : 'Індивідуально';
                                                }elseif($list->finish == 2){
                                                    echo '<svg width="12" height="15">
                                                            <use xlink:href="#icon-medal"></use>
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
                                            @if($list->sale != 0 AND $list->sale < $list->price_course)
                                                {{ $list->sale }}
                                            @else
                                                {{ $list->price_course }}
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
                                        Подробнее
                                        <svg width="7" height="13">
                                            <use xlink:href="#icon-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        </li>
                    @endforeach
                    @foreach($masters as $list)
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
                                            {{ $list->price}}
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
                @if($courses)
                    {{ $courses->appends(request()->input())->links('vendor.pagination.pagination')}}
                @endif
            </section>
        </div>
    </div>
</section>

@endsection
