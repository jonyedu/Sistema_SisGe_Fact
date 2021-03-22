<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Modulo\SgModulo;
use App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario;
use App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LmpDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        PerfilPorUsuario::truncate();
        SgOpcionAplicacion::truncate();
        SgModulo::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
