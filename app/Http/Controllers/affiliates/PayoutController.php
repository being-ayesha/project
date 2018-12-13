<?php

namespace App\Http\Controllers\affiliates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\affiliates\AffiliateProduct;
use App\DataTables\frontend\affiliates\PaymentLogsDataTable;
use Auth;
use Common;
class PayoutController extends Controller
{
    //Get Payouts details
	public function index(PaymentLogsDataTable $dataTables)
	{
		$opts['siteName']  = 'Rocketr';
    	$opts['pageTitle'] = 'Affiliate Payouts';
    	return $dataTables->render('frontend.affiliates.pages.payouts.list',$opts);
	}
}
