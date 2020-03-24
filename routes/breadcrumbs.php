<?php

use App\Model\Category\Entity\Attribute;
use App\Model\Region\Entity\Region;
use App\Model\User\Entity\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use App\Model\Category\Entity\Category;
use App\Model\Publisher\Category\Entity\Category as PublisherCategory;
use App\Course;
use App\Article\Category as ArticleCategory;
use App\Article\Article;
use App\FaqCategory;
use App\FaqArticle;
use App\Master;

// Home

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    if (Route::currentRouteName() != 'home'){
        $crumbs->push(trans('layout/header.Home'), route('home', app()->getLocale()));
    }
});

Breadcrumbs::register('index_favorite', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Избранное' : 'Обранi', route('index_favorite', app()->getLocale()));
});


//Blog
Breadcrumbs::register('article', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Articles'), route('article', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('article_category', function (Crumbs $crumbs, $lang, ArticleCategory $cat) {
    $crumbs->parent('article');
    $crumbs->push((App::isLocale('ru'))? $cat->name_ru : $cat->name_ua, route('article_category', [app()->getLocale(), $cat]));
});

Breadcrumbs::register('article_post', function (Crumbs $crumbs, $lang, ArticleCategory $cat, Article $post) {
    $crumbs->parent('article_category', $lang, $cat);
    $crumbs->push((App::isLocale('ru'))? $post->name_ru : $cat->post, route('article_post', [app()->getLocale(), $cat, $post]));
});



//Search
Breadcrumbs::register('search_page', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Поиск' : 'Пошук', route('search_page', ['locale' => app()->getLocale()]));
});


//Courses add page and region
Breadcrumbs::register('courses_region_all', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Курсы Украины' : 'Курси України', route('courses_region_all', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('courses_region_all_slug', function (Crumbs $crumbs, $lang, $slug) {
    $crumbs->parent('courses_region_all');
    $region = Region::where('slug', $slug)->first();
    $crumbs->push((App::isLocale('ru'))? 'Курсы' . $region->name_ru : 'Курси ' . $region->name_uk, route('courses_region_all_slug', [app()->getLocale(), $slug]));
});

Breadcrumbs::register('courses_region_all_slug_stage_one', function (Crumbs $crumbs, $lang, $slug, $cat_stage_1) {
    if($slug == 'ukraina'){
        $crumbs->parent('courses_region_all');
    }else{
       $crumbs->parent('courses_region_all_slug', $lang, $slug); 
    }
    $region = Region::where('slug', $slug)->first();
    $category = Category::where('slug', $cat_stage_1)->first();
    $crumbs->push((App::isLocale('ru'))? $category->name_ru . '123' : $category->name_uk, route('courses_region_all_slug_stage_one', [app()->getLocale(), $slug, $cat_stage_1]));
});

Breadcrumbs::register('courses_region_all_slug_stage_two', function (Crumbs $crumbs, $lang, $slug, $cat_stage_1, $cat_stage_2) {
    $crumbs->parent('courses_region_all_slug_stage_one', $lang, $slug, $cat_stage_1);

    $region = Region::where('slug', $slug)->first();
    $category = Category::where('slug', $cat_stage_2)->first();
    $crumbs->push((App::isLocale('ru'))? $category->name_ru : $category->name_uk, route('courses_region_all_slug_stage_two', [app()->getLocale(), $slug, $cat_stage_1, $cat_stage_2]));
});

Breadcrumbs::register('courses_region_all_slug_stage_tree', function (Crumbs $crumbs, $lang, $slug, $cat_stage_1, $cat_stage_2, $cat_stage_3) {
    $crumbs->parent('courses_region_all_slug_stage_two', $lang, $slug, $cat_stage_1, $cat_stage_2);

    $region = Region::where('slug', $slug)->first();
    $category = Category::where('slug', $cat_stage_3)->first();
    $crumbs->push((App::isLocale('ru'))? $category->name_ru : $category->name_uk, route('courses_region_all_slug_stage_tree', [app()->getLocale(), $slug, $cat_stage_1, $cat_stage_2, $cat_stage_3]));
});

//Категории + курсы
Breadcrumbs::register('masters_region_all', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Местре-классы Украины' : 'Майстер-класи України', route('masters_region_all', [app()->getLocale()]));
});

