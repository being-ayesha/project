<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_buttons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('invoice_id');
            $table->string('username');
            $table->integer('price')->nullable();
            $table->string('browser_redirect_url')->nullable()->comment('The URL to redirect the buyer to after payment.');
            $table->string('ipn_redirect_url')->nullable()->comment('The URL to send purchase notifications to. Learn more here.');
            $table->enum('buyer_shipping',['Yes','No'])->default('No');
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
        Schema::dropIfExists('payment_buttons');
    }
}
