<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use Auth;
use Validator;
use Common;
use App\DataTables\frontend\sellers\LastOrderListDataTable;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LastOrderListDataTable $dataTable)
    {
       //echo "dddd";exit();
       $data['siteName']  = 'Rocketr';
       $data['pageTitle'] = 'Home';
       return $dataTable->render('frontend.sellers.pages.dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('seller/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       if(!$_POST){
           $data['siteName']  = 'Rocketr';
           $data['pageTitle'] = 'Seller Login';
           return view('frontend.sellers.pages.login',$data);
       }else{
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
                        return redirect('seller/dashboard');
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
    }
}
