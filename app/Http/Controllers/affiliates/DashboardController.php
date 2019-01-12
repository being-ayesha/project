<?php

namespace App\Http\Controllers\affiliates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use App\models\frontend\sellers\Order;
use Validator;
use Auth;
use Common;
use App\models\frontend\Currency;
class DashboardController extends Controller
{

        public function index()
        {
           $data['siteName']  = getenv('APP_NAME');
           $data['pageTitle'] = 'Affiliates Home';
           $data['order']     = $order = Order::find(1);
           $data['currency']    = Currency::currencySymbol();
           
           $total_commission = $daily_commission = $weekly_commission = $number_of_sale = $daily_sale= $weekly_sale = 0;

           if($order!=NULL){
            
            for ($i=0; $i <count($order->affiliatesOrder()) ; $i++) { 
             $total_commission = $total_commission+(int)$order->affiliatesOrder()[$i]->affiliate_amount;
             $number_of_sale   = $number_of_sale+(int)$order->affiliatesOrder()[$i]->product_quantity;

           }

           
           for ($i=0; $i <count($order->dailyAffiliatesOrder()) ; $i++) { 
             $daily_commission = $daily_commission+(int)$order->affiliatesOrder()[$i]->affiliate_amount;
             $daily_sale       = $daily_sale+(int)$order->affiliatesOrder()[$i]->product_quantity;

           }

           
           for ($i=0; $i <count($order->weeklyAffiliatesOrder()) ; $i++) { 
             $weekly_commission = $weekly_commission+(int)$order->affiliatesOrder()[$i]->affiliate_amount;
             $weekly_sale       = $weekly_sale+(int)$order->affiliatesOrder()[$i]->product_quantity;

           }
         }

         $data['total_commission_made']  = $total_commission;
         $data['daily_commission_made']  = $daily_commission;
         $data['weekly_commission_made'] = $weekly_commission;

         $data['number_of_sale']  = $number_of_sale;
         $data['daily_sale']      = $daily_sale;
         $data['weekly_sale']     = $weekly_sale;

        return view('frontend.affiliates.pages.dashboard',$data);
        }


    public function login(Request $request){

    	if(!$_POST){
    		
    		$data['siteName']  = getenv('APP_NAME');
        	$data['pageTitle'] = 'Affiliates Login';
    		return view("frontend.affiliates.pages.login",$data);
    	}

    	else{
            $rules = [
                    'email' => 'required',
                    'password' => 'required'
            ];
            $niceNames = [
                'email' => 'Email',
                'password' => 'Password'
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
                $user                    = User::where(['email' => $request->email])->first();           
                $credentails             = [];
                $credentails['email']    = $request->email;
                $credentails['password'] = $request->password;
                if(@$user->status!='Inactive'){
                    if(Auth::attempt($credentails)){

                        return redirect('affiliates/dashboard');
                    }else{
                        Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password.');
                        return back()->withInput();
                    }
                }else{
                    Common::one_time_message('danger','Account is not active!');
                    return back()->withInput();
                }
            }

       }	
    }

    public function logout()
    {
        Auth::logout();
        return redirect('affiliates/login');
    }
}
