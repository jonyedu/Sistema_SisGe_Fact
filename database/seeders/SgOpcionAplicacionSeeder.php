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
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Grupo',
                'imagen' => 'fas fa-boxes',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/inventario/grupo/mostrar_grupo',
            ]
        );
        //Producto
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Producto",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Producto',
                'imagen' => 'fas fa-dolly',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/inventario/producto/mostrar_producto',
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
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Cliente',
                'imagen' => 'far fa-handshake',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/persona/cliente/mostrar_cliente',
            ]
        );
        //Proveedor
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Proveedor",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Proveedor',
                'imagen' => 'fas fa-laptop-medical',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/persona/proveedor/mostrar_proveedor',
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
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Empresa',
                'imagen' => 'far fa-building',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/empresa/mostrar_empresa',
            ]
        );
        //Sucursal
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Sucursal",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Sucursal',
                'imagen' => 'fas fa-city',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/sucursal/mostrar_sucursal',
            ]
        );
        //Profesion
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Profesion",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Profesion',
                'imagen' => 'far fa-id-badge',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/profesion/mostrar_profesion',
            ]
        );
        //Perfil
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Perfil",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Perfil',
                'imagen' => 'far fa-address-card',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/perfil/mostrar_perfil',
            ]
        );
        //Usuario
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Usuario",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Usuario',
                'imagen' => 'fas fa-address-book',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/usuario/mostrar_usuario',
            ]
        );
        //Modulo
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Modulo",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Modulo',
                'imagen' => 'fas fa-project-diagram',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/modulo/mostrar_modulo',
            ]
        );
        //Sub Modulo
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Sub Modulo",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Sub Modulo',
                'imagen' => 'fas fa-bezier-curve',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/sub_modulo/mostrar_sub_modulo',
            ]
        );
        //Perfil por Usuario
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Perfil por Usuario",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Perfil por Usuario',
                'imagen' => 'fas fa-puzzle-piece',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/seguridad/perfil_por_usuario/mostrar_perfil_por_usuario',
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
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Factura de Compra',
                'imagen' => 'fas fa-cart-plus',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/transaccion/factura_compra/mostrar_factura_compra',
            ]
        );
        //Factura de Venta
        SgOpcionAplicacion::updateOrCreate(
            [
                'descripcion' => "Factura de Venta",
            ],
            [
                'empresa' => 1,
                'sucursal' => 1,
                'modulo' => $modulo->codigo,
                'descripcion'  => 'Factura de Venta',
                'imagen' => 'fas fa-cart-arrow-down',
                'tipo' => 1,
                'ejecutable' => 1,
                'usuario_ingreso' => 1,
                'fecha_ingreso' => date("Y-m-d H:i:s"),
                'usuario_modificacion' => 1,
                'fecha_modificacion' => date("Y-m-d H:i:s"),
                'pcname' => '192.168.1.196',
                'status' => 1,
                'route' => '/modulos/transaccion/factura_venta/mostrar_factura_venta',
            ]
        );


    }
}
