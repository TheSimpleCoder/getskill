<?php

/** @var \App\Model\Category\Entity\Category $category */
/** @var \App\Model\Category\Entity\Category $rootCategory */
/** @var App\Model\Category\Entity\Attribute[] $attribures */
/** @var App\Model\Category\Entity\Attribute[] $parentAttributes */

$title = $category->name_ru;
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-confirm" data-message="Вы подтверждаете действие?">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('name_ru')}}</th><td>{{ $category->name_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('name_uk')}}</th><td>{{ $category->name_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('slug')}}</th><td>{{ $category->slug }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('parent')}}</th><td>{{ $category->parent ? $category->parent->name_ru : null }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('image')}}</th>
                <td>
                    @if($category->image)
                        <a href="{{ $category->getImageUrl() }}" target="_blank">
                            <img class="attachment-img" style="max-width: 150px" src="{{ $category->getImageUrl() }}" alt="image">
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('meta_title_ru')}}</th><td>{{ $category->meta_title_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('meta_title_uk')}}</th><td>{{ $category->meta_title_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('meta_description_ru')}}</th><td>{{ $category->meta_description_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('meta_description_uk')}}</th><td>{{ $category->meta_description_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('meta_keywords_ru')}}</th><td>{{ $category->meta_keywords_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('meta_keywords_uk')}}</th><td>{{ $category->meta_keywords_uk }}</td>
            </tr>
        </tbody>
    </table>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{\App\Model\Category\Helper\AdminHelper::getFormLabel('description_ru')}}</h3>
        </div>
        <div class="card-body">
            {!! nl2br($category->description_ru) !!}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{\App\Model\Category\Helper\AdminHelper::getFormLabel('description_uk')}}</h3>
        </div>
        <div class="card-body">
            {!! nl2br($category->description_uk) !!}
        </div>
    </div>

    <p><a href="{{ route('admin.categories.attributes.create', $category) }}" class="btn btn-success">Добавить атрибут</a></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getAttributeLabel('name_ru')}}</th>
                <th>{{\App\Model\Category\Helper\AdminHelper::getAttributeLabel('type')}}</th>
                <th>{{\App\Model\Category\Helper\AdminHelper::getAttributeLabel('required')}}</th>
            </tr>
        </thead>
        <tbody>

        <tr><th colspan="4">Атрибуты родительских категорий</th></tr>

        @forelse ($parentAttributes as $attribute)
            <tr>
                <td>{{ $attribute->name_ru }}</td>
                <td>{{ $attribute->type }}</td>
                <td>{{ $attribute->getRequiredText() }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Пусто</td></tr>
        @endforelse

        <tr><th colspan="4">Атрибуты текущей категории</th></tr>

        @forelse ($attributes as $attribute)
            <tr>
                <td>
                    <a href="{{ route('admin.categories.attributes.show', [$category, $attribute]) }}">{{ $attribute->name_ru }}</a>
                </td>
                <td>{{ $attribute->type }}</td>
                <td>{{ $attribute->getRequiredText() }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Пусто</td></tr>
        @endforelse

        </tbody>
    </table>

@endsection

