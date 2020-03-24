<?php

$title = (App::isLocale('ru')? 'Отзывы' : 'Вiдгуки');
$description = '';
$keywords = '';

?>


@extends('cabinet.person.template')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('cabinet')

    <div class="cabinet__info-block">
        <div class="cabinet__form">
            <div class="cabinet__page-name">
                <h2 class="h2">
                    {{ $title }}
                </h2>
            </div>

            <section class="reviews reviews-for-user-cabinet">
                <ul class="reviews__list">
                    @foreach($lists as $list)
                        <li class="reviews__item {{ (Rate::getListsChildUser($list->id)->count() > 0)? 'reviews__item--answer' : '' }}">
                            <article class="reviews__review for-cabinet">
                                <div class="reviews__top">
                                    <div class="reviews__img">
                                        <picture>
                                            <img src="{{ $list->user_avatar }}" width="50" height="51" alt="{{ $list->user_name }}">
                                        </picture>
                                    </div>
                                    <div class="reviews__details">
                                        <div class="reviews__author">
                                            <h6 class="reviews__who-author">
                                                Вы <span>кому:</span>
                                            </h6>
                                            <h6 class="reviews__whom">
                                                {{ Rate::fromReviewsOrganization($list->id) }}
                                                <a href="{{ route('school_reviews', [App::getLocale(), Rate::fromReviewsOrganizationID($list->id)]) }}">
                                                    <svg width="19" height="19">
                                                        <use xlink:href="#external-link-icon"></use>
                                                    </svg>
                                                </a>
                                            </h6>
                                        </div>
                                        <div class="reviews__rating rating">
                                            <?php
                                                for ($i=0; $i < 5; $i++) { 
                                                    ?>
                                                        @if($i <= $list->star)
                                                            <div class="rating__star rating__star--active">
                                                        @else
                                                            <div class="rating__star">
                                                        @endif
                                                            <svg width="13" height="13">
                                                                <use xlink:href="#icon-rationg-star"></use>
                                                            </svg>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <span class="reviews__time">
                                            {{ date('d.m.Y', $list->time) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="reviews__main">
                                    <p>
                                        {{ $list->text }}
                                    </p>
                                </div>
                            </article>
                            @foreach(Rate::getListsChildUser($list->id)->get() as $child)
                                <article class="reviews__review for-cabinet reviews__review--answer">
                                    <div class="reviews__top">
                                        <div class="reviews__img">
                                            <picture>
                                                @if($child->owner == 1)
                                                    <img src="/img/commniter-avatar.png" width="50" height="51" alt="владелец">
                                                @else
                                                    <img src="{{ $child->user_avatar }}" width="50" height="51" alt="{{ $child->user_name }}">
                                                @endif
                                            </picture>
                                        </div>
                                        <div class="reviews__details">
                                            <h6 class="reviews__author">
                                                @if($child->owner == 1)
                                                    (владелец)
                                                @else
                                                    {{ $child->user_name }}
                                                @endif
                                            </h6>
                                            <span class="reviews__time">
                                                {{ date('d.m.Y', $child->time) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="reviews__main">
                                        <p>
                                            {{ $child->text }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                            <div class="reviews__footer">
                                <a href="javascript:void(0)" class="button reviews__answer">
                                    <svg width="19" height="15">
                                        <use xlink:href="#icon-arrow-rewies"></use>
                                    </svg>
                                    {{ (App::isLocale('ru'))? 'Ответить' : 'Відповісти' }}
                                </a>
                                <div class="reviews__footer-form">
                                    <form action="{{ route('course_add_review_feedback', ['locale' => app()->getLocale()]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="course" value="{{ $list->course_id }}">
                                        <input type="hidden" name="parent" value="{{ $list->id }}">
                                        <label for="reviews_answer_text" class="visually-hidden">
                                            Ответить
                                        </label>
                                        <textarea name="text" class="reviews__footer-form-textarea" placeholder="Ваш ответ" id="reviews_answer_text"></textarea>
                                        <p class="reviews__footer-text">
                                            Обратите внимание, что ваш ответ будет виден всем пользователям, поэтому он должен
                                            соответствовать нашим правилам в отношении контента.
                                            <a href="#">
                                                Условия обслуживания
                                            </a>
                                        </p>
                                        <button type="submit" class="button reviews__footer-form-textarea-submit">
                                            <svg width="19" height="15">
                                                <use xlink:href="#icon-arrow-rewies"></use>
                                            </svg>
                                            Опубликовать ответ
                                        </button>
                                        <span class="button button--cancel">
                                            {{ (App::isLocale('ru'))? 'Отменить' : 'Вiдмiнити' }}
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach

                 
                </ul>
                <p class="reviews__all">
                    <a href="#">
                        {{ (App::isLocale('ru'))? 'Смотреть все отзывы' : 'Дивитися всi вiдгуки' }}
                    </a>
                </p>

            </section>
        </div>
      
    </div>

@endsection
