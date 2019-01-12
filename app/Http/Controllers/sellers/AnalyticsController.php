<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Product;
use App\models\frontend\sellers\ProductView;
use App\models\frontend\sellers\Order;
use Auth;
use DateTime;
use Carbon\Carbon;
class AnalyticsController extends Controller
{

	// Get Product view Chart and Order Chart by Date and product
    public function index(Request $request)
    {
    	
    	if(!$_POST){
    		$data['siteName']  = getenv('APP_NAME');
    		$data['pageTitle'] = 'Analytic';
    		$data['products']  = Product::where(['seller_id' => Auth::user()->id])->get();
    		return view('frontend.sellers.pages.analytic.analytic',$data);

    	}else{

    		$data['siteName']  = getenv('APP_NAME');
    		$data['pageTitle'] = 'Analytic';
    		$data['products']     = Product::where(['seller_id' => Auth::user()->id])->get();
    		$data['groupProduct'] = $request->analytic_product_id;
    		
    		$products 		= [];
			$total_view    = 0;
    		$product_ids 	= $request->analytic_product_id ;
    		foreach ($product_ids as  $value) {
    		 	array_push($products, (int)$value);
    		}

    		if($request->select_date){

    		 $date_arr 		= explode('-',str_replace(',','-',$request->select_date));
    		
    		 $date_arr_from  = explode(' ',$date_arr[0]);
    		 $from_month     = date('m',strtotime($date_arr_from[0]));
    		 $from_day 		 = $date_arr_from[1];
    		 $from_year 	 = (int)$date_arr[1];
    		 $from_date      = $from_day.'-'.$from_month.'-'.$from_year;
			 $from           = date('Y-m-d',strtotime($from_date));
 			 
			 $date_arr_to  = explode(' ',$date_arr[2]);
			 
    		 $to_month     = date('m',strtotime($date_arr_to[2]));
    		 $to_day 	   = $date_arr_to[3];
    		 $to_year 	   = (int)$date_arr[3];
    		 $to_date      = $to_day.'-'.$to_month.'-'.$to_year;
			 $to           = date('Y-m-d',strtotime($to_date));

    		}else{
    		 	$from = date('Y-m-d', strtotime("-1 Months"));
    		 	$to   = date('Y-m-d');
    		}

    		

    		$product_result = ProductView::where('seller_id',Auth::user()->id)->whereIn('product_id',$products)->whereBetween('product_views_date',array($from, $to))->get();
    		$order_result = Order::where('seller_id',Auth::user()->id)->whereIn('product_id',$products)->whereBetween('order_date',array($from." 00:00:00", $to." 23:59:59"))->get();
    		
    	
    		if(!empty(count($product_result))){
    			

    		 	$get_all_product   = [];
    			$get_all_key       = [];
    		 	$get_all_key_value = [];
    		 	$get_single_date   = [];

    		 	foreach ($product_result as $key => $product_details) {
    		 	array_push($get_all_product, $product_details->product_views_date);
    		 	}

    		 	$result=array_count_values($get_all_product);

    		 	foreach ($result as $key => $value) {
    		 	array_push($get_all_key,$key);
    		 	array_push($get_all_key_value,$value);

    		 	} 	

    		 	for ($i=0; $i <count($get_all_key) ; $i++) { 
    		 		for ($j=$i; $j==$i ; $j++) { 
    		 			$result_data=array($get_all_key[$i],$get_all_key_value[$j]);
    		 			array_push($get_single_date,$result_data);
    		 		}
    		 	}

    		 	$name =['Days','Total View'];
    		 	array_unshift($get_single_date, $name);
    		 	$data['viewcount']= json_encode($get_single_date);	

    		}else{
    		 	$data['result_product_message']="No data Found";
    		}

    		if(!empty(count($order_result))){

    		 	$get_all_order     = [];
    		 	$total_amount      = [];
    		 	$get_order_date    = [];
    		 	$get_result_order  = [];

    		 	foreach ($order_result as $key => $order_details) {
    		 		array_push($get_all_order, date('Y-m-d',strtotime($order_details->order_date)));
    		 		
    		 	}
				$result_order=array_count_values($get_all_order);

				foreach ($result_order as $key => $value) {

					$amount  = Order::where('seller_id',Auth::user()->id)->whereIn('product_id',$products)->whereDate('order_date','=',$key)->sum('amount');
					array_push($total_amount,(int)$amount);
					array_push($get_order_date,$key);
					
				}

				for ($i=0; $i <count($get_order_date) ; $i++) { 
    		 		for ($j=$i; $j==$i ; $j++) { 
    		 			$result_data=array($get_order_date[$i],$total_amount[$j]);
    		 			array_push($get_result_order,$result_data);
    		 		}
    		 	}

    		 	$Ordername =['Days','Total Amount'];
    		 	array_unshift($get_result_order, $Ordername);
    		 	$data['ordercount']= json_encode($get_result_order);

    		}else{
    			$data['result_order_message']="No data Found";
    		 }
    		 
    	  return view('frontend.sellers.pages.analytic.analytic',$data); 

    	}	
    }

}
