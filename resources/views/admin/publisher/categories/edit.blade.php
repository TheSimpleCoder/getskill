<?php

/** @var \App\Model\Publisher\Category\Entity\Category $category */
/** @var \App\Model\Publisher\Category\Entity\Category[] $parents */
$title = 'Изменить ' . $category->name_ru;
?>

@extends('layouts.admin')

@section('title', $title)


@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">

                <form method="POST" action="{{ route('admin.publisher.categories.update', $category) }}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')

                        <?php $name = 'parent' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name)}}</label>
                            <select id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old($name, $category->parent_id) ? ' selected' : '' }}>
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
                            <label for="{{$name}}" class="col-form-label">{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name)}}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $category->name_ru) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'name_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $category->name_uk) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'description_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="5">{{ old($name, $category->description_ru) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'description_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="5">{{ old($name, $category->description_uk) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        @if($category->image)
                            <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                <li>
                                    <a href="{{ $category->getImageUrl() }}" target="_blank">
                                        <span class="mailbox-attachment-icon has-img"><img src="{{ $category->getImageUrl() }}" alt="Attachment"></span>
                                    </a>
                                    <div class="mailbox-attachment-info">
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <a href="{{route('admin.publisher.categories.delete-photo', $category)}}" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i></a>
                            </span>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <?php $name = 'image' ?>
                            <div class="form-group">
                                <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                                <input id="{{$name}}" type="file" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">
                            </div>
                        @endif


                        <?php $name = 'meta_title_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $category->meta_title_ru) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'meta_title_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $category->meta_title_uk) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'meta_description_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="2">{{ old($name, $category->meta_description_ru) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'meta_description_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <textarea id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" rows="2">{{ old($name, $category->meta_description_uk) }}</textarea>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'meta_keywords_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $category->meta_keywords_ru) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'meta_keywords_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $category->meta_keywords_uk) }}">
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
