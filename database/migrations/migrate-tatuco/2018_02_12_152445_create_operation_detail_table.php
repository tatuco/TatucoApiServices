<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enable')->default(true);
            $table->boolean('disable')->default(false);
            $table->integer('operation');
            $table->foreign('operation')->references('id')->on('operation')->onUpdate('cascade');
            $table->integer('product');
            $table->foreign('product')->references('id')->on('product')->onUpdate('cascade');
            $table->integer('quantity');
            $table->decimal('price');
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
        Schema::dropIfExists('operation_detail');
    }
}
