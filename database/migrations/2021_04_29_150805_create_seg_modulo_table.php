<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('seg_modulo')) {
            Schema::create('seg_modulo', function (Blueprint $table) {
                $table->bigIncrements('codigo');
                $table->unsignedInteger('empresa');
                $table->unsignedInteger('sucursal');
                $table->string('descripcion');
                $table->string('imagen');
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
        Schema::dropIfExists('seg_modulo');
    }
}
