<?php

namespace App\Article;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    protected $table = 'articale_comments';
    protected $fillable = ['article_id', 'text', 'time', 'user_id', 'user_name', 'user_avatar', 'parent_id', 'complaint'];

    public static function addComment($r){
    	$user = Auth::user();
    	Self::create([
    		'article_id' => $r->id,
    		'text' => $r->text,
    		'time' => time(),
    		'user_id' => $user->id,
    		'user_name' => $user->name,
    		'user_avatar' => $user->image,
    		'parent_id' => $r->parent_id
    	]);
    }

    public static function getCount($id){
    	$self = Self::where('article_id', $id)->count();
    	return $self;
    }

    public static function getChild($id){
    	$self = Self::where('parent_id', $id)->get();
    	return $self;
    }
}
