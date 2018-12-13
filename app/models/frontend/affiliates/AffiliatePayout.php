<?php

namespace App\models\frontend\affiliates;

use Illuminate\Database\Eloquent\Model;
use App\models\frontend\User;
use App\models\frontend\PaymentMethod;

class AffiliatePayout extends Model
{
    Protected $table="affiliate_payouts";

    public function user(){
        return $this->belongsTo(User::class,'affiliate_user_id','id');
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class,'payment_method_id','id');
    }
}
