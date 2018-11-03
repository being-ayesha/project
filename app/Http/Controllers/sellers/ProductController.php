<?php

namespace App\Http\Controllers\sellers;
use App\DataTables\frontend\sellers\ProductsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\ProductType;
use App\models\frontend\sellers\ProductSocialOption;
use App\models\frontend\sellers\Product;
use App\models\frontend\sellers\ProductGroups;
use Common;
use Validator;
use Image;
use Auth;
class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $dataTable)
    {
        $opts['siteName']  = 'Rocketr';
        $opts['pageTitle'] = 'Product Litst';
        return $dataTable->render('frontend.sellers.pages.products.list',$opts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductType(Request $request)
    {
        if(!$_POST){
            $opts['siteName']  = 'Rocketr';
            $opts['pageTitle'] = 'Add Product Type';
            return view('frontend.sellers.pages.products.producttype',$opts);
        }else{
            $rules = [
                'name' => 'required|unique:product_types,name',
                'photo' => 'required',
            ];
            $niceNames = [
                'name' => 'Product Type Name',
                'photo' => 'Product Type Photo',
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
                //Save data to Product type table
                $productType              = new ProductType();
                $productType->name        = $request->name;
                $productType->description = $request->description;
                $productType->created_at  = date('Y-m-d');
                $pic                      = $request->file('photo');
                $destinationPath = public_path('/uploads/sellers/producttypephoto/');
                $filename        = time().'_'.$pic->getClientOriginalName();
                $img             = Image::make($request->file('photo')->getRealPath());
                $img->resize(200,200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename);
                $productType->photo= $filename;
                $productType->save();
                Common::one_time_message('success', 'Your action has been successfully executed!');
                return redirect('seller/add-product-type');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        if(!$_POST){
            $opts['siteName']     = 'Rocketr';
            $opts['pageTitle']    = 'Add Product';
            return view('frontend.sellers.pages.products.add',$opts);
        }else{
            $product                                 = new Product();
            $product->seller_id                      = Auth::user()->id;
            $product->product_uuid                   = Common::unique_code();
            $product->product_title                  = $request->title;
            $product->product_description            = strip_tags($request->description);
            //Product photo upload codes starts here
            if($request->has('photo')){
                $filePhoto                           = $request->file('photo');
                $destPath                            = public_path('/uploads/sellers/products');
                $photoName                           = time().'_'.$filePhoto->getClientOriginalName();
                $photoImg                            = Image::make($filePhoto->getRealPath());
                $photoImg->save($destPath.'/'.$photoName);
                $product->product_photo              = $photoName;
            }
            //Product photo upload codes ends here
            $product->price                          = $request->price;
            $product->payment_method_id              = $request->payment_method;
            $product->buyer_purchase_permission      = $request->purchase_permission_for_buyers;
            $product->product_delivery_email_message = $request->product_delivery_email_message;
            $product->affiliate_permission           = $request->affiliate_permission?'Yes':'No';
            $product->affiliate_rate                 = $request->affiliate_rate;
            $productType                             = ProductType::where(['name' => $request->product_type])->first();
            if($request->product_type=='file'){
                $product->product_type_id            = $productType->id;
                $product->stock                      = $request->stock_unlimited=='on'?-1:$request->stock_limited;
                //Downloadable file upload codes for any type of file starts here
                $downloadable_file                   = $request->file('downloadable_file');
                $destinationPath                     = public_path('/uploads/sellers/downloadablefiles');
                $fileName                            = time().'_'.$downloadable_file->getClientOriginalName();
                $downloadable_file->move($destinationPath,$fileName);
                //Downloadable file upload for any type of file codes ends here
                $product->downloadable_file          = $fileName;
            }else if($request->product_type=='code'){
                $product->product_type_id            = $productType->id;
                $product->added_codes                = json_encode($request->code_item);
                $product->stock                      = count($request->code_item);
                $product->codes_purchase_permission  = $request->codes_purchase_permission?'Yes':'No';
                $product->purchase_limit             = $request->codes_puchase_limit;
            }else if($request->product_type=='service'){
                $product->product_type_id            = $productType->id;
                $product->purchase_limit             = $request->service_puchase_limit;
                $product->codes_purchase_permission  = $request->service_purchase_permission_state?'Yes':'No';
                $product->stock                      = $request->service_sell_permission;
            }
            $product->save();
            //Save data to social sharing options table starts here
            $socialOptions['facebook']                 = $request->show_fb;
            $socialOptions['twitter']                  = $request->show_tweet;
            $socialOptions['pininterest']              = $request->show_pinit;           
            foreach($socialOptions as $key => $value){
                $ProductSocialOption                       = new ProductSocialOption();
                $ProductSocialOption->seller_id            = $product->seller_id;
                $ProductSocialOption->product_id           = $product->id;
                $ProductSocialOption->social_platform_name = $key;
                $ProductSocialOption->status               = ($value=='on')?"Active":'Inactive';
                $ProductSocialOption->save();
            }
            //Save data to social sharing options table ends here
            Common::one_time_message('success','Your action has been successfully executed!');
            return back();
        }
    }

    /**
     * Update a existing resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function editProduct(Request $request , $id)
    {
        $product               = Product::where(['product_uuid' => $id])->first();
        if(!$_POST){
            $opts['products']  = $product;
            $opts['siteName']  = 'Rocketr';
            $opts['pageTitle'] = 'Update Product';
            return view('frontend.sellers.pages.products.edit',$opts);
        }else{
            $rules = [
                'title' => 'required|unique:products,product_title,'.$product->id,
                'price' => 'required',
                'payment_method' => 'required',
                'product_delivery_email_message' => 'required'
            ];

            $niceNames = [
                'title' => 'Product name',
                'price' => 'Product price',
                'payment_method' => 'Payment method',
                'product_delivery_email_message' => 'Email message'
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
            $product->seller_id                      = Auth::user()->id;
            $product->product_title                  = $request->title;
            $product->product_description            = strip_tags($request->description);
            //Product photo upload codes starts here
            if($request->has('photo')){
                $filePhoto                               = $request->file('photo');
                $destPath                                = public_path('/uploads/sellers/products');
                unlink($destPath.'/'.$product->product_photo);
                $photoName                               = time().'_'.$filePhoto->getClientOriginalName();
                $photoImg                                = Image::make($filePhoto->getRealPath());
                $photoImg->save($destPath.'/'.$photoName);
                $product->product_photo                  = $photoName;
            }
            //Product photo upload codes ends here
            $product->price                          = $request->price;
            $product->payment_method_id              = $request->payment_method;
            $product->buyer_purchase_permission      = $request->purchase_permission_for_buyers;
            $product->product_delivery_email_message = $request->product_delivery_email_message;
            $product->affiliate_permission           = $request->affiliate_permission?'Yes':'No';
            $product->affiliate_rate                 = ($request->affiliate_permission)?$request->affiliate_rate:NULL;
            $productType                             = ProductType::where(['name' => $request->product_type])->first();
            if($request->product_type=='file'){
                $product->product_type_id            = $productType->id;
                $product->stock                      = $request->stock_unlimited=='on'?-1:$request->stock_limited;
                //Downloadable file upload codes for any type of file starts here
                if($request->has('downloadable_file')){
                    $downloadable_file                   = $request->file('downloadable_file');
                    $destinationPath                     = public_path('/uploads/sellers/downloadablefiles');
                    unlink($destinationPath.'/'.$product->downloadable_file);
                    $fileName                            = time().'_'.$downloadable_file->getClientOriginalName();
                    $downloadable_file->move($destinationPath,$fileName);
                    $product->downloadable_file          = $fileName;
                }
                //Downloadable file upload for any type of file codes ends here

            }else if($request->product_type=='code'){
                $product->codes_purchase_permission  = $request->codes_purchase_permission?'Yes':'No';
                $product->purchase_limit             = $request->codes_puchase_limit;
            }else if($request->product_type=='service'){
                $product->purchase_limit             = $request->service_puchase_limit;
                $product->codes_purchase_permission  = $request->service_purchase_permission_state?'Yes':'No';                $product->stock                      = $request->service_sell_permission;
            }
            $product->save();
            //Update data to social sharing options table
            $socialOptions['facebook']                 = $request->show_fb;
            $socialOptions['twitter']                  = $request->show_tweet;
            $socialOptions['pininterest']              = $request->show_pinit;            
            foreach($socialOptions as $key => $value){
                $ProductSocialOption['status']               = ($value=='on')?"Active":'Inactive';
                ProductSocialOption::where(['seller_id'=>$product->seller_id,'product_id' => $product->id,'social_platform_name' => $key])->update($ProductSocialOption);
            }
            Common::one_time_message('success','Your action has been successfully executed!');
            return back();
        }
        }
    }

    /**
    * Check a duplicate product name
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function checkProduct(Request $request){
        $products = Product::where(['product_title' => $request->only(['title'])])->count();
        if($products>0){
            return response()->json(['status'=>1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

}
