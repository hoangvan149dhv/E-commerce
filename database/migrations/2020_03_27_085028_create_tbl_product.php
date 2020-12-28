<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('brandcode_id');
            $table->string('product_Name',255);
            $table->text('product_desc');
            $table->string('product_material');
            $table->integer('product_price');
            $table->integer('product_price_promotion');
            $table->integer('promotion_start_date')->default(0);
            $table->integer('promotion_end_date')->default(0);
            $table->string('product_image',255);
            $table->string('meta_keyword',255);
            $table->text('meta_desc');
            $table->text('meta_slug');
            $table->integer('publish')->default(0);
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_product');
    }
}
