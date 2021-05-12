<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('par_cliente')) {
            Schema::create('par_cliente', function (Blueprint $table) {
                $table->bigIncrements('cliente_id');
                $table->string('nombres');
                $table->string('apellidos');
                $table->string('ruc')->nullable();
                $table->string('cedula');
                $table->string('razon_social')->nullable();
                $table->string('telefono');
                $table->string('direccion');
                $table->string('correo');
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
        Schema::dropIfExists('par_cliente');
    }
}
