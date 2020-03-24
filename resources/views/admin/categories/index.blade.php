<?php

/** @var \App\Model\Category\Entity\Category[] $categories */
$title = 'Все категории'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ \App\Model\Category\Helper\AdminHelper::getFormLabel('name_ru') }}</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.categories.list', $category) }}">{{ $category->name_ru }}</a>
                </td>
                <td>
                    <div class="d-flex flex-row">
                        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-outline-primary mr-2"><span class="fas fa-eye"></span></a>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-warning"><span class="fas fa-edit"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
