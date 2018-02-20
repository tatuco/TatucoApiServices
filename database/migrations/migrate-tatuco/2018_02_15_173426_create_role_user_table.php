<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('rus_id');
            $table->integer('rus_rol_fk')->unsigned()->index();
            $table->string('rus_use_fk', 15)->unsigned()->index();
            $table->integer('rus_sta_fk')->unsigned()->index();

            //fk
            $table->foreign('rus_rol_fk')->references('rol_id')->on('roles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('rus_use_fk')->references('use_dni')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('rus_sta_fk')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
    }
}
