<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Payment;
use App\models\frontend\sellers\Product;
use App\models\frontend\User;
use App\models\frontend\Currency;
use App\models\frontend\sellers\Coupon;
use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\PaymentSetting;
use App\models\frontend\sellers\PaymentDetail;
use App\models\frontend\sellers\ProductView;
use Common;
use Omnipay\Omnipay;
use Session;
class PaymentsController extends Controller
{
    //Get individual product details and order create
    public function getIndividualProductDetails(Request $request , $username,$productUuid){
    	$opts['siteName']  = 'Rocketr';
    	$opts['pageTitle'] = 'Single Product';
    	$opts['user']      = $user    = User::where(['username' => base64_decode($username)])->first();
    	$opts['product']   = $product = Product::with('user','productType','productSocialOptions')->where(['seller_id'=> $user->id,'product_uuid' => $productUuid])->first();
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
	    			$order->amount = ($product->price-($product->price*$coupon->amount_off/100))*($request->quantity);
	    		}else{
	    			$order->amount = ($product->price-$coupon->amount_off)*$request->quantity;
	    		}
	    		$order->coupon_code          = $request->coupon;
	    		$order->coupon_activate_date = date('Y-m');
	    	}else{
	    		    $order->amount  = $request->quantity*$request->originalAmnt;
	    	}
	    	$order->order_uuid        = str_random(20);
	    	$order->payment_method_id = $request->payment_method_id;
	    	$order->product_quantity  = $request->quantity;
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
    //Check product coupon code for validity
    public function productCouponCodeCheck(Request $request){
    	$seller_id  = base64_decode($request->seller_id);
    	$couponCode = $request->couponCode;
    	$couponCnt  = Coupon::where(['seller_id' => $seller_id,'coupon_code' => $couponCode])->where('stock','!=',0)->count();
    	$coupon     = Coupon::where(['seller_id' => $seller_id,'coupon_code' => $couponCode])->where('stock','!=',0)->first();
    	$product    = Product::where(['id' => base64_decode($request->product_id)])->first();
    	if($couponCnt>0){
	    		if($coupon->discount_structure=='percent'){
	    			$result['discountAmount'] = ($product->price-($product->price*$coupon->amount_off)/100);
	    			$result['status']         = 1;
	    			$result['message']        = 'Successfully validated coupon';
	    			return response()->json($result);
	    		}else{
	    			$result['discountAmount'] = ($product->price-$coupon->amount_off);
	    			$result['status']         = 1;
	    			$result['message']        = 'Successfully validated coupon';
	    			return response()->json($result);
	    		}
	    }else{
	    	$result['status']         = 0;
	    	$result['message']        = 'Coupon not found';
	    	return response()->json($result);
	    }
	}

	public function payNow(Request $request){

		$country              = Session::get('country_name');
		$order                = Order::find($request->order_id);
		$order->buyer_email   = $request->buyer_email;
		$order->buyer_country = $country['geoplugin_countryName'];
		$order->buyer_ip      = $country['geoplugin_request'];
		$order->http_referer  = $request->server()['HTTP_REFERER'];
        $order->payment_status= 'unpaid';
		$order->save();
        if($request->affiliates_id==null){
            $match=['account_id'=>$request->seller_id,'type'=>'paypal','account' => 'seller'];
        }else{
            $match=['account_id'=>$request->affiliates_id,'type'=>'paypal','account' => 'affiliate'];
        }
		$paypalCredentials    = PaymentSetting::where($match)->pluck('value', 'name');
        $settingCurrency      = PaymentSetting::where(['account_id'=>$request->seller_id,'type'=>'currency','account' => 'seller'])->pluck('value', 'name');
        
        if(empty($settingCurrency) || $paypalCredentials->isEmpty()){
            Common::one_time_message('error', 'Please activate your account settings.');
            return back();
        }

		$currency             = Currency::where('id',$settingCurrency['currency'])->first();
		$purchaseData         =   [
            'testMode'  => ($paypalCredentials['mode'] == 'sandbox') ? true : false,
            'amount'    => $order->amount,
            'currency'  => $currency->code,
            'returnUrl' => url('payments/success'),
            'cancelUrl' => url('payments/cancel')
        ];
        Session::put('currency',$currency);
        Session::put('amount', $order->amount);
        Session::put('order_id', $request->order_id);
        Session::put('seller_id', $request->seller_id);
        Session::put('affiliates_id',$request->affiliates_id);
        Session::save();
         if($request->affiliates_id==null){
                $this->setup($gateway='PayPal_Express',$request->seller_id);
         }else{
		      $this->setup($gateway='PayPal_Express',$request->seller_id,$request->affiliates_id);  
         }
		if($order->amount) {
            $response   = $this->omnipay->purchase($purchaseData)->send();
            if ($response->isSuccessful()){
                $result = $response->getData();
            } else if ($response->isRedirect()){
                $response->redirect();
            } else {
                //Common::one_time_message('error', $response->getMessage());
                //return redirect('buy/book/'.$request->property_id);
            }
        }else{

        }
	}

	public function setup($gateway,$account_id,$affiliates_id=null){
        if($affiliates_id==null){
            $match=['account_id'=>$account_id,'type'=>'paypal','account' => 'seller'];
        }else{
            $match=['account_id'=>$affiliates_id,'type'=>'paypal','account' => 'affiliate'];
        }
		$paypalCredentials = PaymentSetting::where($match)->pluck('value', 'name');
		$this->omnipay     = Omnipay::create($gateway); 
		$this->omnipay->setUsername($paypalCredentials['username']);
		$this->omnipay->setPassword($paypalCredentials['password']);
		$this->omnipay->setSignature($paypalCredentials['signature']);
		$this->omnipay->setTestMode(($paypalCredentials['mode']=='sandbox')?true:false);
		if($gateway=='PayPal_Express'){
			$this->omnipay->setLandingPage('Login');
		}
	}


	public function success(Request $request){
        $this->setup($gateway='PayPal_Express',Session::get('seller_id'));
        $currency    = Session::get('currency');
        $transaction = $this->omnipay->completePurchase(array(
            'payer_id'              => $request->PayerID,
            'transactionReference'  => $request->token,
            'amount'                => Session::get('amount'),
            'currency'              => $currency->code
        ));

        $response             = $transaction->send();
        $purchaseResponseData = $response->getData();
        $transactionDetails   = $this->omnipay->fetchCheckout(array(
            'payer_id'              => $request->PayerID,
            'transactionReference'  => $request->token,
            'amount'                => Session::get('amount'),
            'currency'              => $currency->code
        ));
        $response             = $transactionDetails->send();
		$checkoutResponseData = $response->getData();
		$this->completeOrder($purchaseResponseData,$checkoutResponseData);
    	$order                = Order::find(Session::get('order_id'));

        $opts['siteName']   = 'Rocketr';
        $opts['pageTitle']  = 'Review';
        $opts['order']      = $order;
        return view('frontend.sellers.pages.review.review',$opts);
    }


    public function cancel(Request $request){
        dd($request->all());
    }

    public function completeOrder($purchaseResponseData,$checkoutResponseData){
    	//Update order with payment status
    	$order                 = Order::find(Session::get('order_id'));
    	$order->payment_status = 'paid';
    	$order->save();
    	$product               = Product::find($order->product_id);
    	if($product->stock!='-1' && $product->stock!=0){
    		$product->stock    = $product->stock-$order->product_quantity;
    		$product->save();
    	}
    	//Insert data to payment details
    	$paymentDetails                       = new PaymentDetail();
    	$paymentDetails->order_id             = $order->id;
    	$paymentDetails->payment_method_id    = $order->payment_method_id;
    	$paymentDetails->transaction_id       = $checkoutResponseData['TRANSACTIONID'];
    	$paymentDetails->payment_status       = $order->payment_status;
    	$paymentDetails->payment_method_email = $checkoutResponseData['EMAIL'];
    	$paymentDetails->amount_paid          = $checkoutResponseData['AMT'];
    	$paymentDetails->payment_method_fees  = $purchaseResponseData['PAYMENTINFO_0_FEEAMT'];
    	$paymentDetails->sender_name          = $checkoutResponseData['FIRSTNAME'].' '.$checkoutResponseData['LASTNAME'];
       	//Creating default object for storing sender address data as a json starts here
       	$senderAddress                        = new PaymentDetail();
    	$senderAddress->Street                = $checkoutResponseData['SHIPTOSTREET'];
    	$senderAddress->City                  = $checkoutResponseData['SHIPTOCITY'];
    	$senderAddress->State                 = $checkoutResponseData['SHIPTOSTATE'];
    	$senderAddress->Zip                   = $checkoutResponseData['SHIPTOZIP'];
    	$senderAddress->country_code          = $checkoutResponseData['SHIPTOCOUNTRYCODE'];
    	$senderAddress->country_name          = $checkoutResponseData['SHIPTOCOUNTRYNAME'];
    	$paymentDetails->sender_address       = json_encode($senderAddress);
    	//Creating default object for storing sender address data as a json ends here
    	$paymentDetails->receiver_email       = $checkoutResponseData['PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID'];
    	$paymentDetails->site_fee             = 0;
    	$paymentDetails->save();
    	return true;
    }

}
