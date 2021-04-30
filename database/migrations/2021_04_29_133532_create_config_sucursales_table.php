<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('config_sucursales')) {
            Schema::create('config_sucursales', function (Blueprint $table) {
                $table->bigIncrements('Sucursal_Id');
                $table->unsignedInteger('Empresa_Id');
                $table->string('Sucursal_Nombre');
                $table->string('Sucursal_Direccion');
                $table->string('Sucursal_Telefonos');
                $table->string('Sucursal_Administrador')->nullable();
                $table->string('Sucursal_EMail')->nullable();
                $table->string('Sucursal_Fax')->nullable();
                $table->string('Sucursal_Actividad')->nullable();
                $table->dateTime('Sucursal_Actividad_Inicio')->nullable();
                $table->unsignedInteger('Sucursal_Matriz')->nullable();
                $table->string('Sucursal_Provincia')->nullable();
                $table->string('Sucursal_Canton')->nullable();
                $table->string('Sucursal_Parroquia')->nullable();
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
        Schema::dropIfExists('config_sucursales');
    }
}
