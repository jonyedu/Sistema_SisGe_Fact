<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulos\Seguridad\Modulo\SgModulo;

class SgModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Banco',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Banco',
                'imagen' => 'fas fa-landmark',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,

            ]

        );

        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Inventario',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Inventario',
                'imagen' => 'fas fa-dolly-flatbed',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,

            ]
        );
        /* SgModulo::updateOrCreate(
            [
                'descripcion' => 'Parametrización',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Parametrización',
                'imagen' => 'fas fa-users',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,

            ]
        ); */
        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Persona',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Persona',
                'imagen' => 'fas fa-users',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,

            ]
        );
        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Reporte',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Reporte',
                'imagen' => 'fas fa-print',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,

            ]
        );
        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Seguridad',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Seguridad',
                'imagen' => 'fas fa-key',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,

            ]
        );
        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Transaccion',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Transaccion',
                'imagen' => 'fas fa-shopping-cart',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
    }
}
