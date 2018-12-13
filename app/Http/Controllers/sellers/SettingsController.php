<?php

namespace App\Http\Controllers\sellers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Product;
use App\models\frontend\sellers\AccountSetting;
use App\models\frontend\sellers\ProductGroups;
use Auth;
use Common;
use App\models\frontend\User;
use App\models\frontend\Currency;
use App\models\frontend\sellers\PaymentSetting;
use Image;
use Hash;
use Validator;
use App\DataTables\frontend\sellers\LoginLogsDataTable;
use Session;
class SettingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accountSettings(Request $request)
    {   
        $settings              = AccountSetting::where(['seller_id' => Auth::user()->id])->first();
        if(!$_POST){
            $opts['settings']  = $settings;
            $opts['siteName']  = 'Rocketr';
            $opts['pageTitle'] = 'Account Settings';
            return view('frontend.sellers.pages.settings.account',$opts);
        }else{
        	//Add or Update account settings table
        	$accountSettings 									  = $settings==null?new AccountSetting():$settings;
	        $accountSettings->seller_id                           = Auth::user()->id;
            if($request->store_settings){
	        	$accountSettings->seller_page_description         = $request->seller_page_description;
	        	$accountSettings->google_track_code               = $request->google_track_code;
	        	$accountSettings->fb_track_code                   = $request->fb_track_code;
	        }	
        	if($request->ipn_settings){
	        	$accountSettings->ipn_status                      = $request->ipn_status=='on'?1:0;
	        	$accountSettings->ipn_secret                      = $request->ipn_secret;        	
	        }
	        if($request->email_settings){
        	  $accountSettings->receive_email_product_sold        = $request->receive_email_product_sold=='on'?1:0;
        	  $accountSettings->receive_email_unsuccessfull_login = $request->receive_email_unsuccessfull_login=='on'?1:0;
        	  $accountSettings->receive_email_site_tips_updates   = $request->receive_email_site_tips_updates=='on'?1:0;
        	}
        	$accountSettings->save();
        	//Add or update users table for profile photo
        	if($request->has('profile_photo')){
        		$user 								 = User::find(Auth::user()->id);
                $filePhoto                           = $request->file('profile_photo');
                if($user->profile_photo!=null){
                	$userImgPath 					 = public_path('uploads/sellers/profilephoto');
                	unlink($userImgPath.'/'.$user->profile_photo);
            	}
                $destPath                            = public_path('/uploads/sellers/profilephoto');
                $photoName                           = time().'_'.$filePhoto->getClientOriginalName();
                $photoImg                            = Image::make($filePhoto->getRealPath());
                $photoImg->resize(120,115,function($constraint){
                	$constraint->aspectRatio();
                })->save($destPath.'/'.$photoName);
                $user->profile_photo              = $photoName;
                $user->save();
            }
            //Save data to social sharing options table ends here
            Common::one_time_message('success','Your action has been successfully executed!');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function userStore($username){
        $opts['siteName']        = $username;
        $opts['pageTitle']       = url('/');
        $opts['user']            = User::where(['username' => $username])->first();
       
        if($opts['user']){
            $cnt                     = ProductGroups::where(['seller_id' => $opts['user']->id])->count();
            if($cnt>0){
                $opts['productGroups']   = $productGroups = ProductGroups::where(['seller_id' => $opts['user']->id])->get();
                for($i=0;$i<count($productGroups);$i++){
                    $groupProducts[]   = Product::whereIn('id',json_decode($productGroups[$i]->product_id))->select('*')->get()->toArray();
                }
                $opts['groupProductAll'] = $groupProducts;
                $opts['commonProducts']  = $this->commonProducts($groupProducts);
                return view('frontend.sellers.pages.stores.store',$opts);
            }else{
                Common::one_time_message('danger',"You don't have any store products");
                return back();
            }

        }else{
            Common::one_time_message('danger',"You don't have any store products");
            return back();
        }
        
        
    }

    public function paymentSettings(Request $response){
        $settings         = PaymentSetting::where(['account_id' => Auth::user()->id])->first();
        if(!$_POST){
            $data['siteName']       = 'Rocketr';
            $data['pageTitle']      = 'Payment Settings';
            $data['settings']       = $settings;
            $data['paypal']         = PaymentSetting::where(['type'=>'paypal','account'=>'seller','account_id'=>Auth::user()->id])->pluck('value','name');
            $data['oldcurrency']    = PaymentSetting::where(['type'=>'currency','account_id'=>Auth::user()->id])->first();
            $data['currency']       = Currency::all();
            return view('frontend.sellers.pages.settings.payment',$data);
        }
        else{
                      
            if($response->currency){
                $match           = ['account_id' => Auth::user()->id ,'account'=>'seller','type'=>'currency'];
                $paymentSettings = PaymentSetting::firstOrNew($match);
                $paymentSettings->account_id  = Auth::user()->id;
                $paymentSettings->account     = 'seller';
                $paymentSettings->name        = 'currency';
                $paymentSettings->value       = $response->currency_id;
                $paymentSettings->type        = 'currency';
                $paymentSettings->save();
            }

            if($response->paypal){
                foreach ($response->method as $key => $payment) {
                    foreach ($payment as $key => $value) {

                       $match                         = ['account_id' => Auth::user()->id ,'account'=>'seller','type'=>'paypal','name'=>$key];               
                       $paymentSettings               = PaymentSetting::firstOrNew($match);
                       $paymentSettings->account_id   = Auth::user()->id;
                       $paymentSettings->account      = 'seller';
                       $paymentSettings->name         = $key;
                       $paymentSettings->value        = $value;
                       $paymentSettings->type         = 'paypal';

                       $paymentSettings->save();
                    }
                }
            }
            Common::one_time_message('success','Your action has been successfully executed!');
            return back();
        }
    }

    public function securitySettings(Request $request,LoginLogsDataTable $datatable){


        if(!$_POST){
            $data['siteName']       = 'Rocketr';
            $data['pageTitle']      = 'Security Settings';
            return $datatable->render('frontend.sellers.pages.settings.security',$data);
        }else{

            $rules = array(
                'current_password'  => 'required',
                'new_password'      => 'required',
                'confirm_password'  => 'required|same:new_password',
                
            );
            $niceNames = array(
               
                'current_password'  => 'Password',
                'new_password'      => 'New Password',
                'confirm_password'  => 'Confirm password'
            );

            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
                $users           = $users;
                $credentails             = [];
                $credentails['email']    = $users->email;
                $credentails['password'] = $request->current_password;
                if(Auth::attempt($credentails)){
                    $users->password = Hash::make($request->new_password);
                    $users->save();
                    Common::one_time_message('success','Your action has been successfully executed!');
                    return back();
                }else{
                    Common::one_time_message('danger','Incorrect Current Password.');
                    return back();
                }
            }

        }
        
    }
    //Get  all group products
    public function commonProducts($groupProducts){
        $result           = [];
        foreach ($groupProducts as $value) {
            $result       = array_merge($result, $value);
        }
        $productIds       = array_column($result, 'id');
        $uniqueProductIds = array_values(array_unique($productIds));
        for($i=0;$i<count($uniqueProductIds);$i++){
            $cProducts[$i] = Product::where('id',$uniqueProductIds[$i])->select('*')->get()->toArray();
        }
        return $cProducts;
    }
}
