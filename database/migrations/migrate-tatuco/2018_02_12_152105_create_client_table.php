<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->char('code')->unique()->nullable();
                $table->string('title');
                $table->text('image')->nullable();
                $table->string('description')->nullable();
                $table->boolean('enable')->default(true);
                $table->boolean('disable')->default(false);
                $table->integer('client_type')->nullable();
                $table->foreign('client_type')->references('id')->on('client_type');
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
        Schema::dropIfExists('client');
    }
}
