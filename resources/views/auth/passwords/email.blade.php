<?php

$title = trans('auth/password/request.Title');
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

    <section class="recovery-password">
        <div class="container recovery-password__inner">
            <h2 class="visually-hidden">{{ __('auth/password/request.Form title') }}</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form form--recovery-password">
                    <p class="form__control">
                        <label for="recovery_password_enter_email" class="label">
                            {{ __('auth/password/request.Email') }}
                        </label>
                        <input type="email" name="email"
                               class="input input--registration @error('email') is-invalid @enderror"
                               id="recovery_password_enter_email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus
                        >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>
                    <div class="form__control form__control--description">
                        <div class="form__description">
                            <p>
                                {!! __('auth/password/request.Right text') !!}
                            </p>
                        </div>
                    </div>
                    <p class="form__control form__control--submit">
                        <button type="submit" class="button button--recovery-password">
                            {{ __('auth/password/request.Send') }}
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </section>

@endsection
