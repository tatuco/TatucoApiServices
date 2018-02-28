<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncomeFuels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_fuels', function (Blueprint $table) {
            $table->increments('inc_id');
            $table->timestamps();
            $table->decimal('inc_amt', 10, 4);
            $table->string('use_nic', 15)->unsigned()->index();
            $table->string('pve_dni', 15)->unsigned()->index();
            $table->integer('sts_id')->unsigned()->index();
            $table->boolean('inc_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pve_dni')->references('pve_dni')->on('providers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sts_id')->references('sts_id')->on('stations')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('income_fuels');
    }
}
