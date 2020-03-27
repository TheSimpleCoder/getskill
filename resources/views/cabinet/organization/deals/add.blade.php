<?php

$title = (App::isLocale('ru'))? 'Новая сделка' : 'Нова угода';
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
                <div class="deals-edit">
                    <form action="{{ route('cabinet.organization.dealsAddNew', App::getLocale()) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="deals-edit__top">
                            <div class="deals-edit__name">
                                <div class="deals-edit__item">
                                    <h2 class="h2 deals-edit__title content-deals-edit">
                                        <a href="{{ route('cabinet.organization.deals', App::getLocale()) }}">
                                            <svg width="7" height="14">
                                                <use xlink:href="#icon-arrow-left"></use>
                                            </svg>
                                            {{ $title }}
                                        </a>
                                    </h2>
                                    <div class="deals-edit__item-input-wrap edit_name_deals">
                                        <p class="deals-edit__item-label">
                                            {{ (App::isLocale('ru'))? 'Название Заявки:' : 'Назва Заявки:' }}
                                        </p>
                                        <label for="deals_edit_name" class="visually-hidden">
                                            Названия
                                        </label>
                                        <input required type="text" name="deals_edit_name" class="deals-edit__item-input" id="deals_edit_name" value="Новая заявка">
                                    </div>
                                    <button type="button" class="deals-edit__button-edit content-deals-edit edit_name_deals_btn" aria-label="Редактировать Названия">
                                        <svg width="16" height="15">
                                            <use xlink:href="#icon-pen"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="deals-edit__buttons fixed-button-wrapper">
                                <button type="submit" class="button disabled button--with-icon button--green">
                                    <svg width="20" height="21">
                                        <use xlink:href="#icon-save"></use>
                                    </svg>
                                    {{ (App::isLocale('ru'))? 'Сохранить' : 'Зберегти' }}
                                </button>
                            </div>
                            <button type="submit" class="button disabled button--cabinet-submit button--save button--green button--fixed show-mobile">
                                <svg width="20" height="21">
                                    <use xlink:href="#icon-save"></use>
                                </svg>
                                Сохранить
                            </button>
                        </div>
                        <div class="deals-edit__select-info">
                            <div class="tag-select">
                                <button class="tag-select__toggle close tag_select" type="button">
                                    <span class="tag-select__value tag_val">
                                        #{{ (App::isLocale('ru'))? 'тегировать' : 'тегувати' }}
                                    </span>
                                </button>
                                <div class="tag-select__content tag_list">
                                    <button class="tag-select__option tag_btn" type="button" data-value="A" data-id="1">
                                        {{ (App::isLocale('ru'))? 'Есть деньги и срочно' : 'Є гроші і терміново' }}
                                    </button>
                                    <button class="tag-select__option tag_btn" type="button" data-value="B" data-id="2">
                                        {{ (App::isLocale('ru'))? 'Есть деньги, но не срочно' : 'Є гроші, але не терміново' }}
                                    </button>
                                    <button class="tag-select__option tag_btn" type="button" data-value="C" data-id="3">
                                        {{ (App::isLocale('ru'))? 'Нет денег и не срочно' : 'Немає грошей і не терміново' }}
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="tag" class="input_tag" value="0">
                        </div>
                        <div class="deals-edit__select-status">
                            <div class="underline-select">
                                <button class="underline-select__toggle close status_select_btn" type="button">
                                    <span class="underline-select__current-value status_val">
                                        {{ Deals::dealStatusName(0) }}
                                    </span>
                                    <svg width="14" height="7">
                                        <use xlink:href="#icon-arrow"></use>
                                    </svg>
                                </button>
                                <div class="underline-select__content status_list">
                                    <button class="underline-select__option status_option" type="button" data-id="0">
                                        {{ (App::isLocale('ru'))? 'Новая заявка' : 'Нова заявка' }}
                                    </button>
                                    <button class="underline-select__option status_option" type="button" data-id="1">
                                        {{ (App::isLocale('ru'))? 'В обработке' : 'В обробцi' }}
                                    </button>
                                    <button class="underline-select__option status_option" type="button" data-id="2">
                                        {{ (App::isLocale('ru'))? 'Завершен' : 'Завершено' }}
                                    </button>
                                    <button class="underline-select__option status_option" type="button" data-id="3">
                                        {{ (App::isLocale('ru'))? 'Отменен' : 'Скасовано' }}
                                    </button>
                                </div>
                                <input type="hidden" name="status" class="input_status" value="0">
                            </div>
                        </div>
                        <div class="deals-edit__edit-list">
                            <div class="deals-edit__edit-left">
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        {{ (App::isLocale('ru'))? 'Имя:' : 'Ім`я:' }}
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <label for="deals_edit_list_name" class="visually-hidden">
                                                {{ (App::isLocale('ru'))? 'Имя:' : 'Ім`я:' }}
                                            </label>
                                            <input required type="text" name="deals_edit_list_name" class="deals-edit__item-input" id="deals_edit_list_name">
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        Телефон:
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <label for="deals_edit_list_tel" class="visually-hidden">
                                                Телефон:
                                            </label>
                                            <input required type="tel" name="deals_edit_list_tel" class="deals-edit__item-input" id="deals_edit_list_tel">
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        E-mail:
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <label for="deals_edit_list_email" class="visually-hidden">
                                                E-mail:
                                            </label>
                                            <input required type="email" name="deals_edit_list_email" class="deals-edit__item-input" id="deals_edit_list_email">
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        Дата:
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <input required type="text" name="date" class="datetimepicker deals-edit__item-input" />
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="deals-edit__edit-right">
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        Курс:
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <label for="deals_edit_list_curse" class="visually-hidden">
                                                Курс:
                                            </label>
                                            <select name="course_id">
                                                @foreach($courseList as $cl)
                                                    <option value="{{ $cl->id }}">{{ (App::isLocale('ru'))? $cl->name_ru : $cl->name_ua }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        Бюджет:
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            0 грн.
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <label for="deals_edit_list_sum" class="visually-hidden">
                                                Бюджет:
                                            </label>
                                            <input required type="text" name="budget" class="deals-edit__item-input" id="deals_edit_list_sum">
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        {{ (App::isLocale('ru'))? 'Преподаватель:' : 'Викладач:' }}
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <label for="deals_edit_list_sum" class="visually-hidden">
                                                {{ (App::isLocale('ru'))? 'Преподаватель:' : 'Викладач:' }}
                                            </label>
                                            <select name="prepod">
                                                @foreach($prepodList as $pl)
                                                    <option value="{{ $pl->id }}">{{ (App::isLocale('ru'))? $pl->name_ru : $pl->name_ua }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="deals-edit__item">
                                    <p class="deals-edit__item-label">
                                        Дата курса:
                                    </p>
                                    <div class="deals-edit__item-input-wrap">
                                        <p class="deals-edit__item--date">
                                            ...
                                        </p>
                                        <div class="deals-edit__item__input-content">
                                            <input required type="text" name="date_course" class="datetimepicker deals-edit__item-input" />
                                        </div>
                                        <button type="button" class="deals-edit__button-edit" aria-label="Редактировать Названия">
                                            <svg width="16" height="15">
                                                <use xlink:href="#icon-pen"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
		</div>
	</section>
    <script type="text/javascript">
        window.onload = function() {
            $('.datetimepicker').datetimepicker({
                minTime:0,
                format:'d.m.Y, H:i:s',
                step:5,
            });
        };
    </script>

@endsection
