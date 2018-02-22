<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TypeVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_vehicles', function (Blueprint $table) {
            $table->increments('tve_id');
            $table->string('tve_des', 250);
            $table->timestamps();
            $table->boolean('tve_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
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
        Schema::dropIfExists('type_vehicles');
    }
}
