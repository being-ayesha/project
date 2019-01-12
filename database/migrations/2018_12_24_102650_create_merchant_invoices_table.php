<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_uid')->unique()->nullable()->comment('Unique for each Invoice');
            $table->integer('merchant_id')->unsigned()->index();
            $table->foreign('merchant_id')->references('id')->on('users');
            $table->integer('payment_method_id')->unsigned()->index();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->text('currency')->nullable();
            $table->string('amount')->nullable();
            $table->string('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('paid_amount')->nullable();
            $table->text('invoice_status')->nullable();
            $table->string('buyer_email')->nullable();
            $table->text('notes')->nullable();
            $table->text('browser_redirect')->nullable()->comment('The URL to redirect Merchant Pages.');
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
        Schema::dropIfExists('merchant_invoices');
    }
}
