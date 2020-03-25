<div class="menu-cabinet">
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/analitic*') ? 'active' : '' }}">
        @if(Pack::getPack()['pack'] == 1)
            <a href="javascript:void(0);" class="menu-cabinet__link">
                <span>
                    <svg width="23" height="21">
                        <use xlink:href="#icon-cab-org-analysts"></use>
                    </svg>
                </span>
                {{ (App::isLocale('ru'))? 'Аналитика' : 'Аналітика' }}
                <span>
                    <svg width="37" height="12">
                        <use xlink:href="#icon-tarif-2"></use>
                    </svg>
                </span>
            </a>
        @else
            <a href="{{ route('cabinet.organization.analitic', App::getLocale()) }}" class="menu-cabinet__link">
                <svg width="23" height="21">
                    <use xlink:href="#icon-cab-org-analysts"></use>
                </svg>
                {{ (App::isLocale('ru'))? 'Аналитика' : 'Аналітика' }}
            </a>
        @endif
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/deals*') ? 'active' : '' }}">
        @if(Pack::getPack()['pack'] == 3)
            <a href="{{ route('cabinet.organization.deals', App::getLocale()) }}" class="menu-cabinet__link">
                <svg width="21" height="21">
                    <use xlink:href="#icon-cab-org-dartz"></use>
                </svg>

                {{ (App::isLocale('ru'))? 'Сделки' : 'Угоди' }}
                @if(Deals::getNewDealsCount() > 0)
                    <span class="menu-cabinet__indicator">
                        {{ Deals::getNewDealsCount() }}
                    </span>
                @endif
            </a>
        @else
            <a href="javascript:void(0);" class="menu-cabinet__link">
                <span>
                    <svg width="21" height="21">
                        <use xlink:href="#icon-cab-org-dartz"></use>
                    </svg>
                </span>

                {{ (App::isLocale('ru'))? 'Сделки' : 'Угоди' }}
                <span>
                    <svg width="37" height="12">
                        <use xlink:href="#icon-tarif-3"></use>
                    </svg>
                </span>
            </a>
        @endif
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/clients*') ? 'active' : '' }}">
        @if(Pack::getPack()['pack'] == 1)
            <a href="javascript:void(0);" class="menu-cabinet__link">
                <span>
                    <svg width="21" height="21">
                        <use xlink:href="#icon-cabinet-clients"></use>
                    </svg>
                </span>
                {{ (App::isLocale('ru'))? 'Клиенты' : 'Клієнти' }}
                <span>
                    <svg width="37" height="12">
                        <use xlink:href="#icon-tarif-2"></use>
                    </svg>
                </span>
            </a>
        @else
            <a href="{{ route('cabinet.organization.clients.index', App::getLocale()) }}" class="menu-cabinet__link">
                <svg width="21" height="21">
                    <use xlink:href="#icon-cabinet-clients"></use>
                </svg>
                {{ (App::isLocale('ru'))? 'Клиенты' : 'Клієнти' }}

            </a>
        @endif
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/reviews*') ? 'active' : '' }}">
        <a href="{{ route('cabinet.organization.reviews', app()->getLocale()) }}" class="menu-cabinet__link">
            <svg width="21" height="20">
                <use xlink:href="#icon-cabinet-star"></use>
            </svg>

            {{ (App::isLocale('ru'))? 'Отзывы' : 'Відгуки' }}
            <!-- <span class="menu-cabinet__indicator">
                2
            </span> -->
        </a>
    </div>
    <div class="menu-cabinet__item menu-cabinet__item--separator {{ Request::is(app()->getLocale() . '/cabinet-organization/course*') ? 'active' : '' }}">
        <a href="{{ route('cabinet.organization.course', app()->getLocale()) }}" class="menu-cabinet__link">
            <svg width="21" height="21">
                <use xlink:href="#icon-cabinet-book"></use>
            </svg>
            {{ (App::isLocale('ru'))? 'Список курсов' : 'Список курсів' }}

        </a>
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/master*') ? 'active' : '' }}">
        @if(Pack::getPack()['pack'] == 1)
            <a href="javascript:void(0);" class="menu-cabinet__link">
                <span>
                    <svg width="20" height="21">
                        <use xlink:href="#icon-cabinet-master"></use>
                    </svg>
                </span>

                {{ (App::isLocale('ru'))? 'Мастер-классы' : 'Майстер-класи' }}

                <span>
                    <svg width="37" height="12">
                        <use xlink:href="#icon-tarif-2"></use>
                    </svg>
                </span>
            </a>
        @else
            <a href="{{ route('cabinet.organization.master', app()->getLocale()) }}" class="menu-cabinet__link">
                <svg width="20" height="21">
                    <use xlink:href="#icon-cabinet-master"></use>
                </svg>

                {{ (App::isLocale('ru'))? 'Мастер-классы' : 'Майстер-класи' }}
            </a>
        @endif
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/teachers*') ? 'active' : '' }}">
        @if(Pack::getPack()['pack'] == 1)
            <a href="javascript:void(0);" class="menu-cabinet__link">
                <span>
                    <svg width="21" height="18">
                        <use xlink:href="#icon-cabinet-teacher"></use>
                    </svg>
                </span>

                {{ (App::isLocale('ru'))? 'Преподаватели' : 'Викладачі' }}

                <span>
                    <svg width="37" height="12">
                        <use xlink:href="#icon-tarif-2"></use>
                    </svg>
                </span>
            </a>
        @else
            <a href="{{ route('cabinet.organization.teachers', app()->getLocale()) }}" class="menu-cabinet__link">
                <svg width="21" height="18">
                    <use xlink:href="#icon-cabinet-teacher"></use>
                </svg>

                {{ (App::isLocale('ru'))? 'Преподаватели' : 'Викладачі' }}
            </a>
        @endif
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/info*') ? 'active' : '' }}">
        <a href="{{ route('cabinet.organization.home', app()->getLocale()) }}" class="menu-cabinet__link">
            <svg width="21" height="21">
                <use xlink:href="#icon-cabinet-organization"></use>
            </svg>
            {{ (App::isLocale('ru'))? 'Организация' : 'Організація' }}

        </a>
    </div>
    <div class="menu-cabinet__item menu-cabinet__item--separator menu-cabinet__item--active {{ Request::is(app()->getLocale() . '/cabinet-organization/profile/setting*') ? 'active' : '' }}">
        <a href="{{ route('cabinet.organization.profile.setting', app()->getLocale()) }}" class="menu-cabinet__link">
            <svg width="21" height="21">
                <use xlink:href="#icon-cabinet-setting"></use>
            </svg>
            {{ (App::isLocale('ru'))? 'Настройки' : 'Налаштування' }}

        </a>
    </div>
    <div class="menu-cabinet__item menu-cabinet__item--active {{ Request::is(app()->getLocale() . '/cabinet-organization/favorite*') ? 'active' : '' }}">
        <a href="{{ route('cabinet.organization.favorite', app()->getLocale()) }}" class="menu-cabinet__link">
            <svg width="21" height="21">
                <use xlink:href="#icon-cabinet-like"></use>
            </svg>
            {{ (App::isLocale('ru'))? 'Избранное' : 'Обране' }}
            <span class="menu-cabinet__indicator">
                {{ Favorite::countAuth() }}
            </span>
        </a>
    </div>
    <div class="menu-cabinet__item {{ Request::is(app()->getLocale() . '/cabinet-organization/payment/*') ? 'active' : '' }}">
        <a href="{{ route('cabinet.organization.pay', app()->getLocale()) }}" class="menu-cabinet__link">
            <svg width="21" height="21">
                <use xlink:href="#icon-cabinet-card"></use>
            </svg>
            {{ (App::isLocale('ru'))? 'Счета и оплата' : 'Рахунки і оплата' }}

        </a>
    </div>
    <div class="menu-cabinet__item">
        <a href="/logout" class="menu-cabinet__link">
            <svg width="21" height="21">
                <use xlink:href="#icon-cabinet-exit"></use>
            </svg>
            {{ __('layout/header.Log Out') }}
        </a>
    </div>
</div>
