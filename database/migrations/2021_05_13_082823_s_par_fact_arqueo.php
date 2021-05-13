<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SParFactArqueo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s_par_fact_arqueo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_arqueo');
            $table->decimal('valor', 18, 2);
            $table->unsignedInteger('cantidad');
            $table->decimal('total', 18, 2);
             
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
