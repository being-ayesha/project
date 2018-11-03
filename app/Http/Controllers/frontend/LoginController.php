<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use Auth;
use Validator;
use Common;
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
            $credentails             = [];
            $credentails['email']    = $request->email;
            $credentails['password'] = $request->password;
            if(@$user->status!='Inactive'){
                if(Auth::attempt($credentails)){
                    return redirect('dashboard');
                }else{
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
