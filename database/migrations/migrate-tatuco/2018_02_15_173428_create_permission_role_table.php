<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->integer('pro_per_fk')->unsigned()->index();
            $table->integer('pro_rol_fk')->unsigned()->index();
            $table->integer('pro_sta_fk')->unsigned()->index();

            //fk
            $table->foreign('pro_per_fk')->references('per_id')->on('permissions')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pro_rol_fk')->references('rol_id')->on('roles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pro_sta_fk')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_role');
    }
}
