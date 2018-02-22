<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('veh_pla', 15)->primary();
            //$table->integer('veh_sta')->unsigned()->index(); estatus del vehiculo
            $table->timestamps();
            $table->string('use_nic', 15)->unsigned()->index();
            $table->integer('tve_id')->unsigned()->index();
            $table->integer('fle_id')->unsigned()->index();
            $table->integer('mod_id')->unsigned()->index();
            $table->integer('sta_id')->unsigned()->index();
            $table->boolean('veh_ass')->default(false);
            $table->boolean('veh_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();


            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tve_id')->references('tve_id')->on('type_vehicles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('fle_id')->references('fle_id')->on('fleets')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('mod_id')->references('mod_id')->on('models_vehicles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sta_id')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('acc_id')->references('acc_id')->on('accounts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
