<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('per_id');
            $table->string('per_nam', 130);
            $table->string('per_slu', 130)->unique();
            $table->text('per_des')->nullable();
            $table->integer('per_sta_fk')->unsigned()->index();

            //fk
            $table->foreign('per_sta_fk')->references('sta_id')->on('status')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions');
    }
}
