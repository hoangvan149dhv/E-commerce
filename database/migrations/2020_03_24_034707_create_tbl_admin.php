<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAdmin extends Migration
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_admin');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->increments('admin_Id');
            $table->string('admin_email',100);
            $table->string('user_name',100);
            $table->string('admin_pass',100);
            $table->string('admin_name',100);
            $table->string('admin_question_getpass',100);
            $table->string('pass',50);
        });
    }


}
