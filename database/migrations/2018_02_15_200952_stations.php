<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('sts_id');
            $table->string('sts_nam', 250);
            $table->integer('cit_id')->unsigned()->index();
            $table->string('sts_dir', 250);
            $table->integer('sts_qut');//cantidad sumada de los tanques asignados
            $table->string('sts_pho', 25);
            $table->string('sts_mai', 130);
            $table->timestamps();
            $table->string('use_nic', 15)->unsigned()->index();
            $table->boolean('sts_act')->default(true);
            $table->integer('acc_id')->unsigned()->unsigned()->index();

            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cit_id')->references('cit_id')->on('cities')->onUpdate('cascade')->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
