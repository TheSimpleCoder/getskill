<?php

/** @var App\Model\User\Entity\User[] $users */
$title = 'Все пользователи'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <p><a href="{{ route('admin.users.create') }}" class="btn btn-success">Создать пользователя</a></p>

    <div class="card mb-3">
        <div class="card-header">Фильтр</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <?php $name = 'name' ?>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control" name="{{$name}}" value="{{ request('name') }}">
                        </div>
                    </div>

                    <?php $name = 'email' ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control" name="{{$name}}" value="{{ request('email') }}">
                        </div>
                    </div>

                    <?php $name = 'type' ?>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <select id="{{$name}}" class="form-control" name="{{$name}}">
                                <option value=""></option>
                                @foreach ($types as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('type') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                        </div>
                    </div>

                    <?php $name = 'status' ?>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <select id="{{$name}}" class="form-control" name="{{$name}}">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                        </div>
                    </div>

                    <?php $name = 'role' ?>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <select id="{{$name}}" class="form-control" name="{{$name}}">
                                <option value=""></option>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('role') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Поиск</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('name') }}</th>
            <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('email') }}</th>
            <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('type') }}</th>
            <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('status') }}</th>
            <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('role') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($users as $user)
            <tr>
                <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{!! \App\Model\User\Helper\AdminHelper::showTypeLabel($user) !!}</td>
                <td>{!! \App\Model\User\Helper\AdminHelper::showStatusLabel($user) !!}</td>
                <td>{!! \App\Model\User\Helper\AdminHelper::showRoleLabel($user) !!}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $users->links() }}
@endsection
