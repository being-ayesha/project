<?php

namespace App\Http\Controllers\merchants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Common;
use Omnipay\Omnipay;
use App\models\frontend\User;
use session;
use App\models\frontend\sellers\PaymentSetting;
use App\models\frontend\sellers\PaymentDetail;
use App\models\frontend\Currency;
use App\models\frontend\merchants\MerchantPaymentDetail;
use App\models\frontend\merchants\MerchantInvoice;
use App\models\frontend\merchants\MerchantOrder;
use App\DataTables\frontend\merchants\MerchantsPaymentDataTable;
use Redirect;
use Auth;
class PaymentsController extends Controller
{

    public function index(MerchantsPaymentDataTable $dataTables)
    {
        $data['siteName']  = getenv('APP_NAME');
        $data['pageTitle'] = 'Merchants Paymetns';
        return $dataTables->render('frontend.merchants.pages.payments.payment',$data);
    }

    public function paymentDetails($id)
    {
        $data['siteName']  = getenv('APP_NAME');
        $data['pageTitle'] = 'Merchants Paymetns Details';
        $data['order']     = $order = MerchantOrder::where(['merchant_id'=>Auth::user()->id,'order_uid'=>$id])->first();
        $data['address']     = json_decode(@$order->paymentDetails->sender_address);
        return View('frontend.merchants.pages.payments.details',$data);
    }

    public function payNow(Request $request){

    	$country  = Session::get('country_name');
    	$user     = User::where('username',$request->username)->first();
    	$match    =['account_id'=>$user->id,'type'=>'paypal','account' => 'merchants'];
    	$paypalCredentials    = PaymentSetting::where($match)->pluck('value', 'name');
        $settingCurrency      = PaymentSetting::where(['account_id'=>$user->id,'type'=>'currency','account' => 'merchants'])->pluck('value', 'name');
        
    	if($settingCurrency->isEmpty() || $paypalCredentials->isEmpty()){
            Common::one_time_message('error', 'Please activate your payment settings.');
            return back();
        }

        $invoice = MerchantInvoice::where(['merchant_id'=>$user->id,'invoice_uid'=>$request->invoice_id])->first();
        if(empty($invoice)){

            $invoice =new MerchantInvoice();

            $invoice->invoice_uid       = $request->invoice_id;
            $invoice->merchant_id       = $user->id;
            $invoice->payment_method_id = 1;
            $invoice->currency          = $settingCurrency['currency'];
            $invoice->amount            = $request->price;
            $invoice->invoice_status    = 'Pending';
            $invoice->notes             = $request->notes;
            $invoice->buyer_email       = $request->mail;
            $invoice->browser_redirect  = $request->browser_redirect;
            $invoice->save();
        }

        $order = MerchantOrder::where(['merchant_id'=>$user->id,'invoice_id'=>$request->invoice_id])->first();
        if(empty($order)){

            $order =new  MerchantOrder();

            $order->order_uid         = strtoupper(str_random(12));
            $order->invoice_id        = $invoice->id;
            $order->merchant_id       = $user->id;
            $order->payment_method_id = 1;
            $order->currency          = $settingCurrency['currency'];
            $order->amount            = $request->price;
            $order->order_status      = 'Unpaid';
            $order->notes             = $request->notes;
            $order->buyer_email       = $request->mail;
            $order->ipn_url           = $request->ipn_redirect_url;
            $order->save();
        }



        $currency       = Currency::where('id',$settingCurrency['currency'])->first();
		$purchaseData   =   [
            'testMode'  => ($paypalCredentials['mode'] == 'sandbox') ? true : false,
            'amount'    => $request->price,
            'currency'  => $currency->code,
            'returnUrl' => url('merchants/payments/success'),
            'cancelUrl' => url('merchants/payments/cancel'),
            'notifyUrl' => $request->ipn_redirect_url,
        ];

        Session::put('currency',$currency);
        Session::put('amount', $request->price);
        Session::put('user_id',$user->id);
        Session::put('browser_redirect_url',$request->browser_redirect_url);
        Session::put('ipn_redirect_url',$request->ipn_redirect_url);
        Session::put('buyer_shipping',$request->buyer_shipping);
        Session::put('invoice_id',$request->invoice_id);
        Session::put('order_id',$request->order_id);
        $this->setup($gateway='PayPal_Express',$user->id);

        if($request->price) {
        	$response   = $this->omnipay->purchase($purchaseData)->send();
        	if ($response->isSuccessful()){
        		$result = $response->getData();
        	} else if ($response->isRedirect()){
        		$response->redirect();
        	} else {
                
        	}
        }else{

        }
    }

    public function setup($gateway,$account_id){
       
        $match=['account_id'=>$account_id,'type'=>'paypal','account' => 'merchants'];
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

       $this->setup($gateway='PayPal_Express',Session::get('user_id'));
        $currency    = Session::get('currency');
        $transaction = $this->omnipay->completePurchase(array(
            'payer_id'              => $request->PayerID,
            'transactionReference'  => $request->token,
            'amount'                => Session::get('amount'),
            'currency'              => $currency->code
        ));

        $buyer_shipping = Session::get('buyer_shipping');

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
		$browser_redirect_url    = Session::get('browser_redirect_url');
		if($browser_redirect_url){
			return Redirect::to($browser_redirect_url);
		}else{
			echo "success";exit();
		}
    }


    public function completeOrder($purchaseResponseData,$checkoutResponseData){


        $invoice  = MerchantInvoice::where('invoice_uid', Session::get('invoice_id'))->first();
        $invoice->invoice_status= "Paid";
        $invoice->save();
        
    	$order     = MerchantOrder::where('invoice_id', $invoice->id)->first();
        $order->order_status ="Paid";
        $order->save();
    	//Insert data to payment details
    	$paymentDetails                       = new MerchantPaymentDetail();
        $paymentDetails->invoice_id           = $invoice->id;
    	$paymentDetails->order_id             = $order->id;
    	$paymentDetails->payment_method_id    = 1;
    	$paymentDetails->transaction_id       = $checkoutResponseData['TRANSACTIONID'];
    	$paymentDetails->payment_status       = 'Paid';
    	$paymentDetails->payment_method_email = $checkoutResponseData['EMAIL'];
    	$paymentDetails->amount_paid          = $checkoutResponseData['AMT'];
    	$paymentDetails->payment_method_fees  = $purchaseResponseData['PAYMENTINFO_0_FEEAMT'];
    	$paymentDetails->sender_name          = $checkoutResponseData['FIRSTNAME'].' '.$checkoutResponseData['LASTNAME'];
       	//Creating default object for storing sender address data as a json starts here
       	$senderAddress                        = new MerchantPaymentDetail();
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
