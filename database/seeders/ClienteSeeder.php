<?php

namespace Database\Seeders;

use App\Models\Modulos\Persona\Cliente\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::truncate();
        Cliente::updateOrCreate(
            [
                'nombres' => 'CONSUMIDOR FINAL',
                'apellidos' => '.',
            ],
            [
                'nombres' => 'CONSUMIDOR FINAL',
                'apellidos' => '.',
                'cedula' => '9999999999',
                'telefono' => '0000000000',
                'direccion' => '',
                'correo' => 'majo-klamag@hotmail.com',
                'usu_created' => date("Y-m-d H:i:s"),
                'usu_update' => date("Y-m-d H:i:s"),
                'created_at' => 1,
                'updated_at' => 1,
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        Cliente::updateOrCreate(
            [
                'nombres' => 'Jonathan Eduardo',
                'apellidos' => 'Mora Candelario',
            ],
            [
                'nombres' => 'Jonathan Eduardo',
                'apellidos' => 'Mora Candelario',
                'cedula' => '0954776779',
                'telefono' => '0994949832',
                'direccion' => 'cdla. Rio Guayas Mc Solar 16',
                'correo' => 'jonathan_1308@hotmail.com',
                'usu_created' => date("Y-m-d H:i:s"),
                'usu_update' => date("Y-m-d H:i:s"),
                'created_at' => 1,
                'updated_at' => 1,
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
    }
}
