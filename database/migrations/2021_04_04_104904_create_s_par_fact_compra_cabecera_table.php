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
                $table->string('secuencia');
                $table->string('no_autorizacion');
                $table->unsignedInteger('id_proveedor');
                $table->date('fecha_compra');
                $table->decimal('sub_total_0', 18, 2);
                $table->decimal('sub_total_12', 18, 2);
                $table->decimal('totalapagar', 18, 2);
                $table->unsignedInteger('id_pago');
                $table->decimal('p_inicial', 18, 2);
                $table->string('observacion');
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
