<?php

$title = 'Добавить новую категорию базы знаний'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.faq_category_add_save') }}" role="form" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        <div class="form-group">
                            <label for="name_1" class="col-form-label">Название ru</label>
                            <input id="name_1" class="form-control" name="name_ru" required>
                        </div>

                        <div class="form-group">
                            <label for="name_2" class="col-form-label">Название ua</label>
                            <input id="name_2" class="form-control" name="name_ua" required>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
