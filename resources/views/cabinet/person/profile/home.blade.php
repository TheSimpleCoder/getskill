<?php

$title = trans('cabinet/person/profile/home.Title');
$description = '';
$keywords = '';


/** @var App\Model\User\Entity\User $user */

?>


@extends('cabinet.person.template')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('cabinet')

    <div class="cabinet__info-block">
        @if($user->getImageUrl())
            <img src="/storage/{{ Auth::user()->image }}" alt="" width="150">
            <form method="POST" action="{{ route('cabinet.person.profile.delete-image', app()->getLocale()) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete photo</button>
            </form>
        @endif

        <form method="POST" action="{{ route('cabinet.person.profile.update', app()->getLocale()) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="cabinet__form">
                <div class="cabinet__page-name">
                    <h2 class="h2">{{ $title }}</h2>
                    <div class="cabinet__submit cabinet__submit--hidden">
                        <button type="submit" class="button button--cabinet-submit button--save button--green">
                            <svg width="20" height="21"><use xlink:href="#icon-save"></use></svg>
                            {{ __('cabinet/person/profile/home.Save') }}
                        </button>
                    </div>
                </div>
                <div class="cabinet__item cabinet__item--avatar">
                @if(!$user->getImageUrl())
                    <div class="load-file">
                        <input type="file" name="image" id="cabinet_user_avatar" class="load-file__input visually-hidden">
                        <label for="cabinet_user_avatar" class="load-file__content">
                            <svg width="40" height="42">
                                <use xlink:href="#icon-download-file"></use>
                            </svg>
                            <span class="visually-hidden">
                                {{ __('cabinet/person/profile/home.Download avatar') }}
                            </span>
                        </label>
                        @error('image')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                @endif
                </div>
                <div class="cabinet__item">
                    <div class="cabinet__description">
                        <p class="cabinet__title">{{ __('cabinet/person/profile/home.Private information') }}</p>
                        <p class="cabinet__text">{{ __('cabinet/person/profile/home.Used for review') }}</p>
                    </div>
                    <ul class="cabinet__list">
                        <li>
                            <label for="user_cabinet_name" class="label">
                                {{ __('cabinet/person/profile/home.First Name') }}
                            </label>
                            <input type="text" name="name" class="input input--cabinet @error('name') is-invalid @enderror"
                                   id="user_cabinet_name" value="{{ old('name', $user->name) }}"
                            >
                            @error('name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </li>
                        <li>
                            <label for="user_cabinet_phone" class="label">
                                {{ __('cabinet/person/profile/home.Phone') }}
                            </label>
                            <input type="tel" name="phone" class="input input--cabinet @error('phone') is-invalid @enderror phone-mask"
                                   id="user_cabinet_phone" value="{{ old('phone', $user->phone) }}"
                                   placeholder="380 xxx xx xx xx"
                            >
                            @error('phone')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </li>
                    </ul>
                </div>
                <div class="cabinet__item">
                    <div class="cabinet__description">
                        <p class="cabinet__title">{{ __('cabinet/person/profile/home.Login and password') }}</p>
                        <p class="cabinet__text">
                            {{ __('cabinet/person/profile/home.Used for authorization') }}
                        </p>
                    </div>
                    <div class="cabinet__details">
                        <p>
                            <span>{{ __('cabinet/person/profile/home.Email') }}</span>
                            <a href="{{ route('cabinet.person.profile.change-email', app()->getLocale()) }}">{{ __('cabinet/person/profile/home.Edit') }}</a>
                        </p>
                        <p>
                            <span>{{ __('cabinet/person/profile/home.Password') }}</span>
                            <a href="{{ route('cabinet.person.profile.change-password', app()->getLocale()) }}">{{ __('cabinet/person/profile/home.Edit') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
