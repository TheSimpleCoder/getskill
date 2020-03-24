<?php

$title = trans('layout/header.Home');
$description = '';
$keywords = '';

?>

@extends('layouts.app')

@section('title', $title)
@section('description', $description)
@section('keywords', $keywords)


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('home/index.Title') }}</div>
                <div class="card-body">
                    Improvement page
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
