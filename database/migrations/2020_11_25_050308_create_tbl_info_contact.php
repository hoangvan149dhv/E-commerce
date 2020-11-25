<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblInfoContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_info_contact', function (Blueprint $table) {
            $table->bigIncrements('id_Info');
            $table->text('google_map');
            $table->string('info_contact_add',100);
            $table->string('info_contact_phone',11);
            $table->string('info_contact_mail',100);
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
        Schema::dropIfExists('tbl_info_contact');
    }
}
