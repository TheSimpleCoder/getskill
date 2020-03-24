<?php

/** @var \App\Model\Publisher\Category\Entity\Category $category */
$title = $category->name_ru;
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.publisher.categories.edit', $category) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.publisher.categories.destroy', $category) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-confirm" data-message="Вы подтверждаете действие?">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('name_ru')}}</th><td>{{ $category->name_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('name_uk')}}</th><td>{{ $category->name_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('slug')}}</th><td>{{ $category->slug }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('parent')}}</th><td>{{ $category->parent ? $category->parent->name_ru : null }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('image')}}</th>
                <td>
                    @if($category->image)
                        <a href="{{ $category->getImageUrl() }}" target="_blank">
                            <img class="attachment-img" style="max-width: 150px" src="{{ $category->getImageUrl() }}" alt="image">
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('meta_title_ru')}}</th><td>{{ $category->meta_title_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('meta_title_uk')}}</th><td>{{ $category->meta_title_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('meta_description_ru')}}</th><td>{{ $category->meta_description_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('meta_description_uk')}}</th><td>{{ $category->meta_description_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('meta_keywords_ru')}}</th><td>{{ $category->meta_keywords_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('meta_keywords_uk')}}</th><td>{{ $category->meta_keywords_uk }}</td>
            </tr>
        </tbody>
    </table>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('description_ru')}}</h3>
        </div>
        <div class="card-body">
            {!! nl2br($category->description_ru) !!}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{\App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('description_uk')}}</h3>
        </div>
        <div class="card-body">
            {!! nl2br($category->description_uk) !!}
        </div>
    </div>

@endsection

