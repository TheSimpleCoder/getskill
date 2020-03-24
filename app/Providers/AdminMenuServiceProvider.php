<?php

namespace App\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AdminMenuServiceProvider extends ServiceProvider
{

    public function register()
    {
    }


    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add([
                'text' => 'Sitemap',
                'icon' => 'fas fa-fw fa-users',
                'url'  => url('sitemap.xml'),
                'active' => null,
            ]);

            $event->menu->add('Парсер отзывов');
            $event->menu->add([
                'text' => 'Парсер',
                'url'  => route('admin.parser.parser'),
                'icon' => 'fas fa-map-marker-alt',
                'active' => ['/admin/parser', '/admin/parser'],
            ]);

            $event->menu->add([
                'text' => 'Парсер (крон задачи)',
                'url'  => route('admin.parser.cron'),
                'icon' => 'fas fa-map-marker-alt',
                'active' => ['/admin/parser/cron', '/admin/parser/cron*'],
            ]);

            $event->menu->add('Документация');
            $event->menu->add([
                'text' => 'Правила сайта',
                'icon' => 'fas fa-map-marker-alt',
                'url'  => route('admin.terms'),
                'active' => ['/admin/terms', '/admin/terms*',],
            ]);

            $event->menu->add('Пользователи');
            $event->menu->add([
                'text' => 'Пользователи',
                'icon' => 'fas fa-fw fa-users',
                'url'  => route('admin.users.index'),
                'active' => ['/admin/users', '/admin/users*',],
            ]);

            $event->menu->add('Обращения пользователей');
            $event->menu->add([
                'text' => 'Обращения пользователей',
                'icon' => 'fas fa-fw fa-users',
                'url'  => route('admin.info_feedback'),
                'active' => ['/admin/feedback', '/admin/feedback*',],
            ]);

            $event->menu->add('Курсы');
            $event->menu->add([
                'text' => 'Категории',
                'icon' => 'fas fa-fw fa-server',
                'url'  => route('admin.categories.index'),
                'active' => ['/admin/categories', '/admin/categories/*'],
            ]);

            $event->menu->add([
                'text' => 'Города',
                'url'  => route('admin.regions.index'),
                'icon' => 'fas fa-map-marker-alt',
                'active' => ['/admin/regions', '/admin/regions*'],
            ]);

            $event->menu->add('Школы');
            $event->menu->add([
                'text' => 'Категории',
                'url'  => route('admin.publisher.categories.index'),
                'icon' => 'fas fa-poll',
                'active' => ['/admin/publisher/categories', '/admin/publisher/categories/*'],
            ]);

            $event->menu->add('Модерация');
            $event->menu->add([
                'text' => 'Модерация (курсы)',
                'url'  => route('admin.course.list'),
                'icon' => 'fas fa-fw fa-server',
                'active' => ['/admin/course/list', '/admin/course/list/*'],
            ]);

            $event->menu->add([
                'text' => 'Модерация (МК)',
                'url'  => route('admin.master.list'),
                'icon' => 'fas fa-fw fa-server',
                'active' => ['/admin/master/list', '/admin/master/list/*'],
            ]);

            $event->menu->add([
                'text' => 'Модерация (отзывы)',
                'url'  => route('admin.reviews.list'),
                'icon' => 'fas fa-fw fa-server',
                'active' => ['/admin/reviews/list', '/admin/reviews/list/*'],
            ]);

            $event->menu->add('Статьи');
            $event->menu->add([
                'text' => 'Категории',
                'url'  => route('admin.article.index_category'),
                'icon' => 'fas fa-poll',
                'active' => ['/admin/article/category', '/admin/article/category/*'],
            ]);

            $event->menu->add([
                'text' => 'Статьи',
                'url'  => route('admin.article.index_article'),
                'icon' => 'fas fa-poll',
                'active' => ['/admin/article/posts', '/admin/article/posts/*'],
            ]);

            $event->menu->add('База знаний');
            $event->menu->add([
                'text' => 'Категории',
                'url'  => route('admin.faq_category'),
                'icon' => 'fas fa-fw fa-server',
                'active' => ['/admin/faq/category', '/admin/faq/category/*'],
            ]);
            $event->menu->add([
                'text' => 'Записи',
                'url'  => route('admin.faq_article'),
                'icon' => 'fas fa-fw fa-server',
                'active' => ['/admin/faq/article', '/admin/faq/article/*'],
            ]);

        });
    }
}
