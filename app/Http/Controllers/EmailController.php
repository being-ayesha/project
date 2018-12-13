<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Mail;

class EmailController extends Controller
{
	public static function sendBuyersEmail($email=[],$all=[]){

		foreach ($email as  $email) {

			$data = [];
			$data  = array(
				'email' 		=> $email,
				'message' 	    => $all->message,
				'subject'		=> $all->subject,
				'from'			=> $all->from,
			);
			@Mail::send('frontend.sellers.pages.email.buyer',["data1"=>$data],function($message) use($data) {
				$message->to($data['email'], $data['message'])->subject($data['subject']);
			});
		}
	}


	public static function feedback($order,$response){
		$data = [];
			$data  = array(
				'email' 		=> $order->buyer_email,
				'message' 	    => $response,
				'subject'		=> "Review Feedback",
			);
			@Mail::send('frontend.sellers.pages.email.feedback',["data1"=>$data],function($message) use($data) {
				$message->to($data['email'], $data['message'])->subject($data['subject']);
			});
		}
}
