<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('rol_id');
            $table->string('rol_nam', 130)->unique();
            $table->string('rol_slu', 130)->unique();
            $table->text('rol_des')->nullable();
            $table->integer('rol_sta_fk')->unsigned()->index();

            //fk
            $table->foreign('rol_sta_fk')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
