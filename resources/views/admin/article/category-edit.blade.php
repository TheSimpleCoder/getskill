<?php

/** @var \App\Model\Category\Entity\Category[] $parents */
$title = 'Изменить'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.article.edit_category_save') }}" role="form">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="form-group">
                            <label for="name_1" class="col-form-label">Название ru</label>
                            <input id="name_1" class="form-control" name="name_ru" required value="{{ $category->name_ru }}">
                        </div>

                        <div class="form-group">
                            <label for="name_2" class="col-form-label">Название ua</label>
                            <input id="name_2" class="form-control" name="name_ua" required value="{{ $category->name_ua }}">
                        </div>

                        <div class="form-group">
                            <label for="name_seo_1" class="col-form-label">SEO заголовок ru</label>
                            <input id="name_seo_1" class="form-control" name="seo_name_ru" required value="{{ $category->seo_name_ru }}">
                        </div>

                        <div class="form-group">
                            <label for="name_seo_2" class="col-form-label">SEO заголовок ua</label>
                            <input id="name_seo_2" class="form-control" name="seo_name_ua" required value="{{ $category->seo_name_ua }}">
                        </div>

                        <div class="form-group">
                            <label for="desc_seo_1" class="col-form-label">SEO описание ru</label>
                            <input id="desc_seo_1" class="form-control" name="seo_desc_ru" required value="{{ $category->seo_desc_ru }}">
                        </div>

                        <div class="form-group">
                            <label for="desc_seo_2" class="col-form-label">SEO описание ua</label>
                            <input id="desc_seo_2" class="form-control" name="seo_desc_ua" required value="{{ $category->seo_desc_ua }}">
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('admin.article.delete_category', $category) }}" class="btn btn-danger">Удалить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
