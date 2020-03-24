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

<section class="instruction-details">
    <div class="instruction-details__inner container">
        <h2 class="h2 instruction-details__title">
            {{ (App::isLocale('ru'))? $article->name_ru : $article->name_ua }}
        </h2>
        <article class="instruction-details__text text">
            @if(App::isLocale('ru'))
                {!! $article->text_ru !!}
            @else
                {!! $article->text_ua !!}
            @endif
        </article>
    </div>
</section>

@endsection
