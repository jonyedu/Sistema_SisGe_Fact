<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegOpcionAplicacionPorPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('seg_opcion_aplicacion_por_perfil')) {
            Schema::create('seg_opcion_aplicacion_por_perfil', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('perfil');
                $table->unsignedInteger('modulo');
                $table->unsignedInteger('opcion_aplicacion');
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
        Schema::table('seg_opcion_aplicacion_por_perfil', function (Blueprint $table) {
            //
        });
    }
}
