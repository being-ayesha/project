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
use Image;
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
        $cnt                     = ProductGroups::where(['seller_id' => $opts['user']->id])->count();
        if($cnt>0){
        $opts['productGroups']   = $productGroups = ProductGroups::where(['seller_id' => $opts['user']->id])->get();
            for($i=0;$i<count($productGroups);$i++){
                $groupProducts[$i]   = Product::whereIn('id',json_decode($productGroups[$i]->product_id))->select('*')->get()->toArray();
            }
            $opts['groupProductAll'] = $groupProducts;
            return view('frontend.sellers.pages.stores.store',$opts);
        }else{
            return back();
        }
        
    }
}
