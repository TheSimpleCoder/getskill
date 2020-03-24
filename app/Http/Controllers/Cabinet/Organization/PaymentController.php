<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Payment;
use LiqPay;
use Auth;
use Route;
use App;

class PaymentController extends Controller
{
    public function index(){

        $ret = Payment::where('user_id', Auth::user()->id)->where('status', 'success')->orderBy('id', 'desc')->get();
        $current_pack = Payment::where('user_id', Auth::user()->id)->where('status', 'success')->where('time', '>', time())->orderBy('id', 'desc')->first();

    	return view('cabinet.organization.payment.index', compact('ret', 'current_pack'));
    }

    public function createPay (Request $r){

    	$user = Auth::user();

    	if($r->tariff__plan == 0 OR $r->tariff_plan_m == null){
    		return redirect()->back();
    	}

        $_pay = Payment::where('user_id', $user->id)->where('status', 'success')->orderBy('id', 'desc')->first();

    	if($r->tariff__plan == 300){
    		$pack = 2;
    	}else if($r->tariff__plan == 900){
    		$pack = 3;
    	}

        if($_pay and $_pay->pack == $pack){
            $month = $r->tariff_plan_m + $_pay->month;
            $_time = $r->tariff_plan_m * 2629743;
            $time = $_time + $_pay->time - time();
            if($r->tariff_plan_m == 6){
                $month = $r->tariff_plan_m + 1;
                $time = $month * 2629743;
                $time = $time + $_pay->time - time();
            }else if($r->tariff_plan_m == 12){
                $month = $r->tariff_plan_m + 2;
                $time = $month * 2629743;
                $time = $time + $_pay->time - time();
            }
        }else{
            

            $time = $r->tariff_plan_m * 2629743;
            $month = $r->tariff_plan_m;
            if($r->tariff_plan_m == 6){
                $month = $r->tariff_plan_m + 1;
                $time = $month * 2629743;
            }else if($r->tariff_plan_m == 12){
                $month = $r->tariff_plan_m + 2;
                $time = $month * 2629743;
            }
        }

        Payment::create([
            'user_id' => $user->id,
            'summ' => $r->summ,
            'pack' => $pack,
            'month' => $month,
            'time' => time() + $time,
            'by_time' => time(),

        ]);

    	$payment_info = Payment::where('user_id', $user->id)->orderBy('id', 'desc')->first();


    	$public_key = 'sandbox_i41102551233';
	    $private_key = 'sandbox_sk1TZ1FJxlxzzsBNiM4pr9538LRVkUh6hCDSZujO';
	    $liqpay = new LiqPay($public_key, $private_key);
	    $html = $liqpay->cnb_form(array(
	        'action'         => 'pay',
	        'amount'         => $payment_info->summ,
	        'currency'       => 'UAH',
	        'description'    => 'Расширенный',
	        'order_id'       => $payment_info->id,
	        'version'        => '3',
	        'result_url'     => 'https://getskill.com.ua/' . App::getLocale() . '/cabinet-organization/payment/callback/user',
	        'server_url'     => 'https://getskill.com.ua/' . App::getLocale() . '/cabinet-organization/payment/callback',
	    ));

	    echo $html;
	    echo '
	    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	    	<script>
	    		$( document ).ready(function() {
    				$( "form:first" ).submit();
				});
			</script>
	    ';
    }

    public function callback(Request $r){
    	$json = base64_decode($r->data);
    	$data = json_decode($json, true);

    	Payment::where('id', $data['order_id'])->update(['status' => $data['status']]);
    }

    public function callbackUser(Request $r){
    	$json = base64_decode($r->data);
    	$data = json_decode($json, true);

    	Payment::where('id', $data['order_id'])->update(['status' => $data['status']]);
    	return redirect(App::getLocale() . '/cabinet-organization/payment');
    }
}
