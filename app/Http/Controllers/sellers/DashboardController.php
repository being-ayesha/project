<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\User;
use Auth;
use Validator;
use Common;
use App\DataTables\frontend\sellers\LastOrderListDataTable;
use App\models\frontend\UserLogs;
use Session;
use App\models\frontend\sellers\ProductView;
use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\PaymentSetting;
use App\models\frontend\Currency;
use App\models\frontend\UserDetail;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Password;
use Google2FA;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LastOrderListDataTable $dataTable)
    {
        
       $data['siteName']    = getenv('APP_NAME');
       $data['pageTitle']   = 'Home';
       $data['productView'] = ProductView::find(1);
       $data['order']       = $order =  Order::find(1);
       $data['currency']    = Currency::currencySymbol();
       $product_result      = ProductView::where('seller_id',Auth::user()->id)->whereBetween('product_views_date',array(date('Y-m-d',strtotime('-1 week')), date('Y-m-d')))->get();
       if(!empty(count($product_result))){
        $get_all_product   = [];
        $get_all_key       = [];
        $get_all_key_value = [];
        $get_single_date   = [];

        foreach ($product_result as $key => $product_details) {
            array_push($get_all_product, $product_details->product_views_date);
        }

        $result=array_count_values($get_all_product);

        foreach ($result as $key => $value) {
            array_push($get_all_key,$key);
            array_push($get_all_key_value,$value);

        }   

        for ($i=0; $i <count($get_all_key) ; $i++) { 
            for ($j=$i; $j==$i ; $j++) { 
                $result_data=array($get_all_key[$i],$get_all_key_value[$j]);
                array_push($get_single_date,$result_data);
            }
        }

        $name =['Days','Total View'];
        array_unshift($get_single_date, $name);
        $data['viewcount']= json_encode($get_single_date);  

    }else{
        $data['result_product_message']="No data Found";
    }
       return $dataTable->render('frontend.sellers.pages.dashboard',$data);
    }

    /**
     *  Authenticatation to the system.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        Google2FA::logout();
        return redirect('seller/login');
    }

    /**
     * Authenticatation to the system.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       if(!$_POST){
           $data['siteName']  = getenv('APP_NAME');
           $data['pageTitle'] = 'Seller Login';

           if($request->token){
            $user                    = User::where(['remember_token' => $request->token])->first();
            if(@Auth::loginUsingId($user->id)){
             return redirect('seller/dashboard'); 
                }
             }
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
                $user  = User::where(['email' => $request->email])->first();
                if($user){
                    $credentails             = [];
                $credentails['email']    = $request->email;
                $credentails['password'] = $request->password;
                if(@$user->status!='Inactive'){

                    $userdetails = UserDetail::where(['user_id'=>@$user->id])->first();
                    if(@$userdetails->email_verification == 1){
                        $user->remember_token = $token = Password::getRepository()->createNewToken();
                        $user->save();
                        $responseData['email']    =  $user->email;
                        $responseData['userName'] =  $user->username;
                        $responseData['token']    =  url('seller/login').'/'.$token;
                        EmailController::emailTwoFactor($responseData);
                        Common::one_time_message('danger','Please Check Your Email For Two Factor Authentication.');
                        return back()->withInput();
                    }else{
                        $country_name            = Session::get('country_name');

                        $userlogs                       = new UserLogs();
                        $userlogs->user_id              = $user->id; 
                        $userlogs->last_login_ip        = \Request::ip();
                        $userlogs->last_login_browser   = \Request::header('User-Agent');
                        $userlogs->last_login_country   = $country_name['geoplugin_city']." - ".$country_name['geoplugin_region']." - ".$country_name['geoplugin_countryName'];
                        $userlogs->last_login_at        = date('Y-m-d H:i:s');

                        if(Auth::attempt($credentails)){
                            $userlogs->last_login_status    = "Success";
                            $userlogs->last_login_details   = "";
                            $userlogs->save();
                            return redirect('seller/dashboard');
                        }else{
                            
                            $userlogs->last_login_status    = "Wrong Password";
                            $userlogs->last_login_details   ="";
                            $userlogs->save();

                        Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password.');
                        return back()->withInput();
                    } 
                }
                    
                }else{
                    Common::one_time_message('danger','Account is not active!');
                    return back()->withInput();
                }

                }else{
                    Common::one_time_message('danger','Log In Failed. Please Check Your Email/Password.!');
                    return back()->withInput();
                }
            }
       } 
    }
}
