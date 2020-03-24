<?php

$title = (App::isLocale('ru'))? 'Платные услуги Get Skill' : 'Платні послуги Get Skill';
$_title = (App::isLocale('ru'))? 'Услуги' : 'Послуги';
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $_title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<div class="services-page">
    <h1 class="visually-hidden">
        {{ $_title }}
    </h1>
    <section class="services-page__promo">
        <div class="container">
            <h2 class="h2 services-page__promo-title">
                {{ $title }}
            </h2>
            <p class="services-page__promo-text">
                {{ (App::isLocale('ru'))? 'Используйте максимум возможностей для своего образовательного  бизнеса — получайте новых клиентов с маркетплейса Get Skill' : 'Використовуйте максимум можливостей для свого освітнього бізнесу - отримуйте нових клієнтів з маркетплейса Get Skill' }}
            </p>
        </div>
    </section>
    <div class="tariff services-page__tariff">
        <div class="container">
            <div class="tariff__content">
                <div class="tariff__list">
                    <article class="tariff__item tariff__item--base">
                        <svg width="77" height="52">
                            <use xlink:href="#icon-tarif-1"></use>
                        </svg>
                        <h2 class="h2">
                            {{ __('cabinet/organization/payment.Tarif_1') }}
                        </h2>
                        <ul>
                            <li>
                                {{ __('cabinet/organization/payment.Info_1') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_2') }}
                            </li>
                            <li>
                                Создание и редактирование
                            </li>
                        </ul>
                        <p class="tariff__price">
                            0
                            <span class="tariff__currency">
                                грн./{{ (App::isLocale('ru'))? 'мес' : 'мiс' }}
                            </span>
                        </p>
                    </article>
                    <article class="tariff__item tariff__item--standard">
                        <svg width="77" height="52">
                            <use xlink:href="#icon-tarif-2"></use>
                        </svg>
                        <h2 class="h2">
                            {{ __('cabinet/organization/payment.Tarif_2') }}
                        </h2>
                        <ul>
                            <li>
                                {{ __('cabinet/organization/payment.Info_3') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_4') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_5') }}
                                <br>
                                {{ __('cabinet/organization/payment.Info_6') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_7') }}
                            </li>
                        </ul>
                        <p class="tariff__price">
                            300
                            <span class="tariff__currency">
                                грн./{{ (App::isLocale('ru'))? 'мес' : 'мiс' }}
                            </span>
                        </p>
                    </article>
                    <article class="tariff__item tariff__item--premium">
                        <svg width="77" height="52">
                            <use xlink:href="#icon-tarif-3"></use>
                        </svg>
                        <h2 class="h2">
                            {{ __('cabinet/organization/payment.Tarif_3') }}
                        </h2>
                        <ul>
                            <li>
                                {{ __('cabinet/organization/payment.Info_8') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_9') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_10') }}
                            </li>
                            <li>
                                {{ __('cabinet/organization/payment.Info_11') }}
                            </li>
                        </ul>
                        <p class="tariff__price">
                            900
                            <span class="tariff__currency">
                                грн./{{ (App::isLocale('ru'))? 'мес' : 'мiс' }}
                            </span>
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <section class="services-page__opportunities">
        <div class="container">
            <h2 class="visually-hidden">
                {{ (App::isLocale('ru'))? 'Возможности' : 'Можливості' }}
            </h2>
            <ul class="services-page__opportunities-list">
                <li class="services-page__opportunities-item">
                    <article class="services-page__opportunities-article">
                        <div class="services-page__opportunities-info">
                            <h2 class="h2">
                                {{ (App::isLocale('ru'))? 'Добавление фото к курсу и организации' : 'Додавання фото до курсу і організації' }}
                            </h2>
                            <p>
                                {{ (App::isLocale('ru'))? 'Данная функция позволяет добавить фотогалерею на странице курса и организации, что дает возможность показать примеры Ваших работ, место обучения и показать рабочую атмосферу' : 'Ця функція дозволяє додати фотогалерею на сторінці курсу і організації, що дає можливість показати приклади Ваших робіт, місце навчання і показати робочу атмосферу' }}
                            </p>
                            <a href="#">
                                {{ (App::isLocale('ru'))? 'Только в пакете «Расширенный» и «Максимальный»' : 'Тільки в пакеті «Розширений» і «Максимальний»' }}
                            </a>
                        </div>
                        <div class="services-page__opportunities-image">
                            <img src="/img/serv-1.jpg" width="665" height="390" alt="Добавление фото к курсу и организации">
                        </div>
                    </article>
                </li>
                <li class="services-page__opportunities-item">
                    <article class="services-page__opportunities-article">
                        <div class="services-page__opportunities-info">
                            <h2 class="h2">
                                {{ (App::isLocale('ru'))? 'Добавление преподавателей' : 'Додавання викладачів' }}
                            </h2>
                            <p>
                                {{ (App::isLocale('ru'))? 'Данная функция позволяет добавить информацию о преподавателях на странице курса. Вы можете добавить, как одного так и несколько преподавателей с личной фотографией и описанием' : 'Ця функція дозволяє додати інформацію про викладачів на сторінці курсу. Ви можете додати, як одного так і кілька викладачів з особистою фотографією та описом' }}
                            </p>
                            <a href="#">
                                {{ (App::isLocale('ru'))? 'Только в пакете «Расширенный» и «Максимальный»' : 'Тільки в пакеті «Розширений» і «Максимальний»' }}
                            </a>
                        </div>
                        <div class="services-page__opportunities-image">
                            <img src="/img/serv-2.jpg" width="491" height="291" alt="Добавление преподавателей">
                        </div>
                    </article>
                </li>
                <li class="services-page__opportunities-item">
                    <article class="services-page__opportunities-article">
                        <div class="services-page__opportunities-info">
                            <h2 class="h2">
                                {{ (App::isLocale('ru'))? 'Публикация мастер-классов' : 'Публікація майстер-класів' }}
                            </h2>
                            <p>
                                {{ (App::isLocale('ru'))? 'Данная функция позволяет опубликовать Ваши мастер-классы в отведенном для них разделе. Вы сможете без ограничений по количеству публиковать объявления, а также прикреплять дату и тип (офлайн или онлайн), что позволит упростить поиск Ваших мастер-классов' : 'Ця функція дозволяє опублікувати Ваші майстер-класи в відведеному для них розділі. Ви зможете без обмежень по кількості публікувати оголошення, а також прикріплювати дату і тип (офлайн або онлайн), що дозволить спростити пошук Ваших майстер-класів' }}
                            </p>
                            <a href="#">
                                {{ (App::isLocale('ru'))? 'Только в пакете «Расширенный» и «Максимальный»' : 'Тільки в пакеті «Розширений» і «Максимальний»' }}
                            </a>
                        </div>
                        <div class="services-page__opportunities-image">
                            <img src="/img/serv-3.jpg" width="660" height="212" alt="Публикация мастер-классов">
                        </div>
                    </article>
                </li>
                <li class="services-page__opportunities-item">
                    <article class="services-page__opportunities-article">
                        <div class="services-page__opportunities-info">
                            <h2 class="h2">
                                {{ (App::isLocale('ru'))? 'Аналитика по курсам' : 'Аналітика по курсам' }}
                            </h2>
                            <p>
                                {{ (App::isLocale('ru'))? 'Данная функция позволяет просмотреть аналитику по каждому курсу в разрезе разных периодов: день, неделя, месяц. В статистике представлена информация о количестве просмотров курсов, открытых телефонов, добавленных курсов в избранные и отправленных заявок' : 'Ця функція дозволяє переглянути аналітику по кожному курсу в розрізі різних періодів: день, тиждень, місяць. У статистиці представлена ​​інформація про кількість переглядів курсів, відкритих телефонів, доданих курсів в обрані і відправлених заявок' }}
                            </p>
                            <a href="#">
                                {{ (App::isLocale('ru'))? 'Только в пакете «Расширенный» и «Максимальный»' : 'Тільки в пакеті «Розширений» і «Максимальний»' }}
                            </a>
                        </div>
                        <div class="services-page__opportunities-image">
                            <img src="/img/serv-4.jpg" width="668" height="255" alt="Аналитика по курсам">
                        </div>
                    </article>
                </li>
                <li class="services-page__opportunities-item">
                    <article class="services-page__opportunities-article">
                        <div class="services-page__opportunities-info">
                            <h2 class="h2">
                                {{ (App::isLocale('ru'))? 'Первые места в поиске' : 'Перші місця в пошуку' }}
                            </h2>
                            <p>
                                {{ (App::isLocale('ru'))? 'В результатах поиска, Ваши курсы будут выводиться вверху страницы и выделены специальным значком «В ТОПе». На странице категории выводиться одновременно не больше 4 ТОП курсов, которые поочередно выбираются из списка всех ТОП курсов. Ваши курсы будут показываться как в ТОПе так и в обычном списке курсов' : 'У результатах пошуку, Ваші курси будуть виводитися вгорі сторінки і виділені спеціальним значком «У ТОПі». На сторінці категорії виводитися водночас не більше 4 ТОП курсів, які по черзі вибираються зі списку всіх ТОП курсів. Ваші курси будуть показуватися як в ТОПі так і в звичайному списку курсів' }}
                            </p>
                            <a href="#">
                                {{ (App::isLocale('ru'))? 'Только в пакете «Максимальный»' : 'Тільки в пакеті «Максимальний»' }}
                            </a>
                        </div>
                        <div class="services-page__opportunities-image">
                            <img src="/img/serv-5.jpg" width="661" height="291" alt="Первые места в поиске">
                        </div>
                    </article>
                </li>
                <li class="services-page__opportunities-item">
                    <article class="services-page__opportunities-article">
                        <div class="services-page__opportunities-info">
                            <h2 class="h2">
                                {{ (App::isLocale('ru'))? 'Управление сделками в личном кабинете' : 'Управління операціями в особистому кабінеті' }}
                            </h2>
                            <p>
                                {{ (App::isLocale('ru'))? 'В личном кабинете вы сможете просмотреть все заявки, которые были оставлены на Ваши курсы, добавить новою заявку если клиент позвонил Вам напрямую, просмотреть и отредактировать информацию о заявке, изменить статус и добавить комментарий. А также собрать базу своих клиентов в разделе «Клиенты»' : 'В особистому кабінеті ви зможете переглянути всі заявки, які були залишені на Ваші курси, додати новою заявку якщо клієнт зателефонував Вам безпосередньо, переглянути і відредагувати інформацію про заявку, змінити статус і додати коментар. А також зібрати базу своїх клієнтів в розділі «Клієнти»' }}
                            </p>
                            <a href="#">
                                {{ (App::isLocale('ru'))? 'Только в пакете «Максимальный»' : 'Тільки в пакеті «Максимальний»' }}
                            </a>
                        </div>
                        <div class="services-page__opportunities-image">
                            <img src="/img/serv-6.jpg" width="666" height="467" alt="Управление сделками в личном кабинете">
                        </div>
                    </article>
                </li>
            </ul>
        </div>
    </section>
    <section class="proposition">
        <div class="proposition__inner container">
            <div class="proposition__img">
                <picture>
                    <source type="image/webp" media="(min-width: 1210px)" srcset="/img/proposition-desktop-@1x.webp 1x, /img/proposition-desktop-@2x.webp 2x">
                    <source type="image/webp" srcset="/img/proposition-mobile-@1x.webp 1x, /img/proposition-mobile-@2x.webp 2x">
                    <source media="(min-width: 1210px)" srcset="/img/proposition-desktop-@1x.jpg 1x, /img/proposition-desktop-@2x.jpg 2x">
                    <img src="/img/proposition-mobile-@1x.jpg" srcset="img/proposition-mobile-@2x.jpg 2x" width="257" height="171" alt="Вы преподавательили представляетеучебное заведение?">
                </picture>
            </div>
            <div class="proposition__info-block">
                <h2 class="h2 proposition__title">
                    
                    {{ (App::isLocale('ru'))? 'Вы преподаватель или представляете учебное заведение?' : 'Ви викладач або уявляєте навчальний заклад?' }}
                </h2>
                <p class="proposition__text">
                    {{ (App::isLocale('ru'))? 'Зарегистрируйтесь на GetSkill и тысячи пользователей увидяn Ваши курсы' : 'Увійдіть на GetSkill і тисячі користувачів увідяn Ваші курси' }}
                </p>
                <a href="{{ route('register-organization', app()->getLocale()) }}" class="button proposition__show-more">
                    {{ (App::isLocale('ru'))? 'Разместить  организацию' : 'Розмістити організацію' }}
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
