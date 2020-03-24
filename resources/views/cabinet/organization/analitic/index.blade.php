<?php

$title = (App::isLocale('ru'))? 'Аналитика' : 'Аналiтика';
$description = '';
$keywords = '';

$analitic_v = AnaliticV::getCountView();
$analitic_o = AnaliticO::getCountOpen();
$analitic_l = AnaliticL::getCountLike();
$analitic_d = AnaliticD::getCountDeal();

if(isset($_GET['info'])){
    switch ($_GET['info']) {
        case 'today':
            $info = (App::isLocale('ru'))? 'Сегодня' : 'Сьогоднi';
            break;
        case 'yesterday':
            $info = (App::isLocale('ru'))? 'Вчера' : 'Вчора';
            break;
        case 'week':
            $info = (App::isLocale('ru'))? 'Неделя' : 'Недiля';
            break;
    }
}else{
    $info = (App::isLocale('ru'))? 'Месяц' : 'Мiсяць';
}

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')

	<section class="cabinet">
		<div class="container cabinet__inner">
			@include('cabinet.organization.layouts.sidebar', ['some' => 'data'])

			<div class="cabinet__info-block">
                <div class="analytics">
                    <div class="analytics__top">
                        <h2 class="h2 analytic__title">
                            {{ $title }}
                        </h2>
                        <div class="select-standard select-standard--without-search analytic__select-filter">
                            <button type="button" class="select-standard__toggle close open_analitic_option" aria-label="Открыть список">
                                <span class="select-standard__title">
                                    {{ $info }}
                                </span>
                                <span class="select-standard__arrow">
                                    <svg width="13" height="7">
                                        <use xlink:href="#icon-arrow"></use>
                                    </svg>
                                </span>
                            </button>
                            <div class="select-standard__body select_list analytic_list_hidden">
                                <ul class="select-standard__list">
                                    <li>
                                        <a href="{{ route('cabinet.organization.analitic', App::getLocale()) }}?info=today">
                                            <button type="button" class="select-standard__option select_option" data-id="1" data-in="city_filter">
                                                {{ (App::isLocale('ru'))? 'Сегодня' : 'Сьогоднi' }}
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cabinet.organization.analitic', App::getLocale()) }}?info=yesterday">
                                            <button type="button" class="select-standard__option select_option" data-id="1" data-in="city_filter">
                                                {{ (App::isLocale('ru'))? 'Вчера' : 'Вчора' }}
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cabinet.organization.analitic', App::getLocale()) }}?info=week">
                                            <button type="button" class="select-standard__option select_option" data-id="1" data-in="city_filter">
                                                {{ (App::isLocale('ru'))? 'Неделя' : 'Недiля' }}
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cabinet.organization.analitic', App::getLocale()) }}">
                                            <button type="button" class="select-standard__option select_option" data-id="1" data-in="city_filter">
                                                {{ (App::isLocale('ru'))? 'Месяц' : 'Мiсяць' }}
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="analytics__slider">
                        <div class="analytics__item">
                            <div class="analytic-card analytic-card--violet">
                                <p class="analytic-card__view">
                                    {{ (App::isLocale('ru'))? 'Просмотров' : 'Переглядiв' }}
                                </p>
                                <div class="analytic-card__details">
                                    <p class="analytic-card__value">
                                        {{ $analitic_v['count'] }}
                                    </p>
                                    <div class="analytic-card__increase analytic-card__increase-{{ $analitic_v['arrow'] }}">
                                        <p>
                                            {{ $analitic_v['sign'] }}{{ $analitic_v['procent'] }}%
                                            <svg width="6" height="15">
                                                <use xlink:href="#icon-analitycs-single-top"></use>
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="analytics__item">
                            <div class="analytic-card analytic-card--yellow">
                                <p class="analytic-card__view">
                                    {{ (App::isLocale('ru'))? 'Открыто телефонов' : 'Вiдкрито телефонiв' }}
                                </p>
                                <div class="analytic-card__details">
                                    <p class="analytic-card__value">
                                        {{ $analitic_o['count'] }}
                                    </p>
                                    <div class="analytic-card__increase analytic-card__increase-{{ $analitic_o['arrow'] }}">
                                        <p>
                                            {{ $analitic_o['sign'] }}{{ $analitic_o['procent'] }}%
                                            <svg width="6" height="15">
                                                <use xlink:href="#icon-analitycs-single-top"></use>
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="analytics__item">
                            <div class="analytic-card analytic-card--red">
                                <p class="analytic-card__view">
                                    {{ (App::isLocale('ru'))? 'В избранном' : 'В обраному' }}
                                </p>
                                <div class="analytic-card__details">
                                    <p class="analytic-card__value">
                                        {{ $analitic_l['count'] }}
                                    </p>
                                    <div class="analytic-card__increase analytic-card__increase-{{ $analitic_l['arrow'] }}">
                                        <p>
                                            {{ $analitic_l['sign'] }}{{ $analitic_l['procent'] }}%
                                            <svg width="6" height="15">
                                                <use xlink:href="#icon-analitycs-single-top"></use>
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="analytics__item">
                            <div class="analytic-card analytic-card--green">
                                <p class="analytic-card__view">
                                    Заявок
                                </p>
                                <div class="analytic-card__details">
                                    <p class="analytic-card__value">
                                        {{ $analitic_d['count'] }}
                                    </p>
                                    <div class="analytic-card__increase analytic-card__increase-{{ $analitic_l['arrow'] }}">
                                        <p>
                                            {{ $analitic_d['sign'] }}{{ $analitic_d['procent'] }}%
                                            <svg width="6" height="15">
                                                <use xlink:href="#icon-analitycs-single-top"></use>
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-cabinet analytics__table-cabinet">
                        <ul class="table-cabinet__sort">
                            <li class="table-cabinet__sort-item table-cabinet__sort-item--title">
                                <a href="javascript:void(0);" class="table-cabinet__sort-element">
                                    {{ (App::isLocale('ru'))? 'Название' : 'Назва' }}
                                </a>
                            </li>
                            <li class="table-cabinet__sort-item table-cabinet__sort-item--view">
                                <a href="javascript:void(0);" class="table-cabinet__sort-element max sort-view">
                                    {{ (App::isLocale('ru'))? 'Просмотров' : 'Переглядiв' }}
                                    <svg width="12" height="15">
                                        <use xlink:href="#icon-double-arrow-black"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="table-cabinet__sort-item table-cabinet__sort-item--open-phone">
                                <a href="javascript:void(0);" class="table-cabinet__sort-element max sort-phone">
                                    {{ (App::isLocale('ru'))? 'Открыто телефонов' : 'Вiдкрито телефонiв' }}
                                    <svg width="12" height="15">
                                        <use xlink:href="#icon-double-arrow-black"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="table-cabinet__sort-item table-cabinet__sort-item--like">
                                <a href="javascript:void(0);" class="table-cabinet__sort-element max sort-like">
                                    {{ (App::isLocale('ru'))? 'В избранном' : 'В обраному' }}
                                    <svg width="12" height="15">
                                        <use xlink:href="#icon-double-arrow-black"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="table-cabinet__sort-item table-cabinet__sort-item--request">
                                <a href="javascript:void(0);" class="table-cabinet__sort-element max sort-deal">
                                    Заявок
                                    <svg width="12" height="15">
                                        <use xlink:href="#icon-double-arrow-black"></use>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <ul class="table-cabinet__list">
                            @foreach($return_v as $item)
                                <?php
                                    if($item->type == 'course'){
                                        if(Course::getNameCourse($item->course) == 'contionue'){
                                            continue;
                                        }
                                    }else{
                                        if(Master::getNameMaster($item->course) == 'contionue'){
                                            continue;
                                        }
                                    }
                                ?>
                                <li class="table-cabinet__list-item" data-view="{{ AnaliticV::getCountViewInfo($item->course, $item->type, $r) }}" data-phone="{{ AnaliticO::getStatItem($item->course, $item->type, $r) }}" data-like="{{ AnaliticL::getStatItem($item->course, $item->type, $r) }}" data-deal="{{ AnaliticD::getStatItem($item->course, $item->type, $r) }}">
                                    <div class="table-cabinet__column table-cabinet__column--name">
                                        <p>
                                            @if($item->type == 'course')
                                                {{ Course::getNameCourse($item->course) }}
                                            @else
                                                {{ Master::getNameMaster($item->course) }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="table-cabinet__column table-cabinet__column--views">
                                        <p class="table-cabinet__mobile-description">
                                            {{ (App::isLocale('ru'))? 'Просмотров' : 'Переглядiв' }}
                                        </p>
                                        <p>
                                            {{ AnaliticV::getCountViewInfo($item->course, $item->type, $r) }}
                                        </p>
                                    </div>
                                    <div class="table-cabinet__column table-cabinet__column--phones">
                                        <p class="table-cabinet__mobile-description">
                                            {{ (App::isLocale('ru'))? 'Открыто телефонов dd' : 'Вiдкрито телефонiв' }}
                                        </p>
                                        <p>
                                            {{ AnaliticO::getStatItem($item->course, $item->type, $r) }}
                                        </p>
                                    </div>
                                    <div class="table-cabinet__column table-cabinet__column--like">
                                        <p class="table-cabinet__mobile-description">
                                            {{ (App::isLocale('ru'))? 'В избранном' : 'В обраному' }}
                                        </p>
                                        <p>
                                            {{ AnaliticL::getStatItem($item->course, $item->type, $r) }}
                                        </p>
                                    </div>
                                    <div class="table-cabinet__column table-cabinet__column--requests">
                                        <p class="table-cabinet__mobile-description">
                                            Заявок
                                        </p>
                                        <p>
                                            {{ AnaliticD::getStatItem($item->course, $item->type, $r) }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                
                        </ul>
                    </div>
                </div>
            </div>
			

		</div>
	</section>

@endsection