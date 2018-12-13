<?php

namespace App\models\frontend;

use Illuminate\Database\Eloquent\Model;
use App\models\frontend\sellers\Order;
class ProductReview extends Model
{
    protected $table="product_reviews";

    // Get order Details
    public function orderDetails(){
    	return $this->belongsTo(Order::class,'order_id');
    }
}
