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
            'descripcion' => "Usuario",
            'imagen' => 'fas fa-address-book',
            'route' => '/modulos/seguridad/usuario/mostrar_usuario',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 2)->update([
            'descripcion' => "Modulo",
            'imagen' => 'fas fa-project-diagram',
            'route' => '/modulos/seguridad/modulo/mostrar_modulo',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 3)->update([
            'descripcion' => "Perfil",
            'imagen' => 'far fa-address-card',
            'route' => '/modulos/seguridad/perfil/mostrar_perfil',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 4)->update([
            'descripcion' => "Sub Modulo",
            'imagen' => 'fas fa-bezier-curve',
            'route' => '/modulos/seguridad/sub_modulo/mostrar_sub_modulo',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 5)->update([
            'descripcion' => "Perfil por Usuario",
            'imagen' => 'fas fa-puzzle-piece',
            'route' => '/modulos/seguridad/perfil_por_usuario/mostrar_perfil_por_usuario',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 6)->update([
            'descripcion' => "Empresa",
            'imagen' => 'far fa-building',
            'route' => '/modulos/seguridad/empresa/mostrar_empresa',
        ]);
        SgOpcionAplicacion::where('status', 1)->where('codigo', 7)->update([
            'descripcion' => "Sucursal",
            'imagen' => 'fas fa-city',
            'route' => '/modulos/seguridad/sucursal/mostrar_sucursal',
        ]);
        $profesion = SgOpcionAplicacion::where('descripcion', 'Profesión')->first();
        if ($profesion != null) {
            SgOpcionAplicacion::where('status', 1)->where('codigo', $profesion->codigo)->update([
                'descripcion' => "Profesión",
                'imagen' => 'fas fa-users',
                'route' => '/modulos/seguridad/profesion/mostrar_profesion',
            ]);
        } else {
            SgOpcionAplicacion::create([
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => 7,
                'descripcion' => "Profesión",
                'imagen' => 'fas fa-users',
                'tipo' => "1",
                'ejecutable' => ".",
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => "192.168.1.196",
                'status' => 1,
                'route' => '/modulos/seguridad/profesion/mostrar_profesion',
            ]);
        }
        //Fin de Seguridad

        //Modulo de Administracion
        SgOpcionAplicacion::where('modulo', 1)->where('codigo', 8)->update([
            'imagen' => 'fas fa-laptop-medical',
            'route' => '/modulos/administracion/laboratorio/mostrar_laboratorio',
        ]);
        SgOpcionAplicacion::where('modulo', 1)->where('codigo', 9)->update([
            'imagen' => 'fas fa-dolly',
            'route' => '/modulos/administracion/producto/mostrar_producto',
        ]);
        SgOpcionAplicacion::where('modulo', 1)->where('codigo', 18)->update([
            'imagen' => 'fas fa-boxes',
            'route' => '/modulos/administracion/grupo/mostrar_grupo',
        ]);
    }
}
