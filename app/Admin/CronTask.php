<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CronTask extends Model
{
    protected $table = 'admin_cron_task';
    protected $fillable = ['organization', 'tasc_name', 'time'];

    public static function createTask($r){
    	Self::create([
    		'organization' => $r->organization,
    		'tasc_name' => $r->name,
    		'time' => time(),
    	]);
    }
}
