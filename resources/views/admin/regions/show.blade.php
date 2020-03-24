<?php

/** @var App\Model\Region\Entity\Region $region */
$title = $region->name_ru;
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.regions.destroy', $region) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-confirm" data-message="Вы подтверждаете действие?">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('name_ru')}}</th><td>{{ $region->name_ru }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('name_uk')}}</th><td>{{ $region->name_uk }}</td>
            </tr>
            <tr>
                <th>{{\App\Model\Category\Helper\AdminHelper::getFormLabel('slug')}}</th><td>{{ $region->slug }}</td>
            </tr>
        </tbody>
    </table>


@endsection

