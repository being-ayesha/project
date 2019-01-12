<?php

namespace App\Http\Controllers\merchants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use App\models\frontend\sellers\AccountSetting;
use App\models\frontend\Merchant;
use Image;
use Auth;
use Common;
use Validator;
use App\DataTables\frontend\sellers\LoginLogsDataTable;
use Hash;
use App\models\frontend\Currency;
use App\models\frontend\sellers\PaymentSetting;
use App\models\frontend\UserDetail;

class SettingsController extends Controller
{

	// Merchants account settings
    public function accountSettings(Request $request){

		$settings              = AccountSetting::where(['seller_id' => Auth::user()->id])->first();
     	if(!$_POST){

     	$opts['settings']  = $settings;
        $opts['siteName']  = getenv('APP_NAME');
        $opts['pageTitle'] = 'Merchants Settings';
        return view('frontend.merchants.pages.settings.account',$opts);

     	}else{

     		$accountSettings 									  = $settings==null?new AccountSetting():$settings;
	        $accountSettings->seller_id                           = Auth::user()->id;

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

	// Merchants profile settings
    public function profileSettings(Request $request){
		$merchants = Merchant::where('user_id',Auth::user()->id)->first();
    	
    	if(!$_POST){
    		$opts['siteName']  = getenv('APP_NAME');
    		$opts['pageTitle'] = 'Merchants profile';
    		$opts['country']   = Common::countryList();
    		$opts['merchant']  = $merchants;
    		return view('frontend.merchants.pages.settings.profile',$opts);

    	}else{

    		$rules=[
                 'first_name'       =>'required',
                 'last_name' 		=>'required',
                 'address_line_1'   =>'required',
                 'address_line_2'   =>'required',
                 'city'             =>'required',
                 'state'            =>'required',
                 'postal_code'      =>'required',
                 'country'          =>'required',
                 
                 ];

            $niceNames = [
                 'first_name'       =>'First Name',
                 'last_name' 		=>'Last Name',
                 'address_line_1'   =>'Address Line 1',
                 'address_line_2' 	=>'Address Line 2',
                 'city'   			=>'City',
                 'state'     		=>'State',
                 'postal_code'      =>'Postal Code',
                 'country'          =>'Country',
                 ];

            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){

                return back()->withErrors($validator)->withInput();
            }
            else{

	            $merchant =  $merchants;

				$merchant->first_name 			= $request->first_name;
				$merchant->last_name 			= $request->last_name;
				$merchant->address_line_1 		= $request->address_line_1;
				$merchant->address_line_2		= $request->address_line_2;
				$merchant->city 				= $request->city;
				$merchant->state 				= $request->state;
				$merchant->postal_code 			= $request->postal_code;
				$merchant->country 				= $request->country;
				$merchant->business_name    	= $request->business_name;
				$merchant->business_description = $request->business_description;
				$merchant->business_company     = $request->business_company;
				$merchant->merchant_website     = $request->merchant_website;
				$merchant->save();

				Common::one_time_message('success','Your action has been successfully executed!');
	            return back();   	
            }
    	}	
    }

	// Merchants Payment settings
    public function paymentSettings(Request $response){
        $settings         = PaymentSetting::where(['account_id' => Auth::user()->id])->first();
        
        if(!$_POST){
            $data['siteName']       = getenv('APP_NAME');
            $data['pageTitle']      = 'Merchant Payment Settings';
            $data['settings']       = $settings;
            $data['paypal']         = PaymentSetting::where(['type'=>'paypal','account'=>'merchants','account_id'=>Auth::user()->id])->pluck('value','name');
            $data['oldcurrency']    = PaymentSetting::where(['type'=>'currency','account_id'=>Auth::user()->id])->first();
            $data['currency']       = Currency::all();
            return view('frontend.merchants.pages.settings.payment',$data);
        }
        else{
                      
            if($response->currency){
                $match           = ['account_id' => Auth::user()->id ,'account'=>'merchants','type'=>'currency'];
                $paymentSettings = PaymentSetting::firstOrNew($match);
                $paymentSettings->account_id  = Auth::user()->id;
                $paymentSettings->account     = 'merchants';
                $paymentSettings->name        = 'currency';
                $paymentSettings->value       = $response->currency_id;
                $paymentSettings->type        = 'currency';
                $paymentSettings->save();
            }

            if($response->paypal){
                foreach ($response->method as $key => $payment) {
                    foreach ($payment as $key => $value) {

                       $match                         = ['account_id' => Auth::user()->id ,'account'=>'merchants','type'=>'paypal','name'=>$key];               
                       $paymentSettings               = PaymentSetting::firstOrNew($match);
                       $paymentSettings->account_id   = Auth::user()->id;
                       $paymentSettings->account      = 'merchants';
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
    // Merchants Security settings
    public function securitySettings(Request $request,LoginLogsDataTable $datatable){
        
        if(!$_POST){
            $data['siteName']       = getenv('APP_NAME');
            $data['pageTitle']      = 'Merchants Security Settings';
            $data['userdetails']    = UserDetail::where(['user_id'=>Auth::user()->id])->first();

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
                $users                   = Auth::user();
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


     public function google2faEnable()
    {
        $data['siteName']        = getenv('APP_NAME');
        $data['pageTitle']       = '2FA';

        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $user->google2fa_secret   = $google2fa->generateSecretKey();
        $user->save();

        $data['QR_Image'] = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        $data['secret']=$user->google2fa_secret;

     return view('frontend.sellers.pages.settings.twofa',$data);
    }

     public function enable2fa(Request $request){

       $user = Auth::user();
        $userdetails = UserDetail::where(['user_id'=>Auth::user()->id])->first();
        $google2fa = app('pragmarx.google2fa');
        $secret = $request->verify_code;
        
        $valid = $google2fa->verifyKey($user->google2fa_secret, $secret);
      
        if($valid){
            $userdetails->two_step_verification = 1;
            $userdetails->save();
            Common::one_time_message('success','Your action has been successfully executed!');
            return redirect('merchants/settings/security');
        }else{
            Common::one_time_message('danger','Your action Not successfully executed!');
            return redirect('merchants/settings/security'); 
        }
    }
    
}
