<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('user_id')->on('sellers');
            $table->integer('product_type_id')->unsigned()->index();
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->string('product_uuid')->unique()->nullable()->comment('Unique for each product');
            $table->string('product_title')->unique();
            $table->text('product_description')->nullable();
            $table->string('product_photo')->nullable();
            $table->text('downloadable_file')->nullable()->comment('For only product type file');
            $table->integer('stock')->comment('-1 for unlimited');
            $table->enum('limit_downloads',['Yes','No'])->nullable()->comment('For only product type file');
            $table->enum('watermark_pdf_file',['Yes','No'])->nullable()->comment('For only product type file');
            $table->integer('price')->unsigned();
            $table->string('payment_method_id')->index();
            //$table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->integer('buyer_purchase_permission')->nullable()->comment('0 for all buyers can purchase,1 for buyers except my blacklist');
            $table->text('product_delivery_email_message')->nullable()->comment('Product delivery email information');
            $table->string('code_separator')->nullable()->comment('For only code/serial based products');
            $table->string('added_codes')->nullable()->comment('For only code/serial base products');
            $table->enum('codes_purchase_permission',['Yes','No'])->nullable()->comment('If yes then unlimited For only code/serial based products');
            $table->string('purchase_limit')->nullable()->comment('-1 for unlimited');
            $table->enum('affiliate_permission',['Yes','No'])->default('No');
            $table->decimal('affiliate_rate')->nullable()->comment('Rate in percentage (%)');
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
        Schema::dropIfExists('products');
    }
}
