<?php

/** @var \App\Model\Category\Entity\Category $region */
$title = 'Изменить ' . $region->name_ru;
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">

                <form method="POST" action="{{ route('admin.regions.update', $region) }}">
                    <div class="card-body">
                        @csrf
                        @method('PUT')


                        <?php $name = 'name_ru' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{\App\Model\Region\Helper\AdminHelper::getFormLabel($name)}}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $region->name_ru) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>


                        <?php $name = 'name_uk' ?>
                        <div class="form-group">
                            <label for="{{$name}}" class="col-form-label">{{ \App\Model\Region\Helper\AdminHelper::getFormLabel($name) }}</label>
                            <input id="{{$name}}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{ old($name, $region->name_uk) }}" required>
                            @if ($errors->has($name))
                                <span class="invalid-feedback"><strong>{{ $errors->first($name) }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
