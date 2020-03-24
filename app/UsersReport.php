<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersReport extends Model
{
    protected $table = 'users_report';
    protected $fillable = ['name', 'time', 'email', 'type', 'text'];

    public static function addNewReport($r){
    	Self::create([
    		'name' => $r->contacts_with_us_name,
    		'time' => time(),
    		'email' => $r->contacts_with_us_email,
    		'type' => $r->type,
    		'text' => $r->contacts_with_us_massage
    	]);
    }
}
