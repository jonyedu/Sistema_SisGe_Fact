<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Modulo\SgModulo;
use App\Models\Modulos\Seguridad\Perfil\Perfil;
use App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario;
use App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion;
use Illuminate\Database\Seeder;

class PerfilPorUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PerfilPorUsuario::truncate();
        //Administrador
        $perfil = Perfil::where('descripcion', 'Administrador')->first();
        $modulo = SgModulo::where('descripcion', 'Inventario')->first();

        //Modulo Inventario - Grupo
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Grupo')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Inventario - Producto
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Producto')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );

        $modulo = SgModulo::where('descripcion', 'Persona')->first();
        //Modulo Persona - Cliente
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Cliente')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Persona - Proveedor
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Proveedor')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );

        $modulo = SgModulo::where('descripcion', 'Seguridad')->first();
        //Modulo Seguridad - Empresa
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Empresa')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Sucursal
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Sucursal')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Profesion
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Profesion')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Perfil
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Perfil')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Usuario
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Usuario')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Modulo
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Modulo')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Sub Modulo
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Sub Modulo')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Seguridad - Perfil por Usuario
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Perfil por Usuario')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );

        $modulo = SgModulo::where('descripcion', 'Transaccion')->first();
        //Modulo Transaccion - Factura de Compra
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Factura de Compra')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Transaccion - Factura de Venta
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Factura de Venta')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Transaccion - Factura de Crédito
        $sub_modulo = SgOpcionAplicacion::where('descripcion', 'Factura de Crédito')->first();
        PerfilPorUsuario::updateOrCreate(
            [
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'perfil' => $perfil->codigo,
                'modulo' => $modulo->codigo,
                'opcion_aplicacion' => $sub_modulo->codigo,
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
