<?php

namespace App\models\frontend\sellers;
use App\models\frontend\sellers\ProductType;
use App\models\frontend\sellers\ProductSocialOption;
use App\models\frontend\PaymentMethod;
use App\models\frontend\affiliates\AffiliateProduct;
use App\models\frontend\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function productType(){
    	return $this->belongsTo(ProductType::class);
    }

    public function paymentMethod(){
    	return $this->belongsTo(PaymentMethod::class);
    }

    public function productSocialOptions(){
    	return $this->hasMany(ProductSocialOption::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'seller_id');
    }

}
