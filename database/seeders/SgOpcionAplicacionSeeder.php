<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Modulo\SgModulo;
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
        //Modulo Banco

        //Modulo Inventario
        $modulo = SgModulo::where('descripcion', 'Inventario')->first();
        //Grupo
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Grupo",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Grupo',
                'imagen' => 'fas fa-boxes',

                'route' => '/modulos/inventario/grupo/mostrar_grupo',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Producto
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Producto",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Producto',
                'imagen' => 'fas fa-dolly',
                'route' => '/modulos/inventario/producto/mostrar_producto',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Persona
        $modulo = SgModulo::where('descripcion', 'Persona')->first();
        //Cliente
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Cliente",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Cliente',
                'imagen' => 'far fa-handshake',

                'route' => '/modulos/persona/cliente/mostrar_cliente',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Proveedor
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Proveedor",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Proveedor',
                'imagen' => 'fas fa-laptop-medical',
                'route' => '/modulos/persona/proveedor/mostrar_proveedor',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo Reporte

        //Modulo de Seguridad
        $modulo = SgModulo::where('descripcion', 'Seguridad')->first();
        //Empresa
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Empresa",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Empresa',
                'imagen' => 'far fa-building',
                'route' => '/modulos/seguridad/empresa/mostrar_empresa',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Sucursal
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Sucursal",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Sucursal',
                'imagen' => 'fas fa-city',
                'route' => '/modulos/seguridad/sucursal/mostrar_sucursal',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Profesion
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Profesion",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Profesion',
                'imagen' => 'far fa-id-badge',
                'route' => '/modulos/seguridad/profesion/mostrar_profesion',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Perfil
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Perfil",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Perfil',
                'imagen' => 'far fa-address-card',
                'route' => '/modulos/seguridad/perfil/mostrar_perfil',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Usuario
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Usuario",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Usuario',
                'imagen' => 'fas fa-address-book',
                'route' => '/modulos/seguridad/usuario/mostrar_usuario',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Modulo
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Modulo",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Modulo',
                'imagen' => 'fas fa-project-diagram',
                'route' => '/modulos/seguridad/modulo/mostrar_modulo',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Sub Modulo
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Sub Modulo",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Sub Modulo',
                'imagen' => 'fas fa-bezier-curve',
                'route' => '/modulos/seguridad/sub_modulo/mostrar_sub_modulo',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Perfil por Usuario
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Perfil por Usuario",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Perfil por Usuario',
                'imagen' => 'fas fa-puzzle-piece',
                'route' => '/modulos/seguridad/perfil_por_usuario/mostrar_perfil_por_usuario',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Fin de Seguridad

        //Modulo de Transaccion
        $modulo = SgModulo::where('descripcion', 'Transaccion')->first();
        //Factura de Compra
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Factura de Compra",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Factura de Compra',
                'imagen' => 'fas fa-cart-plus',
                'route' => '/modulos/transaccion/factura_compra/mostrar_factura_compra',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Factura de Venta
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Factura de Venta",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Factura de Venta',
                'imagen' => 'fas fa-cart-arrow-down',
                'route' => '/modulos/transaccion/factura_venta/mostrar_factura_venta',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
        //Factura de Crédito
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Factura de Crédito",
            ],
            [
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Factura de Crédito',
                'imagen' => 'fas fa-donate',
                'route' => '/modulos/transaccion/factura_credito/mostrar_creditos',
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
