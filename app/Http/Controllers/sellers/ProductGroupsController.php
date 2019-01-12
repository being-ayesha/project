<?php

namespace App\Http\Controllers\sellers;
use App\DataTables\frontend\sellers\ProductGroupsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\ProductGroups;
use Validator;
use App\models\frontend\sellers\Product;
use Auth;
use Common;
class ProductGroupsController extends Controller
{
    
    /**
    * Load the product group views and store the data to product groups
    */
    public function index(Request $request,ProductGroupsDataTable $dataTable)
    {
    	if(!$_POST){
    		$opts['products']  = Product::where(['seller_id' => Auth::user()->id])->get();
    		$opts['siteName']  = getenv('APP_NAME');
    		$opts['pageTitle'] = 'Product groups list';
            return $dataTable->render('frontend.sellers.pages.productgroups.add',$opts);
    	}else{
    		$rules = [
           		'product_group_title' => 'required|unique:product_groups,product_group_title',
           		'product_id'          => 'required'
    		];
    		$niceNames = [
    			'product_group_title' => 'Product group title',
    			'product_id'          => 'Products'
    		];
    		$validator = Validator::make($request->all(),$rules);
    		$validator->setAttributeNames($niceNames);
    		if($validator->fails()){
    			return back()->withErrors($validator)->withInput();
    		}else{
	    		$ProductGroups                      = new ProductGroups();
	    		$ProductGroups->seller_id           = Auth::user()->id;
	    		$ProductGroups->product_id          = json_encode($request->product_id);
	    		$ProductGroups->product_group_title = $request->product_group_title;
	    		$ProductGroups->save();
	    		Common::one_time_message('success','Your action has been successfully executed!');
	    		return back();
    		}
    	}
    }

    /**
    * Load the specific product group and update the specific product groups
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function editProductGroups(Request $request , $id)
    {
        $ProductGroups              = ProductGroups::find($id);
        if(!$_POST){
            $groupProducts          = explode(',',$ProductGroups->groupProducts($ProductGroups->product_group_title));
            $opts['products']       = Product::where(['seller_id' => Auth::user()->id])->get()->toArray();
            $opts['ProductGroups']  = $ProductGroups;
            $opts['groupProducts']  = $groupProducts;
            $opts['siteName']       = getenv('APP_NAME');
            $opts['pageTitle']      = 'Product groups list';
            return view('frontend.sellers.pages.productgroups.edit',$opts);
        }else{
            $rules = [
                'product_group_title' => 'required|unique:product_groups,product_group_title,'.$ProductGroups->id,
                'product_id'          => 'required'
            ];
            $niceNames = [
                'product_group_title' => 'Product group title',
                'product_id'          => 'Products'
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
                $ProductGroups->seller_id           = Auth::user()->id;
                $ProductGroups->product_id          = json_encode($request->product_id);
                $ProductGroups->product_group_title = $request->product_group_title;
                $ProductGroups->save();
                Common::one_time_message('success','Your action has been successfully executed!');
                return back();
            }
        }
    }

    /**
    * Check a duplicate product group name
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function checkProductGroup(Request $request)
    {
        $productGroups = ProductGroups::where(['product_group_title' => $request->only(['productGroupTitle'])])->count();
        if($productGroups>0){
            return response()->json(['status'=>1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    /**
    * Delete a product group
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function deleteProductGroup(Request $request){
        $ProductGroups = ProductGroups::where(['id' => $request->productGroupId]);
        $cnt           = $ProductGroups->count();
        if($cnt==1){
            $ProductGroups->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }


}
