<?php

namespace App\Http\Controllers\affiliates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\PaymentSetting;
use Auth;
use Common;
class SettingsController extends Controller
{
    public function index(Request $request)
    {
    	if(!$_POST){
    		$data['siteName']  = getenv('APP_NAME');
    		$data['pageTitle'] = 'Affiliates Settings';
            $data['paypal']         = PaymentSetting::where(['type'=>'paypal','account'=>'affiliate','account_id'=>Auth::user()->id])->pluck('value','name');
    		return view('frontend.affiliates.pages.settings.payment',$data);
    	}else{
    		foreach ($request->method as $key => $payment) {
    			foreach ($payment as $key => $value) {
    				$match                         = ['account_id' => Auth::user()->id ,'account'=>'affiliate','type'=>'paypal','name'=>$key];               
    				$paymentSettings               = PaymentSetting::firstOrNew($match);
    				$paymentSettings->account_id   = Auth::user()->id;
    				$paymentSettings->account      = 'affiliate';
    				$paymentSettings->name         = $key;
    				$paymentSettings->value        = $value;
    				$paymentSettings->type         = 'paypal';
    				$paymentSettings->save();
    			}
    		}
    		Common::one_time_message('success','Your action has been successfully executed!');
            return back();
    	}
    	
    }
}
