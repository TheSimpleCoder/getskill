<?php

$title = 'Записи базы знаний'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <p><a href="{{ route('admin.faq_article_add') }}" class="btn btn-success">Добавить запись</a></p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Категория</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($lists as $list)
            <tr>
                <td>
                    <a href="{{ route('admin.faq_article_edit', $list) }}">{{ $list->name_ru }}</a>
                </td>
                <td>{{ \App\FaqCategory::find($list->category)->name_ru }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $lists->links() }}
@endsection
