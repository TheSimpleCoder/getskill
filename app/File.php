<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    protected $fillable = ['user_id', 'organization_id', 'course_id', 'img', 'type', 'uid'];
}
