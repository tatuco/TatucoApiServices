<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Providers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->string('pve_dni', 15)->primary();
            $table->string('pve_nam', 130);
            $table->string('pve_lna', 130);
            $table->string('pve_pho', 50);
            $table->string('pve_mai', 130)->nullable();
            $table->timestamps();
            $table->string('use_nic', 15)->unsigned()->index();
            $table->boolean('pve_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();


            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('providers');
    }
}
