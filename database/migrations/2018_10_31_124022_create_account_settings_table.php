<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->longText('seller_page_description')->nullable();
            $table->string('google_track_code')->nullable();
            $table->string('fb_track_code')->nullable();
            $table->tinyInteger('ipn_status')->nullable();
            $table->string('ipn_secret')->nullable();
            $table->tinyInteger('receive_email_product_sold')->nullable()->comment('Receive email when product is sold');
            $table->tinyInteger('receive_email_unsuccessfull_login')->nullable()->comment('Receive an e-mail when someone unsuccessfully attempts to login to your account');
            $table->tinyInteger('receive_email_site_tips_updates')->nullable()->comment('Receive an e-mail with Creationshop tips and update');
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
        Schema::dropIfExists('account_settings');
    }
}
