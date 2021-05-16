<?php

namespace Database\Seeders;

use App\Models\Modulos\Persona\Proveedor\Proveedor;
use Illuminate\Database\Seeder;

class LaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::truncate();
        Proveedor::updateOrCreate(
            [
                'ruc' => '0954776779001',
                'cedula' => '0954776779',
            ],
            [
                'nombre' => 'Jonathan Eduardo',
                'apellido' => 'Mora Candelario',
                'ruc' => '0954776779001',
                'cedula' => '0954776779',
                'razon_social' => 'TrackFast S.A.',
                'direccion' => 'cdla. rio guayas',
                'telefono' => '0994949832',
                'correo' => 'jonathan_1308@hotmail.com',
                'usu_created' => 36,
                'usu_update' => 36,
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
    }
}
