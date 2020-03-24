@extends('layouts.app')

@section('content')

    <section class="cabinet">
        <div class="container cabinet__inner">
            <div class="menu-cabinet">
                <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-person/favorite*') ? 'active' : '' }}">
                    <a href="{{ route('cabinet.person.favorite', ['locale' => app()->getLocale()]) }}" class="menu-cabinet__link">
                        <svg width="21" height="21">
                            <use xlink:href="#icon-cabinet-like"></use>
                        </svg>
                        {{ __('cabinet/person/sidebar.Favorites') }}
                        <span class="menu-cabinet__indicator">
                            {{ Favorite::countAuth() }}
                        </span>
                    </a>
                </div>
                <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-person/profile*') ? 'active' : '' }}">
                    <a class="menu-cabinet__link">
                        <svg width="21" height="21">
                            <use xlink:href="#icon-cabinet-setting"></use>
                        </svg>
                        {{ __('cabinet/person/sidebar.Settings') }}
                    </a>
                </div>
                <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-person/reviews*') ? 'active' : '' }}">
                    <a href="{{ route('cabinet.person.reviews', ['locale' => app()->getLocale()]) }}" class="menu-cabinet__link">
                        <svg width="21" height="20">
                            <use xlink:href="#icon-cabinet-star"></use>
                        </svg>
                        {{ __('cabinet/person/sidebar.Reviews') }}
                    </a>
                </div>
                <div class="menu-cabinet__item menu-cabinet__item--separator">
                    <a href="/logout" class="menu-cabinet__link">
                        <svg width="21" height="21">
                            <use xlink:href="#icon-cabinet-exit"></use>
                        </svg>
                        {{ (App::isLocale('ru'))? 'Выйти' : 'Вийти' }}
                    </a>
                </div>
            </div>
            @yield('cabinet')
        </div>
    </section>

@endsection
