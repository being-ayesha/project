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
class OrderController extends Controller
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

    public function listOrder($orderId='')
    {
        if($this->merchant_id){

            if($orderId){
                $match=['merchant_id'=>$this->merchant_id, 'order_uid'=>$orderId];
            }else{
                $match=['merchant_id'=>$this->merchant_id];
            }
          $order = MerchantOrder::where($match)->get();
            if(empty($order)){
                $result['HTTPCode'] = $this->notFoundStatus;
                $result['message'] = "Not Found -- The specified resource could not be found.";
            }else{
                return $order;
            }

        }else{

            $result['HTTPCode'] = $this->unauthorizedStatus;
            $result['message'] = "Unauthorized -- Your API key is incorrect or your API key does not have access to a particular scope";
            return $result;
            
        }

        
    }

    public function createOrder(Request $request){
    	
        if($this->merchant_id){

           
            $data['payment_method_id'] = $paymentMethod = $request->paymentMethod;
            $data['currency']          = $currency = $request->currency;
            $data['buyer_email']       = $buyerEmail = $request->buyerEmail;
            $data['notes']             = $notes = $request->notes;
            $data['amount']             = $amount = $request->amount;;

            $invoice = $this->createInvoice($data);

            $order = new MerchantOrder();
            $order->order_uid    = strtoupper(str_random(12));
            $order->merchant_id       = $this->merchant_id;
            $order->invoice_id        = $invoice['invoice_id'];
            $order->payment_method_id = $paymentMethod;
            $order->amount            = $amount;
            $order->currency          = $currency;
            $order->order_status      = "NEW ORDER";
            $order->buyer_email       = $buyerEmail;
            $order->save();
            $user = User::where('id',$this->merchant_id)->first();
            if(!empty($order->id) && !empty($invoice['invoice_id']) && !empty($paymentMethod)){
                
                $paymentaddress = PaymentSetting::where(['account_id'=> $this->merchant_id,'account'=>'merchants'])->pluck('value', 'name');
                
                $order_details=[];
                $paymentProcess=[];
                $allOrder=[];

                $paymentProcess['amount']   = $amount;
                $paymentProcess['currency'] = $currency;
                $paymentProcess['address']  = $paymentaddress['username'];
                $paymentProcess['order_status']   = "UNPAID";
                $paymentProcess['invoice_status']  = "DRAFT";

                $paymentProcess['link']   = url("merchants/invoice").'/'.base64_encode($user->username).'/'.$invoice['invoice_uid'];



                $order_details['success'] = true;
                $order_details['paymentInstruction'] = (array)$paymentProcess;
                $result = $order_details;
                return $result;
            }
        }else{

            $result['HTTPCode'] = $this->unauthorizedStatus;
            $result['message'] = "Unauthorized -- Your API key is incorrect or your API key does not have access to a particular scope";
            return $result;
            
        }
    }


    public function createInvoice($data){

        $invoice =new MerchantInvoice();

        $invoice->merchant_id       = $this->merchant_id;
        $invoice->invoice_uid       = strtoupper(str_random(12));
        $invoice->payment_method_id = $data['payment_method_id'];
        $invoice->currency          = $data['currency'];
        $invoice->invoice_status    = "DRAFT";
        $invoice->notes             = $data['notes'];
        $invoice->save();

        $data['invoice_id']  = $invoice->id;
        $data['invoice_uid'] = $invoice->invoice_uid;
        $data['amount']      = $data['amount'];
        $this->createPaymentButton($data);
        return $data;
    }



    public function createPaymentButton($data)
    {

        $user = User::where('id',$this->merchant_id)->first();

        $payment = new PaymentButton();

        $payment->user_id     = $this->merchant_id;
        $payment->username    = $user->username;
        $payment->invoice_id  = $data['invoice_uid'];
        $payment->price       = $data['amount'];
        $payment->save();
    }
}
