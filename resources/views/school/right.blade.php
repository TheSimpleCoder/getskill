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
  							{{ Rate::getRateSchool($org->id) }}
						</div>
						<div class="rating school__rating-stars">
		  					<div class="rating__star {{ (Rate::getRateSchool($org->id) >= 1)? 'rating__star--active' : '' }}">
            					<svg width="17" height="15">
              						<use xlink:href="#icon-rationg-star"></use>
            					</svg>
          					</div>
          					<div class="rating__star {{ (Rate::getRateSchool($org->id) >= 2)? 'rating__star--active' : '' }}">
            					<svg width="17" height="15">
              						<use xlink:href="#icon-rationg-star"></use>
            					</svg>
          					</div>
          					<div class="rating__star {{ (Rate::getRateSchool($org->id) >= 3)? 'rating__star--active' : '' }}">
            					<svg width="17" height="15">
              						<use xlink:href="#icon-rationg-star"></use>
            					</svg>
          					</div>
          					<div class="rating__star {{ (Rate::getRateSchool($org->id) >= 4)? 'rating__star--active' : '' }}">
            					<svg width="17" height="15">
              						<use xlink:href="#icon-rationg-star"></use>
            					</svg>
          					</div>
          					<div class="rating__star {{ (Rate::getRateSchool($org->id) >= 5)? 'rating__star--active' : '' }}">
            					<svg width="17" height="15">
              						<use xlink:href="#icon-rationg-star"></use>
            					</svg>
          					</div>
						</div>
						<p class="school__reviews-count">
  							{{ $reviews->count() }}
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
					<span class="button__all-numbers" data-user="{{ $org->user_id }}" data-type="organization" data-course="{{ $org->id }}">+38 *** *** ** ** <i>{{ (App::isLocale('ru'))? 'показать' : 'показати' }}</i></span>
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
	</div>
</aside>