Breadcrumbs::register('masters_region_all_slug', function (Crumbs $crumbs, $lang, $slug) {
    $crumbs->parent('masters_region_all');
    $region = Region::where('slug', $slug)->first();
    $crumbs->push((App::isLocale('ru'))? 'Мастер-классы ' . $region->name_ru : 'Майстер-класи ' . $region->name_uk, route('masters_region_all_slug', [app()->getLocale(), $slug]));
});

Breadcrumbs::register('masters_region_all_slug_stage_one', function (Crumbs $crumbs, $lang, $slug, $cat_stage_1) {
    if($slug == 'ukraina'){
        $crumbs->parent('masters_region_all');
    }else{
       $crumbs->parent('masters_region_all_slug', $lang, $slug); 
    }
    $region = Region::where('slug', $slug)->first();
    $category = Category::where('slug', $cat_stage_1)->first();
    $crumbs->push((App::isLocale('ru'))? $category->name_ru : $category->name_uk, route('masters_region_all_slug_stage_one', [app()->getLocale(), $slug, $cat_stage_1]));
});

Breadcrumbs::register('masters_region_all_slug_stage_two', function (Crumbs $crumbs, $lang, $slug, $cat_stage_1, $cat_stage_2) {
    $crumbs->parent('masters_region_all_slug_stage_one', $lang, $slug, $cat_stage_1);

    $region = Region::where('slug', $slug)->first();
    $category = Category::where('slug', $cat_stage_2)->first();
    $crumbs->push((App::isLocale('ru'))? $category->name_ru : $category->name_uk, route('masters_region_all_slug_stage_two', [app()->getLocale(), $slug, $cat_stage_1, $cat_stage_2]));
});

Breadcrumbs::register('masters_region_all_slug_stage_tree', function (Crumbs $crumbs, $lang, $slug, $cat_stage_1, $cat_stage_2, $cat_stage_3) {
    $crumbs->parent('masters_region_all_slug_stage_two', $lang, $slug, $cat_stage_1, $cat_stage_2);

    $region = Region::where('slug', $slug)->first();
    $category = Category::where('slug', $cat_stage_3)->first();
    $crumbs->push((App::isLocale('ru'))? $category->name_ru : $category->name_uk, route('masters_region_all_slug_stage_tree', [app()->getLocale(), $slug, $cat_stage_1, $cat_stage_2, $cat_stage_3]));
});


// Auth

Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('auth/login.Title'), route('login', app()->getLocale()));
});


Breadcrumbs::register('register-person', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('auth/register-person.Title'), route('register-person', app()->getLocale()));
});

Breadcrumbs::register('register-organization', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('auth/register-organization.Title'), route('register-organization', app()->getLocale()));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push(trans('auth/password/request.Title'), route('password.request', app()->getLocale()));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push(trans('auth/password/reset.Title'), route('password.reset', app()->getLocale()));
});



// Cabinet Person

Breadcrumbs::register('cabinet.person.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('cabinet/person/home.Title'), route('cabinet.person.home', app()->getLocale()));
});

Breadcrumbs::register('cabinet.person.profile.home', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.person.home');
    $crumbs->push(trans('cabinet/person/profile/home.Title'), route('cabinet.person.profile.home', app()->getLocale()));
});

Breadcrumbs::register('cabinet.person.profile.change-password', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.person.profile.home');
    $crumbs->push(trans('cabinet/person/profile/change-password.Title'), route('cabinet.person.profile.change-password', app()->getLocale()));
});

Breadcrumbs::register('cabinet.person.profile.change-email', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.person.profile.home');
    $crumbs->push(trans('cabinet/person/profile/change-email.Title'), route('cabinet.person.profile.change-email', app()->getLocale()));
});

