<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\merchants\MerchantOrder;
use App\models\frontend\merchants\MerchantInvoice;
use App\models\frontend\merchants\MerchantPaymentDetails;
use App\models\frontend\merchants\MerchantApp;
use App\models\frontend\sellers\PaymentMethod;
use App\models\frontend\sellers\PaymentSetting;
use App\models\frontend\merchants\PaymentButton;
use App\models\frontend\User;
use App\models\frontend\Currency;
use Common;

class InvoiceController extends Controller
{

    private $merchant_id;
    private $unauthorizedStatus = 401;
    private $notFoundStatus     = 404;
	private $tooManyStatus      = 429;

    public function __construct(Request $request)
    {
        $header = $request->headers->all();
        
        if(isset($header['applicationid']) && isset($header['authorization'])){
        
            $applicationId =  $header['applicationid'][0];
            $applicationSecret = $header['authorization'][0];


            $merchants = MerchantApp::where(['app_id'=>$applicationId, 'app_secrect'=>$applicationSecret])->first();

            if($merchants){
               return  $this->merchant_id=$merchants->merchant_id;
           }

        }else{

            $result['message'] ="Key Not Define";
            return $result;
        }

    }

    public function listInvoice($invoiceId='')
    {

    	if($this->merchant_id){

    		if($invoiceId){
    			$match=['merchant_id'=>$this->merchant_id, 'invoice_uid'=>$invoiceId];
    		}else{
    			$match=['merchant_id'=>$this->merchant_id];
    		}

    		$invoice = MerchantInvoice::where($match)->get();

    		if(empty($invoice)){
                $result['HTTPCode'] = $this->notFoundStatus;
    			$result['message'] = "Not Found -- The specified resource could not be found.";
    			return $result;
    		}else{
    			return $invoice;
    			
    		}

    	}else{

    		$result['HTTPCode'] = $this->unauthorizedStatus;
            $result['message'] = "Unauthorized -- Your API key is incorrect or your API key does not have access to a particular scope";
    		return $result;

    	}
    	
    }


    public function createInvoice(Request $request){

    	 if($this->merchant_id){

            $data['price']             = $amount 		= $request->amount;
            $data['quantity']          = $quantity 		= $request->quantity;
            $data['description']       = $description 	= $request->description;
            $data['currency']          = $currency 		= $request->currency;
            $data['buyer_email']       = $buyerEmail 	= $request->buyerEmail;
            $data['notes']             = $notes         = $request->notes;
            $data['browser_redirect']  = $browser_redirect = $request->browserRedirect;



    	 	$invoice =new MerchantInvoice();

            $invoice->invoice_uid       = strtoupper(str_random(12));
        	$invoice->merchant_id       = $this->merchant_id;
        	$invoice->payment_method_id = 1;
            $invoice->currency          = $currency;
            $invoice->amount            = $amount;
            $invoice->quantity          = $quantity;
        	$invoice->description       = $description ;
        	$invoice->invoice_status    = "DRAFT";
            $invoice->notes             = $notes;
            $invoice->buyer_email       = $buyerEmail;
        	$invoice->browser_redirect  = $browser_redirect;
        	$invoice->save();

			$user = User::where('id',$this->merchant_id)->first();

			$data['username'] = $user->username;
			$data['invoice_id'] = $invoice->invoice_uid;

			$this->createPaymentButton($data);
        	if(!empty($invoice->payment_method_id) && !empty($user->id) && !empty($invoice->invoice_uid)){

        		$invoice_details['success'] = true;
                $invoice_details['link'] = url("merchants/invoice").'/'.base64_encode($user->username).'/'.$invoice->invoice_uid;
                $result = $invoice_details;
        		return $result;
        	}else{

                $result['HTTPCode'] = $this->tooManyStatus;
        		$result['message'] ="Too Many Requests -- Learn more about rate limiting ";
    			return $result;
        	}

    	 }else{

    		$result['HTTPCode'] = $this->unauthorizedStatus;
            $result['message'] = "Unauthorized -- Your API key is incorrect or your API key does not have access to a particular scope";
            return $result;

    	} 
    }

    public function createPaymentButton($data)
    {

        $payment = new PaymentButton();
    	$payment->user_id 	       = $this->merchant_id;
    	$payment->username 	       = $data['username'];
    	$payment->invoice_id       = $data['invoice_id'];
        $payment->price            = $data['price'];
    	$payment->browser_redirect_url = $data['browser_redirect'];
    	$payment->save();
    }


}
