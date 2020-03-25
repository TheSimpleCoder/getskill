<?php

$title = (App::isLocale('ru'))? 'Редактирование мастер-класса' : 'Редагування мастер-класа';
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
					<form action="{{ route('cabinet.organization.master_edit_update', app()->getLocale()) }}" method="POST" id="add_curse_organization" autocomplete="off" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{ $master->id }}">
						<div class="edit-information__inner">
							<div class="edit-information__header">
								<h2 class="h2">
									{{ (App::isLocale('ru'))? 'Редактирование мастер-класса' : 'Редагування мастер-класа' }}
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
											<a href="javascript:void(0);" class="tabs__link" data-tab="3">
												Фото
											</a>
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
														<input required type="text" name="edit_name_ru" class="input input--full-width" placeholder="Например: Школа красоты Beauty Club" id="add_curse_name_ru" value="{{ $master->name_ru }}">
													</div>
													<div class="edit-information__input-elements">
														<label for="edit_name_ua" class="label label--has-icon label--required">
															Назва
															<svg width="13" height="13">
																<use xlink:href="#icon-ua"></use>
															</svg>
														</label>
														<input required type="text" name="edit_name_ua" class="input input input--full-width" placeholder="Наприклад: Школа краси Beauty Club" id="edit_name_ua" value="{{ $master->name_ua }}">
													</div>
												</div>
												<div class="load-file">
													<p class="label load-file__title">
														{{ __('cabinet/organization/course.Logo') }}
													</p>
													<input type="file" name="add_curse_main_logo" id="cabinet_user_avatar" class="load-file__input visually-hidden">
													<label for="cabinet_user_avatar" class="load-file__content">
														<svg width="40" height="42">
															<use xlink:href="#icon-download-file"></use>
														</svg>
														<span class="visually-hidden">
															Загрузить аватарку
														</span>
														<img id="image" src="{{ ($master->img) ? $master->img : '#' }}" alt="" style="max-width: 100%; max-height: 100%;" />
														@if($master->img)
                                                            <a href="{{ route('cabinet.organization.masterDeleteAvatar', ['locale' => app()->getLocale(), 'id' => $master->id]) }}?id={{ $master->id }}" class="avatar__delete" aria-label="Удалить"></a>
                                                        @endif
													</label>
												</div>
											</div>
											<div class="edit-information__item edit-information__item--type">
												<div class="edit-information__input-elements edit-information__input-elements--large">
													<p class="label label--required">
														{{ __('cabinet/organization/course.Category') }}
													</p>

													<select required style="width:100%;" id="selSCatList" name="category">
														@foreach($cat as $c)
															@if($cat_current->id == $c['id'])
																<option selected value="{{ $c['id'] }}">{{ $c['name'] }}</option>
															@endif
															<option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
														@endforeach
													</select>

												</div>
											</div>
											<div class="edit-information__item">
												<p class="edit-information__section-name">
													<!-- {{ __('cabinet/organization/course.Group_train') }} -->
												</p>
												<div class="edit-information__input-elements edit-information__input-elements--merged">
													<div class="edit-information__input-merged select_class">
														<label for="add_curse_price" class="label label--required">
															{{ __('cabinet/organization/course.Price') }}
														</label>
														<input required type="text" name="price" class="input input--full-width" id="add_curse_price" value="{{ $master->price }}">
														<div class="select-standard select-standard--without-search">
															<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
																<span class="select-standard__title select_val">
																	<?php
																		switch ($master->currency) {
																			case 1:
																				echo 'грн.';
																				break;
																			case 2:
																				echo '$';
																				break;
																			case 1:
																				echo '€';
																				break;
																		}
																	?>
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="currency" class="select_currency" value="{{ $master->currency }}">
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
													<div class="edit-information__input-elements edit-information__input-elements--small">
														<p class="label label--required">
															{{ (App::isLocale('ru'))? 'Дата проведения' : 'Дата проведення' }}
														</p>
														<div class="select-standard select-standard--without-search course_select_1">
															<input required type="date" name="date" class="course_type date-input input input--full-width" value="{{ date('Y-m-d', $master->date) }}">
														</div>
													</div>
												</div>
												<ul class="edit-information__radio">
													<li>
														<div class="radio">
															<input type="radio" name="organization_curse_add_price_details" id="organization_curse_add_equally" class="radio__input visually-hidden" value="1" {{ ($master->price_type == 1)? 'checked' : '' }}>
															<label for="organization_curse_add_equally" class="radio__label">
																{{ __('cabinet/organization/course.Ravno') }}
															</label>
														</div>
													</li>
													<li>
														<div class="radio">
															<input type="radio" name="organization_curse_add_price_details" id="organization_curse_add_free" class="radio__input visually-hidden" value="2" {{ ($master->price_type == 2)? 'checked' : '' }}>
															<label for="organization_curse_add_free" class="radio__label">
																{{ __('cabinet/organization/course.Free') }}
															</label>
														</div>
													</li>
													<li>
														<div class="radio">
															<input type="radio" name="organization_curse_add_price_details" id="organization_curse_add_price_from" class="radio__input visually-hidden" value="3" {{ ($master->price_type == 2)? 'checked' : '' }}>
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
															@if($master->teachers)
																@foreach($teachers as $t)
																	@if($t['show'] == 'true')
																		<button type="button" class="custom-select__selected select_remove_btn_t btn_option_teachers" data-id="{{ $t['id'] }}">
																			{{ $t['name'] }}
																		</button>
																	@endif
																@endforeach
															@endif
														</div>
														<input type="hidden" name="teachers" class="select_teachers" value="{{ $master->teachers }}">
														<div class="custom-select__body select_list">
															<ul class="custom-select__list select_ul_teachers">
																@if($teachers)
																	@foreach($teachers as $t)
																		<li class="teachers_options_info_{{ $t['id'] }}" style="display: {{ ($t['show'] == 'true')? 'none' : '' }};">
																			<button type="button" class="custom-select__option select_option option_btn_t btn_option_teachers" data-id="{{ $t['id'] }}" data-in="teachers">
																				{{ $t['name'] }}
																			</button>
																		</li>
																	@endforeach
																@endif
															</ul>
														</div>
													</div>
												</div>
												<div class="edit-information__input-elements">
													<label for="filiaSelect" class="label label--required">
														{{ __('cabinet/organization/course.Filia') }}
													</label>

													<select required name="filia[]" id="filiaSelect" multiple style="width:100%;">
														@foreach($filias as $filia)
														@if($filia['show'] == 'true')
															<option selected value="{{ $filia['id'] }}">{{ $filia['name'] }}</option>
														@else
															<option value="{{ $filia['id'] }}">{{ $filia['name'] }}</option>
														@endif;
														@endforeach
													</select>

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
																	<?php
																		switch ($master->finish) {
																			case 1:
																				echo __('cabinet/organization/course.Cert');
																				break;
																			case 2:
																				echo 'Диплом';
																				break;
																			case 3:
																				echo '-';
																				break;
																		}
																	?>
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
																			-
																		</button>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="edit-information__input-elements edit-information__input-elements--small">
														<p class="label label--required">
															Тип мастер-класса
														</p>
														<div class="select-standard select-standard--without-search course_select_1">
															<button type="button" class="select-standard__toggle toggle-btn-course close" aria-label="Открыть список">
																<span class="select-standard__title select-type-course">
																	{{ ($master->type == 1)? 'Офлайн' : 'Онлайн' }}
																</span>
																<span class="select-standard__arrow">
																	<svg width="13" height="7">
																		<use xlink:href="#icon-arrow"></use>
																	</svg>
																</span>
															</button>
															<input type="hidden" name="type_online" class="course_type" value="1">
															<div class="select-standard__body course-cat-list">
																<ul class="select-standard__list">
																	<li>
																		<button type="button" class="select-standard__option get-type-course" data-id="1">
																			Офлайн
																		</button>
																	</li>
																	<li>
																		<button type="button" class="select-standard__option get-type-course" data-id="2">
																			Онлайн
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
													<textarea name="edit_description_ru" class="input input--full-width input--textarea" placeholder="Напишите немного о вашей школе" id="curse_add_description_ru">{{ $master->desc_ru }}</textarea>
												</div>
												<div class="edit-information__input-elements">
													<label for="curse_add_description_ua" class="label label--has-icon">
														Опис
														<svg width="13" height="13">
															<use xlink:href="#icon-ua"></use>
														</svg>
													</label>
													<textarea name="edit_description_ua" class="input input--full-width input--textarea" placeholder="Напишіть пару слів про школу" id="curse_add_description_ua">{{ $master->desc_ua }}</textarea>
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
                                                <form action="{{ route('cabinet.organization.uploadPhotoMassMaster', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" class="dropzone">
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
                            						<input type="hidden" name="id" value="{{ $master->id }}">
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
@endsection
