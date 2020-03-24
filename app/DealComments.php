<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class DealComments extends Model
{
    protected $table = 'deal_comments';
    protected $fillable = ['user_id', 'deal_id', 'text', 'time'];

    public static function addComment($r){
    	Self::create([
    		'user_id' => Auth::user()->id,
    		'deal_id' => $r->id,
    		'text' => $r->text,
    		'time' => time(),
    	]);
    }

    public static function updateComment($r){
    	$comment = Self::where('id', $r->id)->update(['text' => $r->text]);
    }
}
