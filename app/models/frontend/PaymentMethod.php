<?php

namespace App\models\frontend;
use App\models\frontend\sellers\Product;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    public function product(){
    	return $this->hasOne(Product::class);
    }
}
