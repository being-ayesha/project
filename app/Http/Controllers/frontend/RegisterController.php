<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use App\models\frontend\UserDetail;
use App\models\frontend\Merchant;
use App\models\frontend\sellers\Seller;
use Common;
use Validator;
use Hash;
class RegisterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if(!$_POST){
            $opts['siteName']  = getenv('APP_NAME');
            $opts['pageTitle'] = 'Register a new member';
            return view('frontend.register',$opts);
        }else{
            $rules = array(
                'username' => 'required|unique:users,username',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|same:conf_password',
            );
            $niceNames = array(
                'username' => 'Username',
                'email'    => 'Email',
                'password' => 'Password',
                'conf_password' => 'Confirm password'
            );

            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
                //Create users
                $users           = new User();
                $users->username = $request->username;
                $users->email    = $request->email;
                $users->password = Hash::make($request->password);
                $users->save();
                //Create merchant type user details
                $userDetails            = new UserDetail();
                $userDetails->user_id   = $users->id;
                $userDetails->user_type = 'merchant';
                $userDetails->save();
                //Create seller type user details
                $userDetails            = new UserDetail();
                $userDetails->user_id   = $users->id;
                $userDetails->user_type = 'seller';
                $userDetails->save();
                //Create Merchants
                $merchants                = new Merchant();
                $merchants->user_id       = $users->id;
                $merchants->merchant_uuid = Common::unique_code();
                $merchants->save();
                //Create Sellers
                $sellers                   = new Seller();
                $sellers->user_id          = $users->id;
                $sellers->seller_uuid      = Common::unique_code();
                $sellers->save();
                Common::one_time_message('success', 'Registration Successful!');
                return redirect('/');
            }
        } 
    }
}
