<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegOpcionAplicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('seg_opcion_aplicacion')) {
            Schema::create('seg_opcion_aplicacion', function (Blueprint $table) {
                $table->bigIncrements('codigo');
                $table->unsignedInteger('modulo');
                $table->string('descripcion');
                $table->string('imagen');
                $table->string('route');
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
        Schema::dropIfExists('seg_opcion_aplicacion');
    }
}
