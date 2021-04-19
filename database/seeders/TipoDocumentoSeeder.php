<?php

namespace Database\Seeders;

use App\Models\Modulos\Parametrizacion\TipoDocumento\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::truncate();
        TipoDocumento::updateOrCreate(
            [
                'descripcion' => 'Factura',
            ],
            [
                'descripcion' => 'Factura',
                'usu_created' => 1,
                'usu_update' => 1,
                'pcip' => '192.168.1.196',
                'status' => 1
            ]
        );
        TipoDocumento::updateOrCreate(
            [
                'descripcion' => 'Nota de Venta',
            ],
            [
                'descripcion' => 'Nota de Venta',
                'usu_created' => 1,
                'usu_update' => 1,
                'pcip' => '192.168.1.196',
                'status' => 1
            ]
        );
    }
}
