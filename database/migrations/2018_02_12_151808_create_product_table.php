<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->unique();
            $table->string('title');
            $table->text('image')->nullable();
            $table->decimal('price');
            $table->string('description')->nullable();
            $table->boolean('enable')->default(true);
            $table->boolean('disable')->default(false);
            $table->integer('product_type')->nullable();
            $table->foreign('product_type')->references('id')->on('product_type')->onUpdate('cascade');
            $table->integer('brand')->nullable();
            $table->foreign('brand')->references('id')->on('brand')->onUpdate('cascade');
            $table->integer('category')->nullable();
            $table->foreign('category')->references('id')->on('category')->onUpdate('cascade');
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
        Schema::dropIfExists('product');
    }
}
