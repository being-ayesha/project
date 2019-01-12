<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\frontend\sellers\AffiliatePayoutsDataTable;
use App\DataTables\frontend\sellers\AffiliateProductsDataTable;
use App\models\frontend\affiliates\AffiliatePayout;
use App\models\frontend\affiliates\AffiliateProduct;
use App\models\frontend\PaymentMethod;
use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\PaymentSetting;
use Validator;
use Common;
use Auth;
class AffiliateController extends Controller
{
    public function index(AffiliateProductsDataTable $dataTables){
        $data['siteName']  = getenv('APP_NAME');
        $data['pageTitle'] = 'Affiliates';
        return $dataTables->render('frontend.sellers.pages.affiliates.list',$data);
    }

    public function payouts(Request $request,AffiliatePayoutsDataTable $dataTables){
    	if(!$_POST){

        $data['siteName']   = getenv('APP_NAME');
        $data['pageTitle']  = 'Affiliates';
        $data['affiliates'] = AffiliateProduct::where('seller_id',Auth::user()->id)->select('affiliate_id')->distinct('affiliate_id')->get();
        //dd($data['affiliates']);
		$data['payment_method'] = PaymentMethod::all();
        return $dataTables->render('frontend.sellers.pages.affiliates.payout',$data);
    	}else{

    		 $rules=[
                 'user_id'       =>'required',
                 'amount' 		  =>'required',
                 'payment_method' =>'required',
                 'transaction_id' =>'required',
                 'notes'      	  =>'required',
                 ];

            $niceNames = [
                 'user_id'       =>'UserName',
                 'amount' 		  =>'Amount',
                 'payment_method' =>'Payment Method',
                 'transaction_id' =>'Transaction Id',
                 'notes'          =>'Notes',
                 ];

            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){ 
                return back()->withErrors($validator)->withInput();
            }else{ 
                $order = Order::where(['seller_id'=>Auth::user()->id,'affiliate_user_id'=>$request->user_id,'is_affiliated'=>'Yes','payment_status'=>'paid'])->get();
                $total_commission = 0;
                $paid_amount = 0;
                
                for ($i=0; $i <count($order) ; $i++) { 
                   $total_commission = $total_commission+(int)$order[$i]->affiliate_amount;
                 }
                // dd($total_commission);
                 if($total_commission<$request->amount){
                    Common::one_time_message('danger','The Amount for that affiliate is invalid !');
                    return back();
                }else{

                    $affiliate_match   = ['account_id'=>$request->user_id,'type'=>'paypal','account' => 'affiliate'];
                    $affiliate_user    = PaymentSetting::where($affiliate_match)->first();
                    

                    if(!empty($affiliate_user)){
                       
                        $total_commission = 0;
                        $paid_amount = 0;
                            for ($i=0; $i <count($order) ; $i++) { 
                                $total_commission = $total_commission+(int)$order[$i]->affiliate_amount;
                            }

                            if($total_commission<$request->amount){
                                Common::one_time_message('danger','The Total Amount for that affiliate is invalid !');
                                return back();
                            }else {

                                $affiliate_payouts = AffiliatePayout::where(['seller_id'=>Auth::user()->id,'affiliate_user_id'=>$request->user_id])->get();

                                for ($i=0; $i <count($affiliate_payouts) ; $i++) { 
                                    $paid_amount=$paid_amount+$affiliate_payouts[$i]->amount;
                                }
                                 $actual_amount = $paid_amount+$request->amount;

                                if($total_commission<$actual_amount){
                                    Common::one_time_message('danger','The Amount for that affiliate is invalid !');
                                    return back();
                                }else{
                                    $affiliate            = new AffiliatePayout();
                                    $affiliate->seller_id         = Auth::user()->id; 
                                    $affiliate->affiliate_user_id = $request->user_id;
                                    $affiliate->amount            = $request->amount; 
                                    $affiliate->payment_method_id = $request->payment_method; 
                                    $affiliate->transaction_id    = $request->transaction_id; 
                                    $affiliate->notes             = $request->notes; 
                                    $affiliate->save();

                                    Common::one_time_message('success','Your action has been successfully executed!');
                                    return back();
                                }

                            }
                        }else{
                            Common::one_time_message('danger','The payment method you selected for that affiliate is invalid !');
                            return back(); 
                        }
                }

            }
			
    	}
    }
}
