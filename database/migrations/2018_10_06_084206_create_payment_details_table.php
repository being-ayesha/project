<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('payment_method_id')->unsigned()->index();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->string('transaction_id')->unique()->comment('Generate unique id for each transaction');
            $table->enum('payment_status',['Paid','Unpaid'])->nullable();
            $table->string('payment_method_email')->nullable();
            $table->decimal('amount_paid')->nullable();
            $table->decimal('payment_method_fees')->nullable();
            $table->string('sender_name')->nullable();
            $table->text('sender_address')->nullable();
            $table->string('receiver_email')->nullable();
            $table->decimal('site_fee')->nullable();
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
        Schema::dropIfExists('payment_details');
    }
}
