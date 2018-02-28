<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->string('dri_dni', 15)->primary();
            $table->string('dri_nam', 130);
            $table->string('dri_lna', 130)->nullable();
            $table->string('dri_lic', 130)->unique();
            $table->string('dri_pho', 50);
            $table->string('dri_mai', 130)->nullable();
            $table->timestamps();
            //$table->integer('dri_tdr_fk')->nullable(); conductor
            $table->string('use_nic', 15)->unsigned()->index();
            $table->integer('sta_id')->unsigned()->index();
            $table->boolean('dri_ass')->default(false);
            $table->boolean('dri_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sta_id')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('acc_id')->references('acc_id')->on('accounts')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('dri_tdr_fk')->references('tdr_id')->on('type_drivers'); llave foranea a la tabla tipo de conductor
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
