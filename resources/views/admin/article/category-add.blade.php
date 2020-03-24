<?php

/** @var \App\Model\Category\Entity\Category[] $parents */
$title = 'Добавить новую категорию'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.article.add_category_save') }}" role="form">
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

                        <div class="form-group">
                            <label for="name_seo_1" class="col-form-label">SEO заголовок ru</label>
                            <input id="name_seo_1" class="form-control" name="seo_name_ru" required>
                        </div>

                        <div class="form-group">
                            <label for="name_seo_2" class="col-form-label">SEO заголовок ua</label>
                            <input id="name_seo_2" class="form-control" name="seo_name_ua" required>
                        </div>

                        <div class="form-group">
                            <label for="desc_seo_1" class="col-form-label">SEO описание ru</label>
                            <input id="desc_seo_1" class="form-control" name="seo_desc_ru" required>
                        </div>

                        <div class="form-group">
                            <label for="desc_seo_2" class="col-form-label">SEO описание ua</label>
                            <input id="desc_seo_2" class="form-control" name="seo_desc_ua" required>
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
