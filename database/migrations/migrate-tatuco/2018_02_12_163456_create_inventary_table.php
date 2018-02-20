<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventary', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->unique()->nullable();
            $table->boolean('enable')->default(true);
            $table->boolean('disable')->default(false);
            $table->integer('product');
            $table->foreign('product')->references('id')->on('product')->onUpdate('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventary');
    }
}
