<?php

namespace App\Http\Controllers\affiliates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Product;
use App\models\frontend\User;
use App\models\frontend\Currency;
use App\models\frontend\sellers\Coupon;
use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\PaymentSetting;
use Common;
use Omnipay\Omnipay;
use Session;
class PaymentsController extends Controller
{

    //Get individual product details and order create
    public function getIndividualProductDetails(Request $request , $username, $productUuid , $affiliates){
    	$opts['siteName']  = getenv('APP_NAME');
    	$opts['pageTitle'] = 'Single Product';
    	$opts['user']      = $user       = User::where(['username' => base64_decode($username)])->first();
    	$opts['affiliates']= $affiliates = User::where(['username' => base64_decode($affiliates)])->first();
    	$opts['product']   = $product    = Product::with('user','productType','productSocialOptions')->where(['seller_id'=> $user->id,'product_uuid' => $productUuid])->first();
        if($request->method()!='POST'){
	    	$couponsActive     = Coupon::where('seller_id',$user->id)->where('stock','!=',0)->where('expiry_date','>=',date('Y-m-d H:i:s'))->get();
	    	$productArr        = [];
	    	for($i=0;$i<count($couponsActive);$i++){
		    	$couponProducts    = json_decode($couponsActive[$i]->product_ids);
		    	if(in_array($product->id,$couponProducts)){
		    		array_push($productArr, $product->id);
		    	}
		    }
		    $opts['activeCouponsCnt']  = count(array_unique($productArr));
	    	return view('frontend.sellers.pages.stores.single',$opts);
	    }else{
	    	$order             = new Order;
	    	$order->seller_id  = $user->id;
	    	$order->product_id = $product->id;
	    	if($request->coupon){
	    		$coupon = Coupon::where(['coupon_code' => $request->coupon])->first();
	    		if($coupon->discount_structure=='percent'){
	    			$product_amount = ($product->price-($product->price*$coupon->amount_off/100))*($request->quantity);
	    			$order->amount  = $product_amount;
	    			$order->affiliate_amount = $affiliate_amount = $product_amount*($product->affiliate_rate/100);
	    		}else{
	    			$product_amount = ($product->price-$coupon->amount_off)*$request->quantity;
	    			$order->amount  = $product_amount;
	    			$order->affiliate_amount =$affiliate_amount = $product_amount*($product->affiliate_rate/100);
	    		}
	    		$order->coupon_code          = $request->coupon;
	    		$order->coupon_activate_date = date('Y-m');
	    	}else{
	    		    $product_amount  = $request->quantity*$request->originalAmnt;
	    		    $order->amount   = $product_amount;
	    			$order->affiliate_amount = $affiliate_amount =$product_amount*((int)$product->affiliate_rate)/100;
	    	}
	    	$order->order_uuid        = str_random(20);
	    	$order->payment_method_id = $request->payment_method_id;
	    	$order->product_quantity  = $request->quantity;
	    	$order->affiliate_user_id = $affiliates->id;
	    	$order->is_affiliated  	  = 'Yes';
	    	$order->order_date        = date('Y-m-d');
	    	$order->save();
	    	$opts['order_id']         = $order->id;
	    	//Update coupon stock if coming coupon from request starts here
	    	if($request->coupon){
	    		if($coupon->stock!='-1' && $coupon->stock!=0){
	    			$coupon->stock          = $coupon->stock-1;
	    			$coupon->number_of_uses = $coupon->number_of_uses+1;
	    		}else if($coupon->stock=='-1'){
					$coupon->number_of_uses = $coupon->number_of_uses+1;
	    		}
	    		$coupon->save();
	    	}
	    	//Update coupon stock if coming coupon from request ends here
	    	return view('frontend.sellers.pages.stores.buyer',$opts);
	    }
    }
}
