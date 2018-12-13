<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\models\frontend\sellers\EmailCampaign;
Use App\models\frontend\sellers\Order;
use App\Http\Controllers\EmailController;
class CronController extends Controller
{

	public function newMarketingEmail(){

		ini_set('max_execution_time', 280);

		$emailCampaign = EmailCampaign::where('sent_status','pending')->get();
		
		foreach ($emailCampaign as $key => $value) {
			
			$recipient =json_decode($value->recipients);
			$match            			    = ['campaign_id' => $value->campaign_id];
			$emailCampaigning 				= EmailCampaign::firstOrNew($match);
			$emailCampaigning->sent_status  = 'success';
			$emailCampaigning->save();
			
			if(count($recipient)>1){
				
				$sellers = Order::where('seller_id', $value->seller_id)->select('buyer_email')->distinct()->pluck('buyer_email');
				EmailController::sendBuyersEmail($sellers,$value);
			}else{
				foreach ($recipient as $key => $recipientvalue) {
					if($recipientvalue==1){
						$sellers = Order::where(['seller_id'=> $value->seller_id,'payment_status' => 'paid'])->select('buyer_email')->distinct()->pluck('buyer_email');
						EmailController::sendBuyersEmail($sellers,$value);

					}else{
						$sellers = Order::where(['seller_id'=> $value->seller_id,'payment_status' => 'unpaid'])->select('buyer_email')->distinct()->pluck('buyer_email');
						EmailController::sendBuyersEmail($sellers,$value);
					}					
				}
			}
			
	
		}

	}

}
