<?php

namespace App\models\frontend\sellers;

use Illuminate\Database\Eloquent\Model;
use App\models\frontend\PaymentMethod;
class Order extends Model
{
    protected $table = 'orders';

    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function payment(){
    	return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }
}
