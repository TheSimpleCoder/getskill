<?php

$title = (App::isLocale('ru'))? 'Отзывы' : 'Вiдгуки';
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
              	<div class="cabinet__form">
                	<div class="cabinet__page-name">
                  		<h2 class="h2">
                      		{{ $title }}
                  		</h2>
                	</div>

                	<section class="reviews reviews-for-user-cabinet">
                  		<ul class="reviews__list">
                  			@foreach(Rate::getListOrganization($org->id) as $rate)
	                    		<li class="reviews__item {{ (Rate::getFeedbackOrganization($rate->id)->count() > 0)? 'reviews__item--answer' : '' }}">
	                      			<article class="reviews__review for-cabinet">
	                        			<div class="reviews__top">
	                          				<div class="reviews__img">
	                            				<picture>
	                              					<img src="{{ $rate->user_avatar }}" width="50" height="51" alt="{{ $rate->user_name }}">
	                            				</picture>
	                          				</div>
	                          				<div class="reviews__details">
	                            				<div class="reviews__author">
	                              					<h6 class="reviews__who-author">
	                                					{{ $rate->user_name }}
	                              					</h6>
	                              					<h6 class="reviews__whom">
	                                					<a href="#" class="reviews__whom__link">
	                                  						<svg width="19" height="19">
	                                    						<use xlink:href="#external-link-icon"></use>
	                                 						</svg>
	                                					</a>
	                              					</h6>
	                            				</div>
	                            				<div class="reviews__rating rating">
	                            					<?php
	                            						for ($i=0; $i < 5; $i++) {
	                            							?>
	                            								<div class="rating__star rating__star--active">
				                                					<svg width="13" height="13">
				                                  						<use xlink:href="#icon-rationg-star"></use>
				                                					</svg>
				                            					</div>
	                            							<?php
	                            						}
	                            					?>
	                            				</div>
	                            				<span class="reviews__time">
	                              					{{ date('d.m.Y', $rate->time) }}
	                            				</span>
	                          				</div>
	                          				<div class="reviews__option-wrap">
	                            				<button type="button" class="reviews__options" aria-label="Дополнительние действия">
	                              					<span class="reviews__options-circle"></span>
	                              					<span class="reviews__options-circle"></span>
	                              					<span class="reviews__options-circle"></span>
	                            				</button>
	                            				<div class="reviews__option-dropdown">
	                            					<a href="{{ route('course_add_review_complain', ['locale' => app()->getLocale()]) }}?id={{ $rate->id }}">
	                              						<span class="reviews__report">

                      										{{ (App::isLocale('ru'))? 'Пожаловатся' : 'Поскаржитися' }}
	                              						</span>
	                              					</a>
	                            				</div>
	                          				</div>
	                        			</div>
	                        			<div class="reviews__main">
	                          				<p>
					                            {!! $rate->text !!}
	                          				</p>
	                        			</div>
	                        			<div class="reviews__footer">
                                            <a href="javascript:void(0)" class="button reviews__answer">
                                                <svg width="19" height="15">
                                                    <use xlink:href="#icon-arrow-rewies"></use>
                                                </svg>
                                                {{ (App::isLocale('ru'))? 'Ответить' : 'Відповісти' }}
                                            </a>
                                            <div class="reviews__footer-form">
                                                <form action="{{ route('course_add_review_feedback', ['locale' => app()->getLocale()]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="course" value="{{ $rate->course_id }}">
                                                    <input type="hidden" name="parent" value="{{ $rate->id }}">
                                                    <input type="hidden" name="owner" value="1">
                                                    <label for="reviews_answer_text" class="visually-hidden">
                                                        Ответить
                                                    </label>
                                                    <textarea name="text" class="reviews__footer-form-textarea" placeholder="Ваш ответ" id="reviews_answer_text"></textarea>
                                                    <p class="reviews__footer-text">
                                                        Обратите внимание, что ваш ответ будет виден всем пользователям, поэтому он должен
                                                        соответствовать нашим правилам в отношении контента.
                                                        <a href="#">
                                                            Условия обслуживания
                                                        </a>
                                                    </p>
                                                    <button type="submit" class="button reviews__footer-form-textarea-submit">
                                                        <svg width="19" height="15">
                                                            <use xlink:href="#icon-arrow-rewies"></use>
                                                        </svg>
                                                        Опубликовать ответ
                                                    </button>
                                                    <span class="button button--cancel">
                                            			{{ (App::isLocale('ru'))? 'Отменить' : 'Вiдмiнити' }}
                                        			</span>
                                                </form>
                                            </div>
                                        </div>
                                        @foreach(Rate::getFeedbackForOrganization($rate->id) as $feed)
                                            <article class="reviews__review reviews__review--answer">
                                                <div class="reviews__top">
                                                    <div class="reviews__img">
                                                        <picture>
                                                            <img src="{{ $feed->user_avatar }}" width="50" height="51" alt="{{ $feed->user_name }}">
                                                        </picture>
                                                    </div>
                                                    <div class="reviews__details">
                                                        <h6 class="reviews__author">
                                                            {{ $feed->user_name }}
                                                        </h6>
                                                        <span class="reviews__time">
                                                            {{ date('d.m.Y', $feed->time) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="reviews__main">
                                                    <p>
                                                        {!! $feed->text !!}
                                                    </p>
                                                </div>
                                            </article>
                                        @endforeach
	                      			</article>
	                      			@foreach(Rate::getFeedbackOrganization($rate->id)->get() as $feedOrg)
		                      			<article class="reviews__review for-cabinet reviews__review--answer">
		                      				<form method="POST" action="{{ route('cabinet.organization.reviews_edit', ['locale' => app()->getLocale()]) }}">
		                      					{{ csrf_field() }}
		                      					<input type="hidden" name="id" value="{{ $feedOrg->id }}">
	                        					<div class="reviews__top">
	                          						<div class="reviews__img">
	                            						<picture>
	                              							<img src="/img/commniter-avatar.png" width="50" height="51" alt="владелец">
	                            						</picture>
	                          						</div>
	                          						<div class="reviews__details">
	                            						<h6 class="reviews__author">
	                              							(владелец)
	                            						</h6>
	                            						<span class="reviews__time">
	                              							{{ date('d.m.Y', $feedOrg->time) }}
	                            						</span>
	                          						</div>
	                        					</div>
	                        					<div class="reviews__main">
	                          						<p>
							                            {{ $feedOrg->text }}
	                          						</p>
	                          						<textarea name="text" class="textarea" style="display: none;">
	                          							{{ $feedOrg->text }}
	                          						</textarea>
	                        					</div>
	                        					<div class="reviews__footer">
	                         						<button type="button" class="button reviews__answer reviews__answer--edit">
	                            						<svg width="19" height="15">
	                              							<use xlink:href="#icon-pen"></use>
	                            						</svg>
	                            						Редактировать
	                          						</button>
	                          						<button type="submit" class="disabled button button--save button--green" style="display: none;">
														<svg width="20" height="21">
															<use xlink:href="#icon-save"></use>
														</svg>
														Сохранить
													</button>
													<a href="{{ route('cabinet.organization.reviewsDelete', App::getLocale()) }}?id={{ $feedOrg->id }}">
		                          						<span class="button button--cancel">
		                            						Удалить
		                          						</span>
		                          					</a>
	                        					</div>
                                                <button type="submit" class="button disabled button--cabinet-submit button--save button--green button--fixed show-mobile">
                                                    <svg width="20" height="21">
                                                        <use xlink:href="#icon-save"></use>
                                                    </svg>
                                                    Сохранить
                                                </button>
	                        				</form>
                      					</article>
                  					@endforeach
	                    		</li>
                    		@endforeach
                  		</ul>
                  		<!-- <p class="reviews__all">
                    		<a href="#">
                      			Смотреть все отзывы
                   			</a>
                  		</p> -->

                	</section>
              	</div>
	      	</div>
		</div>
	</section>

@endsection
