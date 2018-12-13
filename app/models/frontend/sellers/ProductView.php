<?php

namespace App\models\frontend\sellers;

use Illuminate\Database\Eloquent\Model;
use Auth;
class ProductView extends Model
{
    protected $table="product_views";


    public function totalviews(){
    	return count($this->where('seller_id',Auth::user()->id)->get());
    }

    public function dailyViews(){
    	return count($this->where('seller_id',Auth::user()->id)->whereBetween('product_views_date',array(date('Y-m-d',strtotime('-1 Days')), date('Y-m-d')))->get());
    }

    public function weeklyViews(){
        return count($this->where('seller_id',Auth::user()->id)->whereBetween('product_views_date',array(date('Y-m-d',strtotime('-1 week')), date('Y-m-d')))->get());
    }
}
