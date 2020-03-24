<?php

$title = 'Обращения пользователей'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Причина</th>
                <th>Сообщение</th>
                <th>Время</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($lists as $list)
            <tr>
                <td>
                    {{ $list->name }}
                </td>
                <td>{{ $list->email }}</td>
                <td>
                    <?php
                        switch ($list->type) {
                            case 1:
                                echo 'Сертификат';
                                break;
                            case 2:
                                echo 'Техничиский вопрос';
                                break;
                            case 3:
                                echo 'Улучшение сайта';
                                break;
                            case 4:
                                echo 'Партнерское предложение';
                                break;
                            case 5:
                                echo 'Жалоба';
                                break;
                        }
                    ?>
                </td>
                <td>{!! $list->text !!}</td>
                <td>{{ date('d.m.Y H:i', $list->time) }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $lists->links() }}
@endsection
