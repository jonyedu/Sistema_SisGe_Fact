<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SParFactCredito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s_par_fact_credito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_factura');
            $table->double('total',5,3);
            $table->unsignedInteger('id_tiempo_pago');
            $table->unsignedInteger('id_cliente');
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
