<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTosParFactVentasCabecera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('s_par_fact_ventas_cabecera')) {
            Schema::create('s_par_fact_ventas_cabecera', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('id_cliente');
                $table->string('secuencia');
                $table->string('no_autorizacion');
                $table->datetime('fecha');
                $table->unsignedInteger('viva');
                $table->decimal('subtotaliva1', 18, 2);
                $table->unsignedInteger('iva');
                $table->decimal('subtotaliva2', 18, 2);
                $table->decimal('totalapagar', 18, 2);
                $table->unsignedInteger('tipopago');
                $table->unsignedInteger('formapago');
                $table->unsignedInteger('caj');
                $table->decimal('cambio', 18, 2);
                $table->decimal('recibido', 18, 2);
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
        //
        Schema::table('s_par_fact_ventas_cabecera', function (Blueprint $table) {
            //
        });
    }
}
