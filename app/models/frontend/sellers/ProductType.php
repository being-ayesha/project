<?php

namespace App\models\frontend\sellers;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';

    public function product(){
    	return $this->hasOne(Product::class);
    }
}