Breadcrumbs::register('cabinet.person.favorite', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.person.profile.home');
    $crumbs->push((App::isLocale('ru'))? 'Избранные' : 'Обранi', route('cabinet.person.favorite', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('cabinet.person.reviews', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.person.profile.home');
    $crumbs->push((App::isLocale('ru'))? 'Отзывы' : 'Вiдгуки', route('cabinet.person.reviews', app()->getLocale()));
});




// Cabinet Organization

Breadcrumbs::register('cabinet.organization.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('cabinet/organization/home.Title'), route('cabinet.organization.home', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.teachers', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('cabinet/organization/teachers.Title'), route('cabinet.organization.teachers', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.teachers_add', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.teachers');
    $crumbs->push(trans('cabinet/organization/teachers.Add_teacher'), route('cabinet.organization.teachers_add', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.teachers_edit', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('cabinet/organization/teachers.Edit_teacher'), route('cabinet.organization.teachers_edit', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('cabinet.organization.course', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('cabinet/organization/course.Title'), route('cabinet.organization.course', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.course_add', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.course');
    $crumbs->push(trans('cabinet/organization/course.Title_2'), route('cabinet.organization.course_add', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.course_edit', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.course');
    $crumbs->push(trans('cabinet/organization/course.Title_edit'), route('cabinet.organization.course_add', app()->getLocale(), 1));
});

Breadcrumbs::register('cabinet.organization.pay', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('cabinet/organization/payment.Title'), route('cabinet.organization.pay', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.master', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Мастер-класса' : 'Майстер-класу', route('cabinet.organization.master', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.master_add', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.master');
    $crumbs->push((App::isLocale('ru'))? 'Добавления мастер-класса' : 'Додавання Майстер-класу', route('cabinet.organization.master_add', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.master_edit', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.master');
    $crumbs->push((App::isLocale('ru'))? 'Редактирование' : 'Редагування', route('cabinet.organization.master_add', app()->getLocale(), 1));
});

Breadcrumbs::register('cabinet.organization.profile.setting', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push(trans('cabinet/person/profile/home.Title'), route('cabinet.organization.profile.setting', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.profile.change-password', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.profile.setting');
    $crumbs->push(trans('cabinet/person/profile/change-password.Title'), route('cabinet.organization.profile.change-password', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.profile.change-email', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.profile.setting');
    $crumbs->push(trans('cabinet/person/profile/change-email.Title'), route('cabinet.organization.profile.change-email', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.favorite', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push((App::isLocale('ru'))? 'Избранные' : 'Обранi', route('cabinet.organization.favorite', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('cabinet.organization.reviews', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push((App::isLocale('ru'))? 'Отзывы' : 'Вiдгуки', route('cabinet.organization.reviews', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.deals', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push((App::isLocale('ru'))? 'Сделки' : 'Угоди', route('cabinet.organization.deals', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.showDeals', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.deals');
    $crumbs->push((App::isLocale('ru'))? 'Редактирование сделки' : 'Редагування угоди', route('cabinet.organization.showDeals', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('cabinet.organization.dealsAdd', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push((App::isLocale('ru'))? 'Новая сделка' : 'Нова угода', route('cabinet.organization.dealsAdd', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.dealsArhiv', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.deals');
    $crumbs->push((App::isLocale('ru'))? 'Архив' : 'Архiв', route('cabinet.organization.dealsArhiv', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.dealsArhivShow', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.dealsArhiv');
    $crumbs->push((App::isLocale('ru'))? 'Просмотр сделки' : 'Перегляд угоди', route('cabinet.organization.dealsArhivShow', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('cabinet.organization.clients.index', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push((App::isLocale('ru'))? 'Клиэнты' : 'Клієнти', route('cabinet.organization.clients.index', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.clients.add', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.clients.index');
    $crumbs->push((App::isLocale('ru'))? 'Добавить клиэнта' : 'Додати Клієнта', route('cabinet.organization.clients.add', app()->getLocale()));
});

Breadcrumbs::register('cabinet.organization.clients.edit', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.clients.index');
    $crumbs->push((App::isLocale('ru'))? 'Редактирование' : 'Редагування', route('cabinet.organization.clients.edit', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('cabinet.organization.analitic', function (Crumbs $crumbs) {
    $crumbs->parent('cabinet.organization.home');
    $crumbs->push((App::isLocale('ru'))? 'Аналитика' : 'Аналiтика', route('cabinet.organization.analitic', app()->getLocale()));
});







#======================================================================
// Admin

Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push('Главная', route('admin.home'));
});

// Article
Breadcrumbs::register('admin.article.index_category', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Категории', route('admin.article.index_category'));
});

Breadcrumbs::register('admin.article.add_category', function (Crumbs $crumbs) {
    $crumbs->parent('admin.article.index_category');
    $crumbs->push('Добавление категории', route('admin.article.add_category'));
});

Breadcrumbs::register('admin.article.edit_category', function (Crumbs $crumbs, ArticleCategory $category) {
    $crumbs->parent('admin.article.index_category');
    $crumbs->push($category->name_ru, route('admin.article.edit_category', $category));
});

Breadcrumbs::register('admin.article.index_article', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Статьи', route('admin.article.index_article'));
});

Breadcrumbs::register('admin.article.add_article', function (Crumbs $crumbs) {
    $crumbs->parent('admin.article.index_article');
    $crumbs->push('Добавление статьи', route('admin.article.add_article'));
});

Breadcrumbs::register('admin.article.edit_article', function (Crumbs $crumbs, Article $article) {
    $crumbs->parent('admin.article.index_article');
    $crumbs->push($article->name_ru, route('admin.article.edit_article', $article));
});


// Regions

Breadcrumbs::register('admin.regions.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Города', route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push('Создать', route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.show', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push($region->name_ru, route('admin.regions.show', $region));
});

Breadcrumbs::register('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push('Изменить', route('admin.regions.edit', $region));
});


// Users

Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Пользователи', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Создать', route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push('Изменить', route('admin.users.edit', $user));
});



// Categories

Breadcrumbs::register('admin.categories.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Категории', route('admin.categories.index'));
});

Breadcrumbs::register('admin.categories.list', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.index');
    $crumbs->push($category->name_ru, route('admin.categories.list', $category));
});


Breadcrumbs::register('admin.categories.create', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.list', $category);
    $crumbs->push('Создать', route('admin.categories.create', $category));
});


Breadcrumbs::register('admin.categories.show', function (Crumbs $crumbs, Category $category) {
    if ($category->getRoot()){
        $crumbs->parent('admin.categories.list', $category->getRoot());
    } else {
        $crumbs->parent('admin.categories.index');
    }
    $crumbs->push($category->name_ru, route('admin.categories.show', $category));
});

Breadcrumbs::register('admin.categories.edit', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.show', $category);
    $crumbs->push('Изменить', route('admin.categories.edit', $category));
});


// Advert Category Attributes

Breadcrumbs::register('admin.categories.attributes.create', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.show', $category);
    $crumbs->push('Создать', route('admin.categories.attributes.create', $category));
});

Breadcrumbs::register('admin.categories.attributes.show', function (Crumbs $crumbs, Category $category, Attribute $attribute) {
    $crumbs->parent('admin.categories.show', $category);
    $crumbs->push($attribute->name_ru, route('admin.categories.attributes.show', [$category, $attribute]));
});

Breadcrumbs::register('admin.categories.attributes.edit', function (Crumbs $crumbs, Category $category, Attribute $attribute) {
    $crumbs->parent('admin.categories.attributes.show', $category, $attribute);
    $crumbs->push('Изменить', route('admin.categories.attributes.edit', [$category, $attribute]));
});


// Publisher Categories

Breadcrumbs::register('admin.publisher.categories.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Категории школ', route('admin.publisher.categories.index'));
});


Breadcrumbs::register('admin.publisher.categories.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.publisher.categories.index');
    $crumbs->push('Создать', route('admin.publisher.categories.create'));
});


Breadcrumbs::register('admin.publisher.categories.show', function (Crumbs $crumbs, PublisherCategory $category) {
    $crumbs->parent('admin.publisher.categories.index');
    $crumbs->push($category->name_ru, route('admin.publisher.categories.show', $category));
});

Breadcrumbs::register('admin.publisher.categories.edit', function (Crumbs $crumbs, PublisherCategory $category) {
    $crumbs->parent('admin.publisher.categories.show', $category);
    $crumbs->push('Изменить', route('admin.publisher.categories.edit', $category));
});

Breadcrumbs::register('admin.course.list', function (Crumbs $crumbs) {
    $crumbs->push('Модерация курсов', route('admin.course.list'));
});

Breadcrumbs::register('admin.course.show', function (Crumbs $crumbs) {
    $crumbs->parent('admin.course.list');
    $crumbs->push('Модерация курса', route('admin.course.show', 'coutse'));
});

Breadcrumbs::register('admin.reviews.list', function (Crumbs $crumbs) {
    $crumbs->push('Модерация отзывов', route('admin.reviews.list'));
});

Breadcrumbs::register('admin.master.list', function (Crumbs $crumbs) {
    $crumbs->push('Модерация мастер-классов', route('admin.master.list'));
});

Breadcrumbs::register('admin.master.show', function (Crumbs $crumbs) {
    $crumbs->parent('admin.course.list');
    $crumbs->push('Модерация мастер-класса', route('admin.master.show', 'coutse'));
});

//Info
Breadcrumbs::register('admin.info_feedback', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Обращения пользователей', route('admin.info_feedback'));
});

//База знаний
Breadcrumbs::register('admin.faq_category', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('База знаний', route('admin.faq_category'));
});

Breadcrumbs::register('admin.faq_category_add', function (Crumbs $crumbs) {
    $crumbs->parent('admin.faq_category');
    $crumbs->push('Добавление категории базы знаний', route('admin.faq_category_add'));
});

Breadcrumbs::register('admin.faq_category_edit', function (Crumbs $crumbs, FaqCategory $category) {
    $crumbs->parent('admin.faq_category');
    $crumbs->push($category->name_ru, route('admin.faq_category_edit', $category));
});

Breadcrumbs::register('admin.faq_article', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Записи базы знаний', route('admin.faq_article'));
});

Breadcrumbs::register('admin.faq_article_add', function (Crumbs $crumbs) {
    $crumbs->parent('admin.faq_article');
    $crumbs->push('Добавление записи базы знаний', route('admin.faq_article_add'));
});

Breadcrumbs::register('admin.faq_article_edit', function (Crumbs $crumbs, FaqArticle $article) {
    $crumbs->parent('admin.faq_article');
    $crumbs->push($article->name_ru, route('admin.faq_article_edit', $article));
});

//Правила сайта
Breadcrumbs::register('admin.terms', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Правила сайта', route('admin.terms'));
});

