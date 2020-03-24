<?php

$title = trans('auth/password/reset.Title');
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

    <section class="page-name">
        <div class="container page-name__inner">
            <h2 class="h2">{{$title}}</h2>
        </div>
    </section>
    <section class="recovery-password recovery-password--next-step">
        <div class="container recovery-password__inner">
            <h2 class="visually-hidden">{{$title}}</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form form--recovery-password form--recovery-password--next-step">
                    <p class="form__control">
                        <label for="recovery_password_enter_email" class="label">
                            {{ __('auth/password/reset.Email') }}
                        </label>
                        <input type="email" name="email"
                               class="input input--registration @error('email') is-invalid @enderror"
                               id="recovery_password_enter_email"
                               value="{{ $email ?? old('email') }}" required readonly
                        >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>
                    <p class="form__control">
                        <?php $name = 'password' ?>
                        <label for="registration_user_password" class="label">
                            {{ __('auth/password/reset.Password') }}
                        </label>
                        <input type="password" name="{{$name}}"
                               class="input input--registration @error($name)is-invalid @enderror"
                               id="registration_user_password"
                               required autofocus
                        >
                        @error($name)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>
                    <p class="form__control">
                        <?php $name = 'password_confirmation' ?>
                        <label for="registration_user_password_repeat" class="label">
                            {{ __('auth/password/reset.New password') }}
                        </label>
                        <input type="password" name="{{$name}}"
                               class="input input--registration @error($name)is-invalid @enderror"
                               id="registration_user_password_repeat"
                               required
                        >
                        @error($name)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>
                    <div class="form__control form__control--description">
                        <div class="form__description">
                            <p>
                                {{ __('auth/password/reset.Password must be') }}
                            </p>
                            <ul class="form__content-list form__content-list--circle">
                                <li>
                                    {{ __('auth/password/reset.Min length') }}
                                </li>
                                <li>
                                    {{ __('auth/password/reset.Without') }}
                                    <br>
                                    (!, ?, \, /, и т. п.)
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="form__control form__control--submit">
                        <button type="submit" class="button button--recovery-next-step">
                            {{ __('auth/password/reset.Save new password') }}
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </section>

@endsection
