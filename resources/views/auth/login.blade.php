<?php

$title = trans('auth/login.Title');
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
            <h2 class="h2">{{ __('auth/login.Title') }}</h2>
        </div>
    </section>


    <section class="enter">
        <div class="container enter__inner">
            <h2 class="visually-hidden">{{ __('auth/login.Form title') }}</h2>
            <div class="enter__wrapper">
                <div class="enter__form">
                    <form class="js-form-validation" method="POST" action="{{ route('login', app()->getLocale()) }}">
                        @csrf
                        <div class="form">
                            <p class="form__control">
                                <label for="registration_enter_email" class="label">E-mail</label>
                                <input type="email" name="email"
                                       class="input input--registration @error('email') is-invalid @enderror"
                                       id="registration_enter_email" required autocomplete="email" autofocus
                                       value="{{ old('email') }}"
                                >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </p>
                            <p class="form__control">
                                <label for="registration_enter_password" class="label">{{ __('auth/login.Password') }}</label>
                                <input type="password" name="password"
                                       class="input input--registration @error('email') is-invalid @enderror"
                                       id="registration_enter_password" required
                                >
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                            <p class="form__control">
                                <a href="{{ route('password.request', app()->getLocale()) }}" class="link link--enter">
                                    {{ __('auth/login.Forgot your password?') }}
                                </a>
                            </p>
                            <p class="form__control form__control--submit">
                                <button type="submit" class="disabled button button--enter">
                                    {{ __('auth/login.Enter in your account') }}
                                </button>
                            </p>
                        </div>
						<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    </form>
                </div>
                <div class="enter__by-social" data-text="{{ __('auth/login.Or') }}">
                    <div class="by-social">
                        <p class="by-social__text">
                            {{ __('auth/login.Log in with') }}
                        </p>
                        <ul class="by-social__list">
                            <li class="by-social__item">
                                <a href="#" class="by-social__link by-social__link--google">
                                    <svg width="20" height="19">
                                        <use xlink:href="#icon-google"></use>
                                    </svg>
                                    {{ __('auth/login.Enter by Google') }}
                                </a>
                            </li>
                            <li class="by-social__item">
                                <a href="#" class="by-social__link by-social__link--facebook">
                                    <svg width="19" height="19">
                                        <use xlink:href="#icon-facebook"></use>
                                    </svg>
                                    {{ __('auth/login.Enter by Facebook') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
