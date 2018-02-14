<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->integer('id')->primary()->index();
            $table->char('code')->unique()->nullable();
            $table->string('title');
            $table->text('image')->nullable();
            $table->string('description')->nullable();
            $table->boolean('enable')->default(true);
            $table->boolean('disable')->default(false);
            $table->integer('supplier_type')->nullable();
            $table->foreign('supplier_type')->references('id')->on('supplier_type')->onUpdate('cascade');
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
        Schema::dropIfExists('supplier');
    }
}
