<?php

$title = trans('cabinet/person/profile/change-email.Title');
$description = '';
$keywords = '';

?>


@extends('cabinet.person.template')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('cabinet')

    <div class="cabinet__info-block">
        <h2 class="h2 h2--cabinet">
            {{ $title }}
        </h2>
        <form method="POST"
              action="{{ route('cabinet.person.profile.update-email', app()->getLocale()) }}"
              id="fom_cabinet_user_email">
            @csrf
            @method('PUT')
            <div class="form form--recovery-password form--cabinet-email">
                <p class="form__control">
                    <label for="cabinet_user_change_email" class="label">
                        {{ __('cabinet/person/profile/change-email.New email') }}
                    </label>
                    <input type="email" name="email"
                           class="input input--registration @error('email') is-invalid @enderror"
                           id="cabinet_user_change_email"
                           value="{{ old('email') }}"
                           required
                    >
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </p>
                <div class="form__control form__control--description">
                    <div class="form__description">
                        <p>
                            {{ __('cabinet/person/profile/change-email.To the specified email') }}
                        </p>
                    </div>
                </div>
                <p class="form__control form__control--submit">
                    <button type="submit" class="button button--cabinet-submit">
                        <svg width="19" height="15">
                            <use xlink:href="#icon-double-arrows"></use>
                        </svg>
                        {{ __('cabinet/person/profile/change-email.Edit email') }}
                    </button>
                </p>
            </div>
        </form>
    </div>

@endsection
