<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Assignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('ass_id');
            $table->string('use_nic', 15)->unsigned()->index();
            $table->string('dri_dni', 15)->unsigned()->index();
            $table->string('veh_pla', 15)->unsigned()->index();
            $table->timestamps();
            $table->string('ass_des', 250)->nullable();
            $table->boolean('ass_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('dri_dni')->references('dri_dni')->on('drivers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('veh_pla')->references('veh_pla')->on('vehicles')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('assignments');
    }
}
