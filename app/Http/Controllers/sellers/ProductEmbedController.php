<?php

namespace App\Http\Controllers\sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\frontend\sellers\Product;
use Auth;
class ProductEmbedController extends Controller
{
    public function index(Request $request){
    	    $opts['siteName']  = 'Rocketr';
    		$opts['pageTitle'] = 'Embed Generator';
    		$opts['products']  = Product::where(['seller_id' => Auth::user()->id])->get();
    		return view('frontend.sellers.pages.productembeds.add',$opts);
    }
}
