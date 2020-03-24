<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $table = 'faq_category';
    protected $fillable = ['name_ru', 'name_ua'];

    public static function addNewCategory($r){
    	Self::create([
    		'name_ru' => $r->name_ru,
    		'name_ua' => $r->name_ua
    	]);
    }

    public static function updateCategory($r){
    	$result = Self::where('id', $r->id)->first();
    	$result->name_ru = $r->name_ru;
    	$result->name_ua = $r->name_ua;
    	$result->save();
    }
}
