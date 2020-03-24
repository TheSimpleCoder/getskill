<?php

/** @var App\Model\Region\Entity\Region[] $regions */
$title = 'Все города'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <p><a href="{{ route('admin.regions.create') }}" class="btn btn-success">Добавить город</a></p>

    <div class="card collapsed-card mb-3">
        <div class="card-header" data-card-widget="collapse">
            <h3 class="card-title">Фильтр</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Название на русском</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Поиск</button>
                            <a href="?" class="btn btn-outline-secondary">Очистить</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ \App\Model\Region\Helper\AdminHelper::getFormLabel('name_ru') }}</th>
                <th>{{ \App\Model\Region\Helper\AdminHelper::getFormLabel('slug') }}</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($regions as $region)
            <tr>
                <td>
                    <a href="{{ route('admin.regions.show', $region) }}">{{ $region->name_ru }}</a>
                </td>
                <td>{{ $region->slug }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $regions->links() }}
@endsection
