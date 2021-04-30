<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSParProductoInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('s_par_producto_inventario')) {
            Schema::create('s_par_producto_inventario', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('id_factura');
                $table->unsignedInteger('id_producto');
                $table->unsignedInteger('stock');
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
        Schema::dropIfExists('s_par_producto_inventario');
    }
}
