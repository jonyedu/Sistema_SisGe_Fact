<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion;
use Illuminate\Database\Seeder;

class SgOpcionAplicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Añadir las rutas a los menu que ya Existen
        SgOpcionAplicacion::where('modulo', 1)->where('codigo', 9)->update([
            'imagen' => 'fas fa-dolly',
            'route' => '/modulos/administracion/producto/mostrar_producto',
        ]);

    }
}
