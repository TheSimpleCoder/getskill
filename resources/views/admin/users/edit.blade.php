<?php

/** @var App\Model\User\Entity\User $user */
$title = $user->name;
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <?php $name = 'name' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $user->name) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'email' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" type="email" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $user->email) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                        <?php $name = 'role' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\User\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <select id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"{{ $value === old($name, $user->role) ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>

            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.send_box_tarif') }}">
                    @csrf
                    <input type="hidden" name="user" value="{{ $user->id }}">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                                if(Pack::getUserAccessPack($user->id)){
                                    echo Pack::getNamePack(Pack::getUserAccessPack($user->id)->pack) . ', куплен до: ' . date('d.m.Y', Pack::getUserAccessPack($user->id)->time);
                                }else{
                                    echo 'Нет купленого тарифного плана';
                                }
                            ?>
                        </h5>
                        <div class="clearfix">...</div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlSelect1">Тарифный план</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="plan">
                                    @if(Pack::getUserAccessPack($user->id))
                                        @if(Pack::getUserAccessPack($user->id)->pack == 2)
                                            <option value="2">{{ Pack::getNamePack(2) }}</option>
                                        @else
                                            <option value="3">{{ Pack::getNamePack(3) }}</option>
                                        @endif
                                    @else
                                        <option value="2">{{ Pack::getNamePack(2) }}</option>
                                        <option value="3">{{ Pack::getNamePack(3) }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleFormControlSelect2">Срок</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="month">
                                    <option value="1">1 месяц</option>
                                    <option value="3">3 месяца</option>
                                    <option value="6">6 месяцев</option>
                                    <option value="12">1 год</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Подарить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
