<?php

$title = trans('cabinet/organization/course.Title_2');
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
				<div class="edit-information">
					<form action="{{ route('cabinet.organization.course_add_new', app()->getLocale()) }}" method="POST" id="add_curse_organization" autocomplete="off" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="uid" class="uid">
						<div class="edit-information__inner">
							<div class="edit-information__header">
								<h2 class="h2">
									{{ __('cabinet/organization/course.Title_2') }}
								</h2>
								@if($org)
									<div class="edit-information__buttons">
										<button type="submit" class="button button--save button--green">
											<svg width="20" height="21">
												<use xlink:href="#icon-save"></use>
											</svg>
											{{ __('cabinet/organization/course.Save') }}
										</button>
									</div>
								@endif
							</div>
							@if($org)
								<div class="tabs edit-information__tabs">
									<ul class="tabs__list">
										<li class="tabs__item tabs__item--active">
											<a href="javascript:void(0);" class="tabs__link" data-tab="1">
												{{ __('cabinet/organization/course.Tab_1') }}
											</a>
										</li>
										<li class="tabs__item">
											<a href="javascript:void(0);" class="tabs__link" data-tab="2">
												{{ __('cabinet/organization/course.Tab_2') }}
											</a>
										</li>
										<li class="tabs__item">
											@if(Pack::getPack()['pack'] == 1)
												<a href="javascript:void(0);" class="tabs__link disable" disabled>
													Фото
													<svg width="37" height="12">
                      									<use xlink:href="#icon-tarif-2"></use>
                    								</svg>
												</a>
											@else
												<a href="javascript:void(0);" class="tabs__link" data-tab="3">
													Фото
												</a>
											@endif
										</li>
									</ul>
									<div class="tabs__content edit-information__content">
										<div class="tabs__info-block tabs__info-block--active edit-information__main" id="tab_1">
											<div class="edit-information__name">
												<div class="edit-information__wrapper-name">
													<div class="edit-information__input-elements">
														<label for="add_curse_name_ru" class="label label--has-icon label--required">
															Название
															<svg width="13" height="13">
																<use xlink:href="#icon-ru"></use>
															</svg>
														</label>
														<input required type="text" name="edit_name_ru" class="input input--full-width" placeholder="Например: Школа красоты Beauty Club" id="add_curse_name_ru">
													</div>
													<div class="edit-information__input-elements">
														<label for="edit_name_ua" class="label label--has-icon label--required">
															Назва
															<svg width="13" height="13">
																<use xlink:href="#icon-ua"></use>
															</svg>
														</label>
														<input required type="text" name="edit_name_ua" class="input input input--full-width" placeholder="Наприклад: Школа краси Beauty Club" id="edit_name_ua">
													</div>
												</div>
												<div class="load-file">
													<p class="label load-file__title">
														{{ __('cabinet/organization/course.Logo') }}
													</p>
													<input required type="file" name="add_curse_main_logo" id="cabinet_user_avatar" class="load-file__input visually-hidden">
													<label for="cabinet_user_avatar" class="load-file__content">
														<svg width="40" height="42">
															<use xlink:href="#icon-download-file"></use>
														</svg>
														<span class="visually-hidden">
															Загрузить аватарку
														</span>
														<img id="image" src="#" alt="" style="max-width: 100%; max-height: 100%;" />
													</label>
												</div>
											</div>
											<div class="edit-information__item edit-information__item--type">
												<div class="edit-information__input-elements edit-information__input-elements--small">
													<p class="label label--required">
														Тип курса
													</p>
													<div class="select-standard select-standard--without-search course_select_1">
														<button type="button" class="select-standard__toggle toggle-btn-course close" aria-label="Открыть список">
															<span class="select-standard__title select-type-course">
																Офлайн
															</span>
															<span class="select-standard__arrow">
																<svg width="13" height="7">
																	<use xlink:href="#icon-arrow"></use>
																</svg>
															</span>
														</button>
														<input type="hidden" name="type_online" class="course_type" value="2">
														<div class="select-standard__body course-cat-list">
															<ul class="select-standard__list">
																<li>
																	<button type="button" class="select-standard__option get-type-course" data-id="2">
																		Офлайн
																	</button>
																</li>
																<li>
																	<button type="button" class="select-standard__option get-type-course" data-id="1">
																		Онлайн
																	</button>
																</li>
															</ul>
														</div>
													</div>
												</div>


												<div class="edit-information__input-elements edit-information__input-elements--large">
													<p class="label label--required">
                                                        {{ __('cabinet/organization/course.Category') }}
													</p>
													<div class="select-standard category-select select-standard--without-search course_select_1">
														<button type="button" class="select-standard__toggle toggle-btn-course close" aria-label="Открыть список">
															<span class="select-standard__title select-type-course">
																Офлайн
															</span>
															<span class="select-standard__arrow">
																<svg width="13" height="7">
																	<use xlink:href="#icon-arrow"></use>
																</svg>
															</span>
														</button>
														<input type="hidden" name="type_online" class="course_type" value="2">
														<div class="select-standard__body course-cat-list">
															<ul class="select-standard__list category-select__list">
																<li class="select-standard__item">
                                                                    <button class="select-category__toggle" type="button">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13"><g transform="translate(0 13) rotate(-90)"><path d="M6.533,33.535a.457.457,0,0,1,.65,0l5.711,5.76,5.722-5.76a.457.457,0,0,1,.65,0,.465.465,0,0,1,0,.654L13.23,40.265a.447.447,0,0,1-.325.135.466.466,0,0,1-.325-.135L6.544,34.189A.455.455,0,0,1,6.533,33.535Z" transform="translate(-6.4 -33.4)" fill="#0a0a0a"/></g></svg>
                                                                        <span>Категория 1</span>
                                                                    </button>
                                                                    <ul>
                                                                        <li>
                                                                            <button class="select-category__toggle" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13"><g transform="translate(0 13) rotate(-90)"><path d="M6.533,33.535a.457.457,0,0,1,.65,0l5.711,5.76,5.722-5.76a.457.457,0,0,1,.65,0,.465.465,0,0,1,0,.654L13.23,40.265a.447.447,0,0,1-.325.135.466.466,0,0,1-.325-.135L6.544,34.189A.455.455,0,0,1,6.533,33.535Z" transform="translate(-6.4 -33.4)" fill="#0a0a0a"/></g></svg>
                                                                                <span>Категория 2</span>
                                                                            </button>
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test1" class="radio__input visually-hidden">
                                                                                        <label for="test1" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test2" class="radio__input visually-hidden">
                                                                                        <label for="test2" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test3" class="radio__input visually-hidden">
                                                                                        <label for="test3" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li  class="select-standard__item">
                                                                    <button class="select-category__toggle" type="button">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13"><g transform="translate(0 13) rotate(-90)"><path d="M6.533,33.535a.457.457,0,0,1,.65,0l5.711,5.76,5.722-5.76a.457.457,0,0,1,.65,0,.465.465,0,0,1,0,.654L13.23,40.265a.447.447,0,0,1-.325.135.466.466,0,0,1-.325-.135L6.544,34.189A.455.455,0,0,1,6.533,33.535Z" transform="translate(-6.4 -33.4)" fill="#0a0a0a"/></g></svg>
                                                                        <span>Категория 1</span>
                                                                    </button>
                                                                    <ul>
                                                                        <li>
                                                                            <button class="select-category__toggle" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13"><g transform="translate(0 13) rotate(-90)"><path d="M6.533,33.535a.457.457,0,0,1,.65,0l5.711,5.76,5.722-5.76a.457.457,0,0,1,.65,0,.465.465,0,0,1,0,.654L13.23,40.265a.447.447,0,0,1-.325.135.466.466,0,0,1-.325-.135L6.544,34.189A.455.455,0,0,1,6.533,33.535Z" transform="translate(-6.4 -33.4)" fill="#0a0a0a"/></g></svg>
                                                                                <span>Категория 2</span>
                                                                            </button>
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test1" class="radio__input visually-hidden">
                                                                                        <label for="test1" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test2" class="radio__input visually-hidden">
                                                                                        <label for="test2" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test3" class="radio__input visually-hidden">
                                                                                        <label for="test3" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li  class="select-standard__item">
                                                                    <button class="select-category__toggle" type="button">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13"><g transform="translate(0 13) rotate(-90)"><path d="M6.533,33.535a.457.457,0,0,1,.65,0l5.711,5.76,5.722-5.76a.457.457,0,0,1,.65,0,.465.465,0,0,1,0,.654L13.23,40.265a.447.447,0,0,1-.325.135.466.466,0,0,1-.325-.135L6.544,34.189A.455.455,0,0,1,6.533,33.535Z" transform="translate(-6.4 -33.4)" fill="#0a0a0a"/></g></svg>
                                                                        <span>Категория 1</span>
                                                                    </button>
                                                                    <ul>
                                                                        <li>
                                                                            <button class="select-category__toggle" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13"><g transform="translate(0 13) rotate(-90)"><path d="M6.533,33.535a.457.457,0,0,1,.65,0l5.711,5.76,5.722-5.76a.457.457,0,0,1,.65,0,.465.465,0,0,1,0,.654L13.23,40.265a.447.447,0,0,1-.325.135.466.466,0,0,1-.325-.135L6.544,34.189A.455.455,0,0,1,6.533,33.535Z" transform="translate(-6.4 -33.4)" fill="#0a0a0a"/></g></svg>
                                                                                <span>Категория 2</span>
                                                                            </button>
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test1" class="radio__input visually-hidden">
                                                                                        <label for="test1" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test2" class="radio__input visually-hidden">
                                                                                        <label for="test2" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="radio">
                                                                                        <input type="radio" name="tester" id="test3" class="radio__input visually-hidden">
                                                                                        <label for="test3" class="radio__label">
                                                                                            бесплатно
                                                                                        </label>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
															</ul>
														</div>
													</div>
												</div>


