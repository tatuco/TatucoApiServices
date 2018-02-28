<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('cit_id');
            $table->string('use_nic', 15)->unsigned()->index();
            //$table->integer('cit_cou_fk')->unsigned()->index(); id del pais
            $table->string('cit_des', 150);
            $table->boolean('cit_act')->default(true);


            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('cit_cou_fk')->references('cit_id')->on('countries')->onUpdate('cascade')->onDelete('restrict'); llave foranea a countries
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
