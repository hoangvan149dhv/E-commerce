<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_news', function (Blueprint $table) {
            $table->bigIncrements('news_id');
            $table->string('news_title',255);
            $table->text('news_desc');
            $table->string('news_image');
            $table->text('news_content');
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_news');
    }
}
