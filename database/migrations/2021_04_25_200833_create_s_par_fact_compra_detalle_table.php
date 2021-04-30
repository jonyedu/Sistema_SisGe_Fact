<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSParFactCompraDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('s_par_fact_compra_detalle')) {
            Schema::create('s_par_fact_compra_detalle', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('id_facturac');
                $table->unsignedInteger('id_prod');
                $table->decimal('costo', 18, 4);
                $table->decimal('costimp', 18, 4);
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_par_fact_compra_detalle');
    }
}
