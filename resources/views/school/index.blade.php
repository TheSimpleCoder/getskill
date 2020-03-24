
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
            		@if(count($files) > 0)
                		<section class="curse-gallery about-curse__item">
                  			<div class="curse-gallery__slider">
                                @foreach($files as $file)
                        			<div class="curse-gallery__item">
										<a href="{{ $file->img }}" data-fancybox="school" class="curse-gallery__item-link">
											<img src="{{ $file->img }}" width="214" height="214" alt="Фотографии из курса">
										</a>
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
                    @if($org->desc_ru OR $org->desc_ua)
	            		<section class="about-curse__description about-curse__item">
	              			<h2 class="h2">
	                			{{ (App::isLocale('ru'))? 'Описание' : 'Опис' }}
	              			</h2>
	              			<p>
	                			{!! (App::isLocale('ru'))? $org->desc_ru : $org->desc_ua !!}
	              			</p>
	            		</section>
            		@endif
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
	                    					@if($filia->email)
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
		                      				@endif
	                      					<ul class="social__list">
	                      						<?php
	                      							$messangers = explode(',', $filia->messanger);
	                      							foreach ($messangers as $value) {
	                      								if($value == ''){
	                      									continue;
	                      								}

	                      								$messanger = explode(':', $value, 2);

	                      								//if(isset($messanger[1])){
	                      									//continue;
	                      								//}

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

	                      								if(!isset($messanger[2])){
	                      									$messanger[2] = '';
	                      								}
	                      								?>
	                      									<li class="social__item">
				                          						<a href="{{ $messanger[1] }}" target="_blank" class="social__link social__link--circle" aria-label="Мы в вайбер">
				                            						<svg width="18" height="19">
				                              							<use xlink:href="#{{ (isset($icon))? $icon : '' }}"></use>
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
                		</div>
            		</section>
          		</div>
            	@include('school.right', ['some' => 'data'])
          	</div>
        </div>
    </section>

@endsection