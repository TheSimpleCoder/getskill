<?php

$title = 'Изменить статью'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.article.edit_article_save') }}" role="form">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $article->id }}">
                        <div class="form-group">
                            <label for="img" class="col-form-label">Изображение</label>
                            <input type="file" id="img" class="form-control" name="img">
                        </div>

                        <img src="{{ $article->img }}" alt="изображение" width="200" class="img-thumbnail">

                        <div class="form-group">
                            <label for="name_1" class="col-form-label">Название ru</label>
                            <input id="name_1" class="form-control" name="name_ru" required value="{{ $article->name_ru }}">
                        </div>

                        <div class="form-group">
                            <label for="name_2" class="col-form-label">Название ua</label>
                            <input id="name_2" class="form-control" name="name_ua" required value="{{ $article->name_ua }}">
                        </div>

                        <div class="form-group">
                            <label for="name_content_1" class="col-form-label">Контент ru</label>
                            <textarea name="content_ru">{{ $article->content_ru }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name_content_2" class="col-form-label">Контент ua</label>
                            <textarea name="content_ua">{{ $article->content_ua }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-form-label">Категория</label>
                            <select class="form-control" name="cat_id">
                                @foreach($categorys as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $article->cat_id) selected @endif>{{ $category->name_ru }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cat_course_id" class="col-form-label">Категория</label>
                            <select class="form-control" name="cat_course_id">
                                @foreach($cat_courses_online as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $article->cat_course_id) selected @endif>Онлайн - {{ $category->name_ru }}</option>
                                @endforeach
                                @foreach($cat_courses_offline as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $article->cat_course_id) selected @endif>Офлайн - {{ $category->name_ru }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name_seo_1" class="col-form-label">SEO заголовок ru</label>
                            <input id="name_seo_1" class="form-control" name="seo_name_ru" required value="{{ $article->seo_name_ru }}">
                        </div>

                        <div class="form-group">
                            <label for="name_seo_2" class="col-form-label">SEO заголовок ua</label>
                            <input id="name_seo_2" class="form-control" name="seo_name_ua" required value="{{ $article->seo_name_ua }}">
                        </div>

                        <div class="form-group">
                            <label for="desc_seo_1" class="col-form-label">SEO описание ru</label>
                            <input id="desc_seo_1" class="form-control" name="seo_desc_ru" required value="{{ $article->seo_desc_ru }}">
                        </div>

                        <div class="form-group">
                            <label for="desc_seo_2" class="col-form-label">SEO описание ua</label>
                            <input id="desc_seo_2" class="form-control" name="seo_desc_ua" required value="{{ $article->seo_desc_ua }}">
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
