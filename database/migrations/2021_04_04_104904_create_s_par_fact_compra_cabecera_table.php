<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSParFactCompraCabeceraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('s_par_fact_compra_cabecera')) {
            Schema::create('s_par_fact_compra_cabecera', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('id_documento');
                $table->unsignedInteger('secuencia');
                $table->string('id_proveedor');
                $table->date('fecha_compra');
                $table->decimal('totalapagar', 18, 2);
                $table->unsignedInteger('id_pago');
                $table->unsignedInteger('id_plazo');
                $table->decimal('p_inicial', 18, 2);
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
        Schema::dropIfExists('s_par_fact_compra_cabecera');
    }
}
