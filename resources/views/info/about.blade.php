<?php

$title = (App::isLocale('ru'))? 'О проекте' : 'О проектi';
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<section class="about-project">
    <div class="about-project__promo">
        <div class="about-project__promo-inner container">
            <h2 class="h2 about-project__promo-title">
                Get Skill — сайт
                <br>
                {{ (App::isLocale('ru'))? 'для поисков курсов' : 'для пошуків курсів' }}
            </h2>
            <p class="about-project__text">
                {{ (App::isLocale('ru'))? 'Делаем поиск знаний удобнее и быстрее' : 'Робимо пошук знань зручніше і швидше' }}
            </p>
        </div>
    </div>
    <article class="about-project__opportunities">
        <div class="container about-project__opportunities-inner">
            <div class="about-project__opportunities-info">
                <h2 class="h2 about-project__opportunities-title">
                    {{ (App::isLocale('ru'))? 'Откройте для себя обширную базу курсов' : 'Відкрийте для себе велику базу курсів' }}
                </h2>
                <p class="about-project__opportunities-text">
                    GetSkill.com.ua — 
                    {{ (App::isLocale('ru'))? 'сайт для поиска курсов, мастер-классов в Украине. Ведущие образовательные школы Украины размещают свои курсы и находят своих учеников с помощью нашего сайта.' : 'сайт для пошуку курсів, майстер-класів в Україні. Провідні освітні школи України розміщують свої курси і знаходять своїх учнів за допомогою нашого сайту.' }}
                </p>
            </div>
            <div class="about-project__opportunities-img">
                <img src="/img/about-project-cub.jpg" width="655" height="519" alt="Откройте для себя обширную базукурсов">
            </div>
        </div>
    </article>
    <div class="about-project__info">
        <div class="about-project__info-inner container">
            <div class="about-project__info-header">
                <h2 class="h2 about-project__info-title">
                    {{ (App::isLocale('ru'))? 'Мы разложили все по полочкам' : 'Ми розклали все по поличках' }}
                </h2>
                <p class="about-project__info-text">
                    
                    {{ (App::isLocale('ru'))? 'Мы делаем все, чтобы каждому посетителю GetSkill.com.ua запомнился как самый удобный, быстрый и эффективный сайт по поиску офлайн и онлайн курсов' : 'Ми робимо все, щоб кожному відвідувачу GetSkill.com.ua запам`ятався як найзручніший, швидкий і ефективний сайт з пошуку офлайн і онлайн курсів' }}
                </p>
            </div>
            <div class="about-project__info-list">
                <div class="about-project__info-item about-project__info-item--online-curse">
                    <a href="{{ route('course_catalog_online', [app()->getLocale(), 'all']) }}" class="about-project__info-card">
                        <p class="about-project__info-card-statistics">
                            <span class="about-project__info-card-value">
                                {{ Course::getCountCourseCatFirst(1, null) }}
                            </span>
                            Онлайн {{ (App::isLocale('ru'))? 'курсов' : 'курсів' }}
                        </p>
                        <img src="/img/projects-info-card-1.jpg" width="545" height="242" class="about-project__info-card-img" alt="1203 Онлайн курсов">
                    </a>
                </div>
                <div class="about-project__info-item about-project__info-item--offline-curse">
                    <a href="{{ route('course_catalog_offline', [app()->getLocale(), 'all']) }}" class="about-project__info-card">
                        <p class="about-project__info-card-statistics">
                            <span class="about-project__info-card-value">
                                {{ Course::getCountCourseCatFirst(2, null) }}
                            </span>
                            Офлайн {{ (App::isLocale('ru'))? 'курсов' : 'курсів' }}
                        </p>
                        <img src="/img/projects-info-card-2.jpg" width="545" height="242" class="about-project__info-card-img" alt="6135 Офлайн курсов">
                    </a>
                </div>
                <div class="about-project__info-item about-project__info-item--master-class">
                    <a href="{{ route('master_catalog', [app()->getLocale(), 'all']) }}" class="about-project__info-card">
                        <p class="about-project__info-card-statistics">
                            <span class="about-project__info-card-value">
                                {{ Master::getCountMasterCatFirst(3, null) }}
                            </span>
                            {{ (App::isLocale('ru'))? 'Мастер-классов' : 'Майстер-класів' }}
                        </p>
                        <img src="/img/projects-info-card-3.jpg" width="312" height="513" class="about-project__info-card-img" alt="731 Мастер-классов">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <article class="about-project__emotions">
        <div class="container about-project__emotions-inner">
            <div class="about-project__emotions-info">
                <h2 class="h2 about-project__emotion-title">
                    
                    {{ (App::isLocale('ru'))? 'Делитесь своими эмоциями' : 'Діліться своїми емоціями' }}
                </h2>
                <p class="about-project__emotion-text">
                    {{ (App::isLocale('ru'))? 'Расскажете о своих впечатлениях, выразите собственное мнение. Его прочтут тысячи других пользователей на сайте.' : 'Розповісте про свої враження, висловіть власну думку. Його прочитають тисячі інших користувачів на сайті.' }}
                </p>
                <p class="about-project__emotion-stats">
                    {{ (App::isLocale('ru'))? 'Сейчас на сайте:' : 'Зараз на сайті:' }}
                    <span>
                        {{ Rate::getCountRateDB() }}
                    </span>
                    {{ (App::isLocale('ru'))? 'отзывов' : 'відгуків' }}
                </p>
            </div>
            <div class="about-project__emotion-img">
                <img src="/img/about-project-emotions.jpg" width="664" height="549" alt="Делитесь своими эмоциями">
            </div>
        </div>
    </article>
    <div class="about-project__lessons">
        <div class="container about-project__lessons-inner">
            <h2 class="h2 about-project__lessons-title">
                {{ (App::isLocale('ru'))? 'Знания по всей Украине' : 'Знання по всій Україні' }}
            </h2>
            <ul class="about-project__lessons-list">
                @foreach($regions as $region)
                    <li class="about-project__lessons-item">
                        <a href="{{ route('courses_region_all_slug', [app()->getLocale(), $region->slug]) }}" class="about-project__lessons-link">
                            {{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}
                        </a>
                        <span class="about-project__lessons-count">
                            {{ Course::getCountRegion($region->id) }}
                        </span>
                    </li>
                @endforeach
            </ul>
            <button type="button" class="button button--load-more about-project__lessons-load">
                Показать все города
            </button>
        </div>
    </div>
    <section class="proposition about-project__proposition">
        <div class="proposition__inner container">
            <div class="proposition__img">
                <picture>
                    <source type="image/webp" media="(min-width: 1210px)" srcset="/img/proposition-desktop-@1x.webp 1x, /img/proposition-desktop-@2x.webp 2x">
                    <source type="image/webp" srcset="/img/proposition-mobile-@1x.webp 1x, /img/proposition-mobile-@2x.webp 2x">
                    <source media="(min-width: 1210px)" srcset="img/proposition-desktop-@1x.jpg 1x, img/proposition-desktop-@2x.jpg 2x">
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
</section>

@endsection
