<?php
$title = 'Модерация курса';
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    Организация
                </td>
                <td>
                	{{ $org->name_ru }}
                </td>
            </tr>
            <tr>
                <td>
                    Название ру.
                </td>
                <td>
                    {{ $course->name_ru }}
                </td>
            </tr>
            <tr>
                <td>
                    Название укр.
                </td>
                <td>
                    {{ $course->name_ua }}
                </td>
            </tr>
            <tr>
                <td>
                    Тип
                </td>
                <td>
                    @if($course->type == 1)
                        Офлайн
                    @else
                        Онлайн
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Категория
                </td>
                <td>
                    {{ $cat->name_ru }}
                </td>
            </tr>
            <tr>
                <td>
                    Цена
                </td>
                <td>
                    {{ $course->price }}
                </td>
            </tr>
            <tr>
                <td>
                    Описание ру.
                </td>
                <td>
                    {{ $course->desc_ru }}
                </td>
            </tr>
            <tr>
                <td>
                    Описание укр.
                </td>
                <td>
                    {{ $course->desc_ua }}
                </td>
            </tr>

        </tbody>
    </table>
    <a href="{{ route('admin.master.update', $course) }}?status=1" class="btn btn-success" style="margin-bottom: 20px;">Одобрить</a>
    <form method="GET" action="{{ route('admin.master.update', $course) }}">
        <textarea class="form-control" rows="3" placeholder="Причина отказа" style="margin-bottom: 20px;" name="mess"></textarea>
        <input type="hidden" name="status" value="3">
        <button class="btn btn-danger" type="submit">Отказать</button>
    </form>

@endsection
