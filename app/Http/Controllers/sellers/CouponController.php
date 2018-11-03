<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Common;
use App\models\frontend\sellers\Product;
use App\models\frontend\sellers\Coupon;
use App\models\frontend\PaymentMethod;
use App\models\frontend\sellers\Order;
use Validator;
use Auth;
use DateTime;
use App\DataTables\frontend\sellers\CouponsDataTable;
use App\DataTables\frontend\sellers\LatestOrderUsingCouponDataTable;
class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(CouponsDataTable $dataTable)
    {
        $opts['siteName']  = 'Rocketr';
        $opts['pageTitle'] = 'Coupon Litst';
        return $dataTable->render('frontend.sellers.pages.coupons.list',$opts);
    }

    public function addCoupon(Request $request)
    {


        if(!$_POST){
            $opts['products']       = Product::where(['seller_id' => Auth::user()->id])->get();
            $opts['paymentMethod']  = PaymentMethod::all();
            $opts['siteName']       = 'Rocketr';
            $opts['pageTitle']      = 'Add Coupon';
            return view('frontend.sellers.pages.coupons.add',$opts);
        }else{

            
        	// dd(date_format(date_create($request->expaire_date),"Y-m-d h:i:s"));
            $rules=[
                 'product_id'        =>'required',
                 'payment_method_id' =>'required',
                 'coupon_code'        =>'required',
                 'discount_strcture' =>'required',
                 'discount_amount'   =>'required',
                 'expaire_date'      =>'required',
                 'stock'             =>'required',
                 ];

            $niceNames = [
                 'product_id'        =>'Product Type Name',
                 'payment_method_id' =>'Payment Method Name',
                 'coupon_code'       =>'Coupon Code',
                 'discount_strcture' =>'Discount Strcture',
                 'discount_amount'   =>'Discount Amount',
                 'expaire_date'      =>'Expaire Date',
                 'stock'             =>'Number of uses',
                 ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                
                return back()->withErrors($validator)->withInput();
            }else{    
            
                $cupon                     = new Coupon();
                $cupon->seller_id          = Auth::user()->id;
                $cupon->product_ids        = json_encode($request->product_id);
                $cupon->payment_methods    = json_encode($request->payment_method_id);
                $cupon->coupon_code        = $request->coupon_code;
                $cupon->discount_structure = $request->discount_strcture;
                $cupon->amount_off         = $request->discount_amount;
                $cupon->start_date         = date('Y-m-d h:i:s');
                $cupon->expiry_date        = date_format(date_create($request->expaire_date),"Y-m-d h:i:s");
                $cupon->stock              = $request->stock;
                $cupon->number_of_uses     = 0;
                $cupon->save();

            }
            Common::one_time_message('success','Your action has been successfully executed!');
            return back();
        }
    }

    public function checkCouponCode(Request $request){
        $coupons = Coupon::where(['coupon_code' => $request->only(['coupon_code'])])->count();
        if($coupons>0){
            return response()->json(['status'=>1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function deleteCoupon(Request $request){
        
        $coupons              = Coupon::find($request->coupon_id);
        $coupons->deleted_at  =1;
        $coupons->save();
        return response()->json(['status' => 1]);
    }

    public function editCoupon(Request $request, $id,LatestOrderUsingCouponDataTable $dataTable){
       
        $coupon  = Coupon::where(['id' => $id])->first();

        if(!$_POST){

        $option['coupon']           = $coupon;
        $option['siteName']         = 'Rocketr';
        $option['pageTitle']        = 'Update Coupon';
        $option['groupCoupons']     = explode(',',$coupon->getCouponProducts($coupon->id));
        $option['products']         = Product::where(['seller_id' => Auth::user()->id])->get()->toArray();
        $option['groupPayment']     = explode(',',$coupon->getCouponPayments($coupon->id));
        $option['paymentMethod']    = PaymentMethod::get()->toArray();
        return $dataTable->with('coupon_id',$id)->render('frontend.sellers.pages.coupons.edit',$option);
        }else{

            $rules=[
                 'product_id'        =>'required',
                 'payment_method_id' =>'required',
                 'coupon_code'       =>'required',
                 'discount_strcture' =>'required',
                 'discount_amount'   =>'required',
                 'expaire_date'      =>'required',
                 'stock'             =>'required',
                 ];

            $niceNames = [
                 'product_id'        =>'Product Type Name',
                 'payment_method_id' =>'Payment Method Name',
                 'coupon_code'       =>'Coupon Code',
                 'discount_strcture' =>'Discount Strcture',
                 'discount_amount'   =>'Discount Amount',
                 'expaire_date'      =>'Expaire Date',
                 'stock'             =>'Number of uses',
                 ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                
                return back()->withErrors($validator)->withInput();
            }else{ 

            $coupon->seller_id          = Auth::user()->id;
            $coupon->product_ids        = json_encode($request->product_id);
            $coupon->payment_methods    = json_encode($request->payment_method_id);
            $coupon->coupon_code        = $request->coupon_code;
            $coupon->discount_structure = $request->discount_strcture;
            $coupon->amount_off         = $request->discount_amount;
            $coupon->expiry_date        = date_format(date_create($request->expaire_date),"Y-m-d h:i:s");
            $coupon->stock              = $request->stock;
            $coupon->save();
            Common::one_time_message('success','Your action has been successfully executed!');
            return back();
             }
        }
        
    }

    public function numberOfCouponUses(Request $request){
        // $coupons=Coupon::first();
        // // dd(date_format(date_create($coupons->expiry_date),"Y-m"));
        // dd(date_format(date_create($request->coupon_year.'-'.$request->coupon_month),"Y-m-d h:i:s"));
        // $date=$request->coupon_year.'-'.$request->coupon_month;
        // echo $date;exit();
        $order=Order::where(['seller_id'=>Auth::user()->id,'coupon_code'=>$request->coupon_code])->get();
       // $cupon_expiary_date=date_format(date_create($order->expiry_date),"Y-m");
        //dd($cupon_expiary_date,1);
        dd($request->all());
    }
}
