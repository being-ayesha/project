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
use App\models\frontend\UserDetail;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Password;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $opts['siteName']  = getenv('APP_NAME');
        $opts['pageTitle'] = 'Login';
        
        if($request->token){
            $user = User::where(['remember_token' => $request->token])->first();
            if(@Auth::loginUsingId($user->id)){
                   return redirect('dashboard'); 
               }
           }
        return view('frontend.login',$opts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $country_name       = Session::get('country_name');

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
            $user = User::where(['email' => $request->email])->first();
            if($user){
                 $credentails             = [];
            $credentails['email']    = $request->email;
            $credentails['password'] = $request->password;
            if(@$user->status!='Inactive'){
               
                $userdetails = UserDetail::where(['user_id'=>@$user->id])->first();

                if(@$userdetails->email_verification==1){

                    $user->remember_token = $token = Password::getRepository()->createNewToken();
                    $user->save();
                    $responseData['email']    =  $user->email;
                    $responseData['userName'] =  $user->username;
                    $responseData['token']    =  url('login').'/'.$token;
                    EmailController::emailTwoFactor($responseData);
                    Common::one_time_message('danger','Please Check Your Email For Two Factor Authentication.');
                    return back()->withInput(); 
                     
                }else{

                    $userlogs                       = new UserLogs();
                    $userlogs->user_id              = $user->id; 
                    $userlogs->last_login_ip        = $request->ip();
                    $userlogs->last_login_browser   = $request->header('User-Agent');
                    $userlogs->last_login_country   = $country_name['geoplugin_city']." - ".$country_name['geoplugin_region']." - ".$country_name['geoplugin_countryName'];
                    $userlogs->last_login_at        = date('Y-m-d H:i:s');
                    
                    if(Auth::attempt($credentails)){ 

                        if($userdetails->two_step_verification == 1){
                            return back();
                        }  

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
                }
            }else{
                Common::one_time_message('danger','Account is not active!');
                return back()->withInput();

            }

            }else{
                Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password !');
                return back()->withInput();

            }
        }
    }

    public function dashboard(){
        $opts['siteName']  = getenv('APP_NAME');
        $opts['pageTitle'] = 'Home';
        return view('frontend.dashboard',$opts);
    }
}
