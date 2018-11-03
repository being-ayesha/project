<?php

namespace App\models\frontend\sellers;
use App\models\frontend\sellers\Product;
use Illuminate\Database\Eloquent\Model;

class ProductSocialOption extends Model
{
    protected $table = 'product_social_options';

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
