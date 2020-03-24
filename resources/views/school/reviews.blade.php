<?php
$title = (App::isLocale('ru'))? $org->name_ru : $org->name_ua;
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')

	<section class="about-curse">
      	<div class="about-curse__inner container">
        	<div class="about-curse__row">
          		<div class="about-curse__left">
				  <h2 class="about-curse__name h2 h2--school">
                    {{ (App::isLocale('ru'))? $org->name_ru : $org->name_ua }}
                  </h2>
            		@include('school.menu', ['some' => 'data'])
            		<section class="reviews about-curse__item">
          				<div class="reviews__info">
            				<h2 class="h2">
              					{{ (App::isLocale('ru'))? 'Отзывы' : 'Відгуки' }}
            				</h2>
            				<p class="reviews__count">
              					{{ $reviews->count() }}
            				</p>
          				</div>
                        @if(!Auth::guest())
                            <span class="button reviews__write-reviews">
                                {{ (App::isLocale('ru'))? 'Написать отзыв' : 'Написати відгук' }}
                            </span>
                        @else
                            <p class="reviews__not-reviews">
                                {{ (App::isLocale('ru'))? 'Только зарегистрированные пользователи могут оставить отзыв, пожалуйста' : 'Тільки зареєстровані користувачі можуть залишити відгук, будь ласка' }}
                                <a href="{{ '/' . App::getLocale() . '/login' }}" class="link">
                                    {{ (App::isLocale('ru'))? 'войдите' : 'ввійдіть' }}
                                </a>
                                в&nbsp;{{ (App::isLocale('ru'))? 'аккаунт или' : 'акаунт або' }}
                                <a href="{{ route('register-person', app()->getLocale()) }}" class="link">
                                    {{ (App::isLocale('ru'))? 'зарегистрируйтесь' : 'зареєструйтеся' }}.
                                </a>
                            </p>
                        @endif
          				<ul class="reviews__list">
          					@foreach($reviews->get() as $r)
                				<li class="reviews__item">
                  					<article class="reviews__review">
                    					<div class="reviews__top">
                      						<div class="reviews__img">
                        						<picture>
                          							<img src="{{ $r->user_avatar }}" width="50" height="51" alt="{{ $r->user_name }}">
                        						</picture>
                      						</div>
                      						<div class="reviews__details">
                        						<h6 class="reviews__author">
                          							{{ $r->user_name }}
                        						</h6>
                        						<div class="reviews__rating rating">
                        							<?php
                        								for ($i=0; $i < 5; $i++) { 
                        									?>
                        										@if($i < $r->star)
                        											<div class="rating__star rating__star--active">
                        										@else
                        											<div class="rating__star">
                        										@endif
    		                            							<svg width="13" height="13">
    		                              								<use xlink:href="#icon-rationg-star"></use>
    		                            							</svg>
    		                          							</div>
                        									<?php
                        								}
                        							?>
                        						</div>
                        						<span class="reviews__time">
                          							{{ date('d.m.Y', $r->time) }}
                        						</span>
                      						</div>
    						                    <!-- this div have extra classes "reviews__option-wrap--open"
    						                        
    						                        <div class="reviews__option-wrap reviews__option-wrap--open">
    						                    -->
                      						<div class="reviews__option-wrap ">
                        						<button type="button" class="reviews__options" aria-label="Дополнительние действия">
                          							<span class="reviews__options-circle"></span>
                          							<span class="reviews__options-circle"></span>
                          							<span class="reviews__options-circle"></span>
                        						</button>

												<div class="reviews__option-dropdown ">
														<a class="reviews__report popup-call" lnk="{{ route('course_add_review_complain', ['locale' => app()->getLocale()]) }}?id={{ $r->id }}">
															{{ (App::isLocale('ru'))? 'Пожаловатся' : 'Поскаржитися' }}
														</a>
	                        						</div>
                      						</div>
                    					</div>
                    					<div class="reviews__main">
                      						<p>
    					                        {{ $r->text }}
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
                                                    <input type="hidden" name="course" value="{{ $r->course_id }}">
                                                    <input type="hidden" name="parent" value="{{ $r->id }}">
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
                                        @foreach(Rate::getFeedbackAll($r->id) as $feed)
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
                                                <!-- <div class="reviews__footer">
                                                    <a href="#" class="button reviews__answer">
                                                        <svg width="19" height="15">
                                                            <use xlink:href="#icon-arrow-rewies"></use>
                                                        </svg>
                                                        Ответить
                                                    </a>
                                                </div> -->
                                            </article>
                                        @endforeach
                  					</article>
                				</li>
            				@endforeach
          				</ul>
          				<p class="reviews__all" style="display: none;">
            				<a href="#">
              					{{ (App::isLocale('ru'))? 'Смотреть все отзывы' : 'Дивитися всі відгуки' }}
            				</a>
          				</p>

          				<div class="reviews__new-write">
          					<form method="POST" action="{{ route('course_add_review', ['locale' => app()->getLocale()]) }}">
          						{{ csrf_field() }}
          						<input type="hidden" name="course" value="0">
          						<input type="hidden" name="organization" value="{{ $org->id }}">
          						<input type="hidden" name="parent_id">
                				<div class="reviews__rating rating">
                    				<p class="rating__title">{{ (App::isLocale('ru'))? 'Поставьте рейтинг курсу' : 'Поставте рейтинг курсу' }}</p>
                    				<div class="rating-use__group">
                                        <input type="radio" class="rating-user__input visually-hidden" id="rating_1" name="star" value="1">
                                        <label for="rating_1" class="rating-user__star" aria-label="Ужасно"></label>
                                        <input type="radio" class="rating-user__input visually-hidden" id="rating_2" name="star" value="2">
                                        <label for="rating_2" class="rating-user__star" aria-label="Может быть"></label>
                                        <input type="radio" class="rating-user__input visually-hidden" id="rating_3" name="star" value="3">
                                        <label for="rating_3" class="rating-user__star" aria-label="Нормально"></label>
                                        <input type="radio" class="rating-user__input visually-hidden" id="rating_4" name="star" value="4">
                                        <label for="rating_4" class="rating-user__star" aria-label="Хорошо"></label>
                                        <input type="radio" class="rating-user__input visually-hidden" id="rating_5" name="star" value="5">
                                        <label for="rating_5" class="rating-user__star" aria-label="Отлично"></label>
                                    </div>

                				</div>

                				<div class="new-write__text">
                  					<label class="new-write__text__title">{{ (App::isLocale('ru'))? 'Комментарий' : 'Коментар' }}</label>
                  					<textarea name="text" id="new-write-reviews" class="input input--full-width input--textarea"></textarea>
                				</div>
                				<div class="new-write__text__button">
                  					<span class="button button--cancel">
                   						{{ (App::isLocale('ru'))? 'Отменить' : 'Скасувати' }}
                  					</span>
                  					<button type="submit" class="button button--feedback">
                  						{{ (App::isLocale('ru'))? 'Оставить отзыв' : 'Залишити відгук' }}
                  					</button>
                				</div>
                			</form>
          				</div>
        			</section>
          		</div>
            	@include('school.right', ['some' => 'data'])
          	</div>
        </div>
    </section>
<section class="popup" id="report">
  <div class="popup__content">
    <h6 class="h6 popup__title">
      Пожаловаться
    </h6>
    <div class="popup__info">
      <p>
        Мы рассматриваем только жалобы на отзывы, нарушающие правила сайта в
        <br>
        отношении контента. На это может потребоваться время. Не отправляйте
        <br>
        жалобу повторно.
      </p>
      <p>
        Отзывы, которые не нарушают правила сайта, удалены не будут
      </p>
    </div>
    <div class="popup__send-control">
      <a href="#" id="lnktorep"><button type="button" class="button popup__send">
        Отправить
      </button></a>
      <button type="button" class="popup__cancel">
        Отмена
      </button>
    </div>
  </div>
</section>
@endsection