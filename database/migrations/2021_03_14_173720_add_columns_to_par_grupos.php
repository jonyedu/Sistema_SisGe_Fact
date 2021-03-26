<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToParGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('par_grupos', function (Blueprint $table) {
            /* Datos para auditoria */
            $table->string('usu_created_update');
            $table->timestamps();
            $table->string('pcip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('par_grupos', function (Blueprint $table) {
            //
        });
    }
}
