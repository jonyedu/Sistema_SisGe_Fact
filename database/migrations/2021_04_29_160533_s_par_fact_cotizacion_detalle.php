<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SParFactCotizacionDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s_par_fact_cotizacion_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_facturac');
            $table->unsignedInteger('id_producto'); 
            $table->decimal('iva');
            $table->unsignedInteger('factor');
            $table->decimal('valor');
            $table->unsignedInteger('cantidad');           
            $table->decimal('total');
            /* Datos para auditoria */
            $table->string('usu_created');
            $table->string('usu_update');
            $table->timestamps();
            $table->string('pcip');
            $table->unsignedInteger('status');

        
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
