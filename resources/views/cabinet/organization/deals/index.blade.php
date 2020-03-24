<?php

$title = (App::isLocale('ru'))? 'Сделки' : 'Угоди';
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
          		<div class="deals">
            		<div class="deals__top">
              			<h2 class="h2 deals__title">
                			{{ $title }}
              			</h2>
              			<div class="deals__button">
                			<a href="{{ route('cabinet.organization.dealsArhiv', app()->getLocale()) }}" class="button button--add-something button--gray button--icon-transform-svg">
                  				<svg width="25" height="19">
                    				<use xlink:href="#icon-arhive"></use>
                  				</svg>
                  				{{ (App::isLocale('ru'))? 'Архив' : 'Архiв' }}
                			</a>
                			<a href="{{ route('cabinet.organization.dealsAdd', App::getLocale()) }}" class="button button--add-something button--green button--icon-transform">
                  				{{ (App::isLocale('ru'))? 'Добавить сделку' : 'Додати угоду' }}
                			</a>
              			</div>
            		</div>
            		<ul class="deals__sort-list">
              			<li class="deals__sort-item deals__sort-item--title">
                			<a href="#" class="deals__sort-element">
                  				{{ (App::isLocale('ru'))? 'Название' : 'Назва' }}
                  				<!-- <svg width="12" height="15">
                    				<use xlink:href="#icon-double-arrow-black"></use>
                  				</svg> -->
                			</a>
              			</li>
              			<li class="deals__sort-item deals__sort-item--name">
                			<a href="#" class="deals__sort-element">
                  				{{ (App::isLocale('ru'))? 'Имя' : 'Iм`я' }}
                  				<!-- <svg width="12" height="15">
                    				<use xlink:href="#icon-double-arrow-black"></use>
                  				</svg> -->
                			</a>
              			</li>
              			<li class="deals__sort-item deals__sort-item--date">
                			<a href="#" class="deals__sort-element">
                				Дата
                  				<!-- <svg width="12" height="15">
                    				<use xlink:href="#icon-double-arrow-black"></use>
                  				</svg> -->
                			</a>
              			</li>
              			<li class="deals__sort-item deals__sort-item--status">
                			<a href="#" class="deals__sort-element">
                  				Статус
                  				<!-- <svg width="12" height="15">
                    				<use xlink:href="#icon-double-arrow-black"></use>
                  				</svg> -->
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
                                    @if($list->tag != 0)
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
                                    @endif
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
              			<!-- Сюда втулить пагинацию -->
            		</div>
          		</div>
        	</div>
		</div>
	</section>

@endsection