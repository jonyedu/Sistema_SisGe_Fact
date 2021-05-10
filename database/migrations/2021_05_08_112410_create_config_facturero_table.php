<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigFactureroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('config_facturero')) {
            Schema::create('config_facturero', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('no_establecimiento');
                $table->string('no_facturero');
                $table->unsignedInteger('secuencia');
                $table->string('no_autorizacion');
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
        Schema::dropIfExists('config_facturero');
    }
}
