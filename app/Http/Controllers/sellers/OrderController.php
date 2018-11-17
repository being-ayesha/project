<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Common;
use App\models\frontend\sellers\Order;
use App\DataTables\frontend\sellers\OrderDataTable;
class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
       
        $opts['siteName']  = 'Rocketr';
        $opts['pageTitle'] = 'Order Litst';
        return $dataTable->render('frontend.sellers.pages.orders.list',$opts);

    }

    public function orderView($id){

    	$option['siteName']  = 'Rocketr';
        $option['pageTitle'] = 'Order Details';
    	$option['order']=Order::where(['seller_id'=>Auth::user()->id,'order_uuid'=>$id])->first();
    	return view('frontend.sellers.pages.orders.view',$option);
    }

     public function deleteOrder(Request $request){
        
        $order         = Order::where(['order_uuid'=>$request->orderId]);
        $cnt           = $order->count();
        if($cnt==1){
            $order->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
}