// Parser
Breadcrumbs::register('admin.parser.parser', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Парсер', route('admin.parser.parser'));
});

Breadcrumbs::register('admin.parser.cron', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Парсер - крон задачи', route('admin.parser.cron'));
});







#======================================================================
//Course

#=== Курсы офлайн первого уровня
Breadcrumbs::register('course_catalog_offline', function (Crumbs $crumbs, $lang, $cat_stage_1) {
    $crumbs->parent('home');

    if($cat_stage_1 == 'all'){
        $title = trans('course/home.Title');
		$crumbs->push($title, route('course_catalog_offline', [app()->getLocale(), $cat_stage_1]));
    }else{
        $category = Category::where('slug', $cat_stage_1)->first();
        $title2 = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;
		$crumbs->push(trans('course/home.Title'), route('course_catalog_offline', [app()->getLocale(), "all"]));
		$crumbs->push($title2, route('course_catalog_offline', [app()->getLocale(), $cat_stage_1]));
    }
});

#=== Курсы офлайн второго уровня
Breadcrumbs::register('course_catalog_offline_stage_2', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2) {
    $crumbs->parent('course_catalog_offline', $lang, $cat_stage_1);

    $category = Category::where('slug', $cat_stage_2)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('course_catalog_offline_stage_2', [app()->getLocale(), $cat_stage_1, $cat_stage_2]));
});

