<?php

$title = 'Редактирование записи базы знаний'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.faq_article_add_update') }}" role="form" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $article->id }}">
                        <div class="form-group">
                            <label for="name_1" class="col-form-label">Название ru</label>
                            <input id="name_1" class="form-control" name="name_ru" value="{{ $article->name_ru }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name_2" class="col-form-label">Название ua</label>
                            <input id="name_2" class="form-control" name="name_ua" value="{{ $article->name_ua }}" required>
                        </div>

                        <div class="form-group">
                            <label for="cat_course_id" class="col-form-label">Категория</label>
                            <select class="form-control" name="category">
                                @foreach($categorys as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $article->category) selected @endif>{{ $category->name_ru }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text_ru" class="col-form-label">Описание ru</label>
                            <textarea name="text_ru" id="text_ru" rows="10">{{ $article->text_ru }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="text_ua" class="col-form-label">Описание ua</label>
                            <textarea name="text_ua" id="text_ua" rows="10">{{ $article->text_ua }}</textarea>
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
