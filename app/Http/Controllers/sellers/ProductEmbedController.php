<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Product;
use App\models\frontend\Currency;
use Auth;
class ProductEmbedController extends Controller
{
    public function index(Request $request){
    	    $opts['siteName']  = getenv('APP_NAME');
    		$opts['pageTitle'] = 'Embed Generator';
    		$opts['products']  = Product::where(['seller_id' => Auth::user()->id])->get();
    		$opts['currency'] = Currency::currencyCode();
    		return view('frontend.sellers.pages.productembeds.add',$opts);
    }
}
