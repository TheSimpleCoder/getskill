<?php

$title = trans('cabinet/organization/payment.Title');
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)



@section('content')

<?php
    $public_key = 'sandbox_i41102551233';
    $private_key = 'sandbox_sk1TZ1FJxlxzzsBNiM4pr9538LRVkUh6hCDSZujO';
    $liqpay = new LiqPay($public_key, $private_key);
    $html = $liqpay->cnb_form(array(
        'action'         => 'pay',
        'amount'         => '1',
        'currency'       => 'UAH',
        'description'    => 'description text',
        'order_id'       => 'order_id_1',
        'version'        => '3'
    ));
?>


	<section class="cabinet">
		<div class="container cabinet__inner">
			@include('cabinet.organization.layouts.sidebar', ['some' => 'data'])

			<div class="cabinet__info-block">
          		<div class="tariff">
            		<div class="tariff__header">
              			<h2 class="h2">
                			{{ __('cabinet/organization/payment.Title') }}
              			</h2>
              			<p class="tariff__time-action" data-unix="@if(isset($current_pack)) {{ $current_pack->time }} @endif" data-type="@if(isset($current_pack)) {{ $current_pack->pack }} @endif" data-action="@if(isset($current_pack)) 1 @else 0 @endif" data-start="@if(isset($current_pack)) {{ $current_pack->by_time }} @endif">
                			Ваш тариф {{ Pack::getPack()['type'] }} {{ (Pack::getPack()['time'] == 'free')? '' : ' до ' . date('d.m.Y', Pack::getPack()['time']) }}
              			</p>
            		</div>
            		<div class="tariff__content">
              			<form action="{{ route('cabinet.organization.createPay', app()->getLocale()) }}" method="POST">
                            {{ csrf_field() }}
                			<div class="tariff__list">
                  				<input type="radio" name="tariff__plan" class="tariff__plan-input tariff__plan-input--base visually-hidden" value="0" id="tariff_plan_input_base" {{ (Pack::getPack()['pack'] == 1)? 'checked' : '' }}>
                  				<label for="tariff_plan_input_base" class="visually-hidden">
                    				{{ __('cabinet/organization/payment.Tarif_1') }}
                  				</label>
                  				<input type="radio" name="tariff__plan" class="tariff__plan-input tariff__plan-input--standard visually-hidden" value="300" id="tariff_plan_input_standard" {{ (Pack::getPack()['pack'] == 2)? 'checked' : '' }}>
                  				<label for="tariff_plan_input_standard" class="visually-hidden">
                    				{{ __('cabinet/organization/payment.Tarif_2') }}
                  				</label>
                  				<input type="radio" name="tariff__plan" class="tariff__plan-input tariff__plan-input--premium visually-hidden" value="900" id="tariff_plan_input_premium" {{ (Pack::getPack()['pack'] == 3)? 'checked' : '' }}>
                  				<label for="tariff_plan_input_premium" class="visually-hidden">
                    				{{ __('cabinet/organization/payment.Tarif_3') }}
                  				</label>
                  				<article class="tariff__item tariff__item--base" tabindex="0">
                    				<svg width="77" height="52">
                      					<use xlink:href="#icon-tarif-1"></use>
                    				</svg>
                    				<h2 class="h2">
                      					{{ __('cabinet/organization/payment.Tarif_1') }}
                    				</h2>
                    				<ul>
                      					<li>
                       						{{ __('cabinet/organization/payment.Info_1') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_2') }}
                      					</li>
                      					<li>
                        					{{ (App::isLocale('ru'))? 'Создание и редактирование' : 'Створення і редагування' }}
                      					</li>
                    				</ul>
                    				<p class="tariff__price">
                      					0
                      					<span class="tariff__currency">
                      						грн./{{ (App::isLocale('ru'))? 'мес' : 'мiс' }}
                    					</span>
                    				</p>
                  				</article>
                  				<article class="tariff__item tariff__item--standard" tabindex="0">
                    				<svg width="77" height="52">
                      					<use xlink:href="#icon-tarif-2"></use>
                    				</svg>
                    				<h2 class="h2">
                      					{{ __('cabinet/organization/payment.Tarif_2') }}
                    				</h2>
                    				<ul>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_3') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_4') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_5') }}
                        					<br>
                        					{{ __('cabinet/organization/payment.Info_6') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_7') }}
                      					</li>
                    				</ul>
                    				<p class="tariff__price">
                      					300
                      					<span class="tariff__currency">
                      						грн./{{ (App::isLocale('ru'))? 'мес' : 'мiс' }}
                    					</span>
                    				</p>
                  				</article>
                  				<article class="tariff__item tariff__item--premium" tabindex="0">
                    				<svg width="77" height="52">
                      					<use xlink:href="#icon-tarif-3"></use>
                    				</svg>
                    				<h2 class="h2">
                      					{{ __('cabinet/organization/payment.Tarif_3') }}
                    				</h2>
                    				<ul>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_8') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_9') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_10') }}
                      					</li>
                      					<li>
                        					{{ __('cabinet/organization/payment.Info_11') }}
                      					</li>
                    				</ul>
                    				<p class="tariff__price">
                      					900
                      					<span class="tariff__currency">
                     						грн./{{ (App::isLocale('ru'))? 'мес' : 'мiс' }}
                    					</span>
                    				</p>
                  				</article>
                			</div>
                			<div class="tariff__wrapper-time">
                  				<div class="tariff__wrapper-slider">
                    				<input type="radio" name="tariff_plan_m" class="visually-hidden tariff__plan-input tariff__plan-input--one-month" value="1" id="tariff_plan_one_month">
                    				<label for="tariff_plan_one_month" class="visually-hidden">
                      					1 {{ __('cabinet/organization/payment.Month') }}
                    				</label>
                    				<input type="radio" name="tariff_plan_m" class="visually-hidden tariff__plan-input tariff__plan-input--three-month" value="3" id="tariff_plan_three_month">
                    				<label for="tariff_plan_three_month" class="visually-hidden">
                      					3 {{ __('cabinet/organization/payment.Month') }}
                    				</label>
                    				<input type="radio" name="tariff_plan_m" class="visually-hidden tariff__plan-input tariff__plan-input--six-month" value="6" id="tariff_plan_six_month">
                    				<label for="tariff_plan_six_month" class="visually-hidden">
                      					6 {{ __('cabinet/organization/payment.Month') }}
                    				</label>
                    				<input type="radio" name="tariff_plan_m" class="visually-hidden tariff__plan-input tariff__plan-input--one-year" value="12" id="tariff_plan_one_years">
                    				<label for="tariff_plan_one_years" class="visually-hidden">
                      					1 {{ (App::isLocale('ru'))? 'год' : 'рiк' }}
                    				</label>
                    				<div class="tariff__plan">
                      					<div class="tariff__plan-element tariff__plan-element--one-month" tabindex="0">
                        					<div class="tariff__plan-top">
                          						<p class="tariff__plan-period">
                            						1 {{ __('cabinet/organization/payment.Month') }}
                          						</p>
                          						<div class="tariff__plan-icon">
                            						<svg width="18" height="13">
                              							<use xlink:href="#icon-cheked-green"></use>
                            						</svg>
                          						</div>
                        					</div>
                        					<p class="tariff__plan-price">
                          						<span class="price_1">0</span> грн.
                        					</p>
                      					</div>
                      					<div class="tariff__plan-element tariff__plan-element--three-month" tabindex="0">
                        					<div class="tariff__plan-top">
                          						<p class="tariff__plan-period">
                            						3 {{ __('cabinet/organization/payment.Month') }}
                          						</p>
                          						<div class="tariff__plan-icon">
                            						<svg width="18" height="13">
                              							<use xlink:href="#icon-cheked-green"></use>
                            						</svg>
                          						</div>
                        					</div>
                        					<p class="tariff__plan-price">
                          						<span class="price_2">0</span> грн.
                        					</p>
                      					</div>
                      					<div class="tariff__plan-element tariff__plan-element--six-month" tabindex="0">
                        					<div class="tariff__plan-top">
                          						<p class="tariff__plan-period">
                            						6 {{ __('cabinet/organization/payment.Month') }}
                          						</p>
                          						<div class="tariff__plan-icon">
                            						<svg width="18" height="13">
                              							<use xlink:href="#icon-cheked-green"></use>
                            						</svg>
                          						</div>
                        					</div>
                        					<p class="tariff__plan-price">
                      							<span>
                        							1 {{ __('cabinet/organization/payment.Month') }} {{ (App::isLocale('ru'))? 'в подарок' : 'у подарунок' }}
                      							</span>
                          						<span class="price_3">0</span> грн.
                        					</p>
                      					</div>
                      					<div class="tariff__plan-element tariff__plan-element--one-year" tabindex="0">
                        					<div class="tariff__plan-top">
                          						<p class="tariff__plan-period">
                            						1 {{ (App::isLocale('ru'))? 'год' : 'рiк' }}
                          						</p>
                          						<div class="tariff__plan-icon">
                            						<svg width="18" height="13">
                              							<use xlink:href="#icon-cheked-green"></use>
                            						</svg>
                          						</div>
                        					</div>
                        					<p class="tariff__plan-price">
                      							<span>
                        							2 {{ __('cabinet/organization/payment.Month') }} {{ (App::isLocale('ru'))? 'в подарок' : 'у подарунок' }}
                      							</span>
                          						<span class="price_4">0</span> грн.
                        					</p>
                      					</div>
                    				</div>
                    				<button type="button" class="tariff__plan-arrow tariff__plan-arrow--prev" aria-label="Назад">
                      					<svg width="11" height="20">
                        					<use xlink:href="#icon-tariff-arrow-left"></use>
                      					</svg>
                    				</button>
                    				<button type="button" class="tariff__plan-arrow tariff__plan-arrow--next" aria-label="Вперед">
                      					<svg width="11" height="20">
                        					<use xlink:href="#icon-tariff-arrow-right"></use>
                      					</svg>
                    				</button>
                  				</div>
                  				<div class="tariff__calculation">
                    				<p class="tariff__calculation-label">
                      					{{ (App::isLocale('ru'))? 'сумма' : 'сума' }}:
                    				</p>
                    				<p class="tariff__calculation-sum">
                      					<span class="sp-uah">0</span>
                                        <input type="hidden" name="summ" class="hidden-summ">
                      					<span>
                      						грн.
                    					</span>
                    				</p>
                                    <button type="submit" class="button button--cabinet-submit button--green tariff__submit-button">
                                        <svg width="19" height="20">
                                            <use xlink:href="#icon-cart"></use>
                                        </svg>
                                        {{ (App::isLocale('ru'))? 'Оформить' : 'Оформити' }}
                                        
                                    </button>
                  				</div>
                			</div>
              			</form>
            		</div>
          		</div>
          		<section class="bill tariff__bill">
            		<h6 class="bill__title">
              			{{ __('cabinet/organization/payment.Last_order') }}
            		</h6>
            		<ul class="bill__list">
                        @foreach($ret as $pay)
                  			<li class="bill__item">
                    			<div class="bill__content bill__content--success">
                      				<div class="bill__info bill__info--id">
                        				#{{ $pay->id }}
                      				</div>
                      				<div class="bill__info bill__info--sum">
                        				{{ $pay->summ }} грн.
                      				</div>
                      				<div class="bill__info bill__info--status bill__info--success">
                        				{{ (App::isLocale('ru'))? 'Оплачено' : 'Сплачено' }}
                      				</div>
                      				<div class="bill__info bill__info--data">
                                        {{ date('d.m.Y H:i', $pay->time) }}
                      				</div>
                      				<div class="bill__info bill__info--pay"></div>
                    			</div>
                  			</li>
                        @endforeach
              			<!-- <li class="bill__item">
                			<div class="bill__content bill__content--pending">
                  				<div class="bill__info bill__info--id">
                    				#1023355
                  				</div>
                  				<div class="bill__info bill__info--sum">
                    				900 грн.
                  				</div>
                  				<div class="bill__info bill__info--status bill__info--pending">
                    				{{ __('cabinet/organization/payment.Status_1') }}
                  				</div>
                  				<div class="bill__info bill__info--data">
                    				02.08.2019 17:56
                  				</div>
                  				<div class="bill__info bill__info--pay">
                    				<form action="bill.php" method="post" class="bill__form">
                      					<input type="hidden" name="bill" value="">
                      					<button type="submit" class="button button--green">
                        					{{ __('cabinet/organization/payment.Btn') }}
                      					</button>
                    				</form>
                  				</div>
                			</div>
              			</li> -->
            		</ul>
          		</section>
        	</div>
		</div>
	</section>

    <script type="text/javascript">
        window.onload = function() {
            $('.tariff__plan-element--one-month').trigger('click');

            var plan = $('input[name=tariff__plan]:checked').val();

            $('.price_1').html(plan);
            $('.price_2').html(plan * 3);
            $('.price_3').html(plan * 6);
            $('.price_4').html(plan * 12);
        };
    </script>

@endsection