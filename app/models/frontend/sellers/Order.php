<?php

namespace App\models\frontend\sellers;

use Illuminate\Database\Eloquent\Model;
use App\models\frontend\PaymentMethod;
use App\models\frontend\User;
use App\models\frontend\sellers\PaymentDetail;
use Auth;
class Order extends Model
{
    protected $table = 'orders';

   // Get Product details by order
    public function product(){
    	return $this->belongsTo(Product::class);
    }
    // Get Payment details by order
    public function payment(){
    	return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }
    // Get Seller details by order
    public function user(){
    	return $this->belongsTo(User::class,'seller_id','id');
    }
   // Get Total Order
    public function totalOrder(){
       return count($this->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->get());
    }
    // Get Daily Order
    public function dailyOrder(){
     return count($this->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->whereBetween('order_date',array(date('Y-m-d',strtotime('-1 days'))." 00:00:00", date('Y-m-d')." 23:59:59"))->get());
    }

    // Get Weekly Order
    public function weeklyOrder(){
      return count($this->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->whereBetween('order_date',array(date('Y-m-d',strtotime('-1 week'))." 00:00:00", date('Y-m-d')." 23:59:59"))->get());
    }

    // Get Total Amount by order
    public function totalAmount(){
      $total_amount = $this->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->sum('amount');
       return $total_amount?$total_amount:0;
    }

    // Get Daily Amount by order
    public function dailyAmount(){
       return $this->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->whereBetween('order_date',array(date('Y-m-d',strtotime('-1 days'))." 00:00:00", date('Y-m-d')." 23:59:59"))->sum('amount');

    }

    // Get Weekly Amount by order
    public function WeeklyAmount(){
       return $this->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->whereBetween('order_date',array(date('Y-m-d',strtotime('-1 week'))." 00:00:00", date('Y-m-d')." 23:59:59"))->sum('amount');

    }

    // Get Payment Details by order
    public function paymentDetails(){
      return $this->hasOne(PaymentDetail::class,'order_id');
    }

    // Number of total affiliates order
    public function affiliatesOrder()
    {
      return $this->where(['affiliate_user_id'=>Auth::user()->id,'is_affiliated'=>'Yes','payment_status'=>'paid'])->get();
    }


    // Number of Daily affiliates order
    public function dailyAffiliatesOrder()
    {
      return $this->where(['affiliate_user_id'=>Auth::user()->id,'is_affiliated'=>'Yes','payment_status'=>'paid'])->whereBetween('order_date',array(date('Y-m-d',strtotime('-1 days'))." 00:00:00", date('Y-m-d')." 23:59:59"))->get();
    }

    // Number of Weekly affiliates order
    public function weeklyAffiliatesOrder()
    {
      return $this->where(['affiliate_user_id'=>Auth::user()->id,'is_affiliated'=>'Yes','payment_status'=>'paid'])->whereBetween('order_date',array(date('Y-m-d',strtotime('-1 week'))." 00:00:00", date('Y-m-d')." 23:59:59"))->get();
    }
    
}
