<?php

$title = trans('cabinet/organization/teachers.Edit_teacher');
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
          		<div class="curse teachers curse__teachers--edit">
          			<form action="{{ route('cabinet.organization.teachers_add_save_edit', app()->getLocale()) }}" method="POST" id="add_curse_organization" autocomplete="off" enctype="multipart/form-data">
          				{{ csrf_field() }}
          				<input type="hidden" name="id_t" value="{{ $val->id }}">
	            		<div class="curse__header curse__header--edit">
	              			<h2 class="h2">
	                			{{ __('cabinet/organization/teachers.Add_teacher') }}
	              			</h2>

	                		<div class="reviews__option-wrap">
	                    		<button type="button" class="reviews__options" aria-label="Дополнительние действия">
	                        		<span class="reviews__options-circle"></span>
	                        		<span class="reviews__options-circle"></span>
	                        		<span class="reviews__options-circle"></span>
	                    		</button>
	                    		<div class="reviews__option-dropdown">
	                    			<button type="button" class="button button-delete button--red" onclick=location='{{ route("cabinet.organization.teachers_edit", ["locale" => app()->getLocale(), "id" => $val->id]) }}?delete=yes'>
                            			<svg width="17" height="21" style="fill: #fe5555;">
                              				<use xlink:href="#icon-trash"></use>
                            			</svg>
                            			Удалить
                          			</button>
	                        		<button type="submit" class="button disabled hide-mobile button--cabinet-submit button--save button--green">
	                            		<svg width="20" height="21">
	                              			<use xlink:href="#icon-save"></use>
	                            		</svg>
	                            		Сохранить
	                          		</button>
                                    <button type="submit" class="button disabled button--cabinet-submit button--save button--green button--fixed show-mobile">
                                        <svg width="20" height="21">
                                            <use xlink:href="#icon-save"></use>
                                        </svg>
                                        Сохранить
                                    </button>
	                    		</div>

                                <button type="submit" class="button disabled button--cabinet-submit button--save button--green button--fixed show-mobile">
                                    <svg width="20" height="21">
                                        <use xlink:href="#icon-save"></use>
                                    </svg>
                                    Сохранить
                                </button>
	                		</div>

	              		</div>

	            		<div class="edit-information__name">
	                		<div class="edit-information__wrapper-name">
	                  			<div class="edit-information__input-elements">
	                    			<label for="edit_name_ru" class="label label--has-icon label--required">
	                      				ФИО
	                      				<svg width="13" height="13">
	                        				<use xlink:href="#icon-ru"></use>
	                      				</svg>
	                    			</label>
	                    			<input required type="text" name="edit_teachers_name_ru" class="input input--full-width" id="edit_teachers_name_ru"
	                    			value="{{ $val->name_ru }}">
	                  			</div>
	                  			<div class="edit-information__input-elements">
	                    			<label for="edit_name_ua" class="label label--has-icon label--required">
	                      				ПІП
	                      				<svg width="13" height="13">
	                       					<use xlink:href="#icon-ua"></use>
	                      				</svg>
	                    			</label>
	                    			<input required type="text" name="edit_teachers_name_ua" class="input input input--full-width" id="edit_teachers_name_ua" value="{{ $val->name_ua }}">
	                  			</div>
	                		</div>
	                		<div class="load-file">
	                  			<p class="label load-file__title">
	                    			Фото
	                  			</p>
	                  			<input type="file" name="cabinet_user_avatar" id="cabinet_user_avatar" class="load-file__input visually-hidden">
	                  			<label for="cabinet_user_avatar" class="load-file__content">
	                    			<svg width="40" height="42">
	                      				<use xlink:href="#icon-download-file"></use>
	                    			</svg>
	                    			<span class="visually-hidden">
	                        			Загрузить аватарку
	                      			</span>
	                      			<img id="image" src="{{ ($val->img) ? $val->img : '#' }}" alt="" style="max-width: 100%; max-height: 100%;" />
	                  			</label>
	                		</div>
	              		</div>

	              		<div class="edit-information__description">
	                		<div class="edit-information__input-elements">
	                  			<label for="edit_description_ru" class="label label--has-icon label--required">
	                    			Описание
	                    			<svg width="13" height="13">
	                      				<use xlink:href="#icon-ru"></use>
	                    			</svg>
	                  			</label>
	                  			<textarea required name="edit_teachers_description_ru" class="input input--full-width input--textarea" placeholder="Напишите немного о вашей школе" id="edit_teachers_description_ru">{{ $val->desc_ru }}</textarea>
	                		</div>
	                		<div class="edit-information__input-elements">
	                  			<label for="edit_teachers_description_ua" class="label label--has-icon label--required">
	                    			Опис
	                    			<svg width="13" height="13">
	                      				<use xlink:href="#icon-ua"></use>
	                    			</svg>
	                  			</label>
	                  			<textarea required name="edit_teachers_description_ua" class="input input--full-width input--textarea" placeholder="Напишіть пару слів про школу" id="edit_teachers_description_ua">{{ $val->desc_ua }}</textarea>
	                		</div>
	              		</div>
	              	</form>
          		</div>
        	</div>

		</div>
	</section>

@endsection
