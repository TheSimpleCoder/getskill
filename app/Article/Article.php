<?php

namespace App\Article;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
	protected $table = 'articales';
    protected $fillable = ['name_ru', 'name_ua', 'content_ru', 'content_ua', 'cat_id', 'cat_course_id', 'views', 'time', 'seo_name_ru', 'seo_name_ua', 'seo_desc_ru', 'seo_desc_ua', 'img'];

    public static function addNewCategory($r){
    	$path = '/storage/' . $r->file('img')->store('uploads', 'public', 'org');
    	Self::create([
    		'name_ru' => $r->name_ru,
    		'name_ua' => $r->name_ua,
    		'content_ru' => $r->content_ru,
    		'content_ua' => $r->content_ua,
    		'cat_id' => $r->cat_id,
    		'cat_course_id' => $r->cat_course_id,
    		'time' => time(),
    		'seo_name_ru' => $r->seo_name_ru,
    		'seo_name_ua' => $r->seo_name_ua,
    		'seo_desc_ru' => $r->seo_desc_ru,
    		'seo_desc_ua' => $r->seo_desc_ua,
    		'img' => $path
    	]);
    }

    public static function updateCategory($r){
    	$self = Self::where('id', $r->id)->first();

    	if($r->file('img')){
    		$path = $r->file('img')->store('uploads', 'public', 'org');
    	}else{
    		$path = $self->img;
    	}

    	$self->name_ru = $r->name_ru;
    	$self->name_ua = $r->name_ua;
    	$self->content_ru = $r->content_ru;
    	$self->content_ua = $r->content_ua;
    	$self->cat_id = $r->cat_id;
    	$self->cat_course_id = $r->cat_course_id;
    	$self->seo_name_ru = $r->seo_name_ru;
    	$self->seo_name_ua = $r->seo_name_ua;
    	$self->seo_desc_ru = $r->seo_desc_ru;
    	$self->seo_desc_ua = $r->seo_desc_ua;
    	$self->img = $path;

    	$self->save();
    }
}
