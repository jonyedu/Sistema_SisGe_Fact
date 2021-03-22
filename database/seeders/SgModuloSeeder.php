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
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'imagen' => 'fas fa-landmark',
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
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'imagen' => 'fas fa-dolly-flatbed',
            ]
        );
        SgModulo::updateOrCreate(
            [
                'descripcion' => 'Persona',
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'descripcion' => 'Persona',
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'imagen' => 'fas fa-users',
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
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'imagen' => 'fas fa-print',
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
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'imagen' => 'fas fa-key',
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
                'abreviatura' => '.',
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'imagen' => 'fas fa-shopping-cart',
            ]
        );
    }
}
