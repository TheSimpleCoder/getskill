@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')
	<section class="about-curse">
      	<div class="about-curse__inner container">
        	<div class="about-curse__row">
          		<div class="about-curse__left">
            		<section class="about-curse__short-info">
              			<h2 class="about-curse__name h2">
                			{{ (App::isLocale('ru'))? $course->name_ru : $course->name_ua }}
              			</h2>
              			<div class="about-curse__price">
                			<p class="about-curse__price-label">
                				<?php
                					switch ($course->od) {
                						case 1:
                							echo 'курс:';
                							break;
                						case 2:
                							echo (App::isLocale('ru'))? 'час:' : 'година:';
                							break;
                						case 3:
                							echo (App::isLocale('ru'))? 'занятие:' : 'заняття:';
                							break;
                					}
                				?>
                			</p>
                			<p class="about-curse__price__sum price__sum--active-discount">
                				<?php
                					switch ($course->currency) {
                						case 1:
                							$currency = 'грн';
                							break;
                						case 2:
                							$currency = '$';
                							break;
                						case 3:
                							$currency = '€';
                							break;
                					}
                				?>
                  				{{ $course->price }} {{ $currency }}
                  				<!-- <span class="price__sum__discount">-5%</span> -->
                			</p>
              			</div>
              			<div class="about-curse__short-info-service">
                			<p class="about-curse__views">
                  				<svg width="23" height="15">
                    				<use xlink:href="#icon-eye"></use>
                  				</svg>
                  				{{ $course->view }} {{ (App::isLocale('ru'))? 'просмотров' : 'переглядiв' }}
                			</p>
                			<div class="about-curse__like">
                  				@guest
                                    <a href="javascript:void(0);" class="like like-text like-small {{ (isset($_COOKIE['Like-master-'.$course->id]))? 'like--active' : 'add_favorite' }} favorite_{{ $course->id }} " aria-label="Добавить в избранное" data-favorit="{{ $course->id }}" data-type="master" data-lang="{{ App::getLocale() }}">
                                @else
                                    <a href="javascript:void(0);" class="like like-small favorite_{{ $course->id }} {{ (Favorite::checkAuthMaster($course->id) != 'no')? 'like--active favorite_true_' . Favorite::checkAuthMaster($course->id) : '' }} like-favorite {{ (Favorite::checkAuthMaster($course->id) != 'no')? 'action_delete' : 'action_add' }}" aria-label="Добавить в избранное" data-action="{{ (Favorite::checkAuthMaster($course->id) != 'no')? 'delete' : 'add' }}" data-id="{{ $course->id }}" data-like="{{ Favorite::checkAuthMaster($course->id) }}" data-lang="{{ App::getLocale() }}" data-type="master">
                                        <span class="data-like-{{ $course->id }}" style="display: none;">{{ Favorite::checkAuthMaster($course->id) }}</span>
                                @endguest
                    				<svg width="23" height="21">
                      					<use xlink:href="#icon-like"></use>
                    				</svg>
              					</a>
              					<p class="fav-info">
                                    @if(!Auth::guest())
                                        {{ (Favorite::checkAuth($course->id) != 'no')? (App::isLocale('ru'))? 'В избранном' : 'В обраному' : 'Добавить в избрное' }}
                                    @else
                                        @if(App::isLocale('ru'))
                                            {{ (isset($_COOKIE['Like-master-'.$course->id]))? 'В избранном' : 'Добавить в избрное' }}
                                        @else
                                            {{ (isset($_COOKIE['Like-master-'.$course->id]))? 'В обраному' : 'Додати до обраного' }}
                                        @endif
                                    @endif
                                </p>
                			</div>
              			</div>
            		</section>
            		<div class="about-curse__info about-curse__item">
              			<div class="about-curse__info-item">
                			<p class="about-curse__info-label">
                  				Тип {{ (App::isLocale('ru'))? 'мастер-класса' : 'мастер-класу' }}:
                			</p>
                			<p class="about-curse__info-value">
                				@if($course->type == 1)
                  					офлайн
                  				@else
                  					онлайн
                  				@endif
                			</p>
              			</div>
              			<div class="about-curse__info-item">
                			<p class="about-curse__info-label">
                  				{{ (App::isLocale('ru'))? 'Дата' : 'дата' }}:
                			</p>
                			<p class="about-curse__info-value">
                				{{ date('d.m.Y', $course->date) }}
                			</p>
              			</div>
              			<div class="about-curse__info-item">
                			<p class="about-curse__info-label">
                  				{{ (App::isLocale('ru'))? 'По окончанию выдаеться' : 'По закінченню видаеться' }}:
                			</p>
                			<p class="about-curse__info-value">
                				<?php
                					switch ($course->finish) {
                						case 1:
                							$cert = (App::isLocale('ru'))? 'сертификат' : 'сертифiкат';
                							break;
                						case 2:
                							$cert = 'диплом';
                							break;
                						case 3:
                							$cert = (App::isLocale('ru'))? 'ничего' : 'нiчього';
                							break;
                					}
                				?>
                				{{ $cert }}
                			</p>
              			</div>
              			<!-- <div class="about-curse__info-item">
                			<p class="about-curse__info-label">
                  				{{ (App::isLocale('ru'))? 'Пробное занятие' : 'Пробне заняття' }}:
                			</p>
                			<p class="about-curse__info-value">
                				@if($course->test_train == 1)
                					{{ (App::isLocale('ru'))? 'нет' : 'нi' }}
                  				@else
                  					{{ (App::isLocale('ru'))? 'да' : 'так' }}
                  				@endif
                			</p>
              			</div> -->
            		</div>
            		@if(count($files) > 0)
                        <section class="curse-gallery about-curse__item">
                            <h2 class="h2">
                                Галерея
                            </h2>
                            <div class="curse-gallery__slider">
                                @foreach($files as $file)
                                    <div class="curse-gallery__item">
                                        <picture>
                                            <img src="{{ $file->img }}" width="214" height="214" alt="Фотографии из курса">
                                        </picture>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="curse-gallery__arrow curse-gallery__arrow--prev" aria-label="Назад">
                                <svg width="11" height="20">
                                    <use xlink:href="#icon-arrow-left"></use>
                                </svg>
                            </button>
                            <button type="button" class="curse-gallery__arrow curse-gallery__arrow--next" aria-label="Вперед">
                                <svg width="11" height="20">
                                    <use xlink:href="#icon-arrow-right"></use>
                                </svg>
                            </button>
                        </section>
                    @endif
                    @if($course->desc_ru  OR $course->desc_ua)
                		<section class="about-curse__description about-curse__item">
                  			<h2>
                    			{{ (App::isLocale('ru'))? 'Описание' : 'Опис' }}
                  			</h2>
                  			<p>
                   				{{ (App::isLocale('ru'))? $course->desc_ru : $course->desc_ua }}
                  			</p>
                		</section>
                    @endif
                    @if($prepod)
                		<section class="about-curse__teachers about-curse__item">
                  			<h2 class="h2">
                   				{{ (App::isLocale('ru'))? 'Преподователи' : 'Викладачі' }}
                  			</h2>
                  			@foreach($prepod as $p)
    	              			<div class="about-curse__teacher">
    	                			<div class="about-curse__teacher__img">
    	                  				<picture>
    	                    				<img src="{{ $p->img }}" alt="{{ (App::isLocale('ru'))? $p->name_ru : $p->name_ua }}">
    	                  				</picture>
    	                			</div>
    	                			<div class="about-curse__teacher-info-block">
    	                  				<p class="about-curse__teacher-name">
    	                    				{{ (App::isLocale('ru'))? $p->name_ru : $p->name_ua }}
    	                  				</p>
    	                  				<p class="about-curse__teacher-text">
    	                    				{{ (App::isLocale('ru'))? $p->desc_ru : $p->desc_ua }}
    	                  				</p>
    	                			</div>
    	              			</div>
                  			@endforeach
                		</section>
                    @endif
            		<!-- <section class="about-curse__consultation about-curse__item">
              			<form action="consultation.php" method="post">
                			<h2 class="h2">
                  				{{ (App::isLocale('ru'))? 'Получить консультацию' : 'Отримати консультацію' }}
                			</h2>
                			<p class="about-curse__consultation-item">
                  				<label for="consultation_name" class="label">
                    				{{ (App::isLocale('ru'))? 'Имя' : 'Iм`я' }}
                  				</label>
                  				<input type="text" name="consultation_name" class="input input--full-width" id="consultation_name">
                			</p>
                			<p class="about-curse__consultation-item">
                  				<label for="consultation_phone" class="label">
                    				Телефон
                  				</label>
                  				<input type="tel" name="consultation_phone" class="input input--full-width" id="consultation_phone" placeholder="+38 _ _ _ - _ _ _ - _ _ - _ _">
                			</p>
               				<p class="about-curse__consultation-item about-curse__consultation-item--submit">
                  				<button type="submit" class="button button--cabinet-submit about-curse__consultation-submit">
                    				<svg width="22" height="22">
                      					<use xlink:href="#icon-telegram-full"></use>
                    				</svg>
                    				{{ (App::isLocale('ru'))? 'Узнать подробнее' : 'Дізнатись детальніше' }}
                  				</button>
                			</p>
                			<div class="about-curse__consultation-text">
                  				<p>
                  					@if(App::isLocale('ru'))
                  						После отправки заявки с Вами
					                    свяжется представитель школы и
					                    проконсультирует Вас по даному
					                    курсу.
                  					@else
										Після відправки заявки з Вами
										зв'яжеться представник школи і
										проконсультує Вас з даного
										курсу.
                  					@endif
                  				</p>
                 				<p>
                 					{{ (App::isLocale('ru'))? 'Заявка Вас ни к чему не обязывает!' : 'Заявка Вас ні до чого не зобов`язує!' }}
                  				</p>
                			</div>
              			</form>
            		</section> -->
            		<section class="contacts about-curse__item">
              			<h2 class="h2">
              				{{ (App::isLocale('ru'))? 'Контакты' : 'Контакти' }}
              			</h2>
              			<div class="contacts__accordion accordion">
              				@foreach($filias as $f)
              					<?php $filia = $f['filia']; ?>
	                			<div class="accordion__item accordion__item--hidden">
	                  				<button type="button" class="accordion__toggle">
	                    				<svg width="16" height="21" class="accordion__icon-design">
	                      					<use xlink:href="#icon-location"></use>
	                    				</svg>
	                    				<span class="accordion__title">
	                    					{{ $f['city'] }}, {{ $filia->address }}
	                  					</span>
	                    				<svg width="14" height="7" class="accordion__icon-arrow">
	                      					<use xlink:href="#icon-arrow"></use>
	                    				</svg>
	                  				</button>
	                  				<div class="accordion__body contacts__accordion-body">
	                   					<ul class="contacts__list">
	                   						<?php
	                   							$phones = explode(',', $filia->phones);
	                   						?>
	                   						@foreach($phones as $phone)
	                   							@if($phone != '')
			                      					<li>
			                        					<svg width="21" height="21">
			                        						<use xlink:href="#icon-phone"></use>
			                        					</svg>
			                        					<a href="tel:{{ $phone }}">
			                         						{{ $phone }}
			                        					</a>
			                     					</li>
		                     					@endif
		                     				@endforeach
	                    				</ul>
	                    				<div class="social contacts__social">
	                      					<ul class="social__mail">
	                        					<li>
	                            					<svg width="21" height="21">
	                              						<use xlink:href="#icon-email"></use>
	                            					</svg>
	                            					<a href="mailto:{{ $filia->email }}">
	                              						{{ $filia->email }}
	                            					</a>
	                          					</li>
	                      					</ul>
	                      					<ul class="social__list">
	                      						<?php
	                      							$messangers = explode(',', $filia->messanger);
	                      							foreach ($messangers as $value) {
	                      								if($value == ''){
	                      									continue;
	                      								}

	                      								$messanger = explode(':', $value);

	                      								switch ($messanger[0]) {
	                      									case 'Telegram':
	                      										$icon = 'icon-telegram';
	                      										break;
	                      									case 'Viber':
	                      										$icon = 'icon-viber-social';
	                      										break;
	                      									case 'WhatsApp':
	                      										$icon = 'icon-social-whatsapp';
	                      										break;
	                      									case 'Instagram':
	                      										$icon = 'icon-contacts-social-insta';
	                      										break;
	                      									case 'Facebook':
	                      										$icon = 'icon-facebook-social';
	                      										break;
	                      									case 'YouTube':
	                      										$icon = 'icon-youtube';
	                      										break;
	                      								}

	                      								?>
	                      									<li class="social__item">
				                          						<a href="{{ $messanger[1] }}" class="social__link social__link--circle" aria-label="Мы в вайбер">
				                            						<svg width="18" height="19">
				                              							<use xlink:href="#{{ $icon }}"></use>
				                            						</svg>
				                          						</a>
				                        					</li>
	                      								<?php
	                      							}
	                      						?>
	                      					</ul>
	                    				</div>
	                  				</div>
	                			</div>
                			@endforeach
            			</section>
            			<!-- <section class="reviews about-curse__item">
              				<div class="reviews__info">
                				<h2 class="h2">
                  					{{ (App::isLocale('ru'))? 'Отзывы' : 'Відгуки' }}
                				</h2>
                				<p class="reviews__count">
                  					{{ $reviews->count() }}
                				</p>
                				<span class="button reviews__write-reviews">
                  					{{ (App::isLocale('ru'))? 'Написать отзыв' : 'Написати відгук' }}
                				</span>
              				</div>
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
	                        										@if($i <= $r->star)
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
	                      						<div class="reviews__option-wrap ">
	                        						<button type="button" class="reviews__options" aria-label="Дополнительние действия">
	                          							<span class="reviews__options-circle"></span>
	                          							<span class="reviews__options-circle"></span>
	                          							<span class="reviews__options-circle"></span>
	                        						</button>
	                        						<div class="reviews__option-dropdown ">
	                          							<span class="reviews__report">
	                          								<a href="{{ route('course_add_review_complain', ['locale' => app()->getLocale()]) }}?id={{ $r->id }}">
	                          									{{ (App::isLocale('ru'))? 'Пожаловатся' : 'Поскаржитися' }}
	                          								</a>
	                          							</span>
	                        						</div>
	                      						</div>
	                    					</div>
	                    					<div class="reviews__main">
	                      						<p>
							                        {{ $r->text }}
	                      						</p>
	                    					</div>
	                    					<div class="reviews__footer">
	                      						<a href="#" class="button reviews__answer">
	                        						<svg width="19" height="15">
	                          							<use xlink:href="#icon-arrow-rewies"></use>
	                        						</svg>
	                        						{{ (App::isLocale('ru'))? 'Ответить' : 'Відповісти' }}
	                      						</a>
	                    					</div>
	                  					</article>
	                				</li>
                				@endforeach
              				</ul>
              				<p class="reviews__all">
                				<a href="#">
                  					{{ (App::isLocale('ru'))? 'Смотреть все отзывы' : 'Дивитися всі відгуки' }}
                				</a>
              				</p>

              				<div class="reviews__new-write">
              					<form method="POST" action="{{ route('course_add_review', ['locale' => app()->getLocale()]) }}">
              						{{ csrf_field() }}
              						<input type="hidden" name="course" value="{{ $course->id }}">
              						<input type="hidden" name="organization" value="{{ $org->id }}">
              						<input type="hidden" name="parent_id">
              						<input type="hidden" name="star" value="5">
	                				<div class="reviews__rating rating">
	                    				<p class="rating__title">{{ (App::isLocale('ru'))? 'Поставьте рейтинг курсу' : 'Поставте рейтинг курсу' }}</p>
	                    				<div class="rating__star rating__star--active">
	                      					<svg width="16.5" height="15">&gt;
	                        					<use xlink:href="#icon-rationg-star"></use>
	                      					</svg>
	                    				</div>
	                    				<div class="rating__star rating__star">
	                      					<svg width="16.5" height="15">
	                        					<use xlink:href="#icon-rationg-star"></use>
	                      					</svg>
	                    				</div>
	                    				<div class="rating__star rating__star">
	                      					<svg width="16.5" height="15">&gt;
	                        					<use xlink:href="#icon-rationg-star"></use>
	                      					</svg>
	                    				</div>
	                    				<div class="rating__star rating__star">
	                      					<svg width="16.5" height="15">&gt;
	                        					<use xlink:href="#icon-rationg-star"></use>
	                      					</svg>
	                    				</div>
	                    				<div class="rating__star rating__star">
	                      					<svg width="16.5" height="15">&gt;
	                        					<use xlink:href="#icon-rationg-star"></use>
	                      					</svg>
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
            			</section> -->
          			</div>
            		<aside class="another-curse">
              			<div class="about-curse__right">
                  			<div class="school">
                    
                    			<div class="school__about-this-curse">
                      				<span class="popup__button-close"></span>

                      				<div class="school__logo">
                        			<a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $org->id]) }}" class="school__img">
                          				<picture>
                            				<img src="{{ $org->url_logo }}" width="244" height="125" alt="{{ (App::isLocale('ru'))? $org->name_ru : $org->name_ua }}">
                          				</picture>
                        			</a>
                      
                      				<p class="school__name">
                        				<a href="{{ route('school_description', ['locale' => app()->getLocale(), 'id' => $org->id]) }}">
                          					{{ (App::isLocale('ru'))? $org->name_ru : $org->name_ua }}
                        				</a>
                      				</p>
                      				<div class="school__rating">
                        				<div class="school__rating-status">
                          					5.00
                        				</div>
                        				<div class="rating school__rating-stars">
                          					<div class="rating__star rating__star--active">
                            					<svg width="17" height="15">
                              						<use xlink:href="#icon-rationg-star"></use>
                            					</svg>
                          					</div>
                          					<div class="rating__star rating__star--active">
                            					<svg width="17" height="15">
                              						<use xlink:href="#icon-rationg-star"></use>
                            					</svg>
                          					</div>
                          					<div class="rating__star rating__star--active">
                            					<svg width="17" height="15">
                              						<use xlink:href="#icon-rationg-star"></use>
                            					</svg>
                          					</div>
                          					<div class="rating__star rating__star--active">
                            					<svg width="17" height="15">
                              						<use xlink:href="#icon-rationg-star"></use>
                            					</svg>
                          					</div>
                          					<div class="rating__star">
                            					<svg width="17" height="15">
                              						<use xlink:href="#icon-rationg-star"></use>
                            					</svg>
                          					</div>
                        				</div>
                        				<p class="school__reviews-count">
                          					76
                        				</p>
                        			</div>
                      			</div>
                      			<ul class="school__list-contacts">
                      				@if($org->site_link)
		                    			<li>
		                      				<svg width="21" height="21">
		                        				<use xlink:href="#icon-earth"></use>
		                      				</svg>
		                      				<a href="{{ $org->site_link }}">
		                        				{{ $org->site_link }}
		                      				</a>
		                    			</li>
                        			@endif
                        			@foreach($filias as $ff)
              							<?php $filia = $ff['filia']; ?>
	                        			<li>
	                          				<svg width="16" height="21">
	                            				<use xlink:href="#icon-location"></use>
	                          				</svg>
	              							<a href="#" target="_blank">
	                							{{ $ff['city'] }}, {{ $filia->address }}
	              							</a>
	                        			</li>
                        			@endforeach
                      			</ul>
                    		</div>

                    		<div class="school__fixed-block">
                      			<span class="button__show-about-curse">{{ (App::isLocale('ru'))? 'Об организации' : 'Про організацію' }}</span>

                      			<div class="school__what-numbers">
                        
                        			<span class="button__all-numbers" data-user="{{ $course->user_id }}" data-type="master" data-course="{{ $course->id }}">+38 *** *** ** ** <i>{{ (App::isLocale('ru'))? 'показать' : 'показати' }}</i></span>
                          			<!-- if click "button__all-numbers" this bottom state two classes - "tabs__item--open" or "tabs__item--hidden"  -->
                        			<div class="popup__all-numbers">
                          				<span class="popup__button-close"></span>
                          				@foreach($filias as $ff)
              								<?php $filia = $ff['filia']; ?>
	                      					<div class="all-numbers all-numbers__location">
	                        					<p>{{ $ff['city'] }}, {{ $filia->address }}</p>
	                    						<ul class="contacts__list">
	                    							<?php
			                   							$phones = explode(',', $filia->phones);
			                   						?>
			                   						@foreach($phones as $phone)
			                   							@if($phone != '')
					                      					<li>
					                        					<a href="tel:{{ $phone }}">
					                         						{{ $phone }}
					                        					</a>
					                     					</li>
				                     					@endif
				                     				@endforeach
	                    						</ul>
	                      					</div>
	                      				@endforeach
                        			</div>
                      			</div>
                    		</div>
                  		</div>
              			<div class="another-curse__inner">
                			<p class="another-curs__title">
                  				{{ (App::isLocale('ru'))? 'Другие мастер-классы школы' : 'Інші мастер-класи школи' }}
                			</p>
                			<ul class="catalog__list catalog__list--vertical">
                  				@foreach($lists as $list)
			                        <li class="catalog__item">
			                            <article class="product">
			                                <div class="product__picture">
			                                    <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="product__img">
			                                        <img src="{{ $list->logo_course }}" width="280" height="155" alt="Курс по маникюру">
			                                    </a>
			                                </div>
			                                <div class="product__info-block">
			                                    <h6 class="product__name">
			                                        <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}">
			                                            {{ (App::isLocale('ru'))? $list->name_ru : $list->name_ua }}
			                                        </a>
			                                    </h6>
			                                    <p class="product__organization">
			                                        {{ Organization::getName($list->organization_id) }}
			                                    </p>
			                                    <div class="product__cities">
			                                        <svg width="11" height="16">
			                                            <use xlink:href="#icon-location"></use>
			                                        </svg>
			                                        <p>
			                                            {{ Filia::gatNameRegionForCourse($list->regions) }}
			                                        </p>
			                                        <p class="product__cities__more">
			                                            <a href="#">
			                                                {{ Filia::getCountRegionsCourse($list->regions) }}
			                                            </a>
			                                        </p>
			                                    </div>
			                                    <div class="product__rating">
			                                        5.00
			                                        <svg width="17" height="15">
			                                            <use xlink:href="#icon-star"></use>
			                                        </svg>
			                                    </div>
			                                    <ul class="product__features">
			                                        <li>
			                                            <?php
			                                                if($list->finish == 1){
			                                                    echo '<svg width="12" height="15">
			                                                            <use xlink:href="#icon-medal"></use>
			                                                        </svg>';
			                                                    echo (App::isLocale('ru'))? 'Выдаеться сертификат' : 'Видається сертифікат';
			                                                }elseif($list->finish == 2){
			                                                    echo '<svg width="12" height="15">
			                                                            <use xlink:href="#icon-medal"></use>
			                                                        </svg>';
			                                                    echo (App::isLocale('ru'))? 'Выдаеться диплом' : 'Видається диплом';
			                                                }
			                                            ?>
			                                        </li>
			                                        <li>
			                                            <?php
			                                                if($list->group_info == 1){
			                                                    echo '<svg width="12" height="15">
			                                                            <use xlink:href="#icon-medal"></use>
			                                                        </svg>';
			                                                    echo (App::isLocale('ru'))? 'Индивидуально' : 'Індивідуально';
			                                                }elseif($list->finish == 2){
			                                                    echo '<svg width="12" height="15">
			                                                            <use xlink:href="#icon-medal"></use>
			                                                        </svg>';
			                                                    echo (App::isLocale('ru'))? 'Группой' : 'Групою';
			                                                }
			                                            ?>
			                                        </li>
			                                    </ul>
			                                    <div class="product__price">
			                                        <p class="product__label-price">
			                                            <?php
			                                                switch ($list->od) {
			                                                    case 1:
			                                                        echo "курс:";
			                                                        break;
			                                                    case 2:
			                                                        echo (App::isLocale('ru'))? 'час:' : 'година';
			                                                        break;
			                                                    case 3:
			                                                        echo (App::isLocale('ru'))? 'занятие:' : 'заняття';
			                                                        break;
			                                                }
			                                            ?>
			                                        </p>
			                                        <p class="product__sum">
			                                            {{ $list->price_course }}
			                                            <span>
			                                                <?php
			                                                    switch ($list->currency) {
			                                                        case 1:
			                                                            echo "грн.";
			                                                            break;
			                                                        case 2:
			                                                            echo "$";
			                                                            break;
			                                                        case 3:
			                                                            echo "€";
			                                                            break;
			                                                    }
			                                                ?>
			                                            </span>
			                                        </p>
			                                    </div>
			                                </div>
			                                <div class="product__actions">
			                                    @guest
			                                        <a href="javascript:void(0);" class="like like-small favorite_{{ $list->id }} " aria-label="Добавить в избранное">
			                                    @else
			                                        <a href="javascript:void(0);" class="like like-small favorite_{{ $list->id }} {{ (Favorite::checkAuthMaster($list->id) != 'no')? 'like--active favorite_true_' . Favorite::checkAuthMaster($list->id) : '' }} like-favorite {{ (Favorite::checkAuthMaster($list->id) != 'no')? 'action_delete' : 'action_add' }}" aria-label="Добавить в избранное" data-action="{{ (Favorite::checkAuthMaster($list->id) != 'no')? 'delete' : 'add' }}" data-id="{{ $list->id }}" data-like="{{ Favorite::checkAuthMaster($list->id) }}" data-lang="{{ App::getLocale() }}" data-type="master">
			                                            <span class="data-like-{{ $list->id }}" style="display: none;">{{ Favorite::checkAuthMaster($list->id) }}</span>
			                                    @endguest
			                                        <svg width="17" height="16">
			                                            <use xlink:href="#icon-like"></use>
			                                        </svg>
			                                    </a>
			                                    <a href="{{ route('course_page_info', ['locale' => app()->getLocale(), 'id' => $list->id]) }}" class="button product__buy">
			                                        Подробнее
			                                        <svg width="7" height="13">
			                                            <use xlink:href="#icon-arrow-right"></use>
			                                        </svg>
			                                    </a>
			                                </div>
			                            </article>
			                        </li>
			                    @endforeach
                			</ul>
                			<p class="catalog__all">
                  				<a href="#">
                    				{{ (App::isLocale('ru'))? 'Смотреть все' : 'Дивитися все' }}
                  				</a>
                			</p>
              			</div>
            		</div>
        		</aside>
          	</div>
        </div>
    </section>
@endsection