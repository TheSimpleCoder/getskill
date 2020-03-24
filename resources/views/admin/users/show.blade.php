<?php

/** @var App\Model\User\Entity\User $user */
$title = $user->name
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Изменить</a>

        @if ($user->isWait())
            <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">Активировать</button>
            </form>
        @endif

        @can('manage-users')
            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-confirm" data-message="Вы подтверждаете действие?">Удалить</button>
            </form>
        @endcan
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
            <tr><th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('name') }}</th><td>{{ $user->name }}</td></tr>
            <tr><th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('email') }}</th><td>{{ $user->email }}</td></tr>
            <tr>
                <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('type') }}</th>
                <td>{!! \App\Model\User\Helper\AdminHelper::showTypeLabel($user) !!}</td>
            </tr>
            <tr>
                <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('status') }}</th>
                <td>{!! \App\Model\User\Helper\AdminHelper::showStatusLabel($user) !!}</td>
            </tr>
            <tr>
                <th>{{ \App\Model\User\Helper\AdminHelper::getFormLabel('role') }}</th>
                <td>{!! \App\Model\User\Helper\AdminHelper::showRoleLabel($user) !!}</td>
            </tr>
            <tr>
                <th>Тарифный план</th>
                <td>
                    <?php
                        if(Pack::getUserAccessPack($user->id)){
                            echo Pack::getNamePack(Pack::getUserAccessPack($user->id)->pack) . ' куплен до: ' . date('d.m.Y', Pack::getUserAccessPack($user->id)->time);
                        }else{
                            echo 'Нет купленого тарифного плана';
                        }
                    ?>
                </td>
            </tr>
        <tbody>
    </table>

@endsection
