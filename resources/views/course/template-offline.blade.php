@foreach($data as $list)
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
      				{{ Rate::getRateForCourse($list->id) }}
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
        					}elseif($list->group_info == 2){
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
                        @if($list->sale != 0 AND $list->sale < $list->price_course)
                            {{ $list->sale }}
                        @else
                            {{ $list->price_course }}
                        @endif
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
                        @if($list->sale != 0 AND $list->sale < $list->price_course)
                            <span class="product__sale">
                                {{ Course::getSaleCourse($list->id) }}%
                            </span>
                        @endif
      				</p>
    			</div>
  			</div>
  			<div class="product__actions">
                @guest
                    <a href="javascript:void(0);" class="like like-small {{ (isset($_COOKIE['Like-course-'.$list->id]))? 'like--active' : 'add_favorite' }} favorite_{{ $list->id }} " aria-label="Добавить в избранное" data-favorit="{{ $list->id }}" data-type="course">
                @else
                    <a href="javascript:void(0);" class="like like-small favorite_{{ $list->id }} {{ (Favorite::checkAuth($list->id) != 'no')? 'like--active favorite_true_' . Favorite::checkAuth($list->id) : '' }} like-favorite {{ (Favorite::checkAuth($list->id) != 'no')? 'action_delete' : 'action_add' }}" aria-label="Добавить в избранное" data-action="{{ (Favorite::checkAuth($list->id) != 'no')? 'delete' : 'add' }}" data-id="{{ $list->id }}" data-like="{{ Favorite::checkAuth($list->id) }}" data-lang="{{ App::getLocale() }}">
                        <span class="data-like-{{ $list->id }}" style="display: none;">{{ Favorite::checkAuth($list->id) }}</span>
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