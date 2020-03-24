<?php

$title = trans('cabinet/person/profile/change-password.Title');
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
              action="{{ route('cabinet.person.profile.update-password', app()->getLocale()) }}"
              id="form_cabinet_change_password_user">
            @csrf
            @method('PUT')

            <div class="form form--recovery-password form--cabinet-password">

                <?php $name = 'current_password' ?>
                <p class="form__control">
                    <label for="cabinet_change_password__user_this" class="label">
                        {{ __('cabinet/person/profile/change-password.Current password') }}
                    </label>
                    <input type="password" name="{{ $name }}"
                           class="input input--registration @error($name) is-invalid @enderror"
                           id="cabinet_change_password__user_this" required autofocus>
                    @error($name)
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </p>

                <?php $name = 'password' ?>
                <p class="form__control">
                    <label for="cabinet_change_password_user_new" class="label">
                        {{ __('cabinet/person/profile/change-password.New password') }}
                    </label>
                    <input type="password" name="{{ $name }}"
                           class="input input--registration @error($name) is-invalid @enderror"
                           id="cabinet_change_password_user_new" required>
                    @error($name)
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </p>

                <?php $name = 'password_confirmation' ?>
                <p class="form__control">
                    <label for="cabinet_change_password_user_confirm" class="label">
                        {{ __('cabinet/person/profile/change-password.Confirmation password') }}
                    </label>
                    <input type="password" name="{{ $name }}"
                           class="input input--registration @error($name) is-invalid @enderror"
                           id="cabinet_change_password_user_confirm" required>
                    @error($name)
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </p>
                <div class="form__control form__control--description">
                    <div class="form__description">
                        <p>
                            {{ __('cabinet/person/profile/change-password.Password must be') }}
                        </p>
                        <ul class="form__content-list form__content-list--circle">
                            <li>
                                {{ __('cabinet/person/profile/change-password.Min') }}
                            </li>
                            <li>
                                {{ __('cabinet/person/profile/change-password.Without special symbols') }}
                                <br>
                                (!, ?, \, /, и т. п.)
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="form__control form__control--submit">
                    <button type="submit" class="button button--cabinet-submit">
                        <svg width="19" height="15">
                            <use xlink:href="#icon-double-arrows"></use>
                        </svg>
                        {{ __('cabinet/person/profile/change-password.Edit btn') }}
                    </button>
                </p>
            </div>
        </form>
    </div>

@endsection
