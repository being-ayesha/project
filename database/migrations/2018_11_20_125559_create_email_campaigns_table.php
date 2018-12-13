<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('user_id')->on('sellers');
            $table->string('campaign_id')->unique()->nullable()->index();
            $table->string('from')->nullable();
            $table->longText('recipients')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->enum('sent_status',['pending','success'])->default('pending');
            $table->timestamp('sent_on')->nullable();
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
        Schema::dropIfExists('email_campaigns');
    }
}
