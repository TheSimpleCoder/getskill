<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['user_id', 'summ', 'pack', 'month', 'time', 'by_time', 'status', 'return_liqpay'];
}
