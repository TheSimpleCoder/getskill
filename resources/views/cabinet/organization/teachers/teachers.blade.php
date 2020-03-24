<?php

$title = trans('cabinet/organization/teachers.Title');
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
				<div class="curse teachers">
					<div class="curse__header">
						<h2 class="h2">
							{{ __('cabinet/organization/teachers.Title') }}
						</h2>
						@if($org)
							<button type="button" class="button button--add-something button--green button--icon-transform" onclick=location='{{ route("cabinet.organization.teachers_add", app()->getLocale()) }}'>
								{{ __('cabinet/organization/teachers.Add_teacher') }}
							</button>
						@endif
					</div>
					@if($org)
						<ul class="curse__list teachers__list">
							@foreach($lists as $list)
								<li class="curse__item">
									<article class="curse__content teachers__content">
										<div class="curse__img teachers__img">
											<img src="{{ $list->img }}" width="47" height="47" alt="Ольга Микетюк">
										</div>
										<div class="curse__name teachers__name">
											<p class="curse__link-wrap">
												{{ (App::isLocale('ru'))? $list->name_ru : $list->name_ru }}
											</p>
										</div>
										<p class="curse__status curse__status--active">
											@if($list->status == 1)
												{{ __('cabinet/organization/teachers.Active') }}
											@endif
										</p>
										<div class="curse__action teachers__action">
											<button type="button" class="delete teacher__delete" aria-label="Удалить" onclick=location='{{ route("cabinet.organization.teachers_edit", ["locale" => app()->getLocale(), "id" => $list->id]) }}?delete=yes'>
												<svg width="11" height="15">
													<use xlink:href="#icon-trash"></use>
												</svg>
											</button>
											<button type="button" class="edit" aria-label="Редактировать" onclick=location='{{ route("cabinet.organization.teachers_edit", ["locale" => app()->getLocale(), "id" => $list->id]) }}'>
												<svg width="16" height="15">
													<use xlink:href="#icon-pen"></use>
												</svg>
											</button>
										</div>
									</article>
								</li>
							@endforeach
						</ul>
					@else
						{{ __('cabinet/organization/teachers.Error_org') }}
					@endif
				</div>
			</div>
		</div>
    </section>
@endsection