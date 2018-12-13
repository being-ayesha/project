<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->index()->nullable()->comment('Account id is user id which can be seller or merchant');
            $table->string('name')->nullable();
            $table->longText('value')->nullable();
            $table->string('type',60)->nullable();
            $table->string('account',100)->nullable()->index()->comment('Account is user which can be seller or merchants');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_settings');
    }
}
