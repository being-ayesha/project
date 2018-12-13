<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use App\models\frontend\UserLogs;
use Auth;
use Validator;
use Common;
use Session;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opts['siteName']  = 'Rockter';
        $opts['pageTitle'] = 'Login';
        return view('frontend.login',$opts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $country_name       =Session::get('country_name');

        $rules = [
                'email' => 'required',
                'password' => 'required'
        ];
        $niceNames = [
            'email' => 'Email',
            'password' => 'Password'
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->setAttributeNames($niceNames);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }else{
            $user                    = User::where(['email' => $request->email])->first();
            
            if($user){
                $userlogs                       = new UserLogs();
                $userlogs->user_id              = $user->id; 
                $userlogs->last_login_ip        = $request->ip();
                $userlogs->last_login_browser   = $request->header('User-Agent');
                $userlogs->last_login_country   = $country_name['geoplugin_city']." - ".$country_name['geoplugin_region']." - ".$country_name['geoplugin_countryName'];
                $userlogs->last_login_at        = date('Y-m-d H:i:s');
            }
            
            $credentails             = [];
            $credentails['email']    = $request->email;
            $credentails['password'] = $request->password;
            if(@$user->status!='Inactive'){
                if(Auth::attempt($credentails)){   

                    $userlogs->last_login_status    = "Success";
                    $userlogs->last_login_details   ="";
                    $userlogs->save(); 

                    return redirect('dashboard');
                }else{
                    if($user){
                        $userlogs->last_login_status    = "Wrong Password";
                        $userlogs->last_login_details   ="";
                        $userlogs->save();
                    }
                    Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password.');
                    return back()->withInput();
                }
            }else{
                Common::one_time_message('danger','Account is not active!');
                return back()->withInput();

            }
        }
    }

    public function dashboard(){
        $opts['siteName']  = 'Rockter';
        $opts['pageTitle'] = 'Home';
        return view('frontend.dashboard',$opts);
    }

}
