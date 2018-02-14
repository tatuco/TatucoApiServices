<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->unique()->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->boolean('enable')->default(true);
            $table->boolean('disable')->default(false);
            $table->decimal('total');
            $table->integer('tax')->nullable();
            $table->foreign('tax')->references('id')->on('tax')->onUpdate('cascade');
            $table->integer('operation_type')->nullable();
            $table->foreign('operation_type')->references('id')->on('operation_type')->onUpdate('cascade');
            $table->integer('client')->nullable();
            $table->foreign('client')->references('id')->on('client')->onUpdate('cascade');
            $table->integer('employee')->nullable();
            $table->foreign('employee')->references('id')->on('employee')->onUpdate('cascade');
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
        Schema::dropIfExists('operation');
    }
}
