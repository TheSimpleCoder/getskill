@extends('adminlte::page')


@section('content_top_nav_right')
    <li class="nav-item">
        <a class="nav-link" href="{{route('home', app()->getLocale())}}">
            <i class="fas fa-arrow-circle-right"></i>
            <span>Вернутся на сайт</span>
        </a>
    </li>
@stop


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-sm-12">
                    @section('breadcrumbs', Breadcrumbs::render())
                    @yield('breadcrumbs')
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    @include('layouts.partials.flash')
    @yield('admin-content')
@stop


@section('css')
    <link href="{{ mix('admin/css/app.css', 'build') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ mix('admin/js/app.js', 'build') }}"></script>
    @yield('scripts')
@stop
