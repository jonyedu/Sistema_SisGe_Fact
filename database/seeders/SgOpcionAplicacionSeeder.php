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
        //Modulo de Seguridad
        SgOpcionAplicacion::where('status', 1)->where('codigo', 1)->update([
            'imagen' => 'fas fa-address-book',
            'route' => '/modulos/seguridad/usuario/mostrar_usuario',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 2)->update([
            'imagen' => 'fas fa-project-diagram',
            'route' => '/modulos/seguridad/modulo/mostrar_modulo',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 3)->update([
            'imagen' => 'far fa-address-card',
            'route' => '/modulos/seguridad/perfil/mostrar_perfil',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 4)->update([
            'imagen' => 'fas fa-bezier-curve',
            'route' => '/modulos/seguridad/sub_modulo/mostrar_sub_modulo',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 5)->update([
            'imagen' => 'fas fa-puzzle-piece',
            'route' => '/modulos/seguridad/perfil_por_usuario/mostrar_perfil_por_usuario',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 6)->update([
            'imagen' => 'far fa-building',
            'route' => '/modulos/seguridad/perfil_por_usuario/mostrar_empresa',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 7)->update([
            'imagen' => 'fas fa-city',
            'route' => '/modulos/seguridad/perfil_por_usuario/mostrar_sucursal',
        ]);

        //Modulo de Administracion
        SgOpcionAplicacion::where('modulo', 1)->where('codigo', 9)->update([
            'imagen' => 'fas fa-dolly',
            'route' => '/modulos/administracion/producto/mostrar_producto',
        ]);


    }
}
