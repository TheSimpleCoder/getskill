<?php

namespace App\Article;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name_ru
 * @property string $name_uk
 * @property int $time
 * @property string $seo_name_ru
 * @property string $seo_name_ua
 * @property string $seo_desc_ru
 * @property string $seo_desc_ua
 */

class Category extends Model
{
    protected $table = 'articale_category';
    protected $fillable = ['name_ru', 'name_ua', 'time', 'seo_name_ru', 'seo_name_ua', 'seo_desc_ru', 'seo_desc_ua'];

    public static function addNewCategory($r){
    	Self::create([
    		'name_ru' => $r->name_ru,
    		'name_ua' => $r->name_ua,
    		'time' => time(),
    		'seo_name_ru' => $r->seo_name_ru,
    		'seo_name_ua' => $r->seo_name_ua,
    		'seo_desc_ru' => $r->seo_name_ru,
    		'seo_desc_ua' => $r->seo_desc_ua
    	]);
    }

    public static function updateCategory($r){
    	$self = Self::where('id', $r->id)->first();

    	$self->name_ru = $r->name_ru;
    	$self->name_ua = $r->name_ua;
    	$self->seo_name_ru = $r->seo_name_ru;
    	$self->seo_name_ua = $r->seo_name_ua;
    	$self->seo_desc_ru = $r->seo_desc_ru;
    	$self->seo_desc_ua = $r->seo_desc_ua;

    	$self->save();
    }
}
