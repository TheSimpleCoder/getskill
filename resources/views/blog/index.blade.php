<?php
if(isset($cat)){
    $title = (App::isLocale('ru'))? $cat->name_ru : $cat->name_ua;
}else{
    $title = trans('layout/footer.Articles');
}

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<section class="all-articles">
    <div class="all-articles__inner container">
        <div class="all-articles__header">
            <h2 class="h2 all-articles__title">
                {{ $title }} от Get Skill
            </h2>
            <ul class="all-articles__menu">
                @foreach($categorys as $category)
                    <!-- all-articles__menu-item--active -->
                    @if(isset($cat))
                        <li class="all-articles__menu-item @if($cat->id == $category->id) all-articles__menu-item--active @endif">
                    @else
                        <li class="all-articles__menu-item ">
                    @endif
                        <a href="{{ route('article_category', ['locale' => app()->getLocale(), 'cat' => $category ]) }}" class="button button--gray all-articles__menu-button">
                            {{ (App::isLocale('ru'))? $category->name_ru : $category->name_ua }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <section class="articles all-articles__articles">
            <ul class="articles__list">
                @foreach($articles as $article)
                    <li class="articles__item">
                        <div class="articles__content">
                            <a href="{{ route('article_post', ['locale' => app()->getLocale(), 'cat' => \App\Article\Category::find($article->cat_id), 'post' => $article]) }}" class="articles__img">
                                <img src="{{ $article->img }}" width="295" height="167" alt="{{ (App::isLocale('ru'))? $article->name_ru : $article->name_ua }}">
                            </a>
                            <div class="articles__info-block">
                                <div class="articles__text-content">
                                    <p class="articles__name">
                                        <a href="{{ route('article_post', ['locale' => app()->getLocale(), 'cat' => \App\Article\Category::find($article->cat_id), 'post' => $article]) }}">
                                            {{ (App::isLocale('ru'))? $article->name_ru : $article->name_ua }}
                                        </a>
                                    </p>
                                    <p class="articles__text">
                                        {!! (App::isLocale('ru'))? $article->content_ru : $article->content_ua !!}
                                    </p>
                                </div>
                                <div class="details-article details-article--in-list">
                                    <div class="details-article__item">
                                        <p class="details-article__date">
                                            <svg width="15" height="16">
                                                <use xlink:href="#icon-calendar"></use>
                                            </svg>
                                            {{ date('d.m.Y', $article->time) }}
                                        </p>
                                    </div>
                                    <div class="details-article__item">
                                        <p class="details-article__views-count">
                                            <svg width="23" height="16">
                                                <use xlink:href="#icon-view"></use>
                                            </svg>
                                            {{ $article->views }}
                                        </p>
                                    </div>
                                    <div class="details-article__item">
                                        <p class="details-article__comments">
                                            <svg width="19" height="16">
                                                <use xlink:href="#icon-comments"></use>
                                            </svg>
                                            {{ Comment::getCount($article->id) }}
                                        </p>
                                    </div>
                                    <div class="details-article__item">
                                        <p class="details-article__tag">
                                            {{ (App::isLocale('ru'))? \App\Article\Category::find($article->cat_id)->name_ru : \App\Article\Category::find($article->cat_id)->name_ua }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- <button type="button" class="button button--load-more all-articles__load-more">
                Показать еще
            </button> -->
            {{ $articles->links('vendor.pagination.pagination') }}
        </section>
        <section class="top-articles all-articles__top-articles">
            <h2 class="top-articles__title">
                ТОП - 10 статей
            </h2>
            <ol class="top-articles__list">
                @foreach($tops as $top)
                    <li class="top-articles__item">
                        <a href="{{ route('article_post', ['locale' => app()->getLocale(), 'cat' => \App\Article\Category::find($top->cat_id), 'post' => $top]) }}" class="top-articles__name">
                            {{ (App::isLocale('ru'))? $top->name_ru : $top->name_ua }}
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
    </div>
</section>

@endsection
