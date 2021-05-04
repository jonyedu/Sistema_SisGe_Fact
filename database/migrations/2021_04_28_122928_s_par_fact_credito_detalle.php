<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SParFactCreditoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s_par_fact_credito_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_factura');
            $table->date('fecha');
            $table->double('interes',5,3);
            $table->double('total',5,3);
            $table->double('valor',5,3);
           
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
