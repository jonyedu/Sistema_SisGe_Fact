<?php

namespace Database\Seeders;

use App\Models\Modulos\Parametrizacion\ConfigFacturero\ConfigFacturero;
use Illuminate\Database\Seeder;

class ConfigFactureroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigFacturero::updateOrCreate(
            [
                'no_establecimiento' => '001',
                'no_facturero' => '002',
                'secuencia' => 1,
            ],
            [
                'no_establecimiento' => '001',
                'no_facturero' => '002',
                'secuencia' => 1,
                'no_autorizacion' => '0123456789',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'usu_created' => 1,
                'usu_update' => 1,
                'pcip' => '192.168.1.196',
                'status' => 1
            ]
        );
    }
}
