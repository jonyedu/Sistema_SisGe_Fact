<?php

namespace Database\Seeders;

use App\Models\Modulos\Inventario\Grupo\Grupo;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::truncate();
        $grupos = [
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'descripcion' => "VIVERES",
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'descripcion' => "ARTICULO DE LIMPIEZA",
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'descripcion' => "BEBIDAS",
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ],
        ];

        Grupo::insert($grupos);
    }
}
