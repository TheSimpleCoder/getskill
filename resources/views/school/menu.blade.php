<section class="about-curse__tabs">
	<ul class="tabs__list">
		<li class="tabs__item {{ Request::is(app()->getLocale() . '/school/*') ? 'tabs__item--active' : '' }}">
    		<a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $org->id]) }}" class="tabs__link">
        		{{ (App::isLocale('ru'))? 'Описание' : 'Опис' }}
    		</a>
		</li>
		<li class="tabs__item {{ Request::is(app()->getLocale() . '/catalog/school/*') ? 'tabs__item--active' : '' }}">
    		<a href="{{ route('school_catalog', ['locale' => app()->getLocale(), 'id' => $org->id]) }}" class="tabs__link">
        		{{ (App::isLocale('ru'))? 'Курсы' : 'Курси' }}
    		</a>
		</li>
		<li class="tabs__item {{ Request::is(app()->getLocale() . '/master/school/*') ? 'tabs__item--active' : '' }}">
    		<a href="{{ route('school_master', ['locale' => app()->getLocale(), 'id' => $org->id]) }}" class="tabs__link">
       			{{ (App::isLocale('ru'))? 'Мастер-классы' : 'Майстер-класи' }}
    		</a>
		</li>
		<li class="tabs__item {{ Request::is(app()->getLocale() . '/reviews/school/*') ? 'tabs__item--active' : '' }}">
    		<a href="{{ route('school_reviews', ['locale' => app()->getLocale(), 'id' => $org->id]) }}" class="tabs__link">
       			{{ (App::isLocale('ru'))? 'Отзывы' : 'Відгуки' }}
    		</a>
		</li>
	</ul>
</section>