#=== Курсы офлайн третьего уровня
Breadcrumbs::register('course_catalog_offline_stage_3', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2, $cat_stage_3) {
    $crumbs->parent('course_catalog_offline_stage_2', $lang, $cat_stage_1, $cat_stage_2);

    $category = Category::where('slug', $cat_stage_3)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('course_catalog_offline_stage_3', [app()->getLocale(), $cat_stage_1, $cat_stage_2, $cat_stage_3]));
});



#=== Курсы онлайн первого уровня
Breadcrumbs::register('course_catalog_online', function (Crumbs $crumbs, $lang, $cat_stage_1) {
    $crumbs->parent('home');

    if($cat_stage_1 == 'all'){
        $title = (App::isLocale('ru'))? 'Курсы Онлайн' : 'Курси Онлайн';
    }else{
        $category = Category::where('slug', $cat_stage_1)->first();
        $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;
    }

    $crumbs->push($title, route('course_catalog_online', [app()->getLocale(), $cat_stage_1]));
});

#=== Курсы онлайн второго уровня
Breadcrumbs::register('course_catalog_online_stage_2', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2) {
    $crumbs->parent('course_catalog_online', $lang, $cat_stage_1);

    $category = Category::where('slug', $cat_stage_2)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;
echo "12312312";
    $crumbs->push($title, route('course_catalog_online_stage_2', [app()->getLocale(), $cat_stage_1, $cat_stage_2]));
});

