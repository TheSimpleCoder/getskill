<?php

$title = 'Обращения пользователей'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <p><a href="{{ route('admin.faq_category_add') }}" class="btn btn-success">Добавить категорию</a></p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Имя</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($lists as $list)
            <tr>
                <td>
                    <a href="{{ route('admin.faq_category_edit', $list) }}">{{ $list->name_ru }}</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $lists->links() }}
@endsection
