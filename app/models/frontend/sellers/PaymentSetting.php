<?php

namespace App\models\frontend\sellers;

use Illuminate\Database\Eloquent\Model;
use Auth;
class PaymentSetting extends Model
{
   protected $table = 'payment_settings';

   protected $fillable = [
   	'account_id', 'name', 'value','type','account'
   ];

}
