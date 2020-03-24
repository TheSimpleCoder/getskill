<?php
$title = 'Модерация курсов';
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Название на русском</th>
                <th>Действие</th>
                <th>Статус</th>
                <th>Причина</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($lists as $list)
            <tr>
                <td>
                    <a href="{{ route('admin.master.show', $list) }}">{{ $list->name_ru }}</a>
                </td>
                <td>
                	<a href="{{ route('admin.master.show', $list) }}" class="btn btn-sm btn-outline-primary mr-2">
                		<span class="fas fa-eye"></span>
                	</a>
                </td>
                <td>
                	@if($list->status == 0)
                		Ожидает модерации
                	@endif
                	@if($list->status == 1)
                		Опубликован
                	@endif
                	@if($list->status == 3)
                		Отклонён
                	@endif
                </td>
                <td>{{ $list->modern_message }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
