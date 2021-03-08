<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSParProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('s_par_producto', function (Blueprint $table) {
            /* Datos para auditoria */
            $table->string('usu_created_update');
            $table->timestamps();
            $table->string('pcip');
            $table->unsignedInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('s_par_producto', function (Blueprint $table) {
            //
        });
    }
}
