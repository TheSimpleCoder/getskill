<?php

$title = 'Все категории'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <p><a href="{{ route('admin.article.add_category') }}" class="btn btn-success">Добавить категорию</a></p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ \App\Model\Region\Helper\AdminHelper::getFormLabel('name_ru') }}</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($categorys as $category)
            <tr>
                <td>
                    <a href="{{ route('admin.article.edit_category', $category) }}">{{ $category->name_ru }}</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $categorys->links() }}
@endsection
