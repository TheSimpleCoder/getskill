<?php

$title = (App::isLocale('ru'))? 'Контакты' : 'Контакти';
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<section class="contacts-page">
    <div class="container contacts-page__inner">
        <h2 class="h2 contacts-page__title">
            {{ $title }}
        </h2>
        <div class="contacts-page__info">
            <div class="contacts-page__info-item">
                <h6 class="contacts-page__info-title h6">
                    {{ (App::isLocale('ru'))? 'Телефоны' : 'Телефони' }}
                </h6>
                <ul class="contacts-page__info-list">
                    <li>
                        <a href="tel:0634583320">
                            <svg width="21" height="21">
                                <use xlink:href="#icon-life"></use>
                            </svg>
                            +38 (063) 458-33-20
                        </a>
                    </li>
                    <li>
                        <a href="tel:0962965202">
                            <svg width="21" height="21">
                                <use xlink:href="#icon-kiev-star"></use>
                            </svg>
                            +38 (096) 296-52-02
                        </a>
                    </li>
                    <li>
                        <a href="tel:0956840176">
                            <svg width="21" height="21">
                                <use xlink:href="#icon-vodafon"></use>
                            </svg>
                            +38 (095) 684-01-76
                        </a>
                    </li>
                </ul>
            </div>
            <div class="contacts-page__info-item">
                <h6 class="contacts-page__info-title h6">
                    E-mail
                </h6>
                <ul class="contacts-page__info-list contacts-page__info-list--except-icon">
                    <li>
                        <a href="mailto:getskill.com.ua@gmail.com">
                            getskill.com.ua@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
            <div class="contacts-page__info-item">
                <h6 class="contacts-page__info-title h6">
                    {{ (App::isLocale('ru'))? 'График работы' : 'Графік роботи' }}
                </h6>
                <div class="contacts-page__schedule">
                    <p>
                        {{ (App::isLocale('ru'))? 'понедельник - пятница' : 'понеділок - п`ятниця' }}: 9:00 - 18:00
                    </p>
                    <p>
                        {{ (App::isLocale('ru'))? 'суббота: выходной' : 'субота: вихідний' }}
                    </p>
                    <p>
                        {{ (App::isLocale('ru'))? 'воскресенье: выходной' : 'Неділя: вихідний' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="contacts-page__form">
            <p class="contacts-page__form--title">
                {{ (App::isLocale('ru'))? 'Обратная связь' : 'Зворотній зв`язок' }}
            </p>
            <p class="contacts-page__form-text">
                {{ (App::isLocale('ru'))? 'Письмо будет отправлено в службу поддержки. Мы приложим все усилия для того, чтобы ответить вам максимально быстро.' : 'Лист буде відправлено в службу підтримки. Ми докладемо всіх зусиль для того, щоб відповісти вам максимально швидко.' }}
            </p>
            <form action="{{ route('contacts_report', app()->getLocale()) }}" method="POST">
                @csrf
                <div class="contacts-page__form-item contacts-page__form-item--name">
                    <label class="label" for="contacts_with_us_name">
                        {{ (App::isLocale('ru'))? 'Имя' : 'Iм`я' }}
                    </label>
                    <input type="text" name="contacts_with_us_name" class="input input--full-width" id="contacts_with_us_name">
                </div>
                <div class="contacts-page__form-item contacts-page__form-item--email">
                    <label class="label label--required" for="contacts_with_us_email">
                        {{ (App::isLocale('ru'))? 'E-mail для ответа' : 'E-mail для відповіді' }}
                    </label>
                    <input type="email" name="contacts_with_us_email" class="input input--full-width" id="contacts_with_us_email" required="">
                </div>
                <div class="contacts-page__form-item">
                    <p class="label label--required">
                        {{ (App::isLocale('ru'))? 'Укажите причину обращения' : 'Вкажіть причину звернення' }}
                    </p>
                    <div class="select-standard select-standard--without-search">
                        <button type="button" class="select-standard__toggle" aria-label="Открыть список">
                            <span class="select-standard__title">
                                {{ (App::isLocale('ru'))? 'Сертификат' : 'Cертифікат' }}
                            </span>
                            <span class="select-standard__arrow">
                                <svg width="13" height="7">
                                    <use xlink:href="#icon-arrow"></use>
                                </svg>
                            </span>
                        </button>
                        <input type="hidden" name="type" value="1">
                        <div class="select-standard__body">
                            <ul class="select-standard__list">
                                <li>
                                    <button type="button" class="select-standard__option">
                                        {{ (App::isLocale('ru'))? 'Технический вопрос' : 'Технічне питання' }}
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="select-standard__option">
                                        {{ (App::isLocale('ru'))? 'Улучшение сайта' : 'Поліпшення сайту' }}
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="select-standard__option">
                                        {{ (App::isLocale('ru'))? 'Партнерское предложение' : 'Партнерську пропозицію' }}
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="select-standard__option">
                                        {{ (App::isLocale('ru'))? 'Жалоба' : 'Скарга' }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contacts-page__form-item">
                    <label class="label label--required" for="contacts_with_us_massage">
                        {{ (App::isLocale('ru'))? 'Сообщение' : 'Повідомлення' }}
                    </label>
                    <textarea name="contacts_with_us_massage" class="input input--full-width input--textarea" id="contacts_with_us_massage"></textarea>
                </div>
                <div class="contacts-page__form-item contacts-page__form-item--submit">
                    <button type="submit" class="button">
                        {{ (App::isLocale('ru'))? 'Отправить письмо' : 'Відправити лист' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
