<?php

namespace App\Http\Controllers\affiliates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Product;
use App\models\frontend\User;
use App\models\frontend\Currency;
use App\models\frontend\affiliates\AffiliateProduct;
use App\DataTables\frontend\affiliates\AffiliateProductsDataTable;
use Validator;
use Common;
use Auth;
class ProductController extends Controller
{
    public function index(Request $request , AffiliateProductsDataTable $dataTables){

    	if(!$_POST){

    		$data['siteName']  = getenv('APP_NAME');
    		$data['pageTitle'] = 'Affiliates Product';
    		return $dataTables->render("frontend.affiliates.pages.products.list",$data);

    	}else{

            $rules=[
                 'product_url'       =>'required',
                 ];

            $niceNames = [
                 'product_url'       =>'Affiliates Url',
                 
                 ];

            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){ 
                return back()->withErrors($validator)->withInput();
            }else{
                $details        = explode("/",str_replace(url('buy/'),'',$request->product_url));
            $user_name      = base64_decode($details[1]);
            $product_uuid   = $details[2];
            
            $product        = Product::where('product_uuid',$product_uuid)->first();
            $affiliate      = AffiliateProduct::where(['affiliate_id'=>Auth::user()->id,'product_id'=>$product->id])->first();
            
            if($product->affiliate_permission=='Yes'){

                if(Auth::user()->id == $product->seller_id){
                    Common::one_time_message('danger','You can not be your own affiliate. That is just weird');
                    return back();
                }else{

                    if($affiliate){
                        Common::one_time_message('danger','It seems you are already an affiliate of this product');
                        return back();
                    }else{

                        $affiliate = new  AffiliateProduct();
                        $affiliate->seller_id               = $product->seller_id;
                        $affiliate->product_id              = $product->id;
                        $affiliate->affiliate_id            = Auth::user()->id;
                        $affiliate->affiliate_product_url   = $request->product_url.'/'.base64_encode(Auth::user()->username);
                        $affiliate->save();
                        Common::one_time_message('success','Product Add Successfully');
                        return back();
                    }
                }

            }else{
                Common::one_time_message('danger','That product does not have affiliates enabled !');
                return back();

            }
        }
    		
    	}
    	
    	
    }

}
