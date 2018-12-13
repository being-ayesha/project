<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('user_id')->on('sellers');
            $table->string('product_ids')->index()->nullable();
            $table->string('payment_methods')->index()->nullable();
            $table->string('coupon_code')->unique()->nullable();
            $table->string('discount_structure')->nullable();
            $table->string('amount_off');
            $table->dateTime('start_date');
            $table->dateTime('expiry_date');
            $table->integer('stock')->comment('Uses Left');
            $table->integer('number_of_uses');
            $table->tinyInteger('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
