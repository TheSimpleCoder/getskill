<?php

/** @var \App\Model\Category\Entity\Category[] $parents */
$title = 'Создать новую категорию'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" role="form">
                    <div class="card-body">
                        @csrf
                        <?php $name = 'parent' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <select id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" required>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old($name) ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                        {{ $parent->name_ru }}
                                    </option>
                                @endforeach;
                            </select>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'name_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'name_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'description_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class=" col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="summernote form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="5">{{ old($name) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'description_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="summernote form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="5">{{ old($name) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'image' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" type="file" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">
                        </div>


                        <?php $name = 'meta_title_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'meta_title_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'meta_description_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="2">{{ old($name) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'meta_description_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="2">{{ old($name) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'meta_keywords_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'meta_keywords_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