{{--												<div class="edit-information__input-elements edit-information__input-elements--large">--}}
{{--													<p class="label label--required">--}}
{{--														{{ __('cabinet/organization/course.Category') }}--}}
{{--													</p>--}}
{{--													<br>--}}
{{--													<select required name="category" class="selCatCourse">--}}
{{--														<option disabled selected value="">Выберите категорию</option>--}}
{{--														@foreach($cat as $c)--}}
{{--														<option value="{{ $c['c_id'] }}">{{ $c['name'] }}</option>--}}
{{--														@endforeach--}}
{{--													</select>--}}
{{--                                                    --}}
{{--                                                    <div class="category-select">--}}
{{--                                                        <div class="category-select__current">--}}
{{--                                                            <span>Выберите категорию</span>--}}
{{--                                                            <span class="select-standard__arrow">--}}
{{--																<svg width="13" height="7">--}}
{{--																	<use xlink:href="#icon-arrow"></use>--}}
{{--																</svg>--}}
{{--															</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--													--}}
{{--													<style>--}}
{{--													span.select2-selection.select2-selection--single{--}}
{{--														height: 45px;--}}
{{--													}--}}
{{--													span.select2-selection__rendered{--}}
{{--														height: 35px;--}}
{{--														margin-top: 8px;--}}
{{--													}--}}
{{--													span.select2-selection__arrow{--}}
{{--														margin-top: 8px;--}}
{{--													}--}}
{{--													</style>--}}
{{--												</div>--}}
											</div>
											<div class="edit-information__item">
												<!-- <p class="edit-information__section-name">
													{{ __('cabinet/organization/course.Group_train') }}
												</p> -->
												<div class="edit-information__input-elements edit-information__input-elements--merged">
													<div class="edit-information__input-merged select_class">
														<label for="add_curse_price" class="label label--required">
															{{ __('cabinet/organization/course.Price') }}
														</label>
														<input required type="text" name="add_curse_price" class="input input--full-width" id="add_curse_price">
														<div class="select-standard select-standard--without-search">
															<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
																<span class="select-standard__title select_val">
																	грн.
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="currency" class="select_currency" value="1">
															<div class="select-standard__body select_list">
																<ul class="select-standard__list">
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="1" data-in="currency">
																			грн.
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="2" data-in="currency">
																			$
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="3" data-in="currency">
																			€
																		</button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="edit-information__normal-wrap select_class">
														<p class="label">
															{{ __('cabinet/organization/course.Count') }}
														</p>
														<div class="select-standard select-standard--without-search">
															<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
																<span class="select-standard__title select_val">
																	{{ __('cabinet/organization/course.Count_who') }}
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="od" class="select_od" value="1">
															<div class="select-standard__body select_list">
																<ul class="select-standard__list">
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="1" data-in="od">
																			Курс
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="2" data-in="od">
																			{{ (App::isLocale('ru'))? 'Час' : 'Година' }}
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="3" data-in="od">
																			{{ (App::isLocale('ru'))? 'Занятие' : 'Заняття' }}
																		</button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="edit-information__normal-wrap sale_block_parents">
														<p class="label label_hide_title_sale" style="color: #fff;">
															{{ __('cabinet/organization/course.Sale_info') }}
														</p>

														<button type="button" class="button button--transparent btn_show_sale">
															{{ __('cabinet/organization/course.Sale') }}
														</button>

														<input type="hidden" name="sale" class="input input input--full-width sale_input">
													</div>
												</div>
												<ul class="edit-information__radio">
													<li>
														<div class="radio">
															<input type="radio" name="organization_curse_add_price_details" id="organization_curse_add_equally" class="radio__input visually-hidden" checked="" value="1">
															<label for="organization_curse_add_equally" class="radio__label">
																{{ __('cabinet/organization/course.Ravno') }}
															</label>
														</div>
													</li>
													<li>
														<div class="radio">
															<input type="radio" name="organization_curse_add_price_details" id="organization_curse_add_free" class="radio__input visually-hidden" value="2">
															<label for="organization_curse_add_free" class="radio__label">
																{{ __('cabinet/organization/course.Free') }}
															</label>
														</div>
													</li>
													<li>
														<div class="radio">
															<input type="radio" name="organization_curse_add_price_details" id="organization_curse_add_price_from" class="radio__input visually-hidden" value="3">
															<label for="organization_curse_add_price_from" class="radio__label">
																{{ __('cabinet/organization/course.Price_for') }}
															</label>
														</div>
													</li>
												</ul>
											</div>
											<div class="edit-information__item">
												<div class="edit-information__input-elements">
													<p class="label">
														{{ __('cabinet/organization/course.Teachers') }}
													</p>
													<div class="custom-select select_class">
														<div class="custom-select__header result_btn_t" tabindex="0">

															<span class="custom-select__toggle-icon select_btn close" aria-label="Открыть категорию">
																<svg width="13" height="7">
																	<use xlink:href="#icon-arrow"></use>
																</svg>
															</span>
														</div>
														<input type="hidden" name="teachers" class="select_teachers">
														<div class="custom-select__body select_list">
															<ul class="custom-select__list select_ul_teachers">
																@foreach($teachers as $t)
																	<li class="teachers_options_info_{{ $t['id'] }}">
																		<button type="button" class="custom-select__option select_option option_btn_t btn_option_teachers" data-id="{{ $t['id'] }}" data-in="teachers">
																			{{ $t['name'] }}
																		</button>
																	</li>
																@endforeach
															</ul>
														</div>
													</div>
												</div>
												<div class="edit-information__input-elements">
													<p class="label">
														{{ __('cabinet/organization/course.Filia') }}
													</p>
													<div class="custom-select select_class">
														<div class="custom-select__header result_btn_f" tabindex="0">
															<span class="custom-select__toggle-icon select_btn close" aria-label="Открыть категорию">
																<svg width="13" height="7">
																	<use xlink:href="#icon-arrow"></use>
																</svg>
															</span>
														</div>


									                    @if (count($errors) > 0)
														  	<div class="alert alert-danger">
														    	<ul>
														      		@foreach ($errors->all() as $error)
														        		<li>{{ $error }}</li>
														      		@endforeach
														    	</ul>
														  	</div>
														@endif
														<input required type="hidden" name="filia" class="select_filia" value="{{$filias[0]['id']}}">
														<div class="custom-select__body select_list">
															<ul class="custom-select__list select_ul_filia">
																@foreach($filias as $filia)
																	<li class="filia_options_info_{{ $filia['id'] }}">
																		<button type="button" class="custom-select__option select_option option_btn btn_option_filia" data-id="{{ $filia['id'] }}" data-in="filia">
																			{{ $filia['name'] }}
																		</button>
																	</li>
																@endforeach
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="edit-information__item edit-information__item--last">
												<div class="edit-information__tree-column">
													<div class="edit-information__input-elements select_class">
														<p class="label">
															{{ __('cabinet/organization/course.Finish') }}
														</p>
														<div class="select-standard select-standard--without-search">
															<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
																<span class="select-standard__title select_val">
																	{{ __('cabinet/organization/course.Cert') }}
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="cert" class="select_cert" value="1">
															<div class="select-standard__body select_list">
																<ul class="select-standard__list">
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="1" data-in="cert">
																			{{ __('cabinet/organization/course.Cert') }}
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="2" data-in="cert">
																			Диплом
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="3" data-in="cert">
																			-
																		</button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="edit-information__input-elements">
														<p class="label">
															{{ __('cabinet/organization/course.Group') }}
														</p>
														<div class="select-standard select-standard--without-search select_class">
															<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
																<span class="select-standard__title select_val">
																	{{ __('cabinet/organization/course.Individual') }}
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="group" class="select_group" value="1">
															<div class="select-standard__body select_list">
																<ul class="select-standard__list">
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="1" data-in="group">
																			{{ __('cabinet/organization/course.Individual') }}
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="2" data-in="group">
																			{{ (App::isLocale('ru'))? 'В группе' : 'У групі' }}
																		</button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="edit-information__input-elements">
														<p class="label">
															{{ __('cabinet/organization/course.Test') }}
														</p>
														<div class="select-standard select-standard--without-search select_class">
															<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
																<span class="select-standard__title select_val">
																	{{ __('cabinet/organization/course.No') }}
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="test_train" value="1" class="select_course_no">
															<div class="select-standard__body select_list">
																<ul class="select-standard__list">
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="1" data-in="course_no">
																			{{ (App::isLocale('ru'))? 'Нет' : 'Ні' }}
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option select_option" data-id="2" data-in="course_no">
																			{{ (App::isLocale('ru'))? 'Да' : 'Так' }}
																		</button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tabs__info-block tabs__info-block--hidden" id="tab_2">
											<div class="edit-information__description">
												<div class="edit-information__input-elements">
													<label for="curse_add_description_ru" class="label label--has-icon">
														Описание
														<svg width="13" height="13">
															<use xlink:href="#icon-ru"></use>
														</svg>
													</label>
													<textarea name="edit_description_ru" class="input input--full-width input--textarea" placeholder="Напишите немного о вашей школе" id="curse_add_description_ru"></textarea>
												</div>
												<div class="edit-information__input-elements">
													<label for="curse_add_description_ua" class="label label--has-icon">
														Опис
														<svg width="13" height="13">
															<use xlink:href="#icon-ua"></use>
														</svg>
													</label>
													<textarea name="edit_description_ua" class="input input--full-width input--textarea" placeholder="Напишіть пару слів про школу" id="curse_add_description_ua"></textarea>
												</div>
											</div>
										</div>
										<div class="tabs__info-block tabs__info-block--hidden" id="tab_3">
                      						<div class="edit-information__photo">
                        						<div class="gallery">
                          							<ul class="gallery__list" id="gallery_response">
                            							@foreach($files as $file)
                                                            <li class="gallery-drop-{{ $file->id }}" data-id="{{ $file->id }}">
                                                                <div class="gallery__img">
                                                                    <img src="{{ $file->img }}" width="177" height="177" alt="Фото галерея">
                                                                    <svg width="30" height="30">
                                                                        <use xlink:href="#icon-darag"></use>
                                                                    </svg>
                                                                    <button type="button" class="gallery__delete" aria-label="Удалить" onclick="deletePhotoForAlbum({{ $file->id }})"></button>
                                                                </div>
                                                            </li>
                                                        @endforeach
                          						    </ul>
                                                </form>
                                                <input type="hidden" name="sort_gallery" id="sort_gallery">
                                                <div class="load-file load-file--drag-drop gallery__load-file">
                                                <form action="{{ route('cabinet.organization.uploadPhotoMassCourse', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" class="dropzone">
                                                	{{ csrf_field() }}
                            						<div class="load-file__content" tabindex="0" id="dropzone">
                              							<svg width="67" height="70">
                                							<use xlink:href="#icon-load-photo-bold"></use>
                              							</svg>
                              							<p class="load-file__help-text">
                                							Что б загрузить фото, переместите их эту область
                              							</p>
                                                        <input name="file" type="file" multiple class="visually-hidden load-file__multiple" id="gallery_photos">
                            						</div>
                            						<input type="hidden" name="uid" class="uid">
                                                </form>
                        						<div class="load-file__wrap">
                          							<!-- <div class="load-file__files-names input">
                            							<p class="load-file__placeholder">
                              								Выбрать фото
                            							</p>
                          							</div> -->

                          							<label for="gallery_photos_t" class="button load-file__button btn-add-image">
                            							<svg width="27" height="22">
                              								<use xlink:href="#icon-folder"></use>
                            							</svg>
                            							Выбрать
                          							</label>
                        						</div>
                      						</div>
                    					</div>
									</div>
	                			</div>
                			@else
                				{{ __('cabinet/organization/course.Error') }}
                			@endif
						</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		window.onload = function() {
		   	initTypeCourse();

		   	$(document).on('click', '.btn-add-image', function(){
                $('.dropzone').trigger('click');
            })

		   	function createUUID(){
			    var dt = new Date().getTime();
			    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			        var r = (dt + Math.random()*16)%16 | 0;
			        dt = Math.floor(dt/16);
			        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
			    });
			    $('.uid').val(uuid);
			    return uuid;
		    }
		    console.log(createUUID());

		};
	</script>
@endsection
