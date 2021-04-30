<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConfigEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('config_empresa')) {
            Schema::create('config_empresa', function (Blueprint $table) {
                $table->bigIncrements('Empresa_Id');
                $table->string('Empresa_Nombre');
                $table->string('Empresa_Ciudad')->nullable();
                $table->string('Empresa_Codigo_Postal');
                $table->string('Empresa_Correo_Electronico');
                $table->string('Empresa_Fax')->nullable();;
                $table->unsignedInteger('Empresa_Contribuyente_Especial');
                $table->string('Empresa_Representante');
                $table->string('Empresa_Notas')->nullable();
                $table->string('Empresa_Ruc');
                $table->string('Empresa_Telefonos');
                //$table->binary('Empresa_Ubicacion_Logo');
                $table->string('Empresa_Ruta_Base')->nullable();
                $table->string('Empresa_Direccion');
                $table->string('Empresa_Tipo')->nullable();
                $table->string('Empresa_Dsn_Bases')->nullable();
                $table->string('Empresa_Pais')->nullable();
                $table->string('Empresa_Moneda')->nullable();
                $table->string('Empresa_Contador')->nullable();
                $table->string('Empresa_Contador_Ruc')->nullable();
                $table->string('Empresa_Actividad')->nullable();
                $table->string('Empresa_Razon_Social')->nullable();
                $table->boolean('Empresa_Obligado_Contabilidad')->nullable();
                $table->string('Empresa_Representante_Id')->nullable();
                $table->string('Empresa_Representante_Id_Tipo')->nullable();
                $table->datetime('Empresa_Inicio_Actividades')->nullable();
                $table->datetime('Empresa_Constitucion')->nullable();
                $table->datetime('Empresa_Inscripcion')->nullable();
                $table->datetime('Empresa_Actualizacion')->nullable();
                $table->string('Empresa_Parroquia')->nullable();
                $table->string('Empresa_Provincia')->nullable();
                /* Datos para auditoria */
                $table->string('usu_created');
                $table->string('usu_update');
                $table->timestamps();
                $table->string('pcip');
                $table->unsignedInteger('status');
            });
            DB::statement("ALTER TABLE config_empresa ADD Empresa_Ubicacion_Logo LONGBLOB after Empresa_Ruta_Base");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_empresa');
    }
}
