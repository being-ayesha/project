<?php

namespace App\models\frontend\affiliates;

use Illuminate\Database\Eloquent\Model;
use App\models\frontend\sellers\Product;
use App\models\frontend\sellers\Order;
use App\models\frontend\User;
use App\models\frontend\affiliates\AffiliatePayout;
use Auth;
class AffiliateProduct extends Model
{
    protected $table = 'affiliate_products';

    public function affiliateProduct(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function affiliateOrder($product_id){
    	return Order::where(["affiliate_user_id"=>Auth::user()->id,'product_id'=>$product_id,'payment_status'=>'paid','is_affiliated'=>'Yes'])->get();
    }

    public function affiliateUser(){
    	return $this->belongsTo(User::class,'affiliate_id');
    }

    public function sellerUser(){
        return $this->belongsTo(User::class,'seller_id');
    }


    public function affiliatePayout($affiliates_id){
      return  AffiliatePayout::where(['seller_id'=>Auth::user()->id,'affiliate_user_id'=>$affiliates_id])->get();
    }

    public function totalAffiliateOrder($affiliate_id){
        return  Order::where(['seller_id'=>Auth::user()->id,'affiliate_user_id'=>$affiliate_id,'is_affiliated'=>'Yes','payment_status'=>'paid'])->get();
    }
    

}
