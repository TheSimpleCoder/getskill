<?php

$title = 'Правила сайта'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="{{ route('admin.terms_update') }}" role="form" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        <div class="form-group">
                            <label for="rules_ru" class="col-form-label">Правила сайта ru</label>
                            <textarea name="rules_ru" id="rules_ru" rows="10">{{ $terms->rules_ru }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="rules_ua" class="col-form-label">Правила сайта ua</label>
                            <textarea name="rules_ua" id="rules_ua" rows="10">{{ $terms->rules_ua }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="offer_ru" class="col-form-label">Публичная оферта ru</label>
                            <textarea name="offer_ru" id="offer_ru" rows="10">{{ $terms->offer_ru }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="offer_ua" class="col-form-label">Публичная оферта ua</label>
                            <textarea name="offer_ua" id="offer_ua" rows="10">{{ $terms->offer_ua }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="terms_ru" class="col-form-label">Политика конфиденциальности ru</label>
                            <textarea name="terms_ru" id="terms_ru" rows="10">{{ $terms->terms_ru }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="terms_ua" class="col-form-label">Политика конфиденциальности ua</label>
                            <textarea name="terms_ua" id="terms_ua" rows="10">{{ $terms->terms_ua }}</textarea>
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
