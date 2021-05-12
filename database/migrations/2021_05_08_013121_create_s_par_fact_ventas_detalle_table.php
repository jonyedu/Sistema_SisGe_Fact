<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSParFactVentasDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('s_par_fact_ventas_detalle')) {
            Schema::create('s_par_fact_ventas_detalle', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('id_facturav');
                $table->unsignedInteger('id_producto');
                $table->unsignedInteger('iva');
                $table->unsignedInteger('factor');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_par_fact_ventas_detalle');
    }
}
