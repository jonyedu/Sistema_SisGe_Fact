<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Perfil\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::updateOrCreate(
            [
                'descripcion' => "Administrador",
            ],
            [
                'descripcion' => 'Administrador',
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
            ]
        );
    }
}