#=== Курсы онлайн третьего уровня
Breadcrumbs::register('course_catalog_online_stage_3', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2, $cat_stage_3) {
    $crumbs->parent('course_catalog_online_stage_2', $lang, $cat_stage_1, $cat_stage_2);

    $category = Category::where('slug', $cat_stage_3)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('course_catalog_online_stage_3', [app()->getLocale(), $cat_stage_1, $cat_stage_2, $cat_stage_3]));
});




Breadcrumbs::register('course_page_info', function (Crumbs $crumbs, $lang, $id) {
    $crumbs->parent('home');
    //$crumbs->push(trans('course/home.Title'), route('course_catalog_offline', ['locale' => app()->getLocale(), 'cat_stage_1' => 'all']));
	$course = Course::where('id', $id)->first();
	
	$ccat = explode(', ', $course->category);
	asort($ccat);
	foreach($ccat as $cat)
	{
		$catname = Category::where('id', $cat)->first()['name_ru'];
		if(!is_null($catname))
			$crumbs->push($catname, route('course_catalog_offline', ['locale' => app()->getLocale(), 'cat_stage_1' => 'all']));
	}
	
    $crumbs->push((App::isLocale('ru'))? $course["name_ru"] : $course["name_ua"], route('course_page_info', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('school_description', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Школа', route('school_description', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('school_catalog', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Школа', route('school_catalog', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('school_master', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Школа', route('school_master', ['locale' => app()->getLocale(), 'id' => 'all']));
});

Breadcrumbs::register('school_reviews', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Школа', route('school_reviews', ['locale' => app()->getLocale(), 'id' => 'all']));
});


#=== Мастер-классы первого уровня

Breadcrumbs::register('master_catalog', function (Crumbs $crumbs, $lang, $cat_stage_1) {
    $crumbs->parent('home');

    if($cat_stage_1 == 'all'){
        $title = (App::isLocale('ru'))? 'Мастер-классы' : 'Майстер-класи';
    }else{
        $category = Category::where('slug', $cat_stage_1)->first();
        $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;
    }

    $crumbs->push($title, route('master_catalog', [app()->getLocale(), $cat_stage_1]));
});

#=== Мастер-классы второго уровня
Breadcrumbs::register('master_catalog_stage_2', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2) {
    $crumbs->parent('master_catalog', $lang, $cat_stage_1);

    $category = Category::where('slug', $cat_stage_2)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('master_catalog_stage_2', [app()->getLocale(), $cat_stage_1, $cat_stage_2]));
});

#=== Мастер-классы третьего уровня
Breadcrumbs::register('master_catalog_stage_3', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2, $cat_stage_3) {
    $crumbs->parent('master_catalog_stage_2', $lang, $cat_stage_1, $cat_stage_2);

    $category = Category::where('slug', $cat_stage_2)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('master_catalog_stage_3', [app()->getLocale(), $cat_stage_1, $cat_stage_2, $cat_stage_3]));
});







Breadcrumbs::register('master_page_info', function (Crumbs $crumbs, $lang, $id) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Мастер-классы' : 'Майстер-класи', route('masters_region_all_slug', ['locale' => app()->getLocale(), 'slug' => 'all']));
	$name = Master::where('id', $id)->first();
    $crumbs->push((App::isLocale('ru'))? $name['name_ru'] : $name['name_ua']);
});


//Школы первого уровня

