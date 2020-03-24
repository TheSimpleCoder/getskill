<?php
$title = (App::isLocale('ru'))? $post->name_ru : $post->name_ua;

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<section class="article-page">
    <div class="article-page__preview">
        <img src="{{ $post->img }}" class="article-page__img" width="1920" height="661" alt="{{ $title }}">
        <div class="container article-page__inner article-page__inner--preview">
            <div class="article-page__preview-text">
                <h1 class="h1 article-page__name">
                    {{ $title }}
                </h1>
            </div>
            <div class="details-article details-article__in-page">
                <div class="details-article__item">
                    <p class="details-article__date">
                        <svg width="15" height="16">
                            <use xlink:href="#icon-calendar"></use>
                        </svg>
                        {{ date('d.m.Y', $post->time) }}
                    </p>
                </div>
                <div class="details-article__item">
                    <p class="details-article__views-count">
                        <svg width="23" height="16">
                            <use xlink:href="#icon-view"></use>
                        </svg>
                        {{ $post->views }}
                    </p>
                </div>
                <div class="details-article__item">
                    <p class="details-article__comments">
                        <svg width="19" height="16">
                            <use xlink:href="#icon-comments"></use>
                        </svg>
                        {{ $comments->count() }}
                    </p>
                </div>
                <div class="details-article__item">
                    <p class="details-article__tag">
                        {{ (App::isLocale('ru'))? $cat->name_ru : $cat->name_ua }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container article-page__inner article-page__inner--main-content">
        <div class="article-page__left">
            <article class="article-page__only-text">
                <h1>
                    {{ $title }}
                </h1>
            <!-- <h2>
              H2 заголовок
            </h2>
            <h3>
              H3 заголовок
            </h3>
            <h4>
              H4 заголовок
            </h4>
            <h5>
              H5 заголовок
            </h5>
            <h6>
              H6 заголовок
            </h6> -->
            {!! (App::isLocale('ru'))? $post->content_ru : $post->content_ua !!}
          </article>
          <section class="reviews article-page__reviews">
                <div class="reviews__info">
                    <h2 class="h2">
                        {{ (App::isLocale('ru'))? 'Комментарии' : 'Коментарі' }}
                    </h2>
                    <p class="reviews__count">
                        {{ $comments->count() }}
                    </p>
                    @if(!Auth::guest())
                        <span class="button reviews__write-reviews" style="display: block;">
                            {{ (App::isLocale('ru'))? 'Написать комментарий' : 'Написати коментар' }}
                        </span>
                    @endif
                </div>
                @guest
                    <p class="reviews__not-reviews">
                        {{ (App::isLocale('ru'))? 'Только зарегистрированные пользователи могут оставить отзыв, пожалуйста' : 'Тільки зареєстровані користувачі можуть залишити відгук, будь ласка' }}
                        <a href="{{ '/' . App::getLocale() . '/login' }}" class="link">
                            {{ (App::isLocale('ru'))? 'войдите' : 'ввійдіть' }}
                        </a>
                        в&nbsp;{{ (App::isLocale('ru'))? 'аккаунт или' : 'акаунт або' }}
                        <a href="{{ route('register-person', app()->getLocale()) }}" class="link">
                            {{ (App::isLocale('ru'))? 'зарегистрируйтесь' : 'зареєструйтеся' }}.
                        </a>
                    </p>
                @endguest
                <ul class="reviews__list" style="display: block;">
                    @foreach($comments->get() as $comment)
                        <li class="reviews__item">
                            <article class="reviews__review">
                                <div class="reviews__top">
                                    <div class="reviews__img">
                                        <picture>
                                            <img src="/{{ $comment->user_avatar }}" width="50" height="51" alt="{{ $comment->user_name }}">
                                        </picture>
                                    </div>
                                    <div class="reviews__details">
                                        <h6 class="reviews__author">
                                            {{ $comment->user_name }}
                                        </h6>
                                        <span class="reviews__time">
                                            {{ date('d.m.Y', $comment->time) }}
                                        </span>
                                    </div>
                                    <div class="reviews__option-wrap">
                                        <button type="button" class="reviews__options btn_report" aria-label="Дополнительние действия">
                                            <span class="reviews__options-circle"></span>
                                            <span class="reviews__options-circle"></span>
                                            <span class="reviews__options-circle"></span>
                                        </button>
                                        <div class="reviews__option-dropdown div_report">
                                            <span class="reviews__report">
                                                <a href="{{ route('article_comment_report', [app()->getLocale(), $comment]) }}">
                                                    {{ (App::isLocale('ru'))? 'Пожаловатся' : 'Поскаржитися' }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews__main">
                                    <p>
                                        {!! $comment->text !!}
                                    </p>
                                </div>
                                <div class="reviews__footer">
                                    <a href="javascript:void(0);" class="button reviews__answer">
                                        <svg width="19" height="15">
                                            <use xlink:href="#icon-arrow-rewies"></use>
                                        </svg>
                                        {{ (App::isLocale('ru'))? 'Ответить' : 'Вiдповiсти' }}
                                    </a>
                                    <div class="reviews__footer-form">
                                        <form action="{{ route('article_comment_add', app()->getLocale()) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <label for="reviews_answer_text_{{ $comment->id }}" class="visually-hidden">
                                                {{ (App::isLocale('ru'))? 'Ответить' : 'Вiдповiсти' }}
                                            </label>
                                            <textarea name="text" class="reviews__footer-form-textarea" placeholder="Ваш ответ" id="reviews_answer_text_{{ $comment->id }}"></textarea>
                                            <!-- <p class="reviews__footer-text">
                                                Обратите внимание, что ваш ответ будет виден всем пользователям, поэтому он должен
                                                соответствовать нашим правилам в отношении контента.
                                                <a href="#">
                                                    Условия обслуживания
                                                </a>
                                            </p> -->
                                            <button type="submit" class="button reviews__footer-form-textarea-submit">
                                                <svg width="19" height="15">
                                                    <use xlink:href="#icon-arrow-rewies"></use>
                                                </svg>
                                                {{ (App::isLocale('ru'))? 'Отправить' : 'Вiдправити' }}
                                            </button>
                                        </form>
                                    </div>
                                    @foreach(Comment::getChild($comment->id) as $feed)
                                        <article class="reviews__review reviews__review--answer">
                                            <div class="reviews__top">
                                                <div class="reviews__img">
                                                    <picture>
                                                        <img src="{{ $feed->user_avatar }}" width="50" height="51" alt="{{ $feed->user_name }}">
                                                    </picture>
                                                </div>
                                                <div class="reviews__details">
                                                    <h6 class="reviews__author">
                                                        {{ $feed->user_name }}
                                                    </h6>
                                                    <span class="reviews__time">
                                                        {{ date('d.m.Y', $feed->time) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="reviews__main">
                                                <p>
                                                    {!! $feed->text !!}
                                                </p>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
                <p class="reviews__all" style="display: none;">
                    <a href="#">
                        Смотреть все коментарии
                    </a>
                </p>
                <div class="reviews__new-write" style="display: none;">
                    <div class="reviews__new-comment-add">
                        <form action="{{ route('article_comment_add', app()->getLocale()) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id">
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <p class="reviews__new-comment-add-item">
                                <label for="new-write-reviews" class="label">
                                    {{ (App::isLocale('ru'))? 'Комментарии' : 'Коментарі' }}
                                </label>
                                <textarea name="text" id="new-write-reviews" class="input input--full-width input--textarea"></textarea>
                            </p>
                            <p class="reviews__new-comment-add-item reviews__new-comment-add-item--submit">
                                <a href="#" class="reviews__new-cancel">
                                    {{ (App::isLocale('ru'))? 'Отменить' : 'Відмінити' }}
                                </a>
                                <button type="submit" class="button">
                                    {{ (App::isLocale('ru'))? 'Оставить комментарий' : 'Залишити коментар' }}
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="article-page__right">
            <p class="article-page__right-title">
                {{ (App::isLocale('ru'))? $cat_course->name_ru : $cat_course->name_uk }}
            </p>
            <section class="catalog catalog--advertising">
                <h2 class="visually-hidden">
                    {{ (App::isLocale('ru'))? 'Популярные курсы' : 'Популярні курси' }}
                </h2>
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
                </ul>
            </section>
            <p class="article-page__more-products">
                <a href="{{ route('course_catalog_offline', [App::getLocale(), 'all']) }}" class="link">
                    Смотреть все
                </a>
            </p>
        </div>
    </div>
</section>

@endsection
