<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('par_grupos')) {
            Schema::create('par_grupos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('codigo');
                $table->string('descripcion');
                /* Datos para auditoria */
                $table->string('usu_created');
                $table->string('usu_update');
                $table->timestamps();
                $table->string('pcip');
                $table->unsignedInteger('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('par_grupos');
    }
}
