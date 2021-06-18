<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblsBrandcodeProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_brand_code_product', function (Blueprint $table) {
            $table->increments('code_id');
            $table->string('brandcode_id',70);
            $table->string('brandcode_name',70);
            $table->string('brand_meta_slug',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_brand_code_product');
    }
}
