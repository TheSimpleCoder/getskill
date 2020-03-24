<?php
$title = 'Парсер'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('admin.parser.start_parsing') }}">
                	@csrf
                	<div class="card-body">
    					<div class="row">

    						<div class="col-md-6">
    							<div class="form-group">
    								<label for="exampleFormControlSelect1">Организация</label>
    								<select class="form-control" id="exampleFormControlSelect1" name="organization">
    									@foreach($organizations as $org)
      										<option value="{{ $org->id }}">{{ $org->name_ru }}</option>
      									@endforeach
    								</select>
  								</div>
    						</div>

    						<div class="col-md-6">
    							<div class="form-group">
    								<label for="exampleFormControlInput1">Название с Google Maps</label>
    								<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="24 Fit Club" name="name">
  								</div>
    						</div>
    					</div>
  					</div>
  					<div class="card-footer">
    					<button type="submit" class="btn btn-warning">Начать парсинг отзывов</button>
  					</div>
                </form>
            </div>
        </div>
    </div>
@endsection
