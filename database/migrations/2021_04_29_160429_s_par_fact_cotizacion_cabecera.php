<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SParFactCotizacionCabecera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s_par_fact_cotizacion_cabecera', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_cliente');
            $table->date('fecha');
            $table->unsignedInteger('viva');
            $table->decimal('subtotaliva1');
            $table->decimal('iva');
            $table->decimal('subtotaliva2');
            $table->decimal('totalapagar');

            $table->unsignedInteger('tipopago');
            $table->unsignedInteger('formapago');
            $table->unsignedInteger('caj');

            $table->decimal('cambio');
            $table->decimal('recibido');
            $table->unsignedInteger('status');



 
            /* Datos para auditoria */
            $table->string('usu_created');
            $table->string('usu_update');
            $table->timestamps();
            $table->string('pcip');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
