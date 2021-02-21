<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('usuario');
            $table->string('password');
            $table->unsignedInteger('perfil');
            $table->unsignedInteger('profesion');
            $table->char('abreviatura');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();

            /* Datos para auditoria */
            $table->string('des_campo1', 100)->nullable();
            $table->string('des_campo2', 50)->nullable();
            $table->decimal('des_campo3', 10,2)->nullable();
            $table->string('usu_created_update');
            $table->timestamps();
            $table->string('pcip')->nullable();
            $table->unsignedInteger('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
