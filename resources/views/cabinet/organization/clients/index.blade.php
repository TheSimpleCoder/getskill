<?php

$title = (App::isLocale('ru'))? 'Клиенты' : 'Клiенти';
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')

    <style type="text/css">
        ul.deals__list {
            display: flex;
            height: 100%;
        }
        li.deals__item {
            display: block;
            min-width: 100%;
        }
    </style>

	<section class="cabinet">
		<div class="container cabinet__inner">
			@include('cabinet.organization.layouts.sidebar', ['some' => 'data'])


			<div class="cabinet__info-block">
                <div class="deals deals--clients">
                    <div class="deals__top">
                        <h2 class="h2 deals__title">
                            {{ $title }}
                        </h2>
                        <div class="deals__button">
                            <a href="{{ route('cabinet.organization.clients.add', app()->getLocale()) }}" class="button button--add-something button--green button--icon-transform">
                                {{ (App::isLocale('ru'))? 'Добавить клиента' : 'Додати клієнта' }}
                            </a>
                        </div>
                    </div>
                    <!-- <div class="search deals__search">
                        <form method="get" action="deals_search.php" autocomplete="off">
                            <label for="deals_search" class="visually-hidden">
                                {{ (App::isLocale('ru'))? 'Поиск' : 'Пошук' }}
                            </label>
                            <button class="search__button" aria-label="Искать">
                                <svg width="15" height="16" class="search__icon">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                            <input type="search" name="deals_search" class="input input--search" placeholder="{{ (App::isLocale('ru'))? 'Введите номер клиента' : 'Введіть номер клієнта' }}" id="deals_search">
                        </form>
                    </div> -->
                    <ul class="deals__sort-list">
                        <li class="deals__sort-item deals__sort-item--name">
                            <a href="javascript:void(0);" class="deals__sort-element sort-name">
                                {{ (App::isLocale('ru'))? 'Имя' : 'I`мя' }}
                                <svg width="12" height="15">
                                    <use xlink:href="#icon-double-arrow-black"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="deals__sort-item deals__sort-item--date">
                            <a href="#" class="deals__sort-element">
                                Телефон
                                <!-- <svg width="12" height="15">
                                    <use xlink:href="#icon-double-arrow-black"></use>
                                </svg> -->
                            </a>
                        </li>
                        <li class="deals__sort-item deals__sort-item--status">
                            <a href="javascript:void(0);" class="deals__sort-element sort-email">
                                E-mail
                                <svg width="12" height="15">
                                    <use xlink:href="#icon-double-arrow-black"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <ul class="deals__list">
                        @foreach($clients as $client)
                            <li class="deals__item custom-deals" data-name="{{ $client->name }}" data-email="{{ $client->email }}">
                                <div class="deals__sort-item--name">
                                    <p class="deals__author">
                                        {{ $client->name }}
                                    </p>
                                </div>
                                <div class="deals__sort-item--date">
                                    <p class="deals__phone">
                                        {{ $client->phone }}
                                    </p>
                                </div>

                                <div class="deals__sort-item--status">
                                    <p class="deal__email">
                                        {{ $client->email }}
                                    </p>
                                </div>

                                <div class="action-circle action-circle--open deal__action">
                                    <button type="button" class="action-circle__toggle" aria-label="Открыть меню">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                    <div class="action-circle__wrapper">
                                        <div class="action-circle__list">
                                            <div class="action-circle__item">
                                                <form action="{{ route('cabinet.organization.clients.delete', app()->getLocale()) }}" method="POST">
                                                    <button type="submit" class="delete delete--view-square action-circle__delete" aria-label="Удалить">
                                                        <svg width="13" height="15">
                                                            <use xlink:href="#icon-trash"></use>
                                                        </svg>
                                                    </button>
                                                    <input type="hidden" name="id" value="{{ $client->id }}">
                                                    @csrf
                                                </form>
                                            </div>
                                            <div class="action-circle__item">
                                                <a href="{{ route('cabinet.organization.clients.edit', ['locale' => app()->getLocale(), 'id' => $client->id]) }}" class="edit action-circle__edit" aria-label="Редактировать">
                                                    <svg width="16" height="15">
                                                        <use xlink:href="#icon-pen"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="deals__pagination">
                        <!-- Тут пагинация -->
                    </div>
                </div>
            </div>

		</div>
	</section>

@endsection
