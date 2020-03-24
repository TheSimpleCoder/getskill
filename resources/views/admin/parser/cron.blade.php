<?php
$title = 'Парсер (крон)'
?>

@extends('layouts.admin')

@section('title', $title)

@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('admin.parser.add_task') }}">
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
    					<button type="submit" class="btn btn-success">Добавить новую задачу</button>
  					</div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">Крон задачи</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Организация</th>
                                <th scope="col">Название с Google Maps</th>
                                <th scope="col">Время создания</th>
                                <th scope="col">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <th scope="row">{{ $task->id }}</th>
                                    <td>{{ Organization::getNameAdmin($task->organization) }}</td>
                                    <td>{{ $task->tasc_name }}</td>
                                    <td>{{ date('d.m.Y, H:i', $task->time) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.parser.delete_task') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $task->id }}">
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
