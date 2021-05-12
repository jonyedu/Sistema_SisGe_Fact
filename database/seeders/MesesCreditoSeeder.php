<?php

namespace Database\Seeders;

use App\Models\Modulos\Parametrizacion\FormaPago\FormaPago;
use Illuminate\Database\Seeder;

class MesesCreditoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormaPago::truncate();
        FormaPago::updateOrCreate(
            [
                'descripcion' => '3 MESES'
            ],
            [
                'descripcion' => '3 MESES',
                'dias' => '3',
                'interes' => '1',
                'usu_created' => 1,
                'usu_update' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        FormaPago::updateOrCreate(
            [
                'descripcion' => '6 MESES'
            ],
            [
                'descripcion' => '6 MESES',
                'dias' => '6',
                'interes' => '1',
                'usu_created' => 1,
                'usu_update' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        FormaPago::updateOrCreate(
            [
                'descripcion' => '12 MESES'
            ],
            [
                'descripcion' => '12 MESES',
                'dias' => '12',
                'interes' => '1',
                'usu_created' => 1,
                'usu_update' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
    }
}
