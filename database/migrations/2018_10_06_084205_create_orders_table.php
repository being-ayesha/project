<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('order_uuid')->unique()->index();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_country')->nullable();
            $table->string('buyer_ip')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_activate_date')->nullable();
            $table->string('http_referer')->nullable();
            $table->decimal('amount')->nullable();
            $table->integer('payment_method_id')->unsigned()->index();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->integer('product_quantity')->nullable();
            $table->enum('payment_status',['unpaid','paid'])->nullable();
            $table->enum('delivery_status',['Yes','No'])->nullable();
            $table->dateTime('order_date')->nullable();
            $table->integer('affiliate_user_id')->unsigned()->index()->nullable();
            $table->foreign('affiliate_user_id')->references('id')->on('users');
            $table->enum('is_affiliated',['Yes','No'])->default('No');
            $table->text('affiliate_amount')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
