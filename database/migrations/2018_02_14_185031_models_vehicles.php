<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelsVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models_vehicles', function (Blueprint $table) {
            $table->increments('mod_id');
            $table->integer('bra_id')->unsigned()->index();
            $table->string('use_nic', 15)->unsigned()->index();
            $table->timestamps();
            $table->string('mod_des', 250);
            $table->boolean('mod_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('bra_id')->references('bra_id')->on('brands_vehicles')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('models_vehicles');
    }
}
