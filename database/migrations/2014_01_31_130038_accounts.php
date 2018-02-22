<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Accounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('acc_id');
            $table->string('acc_enc', 255);
            $table->timestamps();
            $table->string('acc_des', 255);
            $table->string('acc_dir', 255);
            $table->string('acc_mai', 255);
            $table->text('acc_ima');
            $table->string('acc_nom', 255);
            $table->string('acc_ruc', 255);
            $table->string('acc_pho', 50);
            $table->string('acc_web', 50);
            $table->boolean('acc_act')->default(true);

            //fk
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
