<?php

namespace App\models\frontend;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\models\frontend\sellers\PaymentSetting;
class Currency extends Model
{
    protected $table = 'currencies';

    public static function currencySymbol(){
		$payment   = PaymentSetting::where(['type'=>'currency','account_id'=>Auth::user()->id])->first();
		if(!empty($payment)){
		$cuerrency = Currency::where('id',$payment->value)->select('code')->first();
		}else{
		$cuerrency = Currency::where('id',1)->select('code')->first();
		}
		return $cuerrency->code;
    }
}
