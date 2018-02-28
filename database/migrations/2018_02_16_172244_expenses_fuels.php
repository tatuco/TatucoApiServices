<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpensesFuels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_fuels', function (Blueprint $table) {
            $table->increments('exp_id');
            $table->timestamps();
            $table->decimal('exp_amt', 10, 4)->nullable();
            $table->string('use_nic', 15)->unsigned()->index();
            $table->integer('ass_id')->unsigned()->index();
            //$table->string('dri_dni', 15)->unsigned()->index();
            //$table->string('veh_pla', 15)->unsigned()->index();
            $table->integer('sts_id')->unsigned()->index();
            $table->boolean('exp_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('use_nic')->references('use_nic')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ass_id')->references('ass_id')->on('assignments')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('dri_dni')->references('dri_dni')->on('drivers')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('veh_pla')->references('veh_pla')->on('vehicles')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('expenses_fuels');
    }
}
