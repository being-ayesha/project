<?php

namespace App\models\frontend\merchants;
use App\models\frontend\PaymentMethod;
use App\models\frontend\merchants\MerchantPaymentDetail;
use App\models\frontend\merchants\MerchantInvoice;

use Illuminate\Database\Eloquent\Model;
use Auth;
class MerchantOrder extends Model
{
    protected $table="merchant_orders";

    public function paymentMethod(){
    	return $this->belongsTo(PaymentMethod::class);
    }
    // Get Payment details by order
    public function payment(){
      return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

     // Get Payment Details by order
    public function paymentDetails(){
      return $this->hasOne(MerchantPaymentDetail::class,'order_id');
    }

     // Get Total Order
    public function totalOrder(){
       return count($this->where(['merchant_id'=>Auth::user()->id,'order_status'=>'paid'])->get());
    }
    // Get Daily Order
    public function dailyOrder(){
     return count($this->where(['merchant_id'=>Auth::user()->id,'order_status'=>'paid'])->whereBetween('created_at',array(date('Y-m-d',strtotime('-1 days'))." 00:00:00", date('Y-m-d')." 23:59:59"))->get());
    }

    // Get Weekly Order
    public function weeklyOrder(){
      return count($this->where(['merchant_id'=>Auth::user()->id,'order_status'=>'paid'])->whereBetween('created_at',array(date('Y-m-d',strtotime('-1 week'))." 00:00:00", date('Y-m-d')." 23:59:59"))->get());
    }

     // Get Total Amount by order
    public function totalAmount(){
      $total_amount = $this->where(['merchant_id'=>Auth::user()->id,'order_status'=>'paid'])->sum('amount');
       return $total_amount?$total_amount:0;
    }

    // Get Daily Amount by order
    public function dailyAmount(){
       return $this->where(['merchant_id'=>Auth::user()->id,'order_status'=>'paid'])->whereBetween('created_at',array(date('Y-m-d',strtotime('-1 days'))." 00:00:00", date('Y-m-d')." 23:59:59"))->sum('amount');

    }

    // Get Weekly Amount by order
    public function WeeklyAmount(){
       return $this->where(['merchant_id'=>Auth::user()->id,'order_status'=>'paid'])->whereBetween('created_at',array(date('Y-m-d',strtotime('-1 week'))." 00:00:00", date('Y-m-d')." 23:59:59"))->sum('amount');

    }
}
