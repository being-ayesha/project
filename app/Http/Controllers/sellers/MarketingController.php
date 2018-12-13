<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use App\models\frontend\sellers\EmailCampaign;
use Common;
use Validator;
use App\DataTables\frontend\sellers\PreviousMarketingEmailDataTable;
class MarketingController extends Controller
{

	public function index(PreviousMarketingEmailDataTable $dataTable){

		$opts['siteName']  = 'Rocketr';
    	$opts['pageTitle'] = 'Sent Marketing';
    	return $dataTable->render('frontend.sellers.pages.marketing.previous',$opts);
    }



    public function newMarketing(Request $request){
    	if(!$_POST){
    		$opts['siteName']  = 'Rocketr';
    		$opts['pageTitle'] = 'New Marketing';
    		$opts['from'] = Auth::user()->username.'@seller'.'.'.preg_replace('#^http?://#','',url('/'));
    		return view('frontend.sellers.pages.marketing.new',$opts);
    	}else{

    		$rules=[
    			'buyers_email'	=>'required',
    			'subject'		=>'required',
    			'content'		=>'required',	
    		];

    		$niceNames=[
    			'buyers_email'=>'Buyer Email',
    			'subject'	 =>'Subject',
    			'content'	 =>'Message',
    		];

    		$validator=Validator::make($request->all(),$rules);
    		$validator->setAttributeNames($niceNames);

    		if($validator->fails()){
 				return back()->withErrors($validator)->withInput();
    		}
    		else{

    		$emailcampain 				= new EmailCampaign();
    		$emailcampain->seller_id	= Auth::user()->id;
    		$emailcampain->campaign_id  = Common::unique_code();
    		$emailcampain->from 		= $request->from;
    		$emailcampain->recipients   = json_encode($request->buyers_email);
    		$emailcampain->subject  	= $request->subject;
    		$emailcampain->message      = $request->content;
    		$emailcampain->sent_on      = date("Y-m-d H:i:s");
    		$emailcampain->save();

    		Common::one_time_message('success','Your action has been successfully executed!');
            return back();
    		}		
    	}	
    }

    
}
