<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqArticle extends Model
{
    protected $table = 'faq_article';
    protected $fillable = ['name_ru', 'name_ua', 'category', 'text_ru', 'text_ua'];

    public static function addNewArticle($r){
    	Self::create([
    		'name_ru' => $r->name_ru,
    		'name_ua' => $r->name_ua,
    		'category' => $r->category,
    		'text_ru' => $r->text_ru,
    		'text_ua' => $r->text_ua,
    	]);
    }

    public static function updateArticle($r){
    	$result = Self::where('id', $r->id)->first();
    	$result->name_ru = $r->name_ru;
    	$result->name_ua = $r->name_ua;
    	$result->category = $r->category;
    	$result->text_ru = $r->text_ru;
    	$result->text_ua = $r->text_ua;
    	$result->save();
    }

    public static function getArticle($id){
    	$result = Self::where('category', $id)->get();
    	return $result;
    }
}
