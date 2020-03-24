<?php

$title = trans('layout/header.Home');

if(App::isLocale('ru')){
    $description = 'Ведущие образовательные школы Украины размещают свои курсы и находят своих учеников с помощью нашего сайта. Языковые курсы, маникюр, программирование и другие онлайн и офлайн курсы.';
    $keywords = '';
    $title = 'Get Skill — сайт для поиска курсов, мастер-классов в Украине';
}else{
    $description = 'Провідні школи України розміщують свої курси і знаходять своїх учнів за допомогою нашого сайту. Мовні курси, манікюр, програмування та інші онлайн і офлайн курси.';
    $keywords = '';
    $title = 'Get Skill - сайт для пошуку курсів, майстер-класів в Україні';
}

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<main class="site-main">
    <section class="promo">
        <div class="promo__inner container">
            <h1 class="h1 promo__title">
                @if(App::isLocale('ru'))
                    Платформа для
                    поиска курсов и
                    мастер-классов
                @else
                    Платформа для
                    пошуку курсів і
                    майстер-класів
                @endif
            </h1>
            <p class="promo__text">
                @if(App::isLocale('ru'))
                    Более {{ Course::where('status', 1)->count() }} курсов от {{ $countOrg }} школ, которые можно отфильтровать по цене, рейтингу и месторасположению
                @else
                    Більше {{ Course::where('status', 1)->count () }} курсів від {{ $countOrg }} шкіл, які можливо відфільтрувати за ціною, рейтингу та місцерозташуванням
                @endif
            </p>
        </div>
    </section>
    <section class="master-classes">
        <div class="container master-classes__inner">
            <h2 class="h2 master-classes__title">
                @if(App::isLocale('ru'))
                    Ближайшие
                    <br>
                    мастер-классы
                @else
                    Найближчі
                    <br>
                    майстер-класи
                @endif
            </h2>
            <ul class="master-classes__list">
                @foreach($masters as $master)
                    <li class="master-classes__item">
                        <a href="{{ route('master_page_info', [App::getLocale(), $master->id]) }}" class="master-class">
                            <div class="master-class__time">
                                <p class="master-class__day">
                                    {{ date('d', $master->date) }}
                                </p>
                                <p class="master-class__month">
                                    {{ Info::getMonthName(date('m', $master->date)) }}
                                </p>
                            </div>
                            <p class="master-class__name">
                                {{ (App::isLocale('ru'))? $master->name_ru : $master->name_ua }}
                            </p>
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ Info::getMasterPhoto($master->id) }}" class="lazy master-classes__img" width="440" height="252" alt="Мастер-класс как выучить по 100 английских слов вдень с помощью 3 правил">
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('master_catalog', [App::getLocale(), 'all']) }}" class="button master-classes__watch-more">
                {{ (App::isLocale('ru'))? 'Смотреть все мастер-классы' : 'Дивитися всі майстер-класи' }}
            </a>
        </div>
    </section>
    <section class="best-organization">
        <div class="best-organization__inner container">
            <h2 class="h2 best-organization__title">
                @if(App::isLocale('ru'))
                    Курсы от лучших
                    организаций
                @else
                    Курси від кращих
                    організацій
                @endif
            </h2>
            <ul class="best-organization__list">
                @foreach($organizations as $organization)
                    <li class="best-organization__item">
                        <a href="{{ route('school_description', [App::getLocale(), $organization->id]) }}" class="best-curse">
                            <img src="data:image/gif;base64,R0lGODlhAwACAIAAAP///wAAACH5BAEAAAEALAAAAAADAAIAAAICjF8AOw==" data-src="{{ Info::getOrganizationPhoto($organization->id) }}" width="315" height="315" class="best-curse__img lazy" alt="Школа красоты Kodiy School">
                            <div class="best-curse__info-block">
                                <p class="best-curse__name">
                                    {{ (App::isLocale('ru'))? $organization->name_ru : $organization->name_ua }}
                                </p>
                                <div class="best-curse__details">
                                    <div class="best-curse__rating-info">
                                        <p class="best-curse__rating-value">
                                            {{ Rate::getRateSchool($organization->id) }}
                                        </p>
                                        <ul class="best-curse__list-star">
                                            <?php
                                                for ($i=0; $i < 5; $i++) { 
                                                    if($i <= Rate::getRateSchool($organization->id)){
                                                        ?>
                                                            <li class="best-curse__item best-curse__item--active">
                                                                <svg width="17" height="15">
                                                                    <use xlink:href="#icon-best-curse-star"></use>
                                                                </svg>
                                                            </li>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <li class="best-curse__item">
                                                                <svg width="17" height="15">
                                                                    <use xlink:href="#icon-best-curse-star"></use>
                                                                </svg>
                                                            </li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                        <p class="best-curse__rating-count">
                                            {{ Rate::getCountRateSchool($organization->id) }}
                                        </p>
                                    </div>
                                    <p class="best-curse__count">
                                        {{ Course::getCourseCountOrganization($organization->id) }} курсов
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('school_list', [App::getLocale(), 'all']) }}" class="button best-organization__watch-more">
                {{ (App::isLocale('ru'))? 'Смотреть все школы' : 'Дивитися всі школи' }}
            </a>
        </div>
    </section>
    <section class="featured-articles">
        <div class="featured-articles__inner container">
            <h2 class="h2 featured-articles__title">
                {{ (App::isLocale('ru'))? 'Рекомендованные статьи' : 'Рекомендовані статті' }}
            </h2>
            <ul class="featured-articles__list">
                @foreach($articles as $article)
                    <li class="featured-articles__item">
                        <article class="article">
                            <a href="{{ route('article_post', ['locale' => app()->getLocale(), 'cat' => \App\Article\Category::find($article->cat_id), 'post' => $article]) }}" class="article__img">
                                <img src="data:image/gif;base64,R0lGODlhKwAYAIAAAP///wAAACH5BAEAAAEALAAAAAArABgAAAIejI+py+0Po5y02ouz3rz7D4biSJbmiabqyrbuC7sFADs=" data-src="{{ $article->img }}" class="lazy" width="430" height="242" alt="{{ (App::isLocale('ru'))? $article->name_ru : $article->name_ua }}">
                            </a>
                            <div class="article__info-block">
                                <h3 class="article__name">
                                    <a href="{{ route('article_post', ['locale' => app()->getLocale(), 'cat' => \App\Article\Category::find($article->cat_id), 'post' => $article]) }}">
                                        {{ (App::isLocale('ru'))? $article->name_ru : $article->name_ua }}
                                    </a>
                                </h3>
                                <p class="article__text">
                                    {!! (App::isLocale('ru'))? $article->content_ru : $article->content_ua !!}
                                </p>
                                <p class="article__time">
                                    {{ date('d.m.Y', $article->time) }}
                                </p>
                            </div>
                        </article>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('article', App::getLocale()) }}" class="button featured-articles__show-more">
                {{ (App::isLocale('ru'))? 'Смотреть все статьи' : 'Дивитися всі статті' }}
            </a>
        </div>
    </section>
    <section class="proposition">
        <div class="proposition__inner container">
            <div class="proposition__img">
                <picture>
                    <source type="image/webp" media="(min-width: 1210px)" srcset="/img/proposition-desktop-@1x.webp 1x, /img/proposition-desktop-@2x.webp 2x">
                    <source type="image/webp" srcset="/img/proposition-mobile-@1x.webp 1x, /img/proposition-mobile-@2x.webp 2x">
                    <source media="(min-width: 1210px)" srcset="/img/proposition-desktop-@1x.jpg 1x, /img/proposition-desktop-@2x.jpg 2x">
                    <img src="/img/proposition-mobile-@1x.jpg" srcset="/img/proposition-mobile-@2x.jpg 2x" width="257" height="171" alt="Вы преподавательили представляетеучебное заведение?">
                </picture>
            </div>
            <div class="proposition__info-block">
                <h2 class="h2 proposition__title">
                    @if(App::isLocale('ru'))
                        Вы преподаватель
                        или представляете
                        учебное заведение?
                    @else
                        Ви викладач
                        або представляєте
                        навчальний заклад?
                    @endif
                </h2>
                <p class="proposition__text">
                    @if(App::isLocale('ru'))
                        Зарегистрируйтесь на GetSkill и
                        тысячи пользователей увидят
                        Ваши курсы
                    @else
                        Увійдіть на GetSkill і
                        тисячі користувачів побачать
                        Ваші курси
                    @endif
                </p>
                <a href="{{ route('register-organization', app()->getLocale()) }}" class="button proposition__show-more">
                    {{ (App::isLocale('ru'))? 'Разместить  организацию' : 'Розмістити організацію' }}
                </a>
            </div>
        </div>
    </section>
    <div class="seo-text seo-text--main-page">
      <div class="seo-text__inner container">
        <div class="seo-text__wrapper">
          <p class="seo-text__info">
            Вы обучаете людей востребованным профессиям? А может быть, вы сами хотите освоить новый навык, устроиться на престижную и интересную работу? Зарегистрируйтесь на платформе Get Skill и выбирайте для себя подходящие курсы и мастер-классы по желаемой специальности! Наш сайт упрощает и ускоряет выбор нужного курса, предлагая возможность публиковать свои предложения лучшим студиям и школам.
