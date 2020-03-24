<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Payment;
use App\Model\User\Entity\User;

class HomeController extends AdminController
{
    public function index()
    {
        return view('admin.home');
    }

    public function box(Request $r){
    	$user = User::find($r->user);

        $_pay = Payment::where('user_id', $user->id)->where('status', 'success')->orderBy('id', 'desc')->first();

    	$pack = $r->plan;

        if($_pay and $_pay->pack == $pack){
            $month = $r->month + $_pay->month;
            $_time = $r->month * 2629743;
            $time = $_time + $_pay->time - time();
            if($r->month == 6){
                $month = $r->month + 1;
                $time = $month * 2629743;
                $time = $time + $_pay->time - time();
            }else if($r->month == 12){
                $month = $r->month + 2;
                $time = $month * 2629743;
                $time = $time + $_pay->time - time();
            }
        }else{
            $time = $r->month * 2629743;
            $month = $r->month;
            if($r->month == 6){
                $month = $r->month + 1;
                $time = $month * 2629743;
            }else if($r->month == 12){
                $month = $r->month + 2;
                $time = $month * 2629743;
            }
        }

        Payment::create([
            'user_id' => $user->id,
            'summ' => 0,
            'pack' => $pack,
            'month' => $month,
            'time' => time() + $time,
            'by_time' => time(),
            'status' => 'success',

        ]);

    	return redirect()->back();
    }
}