Breadcrumbs::register('school_list', function (Crumbs $crumbs, $lang, $cat_stage_1) {
    $crumbs->parent('home');

    if($cat_stage_1 == 'all'){
        $title = (App::isLocale('ru'))? 'Школы' : 'Школи';
    }else{
        $category = PublisherCategory::where('slug', $cat_stage_1)->first();
        $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;
    }

    $crumbs->push($title, route('school_list', [app()->getLocale(), $cat_stage_1]));
});

//Школы второго уровня

Breadcrumbs::register('school_list_stage_2', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2) {
    $crumbs->parent('school_list', $lang, $cat_stage_1);

    $category = PublisherCategory::where('slug', $cat_stage_2)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('school_list_stage_2', [app()->getLocale(), $cat_stage_1, $cat_stage_2]));
});

//Школы третьего уровня

Breadcrumbs::register('school_list_stage_3', function (Crumbs $crumbs, $lang, $cat_stage_1, $cat_stage_2, $cat_stage_3) {
    $crumbs->parent('school_list', $lang, $cat_stage_1, $cat_stage_2);

    $category = PublisherCategory::where('slug', $cat_stage_3)->first();
    $title = (App::isLocale('ru'))? $category->name_ru : $category->name_uk;

    $crumbs->push($title, route('school_list_stage_3', [app()->getLocale(), $cat_stage_1, $cat_stage_2, $cat_stage_3]));
});




Breadcrumbs::register('about_us', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.About project'), route('about_us', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('services', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Services and rates'), route('services', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('faq', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Knowledge base'), route('faq', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('faq_show', function (Crumbs $crumbs, $lang, FaqArticle $article) {
    $crumbs->parent('faq');
    $crumbs->push((App::isLocale('ru'))? $article->name_ru : $article->name_ua, route('faq_show', [app()->getLocale(), $article]));
});

Breadcrumbs::register('contacts', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Contacts'), route('contacts', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('improvement', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Improve of site'), route('improvement', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('terms', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Rules of site'), route('terms', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('offer', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('layout/footer.Offer'), route('offer', ['locale' => app()->getLocale()]));
});

Breadcrumbs::register('term', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push((App::isLocale('ru'))? 'Политика конфиденциальности' : 'Політика конфіденційності', route('term', ['locale' => app()->getLocale()]));
});






//// Users
//
//Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.home');
//    $crumbs->push('Users', route('admin.users.index'));
//});
//
//Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.users.index');
//    $crumbs->push('Create', route('admin.users.create'));
//});
//
//Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
//    $crumbs->parent('admin.users.index');
//    $crumbs->push($user->name, route('admin.users.show', $user));
//});
//
//Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
//    $crumbs->parent('admin.users.show', $user);
//    $crumbs->push('Edit', route('admin.users.edit', $user));
//});
//
//
//// Regions
//
//Breadcrumbs::register('admin.regions.index', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.home');
//    $crumbs->push('Regions', route('admin.regions.index'));
//});
//
//Breadcrumbs::register('admin.regions.create', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.regions.index');
//    $crumbs->push('Create', route('admin.regions.create'));
//});
//
//Breadcrumbs::register('admin.regions.show', function (Crumbs $crumbs, Region $region) {
//    if ($parent = $region->parent) {
//        $crumbs->parent('admin.regions.show', $parent);
//    } else {
//        $crumbs->parent('admin.regions.index');
//    }
//    $crumbs->push($region->name, route('admin.regions.show', $region));
//});
//
//Breadcrumbs::register('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
//    $crumbs->parent('admin.regions.show', $region);
//    $crumbs->push('Edit', route('admin.regions.edit', $region));
//});



