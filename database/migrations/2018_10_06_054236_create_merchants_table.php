<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('merchant_tier_id')->unsigned()->index()->nullable();
            $table->foreign('merchant_tier_id')->references('id')->on('merchant_tiers');
            $table->string('merchant_uuid')->unique()->comment('Unique id for each merchant')->nullable()->index();
            $table->string('first_name',30)->nullable();
            $table->string('last_name',30)->nullable();
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('city',25)->nullable();
            $table->string('state',25)->nullable();
            $table->string('postal_code',20)->nullable();
            $table->string('country',20)->nullable();
            $table->string('business_name',150)->nullable();
            $table->text('business_description')->nullable();
            $table->string('business_company')->nullable();
            $table->string('merchant_website')->nullable();
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
        Schema::dropIfExists('merchants');
    }
}
