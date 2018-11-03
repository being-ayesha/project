<?php

namespace App\models\frontend\sellers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\models\frontend\PaymentMethod;
use Auth;
class Coupon extends Model
{
    //use SoftDeletes;
    protected $table = 'coupons';
   // protected $dates = ['deleted_at'];

    public function couponProducts($productId){
    	$groupProductArr         = $this->where(['seller_id' => Auth::user()->id,'product_ids'=> $productId])->select('product_ids')->get();
    	$groupProductIds         = $groupProductArr[0]->product_ids;
    	$individualGroupProducts = Product::whereIn('id',json_decode($groupProductIds))->select('product_title','product_uuid')->get()->toArray();
    	$separator               = $groupProducts = '';
		foreach ($individualGroupProducts as $individualGroupProduct){
		    $groupProducts .="<a href=".$individualGroupProduct['product_uuid'].">".$separator . $individualGroupProduct['product_title']."</a>";
		    $separator      = ',';
		}
		return $groupProducts;
    }

    public function getCouponProducts($couponId){
        $groupProductArr         = $this->where(['seller_id' => Auth::user()->id,'id'=> $couponId])->select('product_ids')->get();
        $groupProductIds         = $groupProductArr[0]->product_ids;
        $individualGroupProducts = Product::whereIn('id',json_decode($groupProductIds))->select('product_title')->get()->toArray();
        $separator               = $groupProducts = '';
        foreach ($individualGroupProducts as $individualGroupProduct){
            $groupProducts .= $separator . $individualGroupProduct['product_title'];
            $separator      = ',';
        }
        return $groupProducts;
    }

    public function getCouponPayments($couponId){
        $groupPaymentArr         = $this->where(['seller_id' => Auth::user()->id,'id'=> $couponId])->select('payment_methods')->get();
        $groupPayment         = $groupPaymentArr[0]->payment_methods;
        $individualGroupPayment = PaymentMethod::whereIn('id',json_decode($groupPayment))->select('name')->get()->toArray();
        $separator               = $groupPayment = '';
        foreach ($individualGroupPayment as $individualGroupPayment){
            $groupPayment .= $separator . $individualGroupPayment['name'];
            $separator      = ',';
        }
        return $groupPayment;
    }
}