//// Advert Category Attributes
//
//Breadcrumbs::register('admin.adverts.categories.attributes.create', function (Crumbs $crumbs, Category $category) {
//    $crumbs->parent('admin.adverts.categories.show', $category);
//    $crumbs->push('Create', route('admin.adverts.categories.attributes.create', $category));
//});
//
//Breadcrumbs::register('admin.adverts.categories.attributes.show', function (Crumbs $crumbs, Category $category, Attribute $attribute) {
//    $crumbs->parent('admin.adverts.categories.show', $category);
//    $crumbs->push($attribute->name, route('admin.adverts.categories.attributes.show', [$category, $attribute]));
//});
//
//Breadcrumbs::register('admin.adverts.categories.attributes.edit', function (Crumbs $crumbs, Category $category, Attribute $attribute) {
//    $crumbs->parent('admin.adverts.categories.attributes.show', $category, $attribute);
//    $crumbs->push('Edit', route('admin.adverts.categories.attributes.edit', [$category, $attribute]));
//});
//
//
//// Banners
//
//Breadcrumbs::register('admin.banners.index', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.home');
//    $crumbs->push('Banners', route('admin.banners.index'));
//});
//
//Breadcrumbs::register('admin.banners.show', function (Crumbs $crumbs, Banner $banner) {
//    $crumbs->parent('admin.banners.index');
//    $crumbs->push($banner->name, route('admin.banners.show', $banner));
//});
//
//Breadcrumbs::register('admin.banners.edit', function (Crumbs $crumbs, Banner $banner) {
//    $crumbs->parent('admin.banners.show', $banner);
//    $crumbs->push('Edit', route('admin.banners.edit', $banner));
//});
//
//Breadcrumbs::register('admin.banners.reject', function (Crumbs $crumbs, Banner $banner) {
//    $crumbs->parent('admin.banners.show', $banner);
//    $crumbs->push('Reject', route('admin.banners.reject', $banner));
//});
//
//
//
//// Pages
//
//Breadcrumbs::register('admin.pages.index', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.home');
//    $crumbs->push('Pages', route('admin.pages.index'));
//});
//
//Breadcrumbs::register('admin.pages.create', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.pages.index');
//    $crumbs->push('Create', route('admin.pages.create'));
//});
//
//Breadcrumbs::register('admin.pages.show', function (Crumbs $crumbs, Page $page) {
//    if ($parent = $page->parent) {
//        $crumbs->parent('admin.pages.show', $parent);
//    } else {
//        $crumbs->parent('admin.pages.index');
//    }
//    $crumbs->push($page->title, route('admin.pages.show', $page));
//});
//
//Breadcrumbs::register('admin.pages.edit', function (Crumbs $crumbs, Page $page) {
//    $crumbs->parent('admin.pages.show', $page);
//    $crumbs->push('Edit', route('admin.pages.edit', $page));
//});
//
//
//// Tickets
//
//Breadcrumbs::register('admin.tickets.index', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.home');
//    $crumbs->push('Tickets', route('admin.tickets.index'));
//});
//
//Breadcrumbs::register('admin.tickets.show', function (Crumbs $crumbs, Ticket $ticket) {
//    $crumbs->parent('admin.tickets.index');
//    $crumbs->push($ticket->subject, route('admin.tickets.show', $ticket));
//});
//
//Breadcrumbs::register('admin.tickets.edit', function (Crumbs $crumbs, Ticket $ticket) {
//    $crumbs->parent('admin.tickets.show', $ticket);
//    $crumbs->push('Edit', route('admin.tickets.edit', $ticket));
//});
//
//
//
//// Adverts
//
//Breadcrumbs::register('admin.adverts.adverts.index', function (Crumbs $crumbs) {
//    $crumbs->parent('admin.home');
//    $crumbs->push('Adverts', route('admin.adverts.adverts.index'));
//});
//
//Breadcrumbs::register('admin.adverts.adverts.edit', function (Crumbs $crumbs, Advert $advert) {
//    $crumbs->parent('admin.home');
//    $crumbs->push($advert->title, route('admin.adverts.adverts.edit', $advert));
//});
//
//Breadcrumbs::register('admin.adverts.adverts.photos', function (Crumbs $crumbs, Advert $advert) {
//    $crumbs->parent('admin.home');
//    $crumbs->push($advert->title, route('admin.adverts.adverts.photos', $advert));
//});
//
//Breadcrumbs::register('admin.adverts.adverts.attributes', function (Crumbs $crumbs, Advert $advert) {
//    $crumbs->parent('admin.home');
//    $crumbs->push($advert->title, route('admin.adverts.adverts.attributes', $advert));
//});
//
//
//Breadcrumbs::register('admin.adverts.adverts.reject', function (Crumbs $crumbs, Advert $advert) {
//    $crumbs->parent('admin.home');
//    $crumbs->push($advert->title, route('admin.adverts.adverts.reject', $advert));
//});


