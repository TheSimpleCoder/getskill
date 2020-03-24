<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Clients extends Model
{
    protected $table = 'clients';
    protected $fillable = ['name', 'phone', 'email', 'user_id'];

    public static function saveNew($r){
    	Self::create([
    		'user_id' => Auth::user()->id,
    		'name' => $r->deals_clients_edit_name,
    		'phone' => $r->deals_clients_edit_phone,
    		'email' => $r->deals_clients_edit_email,
    	]);
    }

    public static function updateNew($r){
    	$self = Self::where('id', $r->id)->first();

    	$self->name = $r->deals_clients_edit_name;
    	$self->phone = $r->deals_clients_edit_phone;
    	$self->email = $r->deals_clients_edit_email;

    	$self->save();
    }
}
