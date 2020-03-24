<?php

/** @var \App\Model\Publisher\Category\Entity\Category[] $categories */
$title = 'Все категории'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <p><a href="{{ route('admin.publisher.categories.create') }}" class="btn btn-success">Добавить категорию</a></p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('name_ru') }}</th>
                <th>{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('slug') }}</th>
                <th>{{ \App\Model\Publisher\Category\Helper\AdminHelper::getFormLabel('parent') }}</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.publisher.categories.show', $category) }}">{{ $category->name_ru }}</a>
                </td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->parent ? $category->parent->name_ru : null }}</td>
                <td>
                    <div class="d-flex flex-row">
                        <form method="POST" action="{{ route('admin.publisher.categories.first', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-up"></span></button>
                        </form>
                        <form method="POST" action="{{ route('admin.publisher.categories.up', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-up"></span></button>
                        </form>
                        <form method="POST" action="{{ route('admin.publisher.categories.down', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-down"></span></button>
                        </form>
                        <form method="POST" action="{{ route('admin.publisher.categories.last', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-down"></span></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
