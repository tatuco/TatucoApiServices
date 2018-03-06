<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fuels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->increments('fue_id');
            $table->string('fue_des', 250);
            $table->integer('fue_oct');
            $table->integer('fue_qua');//cantidad total de combustible
            $table->timestamps();
            $table->string('use_nic', 15)->unsigned()->index();
            $table->integer('tfu_id')->unsigned()->index();
            //$table->integer('ume_id')->unsigned()->index();
            $table->boolean('fue_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tfu_id')->references('tfu_id')->on('type_fuels')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('ume_id')->references('ume_id')->on('units_measure')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('fuels');
    }
}
