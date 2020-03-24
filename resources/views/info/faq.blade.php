<?php

$title = (App::isLocale('ru'))? 'База знаний' : 'База знань' ;
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<section class="instruction">
    <div class="container instruction__inner">
        @foreach($categorys as $category)
            <div class="instruction__elements">
                <h2 class="instruction__title h2">
                    {{ (App::isLocale('ru'))? $category->name_ru : $category->name_ua }}
                </h2>
                <ul class="instruction__list">
                    @foreach(\App\FaqArticle::getArticle($category->id) as $article)
                        <li class="instruction__item">
                            <a href="{{ route('faq_show', [app()->getLocale(), $article->id]) }}" class="instruction__link">
                                {{ (App::isLocale('ru'))? $article->name_ru : $article->name_ua }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>

@endsection