На платформе вы найдете оптимальный формат обучения, отобрав курсы по стоимости, длительности и формату (онлайн, дистанционно, очно). Для вас мы создали фильтры для сортировки школ и курсов по направлению и рейтингу. Для удобства все публикации поделены по городам, чтобы сэкономить ваше время и подобрать подходящие варианты!
Благодаря курсам и мастер-классам можно легко освоить любую из востребованных и высокооплачиваемых специальностей, включая услуги в сфере красоты (косметолог, специалист ногтевого сервиса и лазерной косметологии, парикмахер-стилист), IT (программирование, разработка софта, веб-дизайн). Выучить английский и другие иностранные языки, усовершенствовать свои разговорные навыки и получить международный сертификат можно в любой из языковых школ в Виннице, Киеве, Харькове, Днепре и других городах Украины. Регистрируйтесь сегодня и меняйте свою жизнь к лучшему!
Если вы открыли собственную школу, запускаете онлайн-курсы либо проводите мастер-классы как профессионал в своей сфере, то также можете предложить свои образовательные услуги будущим клиентам через Get Skill!
          </p>
        </div>
        <a href="#" class="seo-text__show-more">
          Читать дальше
          <svg width="6" height="15">
            <use xlink:href="#icon-light-gray-down"></use>
          </svg>
        </a>
      </div>
    </div>
</main>

@endsection
