<?php

$title = 'Все статьи'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <p><a href="{{ route('admin.article.add_article') }}" class="btn btn-success">Добавить статью</a></p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ \App\Model\Region\Helper\AdminHelper::getFormLabel('name_ru') }}</th>
                <th>Категория</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>
                    <a href="{{ route('admin.article.edit_article', $article) }}">{{ $article->name_ru }}</a>
                </td>
                <td>{{ \App\Article\Category::find($article->cat_id)->name_ru }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $articles->links() }}
@endsection
