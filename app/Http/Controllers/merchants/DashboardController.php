<?php

namespace App\Http\Controllers\merchants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use App\models\frontend\Currency;
use Validator;
use Auth;
use Common;
use App\models\frontend\UserDetail;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Password;
use Google2FA;
use App\models\frontend\merchants\MerchantOrder;
use App\models\frontend\Merchant;
use App\models\frontend\sellers\PaymentSetting;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['siteName']  = getenv('APP_NAME');
        $data['pageTitle'] = 'Merchants Home';
        $data['currency']  = Currency::currencySymbol();
        $data['order']     = $order = MerchantOrder::find(1);
        $merchant_user     = Merchant::where('user_id',Auth::user()->id)->select('first_name')->first();
        $data['paymentSetting'] = PaymentSetting::where(['account_id'=>Auth::user()->id,'type'=>'paypal','account' => 'merchants'])->count();
        $user_details       = UserDetail::where(['user_id'=>Auth::user()->id])->first();
        
        if($merchant_user->first_name!=''){
            $data['profile']="1";
        }else{
            $data['profile']="0";
        }
        if($user_details->email_verification==1 || $user_details->two_step_verification){
            $data['user_details']="1";
        }else{
            $data['user_details']="0";
        }
        return view('frontend.merchants.pages.dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function login(Request $request){

        if(!$_POST){
            
            $data['siteName']  = getenv('APP_NAME');
            $data['pageTitle'] = 'Merchants Login';
            if($request->token){
                $user                    = User::where(['remember_token' => $request->token])->first();
                if(@Auth::loginUsingId($user->id)){
                   return redirect('merchants/dashboard'); 
               }
           }
            return view("frontend.merchants.pages.login",$data);
        }

        else{
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
                        $responseData['token']    =  url('merchants/login').'/'.$token;
                        EmailController::emailTwoFactor($responseData);
                        Common::one_time_message('danger','Please Check Your Email For Two Factor Authentication.');
                        return back()->withInput();
                        
                    }else{
                        if(Auth::attempt($credentails)){
                            return redirect('merchants/dashboard');
                        }else{
                            Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password.');
                            return back()->withInput();
                        }
                    }
                    
                }else{
                    Common::one_time_message('danger','Account is not active!');
                    return back()->withInput();
                }

                }else{
                    Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password!');
                    return back()->withInput();
                }
            }

       }    
    }

    public function logout()
    {
        Auth::logout();
        Google2FA::logout();
        return redirect('merchants/login');
    }
}
