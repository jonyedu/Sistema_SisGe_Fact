<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTipoDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('config_tipo_documento')) {
            Schema::create('config_tipo_documento', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('descripcion');
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
        Schema::dropIfExists('config_tipo_documento');
    }
}
