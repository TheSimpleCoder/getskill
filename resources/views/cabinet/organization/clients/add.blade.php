<?php

$title = (App::isLocale('ru'))? 'Добавить клиента' : 'Додати клієнта';
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
                    <form action="{{ route('cabinet.organization.clients.save', app()->getLocale()) }}" method="POST">
                        @csrf
                        <div class="deals__top">
                            <h2 class="h2 deals__title">
                                {{ $title }}
                            </h2>
                            <div class="deals__button fixed-button-wrapper">
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
                        <div class="deals__clients-edit-form">
                            <div class="deals__clients-edit-item">
                                <label for="deals_clients_edit_name" class="label label--required">
                                    {{ (App::isLocale('ru'))? 'Имя' : 'Iм`я' }}
                                </label>
                                <input required type="text" name="deals_clients_edit_name" class="input input--full-width" id="deals_clients_edit_name" required="">
                            </div>
                            <div class="deals__clients-edit-item">
                                <label for="deals_clients_edit_phone" class="label label--required">
                                    Телефон
                                </label>
                                <input required type="text" name="deals_clients_edit_phone" class="input input--full-width" id="deals_clients_edit_phone" required="">
                            </div>
                            <div class="deals__clients-edit-item">
                                <label for="deals_clients_edit_email" class="label">
                                    E-mail
                                </label>
                                <input required type="text" name="deals_clients_edit_email" class="input input--full-width" id="deals_clients_edit_email">
                            </div>
                        </div>
                    </form>
                    <div class="deals__pagination">

                    </div>
                </div>
            </div>
		</div>
	</section>

@endsection
