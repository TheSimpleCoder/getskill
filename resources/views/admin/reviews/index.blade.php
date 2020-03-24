<?php
$title = 'Модерация курсов';
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Отзыв</th>
                <th>Время</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($lists as $list)
            <tr>
                <td>
                    {{ $list->text }}
                </td>
                <td>{{ date('d.m.Y', $list->time) }}</td>
                <td>
                	<a href="{{ route('admin.reviews.update', $list) }}?delete=yes&id={{ $list->id }}&status=no" class="btn btn-sm btn-outline-primary mr-2">
                		Удалить
                	</a>
                    <a href="{{ route('admin.reviews.update', $list) }}?delete=no&id={{ $list->id }}&status=yes" class="btn btn-sm btn-outline-primary mr-2">
                        Отменить
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
