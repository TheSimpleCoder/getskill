<?php

$title = trans('cabinet/organization/home.Title');
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
            			<form action="{{ route('cabinet.organization.updateOrganization', app()->getLocale()) }}" method="POST" autocomplete="off" enctype="multipart/form-data" id="my-awesome-dropzone">
            				{{ csrf_field() }}
              				<div class="edit-information__inner">
                				<div class="edit-information__header">
                  					<h2 class="h2">
                    					{{ __('cabinet/organization/home.name') }}
                  					</h2>
                  					<div class="edit-information__buttons">
                                        @if($org)
                        					<a href="{{ route('school_description', [app()->getLocale(), $org->id]) }}" class="button button-view button--yellow">
                          						<svg width="25" height="15">
                            						<use xlink:href="#icon-eye"></use>
                          						</svg>
                          						{{ __('cabinet/organization/home.btn_view') }}
                        					</a>
                                        @endif
                    					<button type="submit" class="disabled button button--save button--green">
                      						<svg width="20" height="21">
                        						<use xlink:href="#icon-save"></use>
                      						</svg>
                      						{{ __('cabinet/organization/home.btn_save') }}
                    					</button>
                  					</div>
                				</div>
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
                            							<label for="edit_name_ru" class="label label--has-icon label--required">
                              								Название
                              								<svg width="13" height="13">
                                								<use xlink:href="#icon-ru"></use>
                              								</svg>
                            							</label>
                            							<input required type="text" name="edit_name_ru" class="input input--full-width" placeholder="Например: Школа красоты Beauty Club" id="edit_name_ru" value="{{ ($org) ? $org->name_ru : '' }}">
                          							</div>
                          							<div class="edit-information__input-elements">
                            							<label for="edit_name_ua" class="label label--has-icon label--required">
                              								Назва
                              								<svg width="13" height="13">
                                								<use xlink:href="#icon-ua"></use>
                              								</svg>
                            							</label>
                            							<input required type="text" name="edit_name_ua" class="input input input--full-width" placeholder="Наприклад: Школа краси Beauty Club" id="edit_name_ua" value="{{ ($org) ? $org->name_ua : '' }}">
                          							</div>
                        						</div>
                        						<div class="load-file">
                          							<p class="label load-file__title">
                            							Логотип
                          							</p>
                          							<input type="file" name="avatar_organization" id="cabinet_user_avatar" class="load-file__input visually-hidden">
                          							<label for="cabinet_user_avatar" class="load-file__content">
                            							<svg width="40" height="42">
                              								<use xlink:href="#icon-download-file"></use>
                            							</svg>
                           								<span class="visually-hidden">
                                							Загрузить аватарку
                              							</span>
                              							<img id="image" src="{{ ($org) ? ($org->url_logo) ? $org->url_logo : '#' : '#' }}" alt="" style="max-width: 100%; max-height: 100%;" />
                                                        @if($org)
                                                            @if($org->url_logo)
                                                                <a href="{{ route('cabinet.organization.deleteAvatar', app()->getLocale()) }}" class="avatar__delete" aria-label="Удалить"></a>
                                                            @endif
                                                        @endif
                          							</label>
                        						</div>
                      						</div>
                      						<div class="edit-information__business-information">
                        						<div class="edit-information__input-elements">
                          							<p class="label label--required">
                            							{{ __('cabinet/organization/home.category') }}
                          							</p>

													<br>

													<select required style="width:100%;" id="selSCatList" multiple="" name="cat-list[]">
													  <option value="">Категория</option>
														@foreach($cat_user as $category)
															<option selected value="{{ $category['id'] }}">{{ $category['name'] }}</option>
														@endforeach
														@foreach($cat as $category)
															<option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
														@endforeach
													</select>


                        						</div>
                        						<div class="edit-information__input-elements">
                          							<label for="edit_link" class="label">
                            							{{ __('cabinet/organization/home.link') }}
                          							</label>
                          							<input type="text" name="edit_link" class="input input--full-width" placeholder="https://my-site.com" id="edit_link" value="{{ ($org) ? $org->site_link : '' }}">
                        						</div>
                      						</div>
                      						<div class="edit-information__details">
                      							<input type="hidden" name="count_fillia" id="count_fillia" value="{{ ($filias) ? count($filias) : '1' }}">
                        						<ol class="dynamic-form" id="ol_list_fill">
                        							<?php if(!$filias){ ?>
                        								<li class="dynamic-form__item dynamic-form__item--open fillia-li  class-fillia-1">
                            							<div class="dynamic-form__content">
                              								<div class="dynamic-form__header">
                                								<p class="dynamic-form__name">

                                								</p>
                                								<div class="dynamic-form__switcher">
                                  									<div class="switcher">
                                    									<label class="switcher__label">
                                        									<span class="visually-hidden">
                                          										Переключатель
                                        									</span>
                                      										<input type="checkbox" name="switcher_dynamic_1" class="switcher__checkbox visually-hidden" checked="">
                                      										<span class="switcher__tumbler"></span>
                                    									</label>
                                  									</div>
                                								</div>
                                								<button type="button" class="delete dynamic-form__dynamic trash-btn-fillia" aria-label="Удалить" data-id="1">
                                  									<svg width="17" height="21">
                                    									<use xlink:href="#icon-trash"></use>
                                  									</svg>
                                								</button>
                                								<button type="button" class="dynamic-form__toggle plus" aria-label="Открыть форму">
                                  									<span></span>
                                								</button>

                              								</div>
                              								<div class="dynamic-form__body">
                                								<div class="dynamic-form__elements">
                                  									<div class="dynamic-form__left-element">
                                    									<p class="label">
                                      										{{ __('cabinet/organization/home.city') }}
                                    									</p>

																		<div id="cSelCopy" style="display:none;">
																				<select style="width:100%;" required name="regions_1" class="selCityElem_1_copy">
																				@foreach(\App\Model\Region\Entity\Region::all() as $c)
																					<option value="{{$c->id}}">{{ app()->getLocale() === 'ru' ? $c->name_ru : $c->name_uk }}</option>
																				@endforeach
																				</select>
																			</div>
																			<br>

																			<select style="width:100%;" required name="regions_1" class="selCityElem_1">
																				@foreach(\App\Model\Region\Entity\Region::all() as $c)

																						<option value="{{$c->id}}">{{ app()->getLocale() === 'ru' ? $c->name_ru : $c->name_uk }}</option>

																				@endforeach
																			</select>
                                  									</div>
                                  									<div class="dynamic-form__right-element">
                                    									<label for="dynamic_form_address" class="label">
                                      										{{ __('cabinet/organization/home.address') }}
                                    									</label>
                                    									<input type="text" name="dynamic_form_address_1" class="input input--full-width" placeholder="Некрасова, 12" id="dynamic_form_address">
                                  									</div>
                                								</div>
                                								<div class="dynamic-form__elements">
                                  									<div class="dynamic-form__left-element">
                                   										<label for="dynamic_form_phone" class="label">
                                      										{{ __('cabinet/organization/home.phones') }}
                                    									</label>
                                    									<input required type="hidden" name="phone-numbers-1" class="phone_numbers_list">
                                    									<input required type="text" name="dynamic-form-phone" class="input input--full-width phone-add-list" id="dynamic_form_phone" data-phone-number="">
                                    									<div class="cloned-input dynamic-form__cloned">
                                      										<ul class="cloned-input__list ul-clone-list-1">

                                      										</ul>
                                      										<button type="button" class="cloned-input__add clone-add-phone-number" data-clone="1">
                                        										{{ __('cabinet/organization/home.add_number') }}
                                      										</button>
                                    									</div>
                                  									</div>
                                  									<div class="dynamic-form__right-element">
                                    									<label for="dynamic_form_email" class="label">
                                      										E-mail
                                    									</label>
                                    									<input type="email" name="dynamic_form_email_1" class="input input--full-width" placeholder="info@gmail.com" id="dynamic_form_email">
                                  									</div>
                                								</div>
                                								<p class="label">
                              										{{ __('cabinet/organization/home.other_comm') }}
                            									</p>
                                								<div class="dynamic-form__elements container-c">
                                  									<div class="dynamic-form__left-element">

                                    									<div class="select-standard select-standard--without-search messanger-block"  data-list="1">
                                      										<button type="button" class="select-standard__toggle toggle-list-messanger close" aria-label="Открыть список">
                                         										<span class="select-standard__title get-name">
                                          											{{ __('cabinet/organization/home.select') }}
                                        										</span>
                                        										<span class="select-standard__arrow">
                                          											<svg width="13" height="7">
                                          												<use xlink:href="#icon-arrow"></use>
                                          											</svg>
                                        										</span>
                                      										</button>
                                      										<div class="select-standard__body list-messenger list-messenger-1">

                                      										</div>
                                    									</div>
                                  									</div>
                                  									<div class="dynamic-form__right-element">
                                    									<label for="dynamic_form_communication_0" class="label visually-hidden">
                                      										Метод связи
                                    									</label>
                                    									<input name="dynamic_form_communication_0" class="input input--full-width change-in-messanger-data" placeholder="{{ __('cabinet/organization/home.placeholder') }}" id="dynamic_form_communication_0">
                                  									</div>
                                								</div>
                                								<div class="spawn-methods spawn-method"></div>
                                								<input type="hidden" name="messanger_list_data_1" class="messanger_list_data">
                                								<div class="cloned-input">
                              										<button type="button" class="cloned-input__add add-method-c">
                                										{{ __('cabinet/organization/home.add_other_comm') }}
                              										</button>
                            									</div>
                              								</div>
                            							</div>
                            							<input type="hidden" name="defaul_id_1">
                          							</li>
                        							<?php } ?>
                        							<?php $i = 1; ?>
                        							@if($filias)
	                        							@foreach($filias as $f)

	                          							<li class="dynamic-form__item dynamic-form__item--open fillia-li  class-fillia-{{ $i }}" data-filia="{{ $i }}">
	                            							<div class="dynamic-form__content">
	                              								<div class="dynamic-form__header">
	                                								<p class="dynamic-form__name">
	                                  									{{ \App\Model\Region\Entity\Region::getCity($f->city) }}, {{ $f->address }}
	                                								</p>
	                                								<div class="dynamic-form__switcher">
	                                  									<div class="switcher">
	                                    									<label class="switcher__label">
	                                        									<span class="visually-hidden">
	                                          										Переключатель
	                                        									</span>
	                                      										<input type="checkbox" name="switcher_dynamic_{{ $i }}" class="switcher__checkbox visually-hidden" {{ ($f->active == 'on') ? 'checked' : '' }}>
	                                      										<span class="switcher__tumbler"></span>
	                                    									</label>
	                                  									</div>
	                                								</div>
                                                                    @if($i != 1)
    	                                								<button type="button" class="delete dynamic-form__dynamic trash-btn-fillia" aria-label="Удалить" data-id="{{ $i }}" data-f="{{ $f->id }}">
    	                                  									<svg width="17" height="21">
    	                                    									<use xlink:href="#icon-trash"></use>
    	                                  									</svg>
    	                                								</button>
                                                                    @endif
	                                								<button type="button" class="dynamic-form__toggle plus" aria-label="Открыть форму">
	                                  									<span></span>
	                                								</button>

	                              								</div>
	                              								<div class="dynamic-form__body">
	                                								<div class="dynamic-form__elements">
	                                  									<div class="dynamic-form__left-element">
	                                    									<p class="label label--required">
	                                      										{{ __('cabinet/organization/home.city') }}
	                                    									</p>

																			<div id="cSelCopy" style="display:none;">
																				<select style="width:100%;" required name="regions_{{ $i }}" class="selCityElem_{{ $i }}">
																				@foreach(\App\Model\Region\Entity\Region::all() as $c)
																					<option value="{{$c->id}}">{{ app()->getLocale() === 'ru' ? $c->name_ru : $c->name_uk }}</option>
																				@endforeach
																				</select>
																			</div>
																			<br>

																			<select style="width:100%;" required name="regions_{{ $i }}" class="selCityElem_{{ $i }}">
																				@foreach(\App\Model\Region\Entity\Region::all() as $c)
																					@if($f->city == $c->id)
																						<option selected value="{{$c->id}}">{{ app()->getLocale() === 'ru' ? $c->name_ru : $c->name_uk }}</option>
																					@else
																						<option value="{{$c->id}}">{{ app()->getLocale() === 'ru' ? $c->name_ru : $c->name_uk }}</option>
																					@endif
																				@endforeach
																			</select>

	                                  									</div>
	                                  									<div class="dynamic-form__right-element">
	                                    									<label for="dynamic_form_address" class="label">
	                                      										{{ __('cabinet/organization/home.address') }}
	                                    									</label>
	                                    									<input type="text" name="dynamic_form_address_{{ $i }}" class="input input--full-width" placeholder="Некрасова, 12" id="dynamic_form_address" value="{{ $f->address }}">
	                                  									</div>
	                                								</div>
	                                								<div class="dynamic-form__elements">
	                                  									<div class="dynamic-form__left-element">
	                                   										<label for="dynamic_form_phone" class="label label--required">
	                                      										{{ __('cabinet/organization/home.phones') }}
	                                    									</label>
	                                    									<input required type="hidden" name="phone-numbers-{{ $i }}" class="phone_numbers_list" value="{{ $f->phones }}">

	                                    									<?php
	                                    										$phone_mass = explode(',', $f->phones);
	                                    									?>

	                                    									<input required type="text" name="dynamic-form-phone" class="input input--full-width phone-add-list" id="dynamic_form_phone" data-phone-number="{{ ($f->phones)? $phone_mass[0] : '' }}" value="{{ ($f->phones)? $phone_mass[0] : '' }}">
	                                    									<?php
	                                    										unset($phone_mass[0]);
	                                    									?>
	                                    									<div class="cloned-input dynamic-form__cloned">
	                                      										<ul class="cloned-input__list ul-clone-list-{{ $i }}">
	                                        										@foreach($phone_mass as $s)
	                                        											<li>
																							<label for="dynamic_form_phone-0" class="label visually-hidden">
																								Телефон
																							</label>
																							<input type="text" name="dynamic_form_phone-0" class="input input--full-width phone-add-list" data-phone-number="{{ $s }}" value="{{ $s }}" required="">
																							<button type="button" class="delete cloned-input__delete delete-clone-phone" aria-label="Удалить">
																							 	<svg width="17" height="21">
																									<use xlink:href="#icon-trash"></use>
																								</svg>
																							</button>
																						</li>
	                                        										@endforeach
	                                      										</ul>
	                                      										<button type="button" class="cloned-input__add clone-add-phone-number" data-clone="{{ $i }}">
	                                        										{{ __('cabinet/organization/home.add_number') }}
	                                      										</button>
	                                    									</div>
	                                  									</div>
	                                  									<div class="dynamic-form__right-element">
	                                    									<label for="dynamic_form_email" class="label">
	                                      										E-mail
	                                    									</label>
	                                    									<input type="email" name="dynamic_form_email_{{ $i }}" class="input input--full-width" placeholder="info@gmail.com" id="dynamic_form_email" value="{{ $f->email }}">
	                                  									</div>
	                                								</div>
	                                								<p class="label">
	                              										{{ __('cabinet/organization/home.other_comm') }}
	                            									</p>
	                            									@if(!$f->messanger)
		                                								<div class="dynamic-form__elements container-c">
		                                  									<div class="dynamic-form__left-element">

		                                    									<div class="select-standard select-standard--without-search messanger-block"  data-list="{{ $i }}">
		                                      										<button type="button" class="select-standard__toggle toggle-list-messanger close" aria-label="Открыть список">
		                                         										<span class="select-standard__title get-name">
		                                          											{{ __('cabinet/organization/home.select') }}
		                                        										</span>
		                                        										<span class="select-standard__arrow">
		                                          											<svg width="13" height="7">
		                                          												<use xlink:href="#icon-arrow"></use>
		                                          											</svg>
		                                        										</span>
		                                      										</button>
		                                      										<div class="select-standard__body list-messenger list-messenger-{{ $i }}">

		                                      										</div>
		                                    									</div>
		                                  									</div>
		                                  									<div class="dynamic-form__right-element">
		                                    									<label for="dynamic_form_communication_0" class="label visually-hidden">
		                                      										Метод связи
		                                    									</label>
		                                    									<input name="dynamic_form_communication_0" class="input input--full-width change-in-messanger-data" placeholder="{{ __('cabinet/organization/home.placeholder') }}" id="dynamic_form_communication_0">
		                                  									</div>
		                                								</div>
	                                								@else


	                                									<?php $mass_m = explode(',', $f->messanger);?>

	                                									@foreach($mass_m as $m)
		                                									<?php $data_m = explode(': ', $m); ?>
		                                									<div class="dynamic-form__elements container-c spawn-method" style="position: relative;">
			                                  									<div class="dynamic-form__left-element">

			                                    									<div class="select-standard select-standard--without-search messanger-block"  data-list="{{ $i }}">
			                                      										<button type="button" class="select-standard__toggle toggle-list-messanger close" aria-label="Открыть список">
			                                         										<span class="select-standard__title get-name">
			                                          											{{ $data_m[0] }}
			                                        										</span>
			                                        										<span class="select-standard__arrow">
			                                          											<svg width="13" height="7">
			                                          												<use xlink:href="#icon-arrow"></use>
			                                          											</svg>
			                                        										</span>
			                                      										</button>
			                                      										<div class="select-standard__body list-messenger list-messenger-{{ $i }}">

			                                      										</div>
			                                    									</div>
			                                  									</div>
			                                  									<div class="dynamic-form__right-element">
			                                    									<label for="dynamic_form_communication_0" class="label visually-hidden">
			                                      										Метод связи
			                                    									</label>
			                                    									<input name="dynamic_form_communication_0" class="input input--full-width change-in-messanger-data" placeholder="{{ __('cabinet/organization/home.placeholder') }}" value="{{$data_m[1]}}" data-name="{{$data_m[0]}}" data-data="{{$data_m[1]}}">

			                                  									</div>
                                                                                <button type="button" class="delete cloned-input__delete delete-messanger-data" aria-label="Удалить">
                                                                                    <svg width="17" height="21">
                                                                                        <use xlink:href="#icon-trash"></use>
                                                                                    </svg>
                                                                              </button>
			                                								</div>
		                                								@endforeach
	                                								@endif
	                                								<div class="spawn-methods spawn-method"></div>

	                                								<input type="hidden" name="messanger_list_data_{{ $i }}" class="messanger_list_data" value="{{ $f->messanger }}">
	                                								<div class="cloned-input">
	                              										<button type="button" class="cloned-input__add add-method-c">
	                                										{{ __('cabinet/organization/home.add_other_comm') }}
	                              										</button>
	                            									</div>
	                              								</div>
	                            							</div>
	                            							<input type="hidden" name="defaul_id_{{ $i }}" value="{{ $f->id }}">
	                          							</li>
	                          							<?php $i++; ?>
	                          							@endforeach
	                          						@endif
                        						</ol>
                        						<p class="edit-information__add">
                          							<button type="button" class="button button--add-something" onclick="addNewFiliya();">
                            							{{ __('cabinet/organization/home.add_fil') }}
                          							</button>
                        						</p>
                      						</div>
                    					</div>
                    					<div class="tabs__info-block tabs__info-block--hidden" id="tab_2">
                      						<div class="edit-information__description">
                        						<div class="edit-information__input-elements">
                          							<label for="edit_description_ru" class="label label--has-icon">
                           								Описание
                            							<svg width="13" height="13">
                              								<use xlink:href="#icon-ru"></use>
                            							</svg>
                          							</label>
                          							<textarea name="edit_description_ru" class="input input--full-width input--textarea" placeholder="Напишите немного о вашей школе" id="edit_description_ru">{{ ($org) ? $org->desc_ru : '' }}</textarea>
                        						</div>
                        						<div class="edit-information__input-elements">
                          							<label for="edit_description_ua" class="label label--has-icon">
                            							Опис
                            							<svg width="13" height="13">
                              								<use xlink:href="#icon-ua"></use>
                            							</svg>
                          							</label>
                          							<textarea name="edit_description_ua" class="input input--full-width input--textarea" placeholder="Напишіть пару слів про школу" id="edit_description_ua">{{ ($org) ? $org->desc_ua : '' }}</textarea>
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
                                                <form action="{{ route('cabinet.organization.uploadPhotoMass', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" class="dropzone">
                            						<div class="load-file__content" tabindex="0" id="dropzone">
                              							<svg width="67" height="70">
                                							<use xlink:href="#icon-load-photo-bold"></use>
                              							</svg>
                              							<p class="load-file__help-text">
                                							{{ (App::isLocale('ru'))? 'Что б загрузить фото, переместите их эту область' : 'Щоб загрузити фото, перемістіть їх в цю область' }}
                              							</p>
                                                        <input name="file" type="file" multiple class="visually-hidden load-file__multiple" id="gallery_photos">
                            						</div>
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
                            							{{ (App::isLocale('ru'))? 'Выбрать' : 'Вибрати' }}
                          							</label>
                        						</div>
                      						</div>
                    					</div>
                  					</div>

                  					<div style="display: none;" id="region_list">
									   <div class="search">
											<label for="region_search" class="visually-hidden">
												Поиск
											</label>
											<button class="search__button" aria-label="Искать">
												<svg width="15" height="16" class="search__icon">
													<use xlink:href="#icon-search"></use>
												</svg>
											</button>
											<input type="search" name="search" class="input input--search" placeholder="Поиск" id="region_search" data-search="region">
										</div>
                  						<ul class="select-standard__list">
                  							@foreach($query as $region)
      											<li class="list-search-region">
        											<button type="button" class="select-standard__option get-region" data-name="{{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}" data-id="{{ $region->id }}">
          												{{ (App::isLocale('ru'))? $region->name_ru : $region->name_uk }}
        											</button>
      											</li>
  											@endforeach
										</ul>
                  					</div>
                  					<div style="display: none;" id="list_messenger">
                  						<ul class="select-standard__list">
  											<li>
    											<button type="button" class="select-standard__option get-messanger" data-name="Telegram">
      												Telegram
    											</button>
  											</li>
  											<li>
    											<button type="button" class="select-standard__option get-messanger" data-name="Viber">
      												Viber
    											</button>
  											</li>
  											<li>
    											<button type="button" class="select-standard__option get-messanger" data-name="WhatsApp">
      												WhatsApp
    											</button>
  											</li>
  											<li>
    											<button type="button" class="select-standard__option get-messanger" data-name="Instagram">
      												Instagram
    											</button>
  											</li>
  											<li>
    											<button type="button" class="select-standard__option get-messanger" data-name="Facebook">
      												Facebook
    											</button>
  											</li>
  											<li>
    											<button type="button" class="select-standard__option get-messanger" data-name="YouTube">
      												YouTube
    											</button>
  											</li>
										</ul>
                  					</div>
                  					<div class="lang_module" style="display: none;">
                  						<div class="city_lang">{{ __('cabinet/organization/home.city') }}</div>
                  						<div class="address_lang">{{ __('cabinet/organization/home.address') }}</div>
                  						<div class="phones_lang">{{ __('cabinet/organization/home.phones') }}</div>
                  						<div class="add_number_lang">{{ __('cabinet/organization/home.add_number') }}</div>
                  						<div class="other_comm_lang">{{ __('cabinet/organization/home.other_comm') }}</div>
                  						<div class="other_comm_add_lang">{{ __('cabinet/organization/home.add_other_comm') }}</div>
                  						<div class="placeholder_lang">{{ __('cabinet/organization/home.placeholder') }}</div>
                  						<div class="select_lang">{{ __('cabinet/organization/home.select') }}</div>
                  					</div>
                                    <div class="lang" style="display: none;">{{ App::getLocale() }}</div>
                				</div>
              				</div>
            			</div>
          			</div>
          		</div>
        	</div>
      	</div>
    </section>
    <script type="text/javascript">
        window.onload = function() {
            //var myDropzone = new Dropzone("div#dropzone", { url: "/file/post"});
            $(document).on('click', '.btn-add-image', function(){
                $('.dropzone').trigger('click');
            })
            $(function() {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            checkCat();
        };
    </script>
@endsection
