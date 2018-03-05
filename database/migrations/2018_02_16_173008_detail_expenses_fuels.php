<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailExpensesFuels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_expenses_fuels', function (Blueprint $table) {
            $table->increments('dex_id');
            $table->integer('dex_qua');
            $table->decimal('dex_amu', 10, 4);
            $table->integer('exp_id')->unsigned()->index();
            $table->integer('fue_id')->unsigned()->index();
            $table->integer('tan_id')->unsigned()->index();
            $table->boolean('dex_act')->default(true);
            $table->integer('acc_id')->unsigned()->index();

            //fk
            $table->foreign('exp_id')->references('exp_id')->on('expenses_fuels')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('fue_id')->references('fue_id')->on('fuels')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tan_id')->references('tan_id')->on('tanks')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('detail_expenses_fuels');
    }
}
