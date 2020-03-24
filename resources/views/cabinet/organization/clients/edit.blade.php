<?php

$title = (App::isLocale('ru'))? 'Редактирование' : 'Редагування';
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')

	<section class="cabinet">
		<div class="container cabinet__inner">
			@include('cabinet.organization.layouts.sidebar', ['some' => 'data'])

			
			<div class="cabinet__info-block">
                <div class="deals deals--clients-edit">
                    <form action="{{ route('cabinet.organization.clients.update', app()->getLocale()) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <div class="deals__top">
                            <h2 class="h2 deals__title">
                                {{ $title }}
                            </h2>
                            <div class="deals__button fixed-button-wrapper">
                                <a href="{{ route('cabinet.organization.clients.deleteGet', app()->getLocale()) }}?id={{ $client->id }}" class="button button--with-icon button--red">
                                    <svg width="20" height="21">
                                        <use xlink:href="#icon-trash"></use>
                                    </svg>
                                    {{ (App::isLocale('ru'))? 'Удалить' : 'Видалити' }}
                                </a>
                                <button type="submit" class="button button--with-icon button--green">
                                    <svg width="20" height="21">
                                        <use xlink:href="#icon-save"></use>
                                    </svg>
                                    {{ (App::isLocale('ru'))? 'Сохранить' : 'Зберегти' }}
                                </button>
                            </div>
                        </div>
                        <div class="deals__clients-edit-form">
                            <div class="deals__clients-edit-item">
                                <label for="deals_clients_edit_name" class="label label--required">
                                    {{ (App::isLocale('ru'))? 'Имя' : 'Iм`я' }}
                                </label>
                                <input required type="text" name="deals_clients_edit_name" class="input input--full-width" id="deals_clients_edit_name" required="" value="{{ $client->name }}">
                            </div>
                            <div class="deals__clients-edit-item">
                                <label for="deals_clients_edit_phone" class="label label--required">
                                    Телефон
                                </label>
                                <input required type="text" name="deals_clients_edit_phone" class="input input--full-width" id="deals_clients_edit_phone" required="" value="{{ $client->phone }}">
                            </div>
                            <div class="deals__clients-edit-item">
                                <label for="deals_clients_edit_email" class="label">
                                    E-mail
                                </label>
                                <input required type="text" name="deals_clients_edit_email" class="input input--full-width" id="deals_clients_edit_email" value="{{ $client->email }}">
                            </div>
                        </div>
                    </form>
                    <ul class="deals__sort-list">
                        <li class="deals__sort-item deals__sort-item--name">
                            <a href="#" class="deals__sort-element">
                                {{ (App::isLocale('ru'))? 'Курсы' : 'Курси' }}
                                <!-- <svg width="12" height="15">
                                    <use xlink:href="#icon-double-arrow-black"></use>
                                </svg> -->
                            </a>
                        </li>
                        <li class="deals__sort-item deals__sort-item--price">
                            <a href="#" class="deals__sort-element">
                                Бюджет
                            </a>
                        </li>
                        <li class="deals__sort-item deals__sort-item--status">
                            <a href="#" class="deals__sort-element">
                                Статус
                            </a>
                        </li>
                    </ul>
                    <ul class="deals__list">
                        @foreach($lists as $list)
                            <li class="deals__item">
                                <p class="deals__status">
                                    @if($list->name_deal)
                                        {{ $list->name_deal }}
                                    @else
                                        {{ (App::isLocale('ru'))? 'Новая заявка' : 'Нова заявка' }}
                                    @endif
                                </p>
                                <p class="deals__author">
                                    {{ $list->name_user }}
                                </p>
                                <p class="deals__date">
                                    {{ date('d.m.Y, H:i:s') }}
                                </p>
                                <div class="deal__tags">
                                    {!! Deals::dealStatus($list->status) !!}
                                    <div class="deal__tag-marker">
                                        @if($list->tag == 1)
                                            А
                                        @endif
                                        @if($list->tag == 2)
                                            B
                                        @endif
                                        @if($list->tag == 3)
                                            C
                                        @endif
                                    </div>
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
                                                <form method="POST" action="{{ route('cabinet.organization.deleteDeals', App::getLocale()) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $list->id }}">
                                                    <button type="sumbit" class="delete delete--view-square action-circle__delete" aria-label="Удалить">
                                                        <svg width="13" height="15">
                                                            <use xlink:href="#icon-trash"></use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="action-circle__item">
                                                <a href="{{ route('cabinet.organization.showDeals', ['locale' => App::getLocale(), 'id' => $list->id]) }}" class="edit action-circle__edit" aria-label="Редактировать">
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
          
                    </div>
                </div>
            </div>
		</div>
	</section>

@endsection