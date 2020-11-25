<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->bigIncrements('orderid');
            $table->integer('cusid');
            $table->string('	cusname',70);
            $table->integer('product_id');
            $table->string('productname',100);
            $table->string('image',255);
            $table->integer('soluong');
            $table->integer('price');
            $table->integer('fee_ship');
            $table->integer('total');
            $table->string('	cusphone',11);
            $table->string('status',20);
            $table->text('note');
            $table->date('order_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_orders');
    }
}
