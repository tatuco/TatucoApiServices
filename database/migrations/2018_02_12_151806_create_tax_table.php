<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->unique()->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->boolean('enable')->default(true);
            $table->boolean('disable')->default(false);
            $table->decimal('value');
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
        Schema::dropIfExists('tax');
    }
}
