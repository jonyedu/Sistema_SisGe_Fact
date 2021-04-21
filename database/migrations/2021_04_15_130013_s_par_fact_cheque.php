<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SParFactCheque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s_par_fact_cheque', function (Blueprint $table) {
            $table->bigIncrements('cheque_id');
            $table->integer('id_facturav');
            $table->date('fecha_emision');
            $table->double('cantidad',5,3);
            $table->string('nombre');
            $table->integer('banco');
            $table->string('numero_cuenta'); 
            $table->string('beneficiario');
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
