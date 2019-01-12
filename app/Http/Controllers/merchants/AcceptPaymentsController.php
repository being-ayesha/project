<?php

namespace App\Http\Controllers\merchants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\PaymentMethod;
use App\models\frontend\User;
use App\models\frontend\merchants\PaymentButton;
use App\DataTables\frontend\merchants\merchantsApiDataTable;
use App\models\frontend\merchants\MerchantApp;
use Auth;
use App\models\frontend\sellers\AccountSetting;
use Common;
use Token;
class AcceptPaymentsController extends Controller
{
    public function acceptPayments()
    {
        $data['siteName']       = getenv('APP_NAME');
        $data['pageTitle']      = 'Accept Payment';
        return view('frontend.merchants.pages.acceptpayment.accept',$data);
    }
    public function paymentButtons()
    {
        $data['siteName']       = getenv('APP_NAME');
        $data['pageTitle']      = 'Payment Buttons';
        $data['paymentMethod']  = PaymentMethod::all();
        $data['invoice_id']     = strtoupper(str_random(12));
        return view('frontend.merchants.pages.acceptpayment.paymentbutton',$data);
    }

    public function invoice(Request $request){

        $data['siteName']       = getenv('APP_NAME');
        $data['pageTitle']      = 'Accept Payment';
        $data['username']       = $username = base64_decode($request->username);
        $data['user_details']   = User::where('username',$username)->first();
        $data['payment_details']= PaymentButton::where(['username'=>$username,'invoice_id'=>$request->invoiceId])->first();
        return view('frontend.merchants.pages.buynow.pay',$data);
    }

    public function buyButton(Request $request){

        $paymetn_button = PaymentButton::where(['user_id'=>Auth::user()->id,'invoice_id'=>$request->invoice_id])->first();

        $paymentbutton = $paymetn_button==null?new PaymentButton():$paymetn_button;
        
        $paymentbutton->user_id              = Auth::user()->id;
        $paymentbutton->username             = Auth::user()->username;
        $paymentbutton->invoice_id           = $request->invoice_id;
        $paymentbutton->price                = $request->price;
        $paymentbutton->browser_redirect_url = $request->browserRedirectURL;
        $paymentbutton->ipn_redirect_url     = $request->ipnRedirectURL;
        $paymentbutton->buyer_shipping       = $request->buyerShipping;
        $paymentbutton->save();
        return response()->json(['status'=>1]);
    }

    public function api(Request $request,merchantsApiDataTable $dataTables){

        if(!$_POST){

        $data['settings']       = AccountSetting::where(['seller_id' => Auth::user()->id])->first();
        $data['siteName']       = getenv('APP_NAME');
        $data['pageTitle']      = 'Accept Payment';
        return $dataTables->render('frontend.merchants.pages.acceptpayment.api',$data);
        }else{

            $allstring  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $scope = ['orders','invoices','merchants'];
            
            $merchantApp = new MerchantApp;

            $merchantApp->merchant_id     = Auth::user()->id;
            $merchantApp->app_name        = $request->appName;
            $merchantApp->app_description = $request->appDescription;
            $merchantApp->app_id          = $request->appName . substr(str_shuffle($allstring), 0,30);
            $merchantApp->app_secrect     = base64_encode(substr(str_shuffle($allstring), 0,50));
            $merchantApp->scope           = json_encode($scope);
            $merchantApp->save();
            return response()->json(['status'=>1]);

        }
        
    }

    public function apiDelete(Request $request){
      
        $merchantApp = MerchantApp::where(['merchant_id'=>Auth::user()->id,'app_id'=>$request->apiId]);
        $cnt           = $merchantApp->count();
        if($cnt==1){
            $merchantApp->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }

        

    }
    
}
