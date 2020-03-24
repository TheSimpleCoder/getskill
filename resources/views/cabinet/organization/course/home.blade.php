<?php

$title = trans('cabinet/organization/course.Title');
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
				<div class="curse">
					<div class="curse__header">
						<h2 class="h2">
							{{ __('cabinet/organization/course.Title') }}
						</h2>
						@if($org)
							<button type="button" class="button button--add-something button--green button--icon-transform" onclick=location='{{ route("cabinet.organization.course_add", app()->getLocale()) }}'>
								{{ __('cabinet/organization/course.Add') }}
							</button>
						@endif
					</div>
					@if($org)
						<ul class="curse__list">
							@foreach($courses as $course)
								<li class="curse__item">
									<article class="curse__content">
										<a href="{{ route('cabinet.organization.course_edit', ['locale' => app()->getLocale(), 'id' => $course->id]) }}" class="curse__img">
											<img src="{{ $course->logo_course }}" width="240" height="135" alt="{{ (App::isLocale('ru'))? $course->name_ru : $course->name_ru }}">
										</a>
										<div class="curse__name">
											<p class="curse__link-wrap">
												<a href="{{ route('cabinet.organization.course_edit', ['locale' => app()->getLocale(), 'id' => $course->id]) }}">
													{{ (App::isLocale('ru'))? $course->name_ru : $course->name_ru }}
												</a>
											</p>
											<p class="curse__status-time">
												{{ ($course->type == 1)? 'Онлайн' : 'Офлайн' }}
											</p>
										</div>
										<p class="curse__price">
											{{ $course->price_course }} <?php if($course->currency == 1){ echo "грн."; }elseif ($course->currency == 2) {echo "$";}else{echo "€";} ?>
										</p>
										@if($course->status == 0)
											<p class="curse__status curse__status--hidden">
												{{ __('cabinet/organization/course.Status_4') }}
											</p>
										@endif
										@if($course->status == 1)
											<p class="curse__status curse__status--active">
												{{ __('cabinet/organization/course.Status_1') }}
											</p>
										@endif
										@if($course->status == 2 OR $course->status == 5)
											<p class="curse__status curse__status--hidden">
												{{ __('cabinet/organization/course.Status_' . $course->status) }}
											</p>
										@endif
										@if($course->status == 3)
											<!-- tooltip--open -->
											<div class="curse__status curse__status--rejected tooltip">
                    							<button type="button" class="tooltip__toggle">
                      								{{ __('cabinet/organization/course.Status_3') }}
                      								<svg width="15" height="15">
                        								<use xlink:href="#icon-info-red"></use>
                      								</svg>
                   								</button>
                    							<div class="tooltip__content">
                      								<p class="tooltip__label">
                        								{{ (App::isLocale('ru'))? 'Причины отклонения:' : 'Причини відхилення:' }}
                      								</p>
                      								<p class="tooltip__text">
                        								{!! $course->modern_message !!}
                      								</p>
                    							</div>
                  							</div>
										@endif
										<div class="curse__action">
											<div class="select-standard select-standard--without-search select_class">
												<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
													<span class="select-standard__title">
														{{ __('cabinet/organization/course.Action') }}
													</span>
													<span class="select-standard__arrow">
														<svg width="13" height="7">
															<use xlink:href="#icon-arrow"></use>
														</svg>
													</span>
												</button>
												<div class="select-standard__body select_list select_list-for-curse">
													<ul class="select-standard__list">
														@if($course->status == 0 OR $course->status == 2)
															<li>
																<button type="button" class="select-standard__option" onclick=location='{{ route("cabinet.organization.status_course", app()->getLocale()) }}?status=5&id={{ $course->id }}'>
																	{{ __('cabinet/organization/course.Action_1') }}
																</button>
															</li>
														@endif
														<li>
															<button type="button" class="select-standard__option" onclick=location="{{ route('cabinet.organization.course_edit', ['locale' => app()->getLocale(), 'id' => $course->id]) }}">
																{{ __('cabinet/organization/course.Action_2') }}
															</button>
														</li>
														@if($course->status != 2)
															<li>
																<button type="button" class="select-standard__option" onclick=location='{{ route("cabinet.organization.status_course", app()->getLocale()) }}?status=2&id={{ $course->id }}'>
																	{{ __('cabinet/organization/course.Action_3') }}
																</button>
															</li>
														@endif
														<li>
															<button type="button" class="select-standard__option" onclick=location='{{ route("cabinet.organization.status_course", app()->getLocale()) }}?status=6&id={{ $course->id }}'>
																{{ __('cabinet/organization/course.Action_5') }}
															</button>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</article>
								</li>
							@endforeach
						</ul>
						<div class="curse__navigation">
							<div class="curse__navigation-left">
								<?php echo $courses->render(); ?>
							</div>
							<div class="curse__navigation-right">
								<div class="select-standard select-standard--without-search select_class">
									<button type="button" class="select-standard__toggle select_btn close" aria-label="Открыть список">
										<span class="select-standard__title select_val">
											{{ __('cabinet/organization/course.Position_' . Auth::user()->course_pagination) }}
										</span>
										<span class="select-standard__arrow">
											<svg width="13" height="7">
												<use xlink:href="#icon-arrow"></use>
											</svg>
										</span>
									</button>
									<div class="select-standard__body select_list">
										<ul class="select-standard__list">
											<li>
												<button type="button" class="select-standard__option select_option select_pagination" data-id="10" data-in="pagination" data-locale="{{ App::getLocale() }}">
													{{ __('cabinet/organization/course.Position_10') }}
												</button>
											</li>
											<li>
												<button type="button" class="select-standard__option select_option select_pagination" data-id="20" data-in="pagination" data-locale="{{ App::getLocale() }}">
													{{ __('cabinet/organization/course.Position_20') }}
												</button>
											</li>
											<li>
												<button type="button" class="select-standard__option select_option select_pagination" data-id="30" data-in="pagination" data-locale="{{ App::getLocale() }}">
													{{ __('cabinet/organization/course.Position_30') }}
												</button>
											</li>
										</ul>
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
	</section>
	<div id="current_url" style="display: none;">{{ url()->current() }}</div>
@endsection