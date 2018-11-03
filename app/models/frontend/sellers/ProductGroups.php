<?php

namespace App\models\frontend\sellers;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Common;
class ProductGroups extends Model
{
    protected $table = 'product_groups';
    /**
    * Get Product group products from product_groups table
    * @param $proudctGroupsTitle
    * @return $groupProducts
    */
    public function groupProducts($productGroupsTitle){
    	$groupProductArr         = $this->where(['seller_id' => Auth::user()->id,'product_group_title' => $productGroupsTitle])->select('product_id')->get();
    	$groupProductIds         = $groupProductArr[0]->product_id;
    	$individualGroupProducts = Product::whereIn('id',json_decode($groupProductIds))->select('product_title')->get()->toArray();
    	$separator               = $groupProducts = '';
		foreach ($individualGroupProducts as $individualGroupProduct){
		    $groupProducts .= $separator . $individualGroupProduct['product_title'];
		    $separator      = ',';
		}
		return $groupProducts;
    }
}
