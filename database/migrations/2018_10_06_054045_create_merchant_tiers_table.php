<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantTiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_tiers', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('tier_name')->nullable();
            $table->integer('daily_processing_time')->nullable();
            $table->integer('annual_processing_time')->nullable();
            $table->enum('tier_verfication',['Yes','No'])->default('No');
            $table->string('tier_documentation')->nullable();
            $table->string('tier_ein')->nullable();
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
        Schema::dropIfExists('merchant_tiers');
    }
}
