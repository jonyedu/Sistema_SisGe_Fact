<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParLaboratorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('par_laboratorio')) {
            Schema::create('par_laboratorio', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('nombre');
                $table->string('apellido');
                $table->string('cedula');
                $table->string('representante');
                $table->string('direccion');
                $table->string('telefono');
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
        Schema::dropIfExists('par_laboratorio');
    }
}
