<?php

$title = (App::isLocale('ru'))? 'Правила сайта' : 'Правила сайту' ;
//$title = (App::isLocale('ru'))? 'Политика конфиденциальности' : 'Правила сайту' ;
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<section class="info-site">
    <div class="container info-site__inner">
        <h2 class="h2 info-site__page-name">
            {{ $title }}
        </h2>
        <ul class="info-site__menu">
            <li class="info-site__menu-item info-site__menu-item--active">
                <a href="{{ route('terms', app()->getLocale()) }}" class="info-site__menu-link">
                    <svg width="21" height="21">
                        <use xlink:href="#icon-rulles"></use>
                    </svg>
                    <span class="info-site__menu-text">
                        {{ (App::isLocale('ru'))? 'Правила сайта' : 'Правила сайту' }}
                    </span>
                </a>
            </li>
            <li class="info-site__menu-item">
                <a href="{{ route('offer', app()->getLocale()) }}" class="info-site__menu-link">
                    <svg width="21" height="21">
                        <use xlink:href="#icon-offerta"></use>
                    </svg>
                    <span class="info-site__menu-text">
                        {{ (App::isLocale('ru'))? 'Публичная оферта' : 'Публічна оферта' }}
                    </span>
                </a>
            </li>
            <li class="info-site__menu-item">
                <a href="{{ route('term', app()->getLocale()) }}" class="info-site__menu-link">
                    <svg width="21" height="21">
                        <use xlink:href="#icon-privacy-policy"></use>
                    </svg>
                    <span class="info-site__menu-text">
                        {{ (App::isLocale('ru'))? 'Политика конфиденциальности' : 'Політика конфіденційності' }}
                    </span>
                </a>
            </li>
        </ul>
        <article class="info-site__text text">
            {!! (App::isLocale('ru'))? $term->rules_ru : $term->rules_ua !!}
        </article>
    </div>
</section>

@endsection
