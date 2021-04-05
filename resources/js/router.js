import Vue from "vue";
import { prefix } from "./variables";
import VueRouter from "vue-router";

//Modulo Banco


//Modulo Inventario
import Grupo from "./components/Modulos/Inventario/Grupo/ListarGrupo";
import ModificarCrearGrupo from "./components/Modulos/Inventario/Grupo/CrearModificarGrupo";
import Producto from "./components/Modulos/Inventario/Producto/ListarProducto";
import ModificarCrearProducto from "./components/Modulos/Inventario/Producto/CrearModificarProducto";

//Modulo Persona
import Proveedor from "./components/Modulos/Persona/Proveedor/ListaProveedor";
import ModificarCrearProveedor from "./components/Modulos/Persona/Proveedor/CrearModificarProveedor";
import Cliente from "./components/Modulos/Persona/Cliente/ListaCliente";
import ModificarCrearCliente from "./components/Modulos/Persona/Cliente/CrearModificarCliente";

//Modulo Reporte

//Modulo Seguridad
import Usuario from "./components/Modulos/Seguridad/Usuario/ListarUsuario";
import ModificarCrearUsuario from "./components/Modulos/Seguridad/Usuario/CrearModificarUsuario";
import Modulo from "./components/Modulos/Seguridad/modulo/ListarModulo";
import ModificarCrearModulo from "./components/Modulos/Seguridad/modulo/CrearModificarModulo";
import Perfil from "./components/Modulos/Seguridad/Perfil/ListarPerfil";
import ModificarCrearPerfil from "./components/Modulos/Seguridad/Perfil/CrearModificarPerfil";
import SubModulo from "./components/Modulos/Seguridad/sub_modulo/ListarSubModulo";
import ModificarCrearSubModulo from "./components/Modulos/Seguridad/sub_modulo/CrearModificarSubModulo";
import PerfilPorUsuario from "./components/Modulos/Seguridad/PerfilPorUsuario/PerfilPorUsuario";
import Profesion from "./components/Modulos/Seguridad/Profesion/ListarProfesion";
import ModificarCrearProfesion from "./components/Modulos/Seguridad/Profesion/CrearModificarProfesion";
import Empresa from "./components/Modulos/Seguridad/Empresa/ListarEmpresa";
import ModificarCrearEmpresa from "./components/Modulos/Seguridad/Empresa/CrearModificarEmpresa";
import Sucursal from "./components/Modulos/Seguridad/Sucursal/ListarSucursal";
import ModificarCrearSucursal from "./components/Modulos/Seguridad/Sucursal/CrearModificarSucursal";


//Modulo Transaccion
import ListaFacturacionVenta from "./components/Modulos/Transaccion/FacturaVenta/ListaFacturacionV";
import FacturacionVenta from "./components/Modulos/Transaccion/FacturaVenta/FacturaVenta";
import ListarCompraCabecera from "./components/Modulos/Transaccion/FacturaCompra/ListarCompraCabecera";
import IndexFacturaCompra from "./components/Modulos/Transaccion/FacturaCompra/IndexFacturaCompra";



Vue.use(VueRouter);
let prefijo = prefix;
export default new VueRouter({
    routes: [

        //Banco

        //Inventario
        {
            path: prefijo + "/modulos/inventario/grupo/mostrar_grupo",
            component: Grupo
        },
        {
            path:
                prefijo + "/modulos/inventario/grupo/crear_modificar_grupo",
            component: ModificarCrearGrupo
        },
        {
            path: prefijo + "/modulos/inventario/producto/mostrar_producto",
            component: Producto
        },
        {
            path:
                prefijo +
                "/modulos/inventario/producto/crear_modificar_producto",
            component: ModificarCrearProducto
        },

        //Persona
        {
            path:
                prefijo +
                "/modulos/persona/proveedor/mostrar_proveedor",
            component: Proveedor
        },
        {
            path:
                prefijo +
                "/modulos/persona/proveedor/crear_modificar_proveedor",
            component: ModificarCrearProveedor
        },
        {
            path:
                prefijo +
                "/modulos/persona/cliente/mostrar_cliente",
            component: Cliente
        },
        {
            path:
                prefijo +
                "/modulos/persona/cliente/crear_modificar_cliente",
            component: ModificarCrearCliente
        },

        //Reporte

        //Seguridad
        {
            path: prefijo + "/modulos/seguridad/usuario/mostrar_usuario",
            component: Usuario
        },
        {
            path:
                prefijo + "/modulos/seguridad/usuario/crear_modificar_usuario",
            component: ModificarCrearUsuario
        },
        {
            path: prefijo + "/modulos/seguridad/modulo/mostrar_modulo",
            component: Modulo
        },
        {
            path: prefijo + "/modulos/seguridad/modulo/crear_modificar_modulo",
            component: ModificarCrearModulo
        },
        {
            path: prefijo + "/modulos/seguridad/perfil/mostrar_perfil",
            component: Perfil
        },
        {
            path: prefijo + "/modulos/seguridad/perfil/crear_modificar_perfil",
            component: ModificarCrearPerfil
        },
        {
            path: prefijo + "/modulos/seguridad/sub_modulo/mostrar_sub_modulo",
            component: SubModulo
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/sub_modulo/crear_modificar_sub_modulo",
            component: ModificarCrearSubModulo
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/perfil_por_usuario/mostrar_perfil_por_usuario",
            component: PerfilPorUsuario
        },
        {
            path: prefijo + "/modulos/seguridad/profesion/mostrar_profesion",
            component: Profesion
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/profesion/crear_modificar_profesion",
            component: ModificarCrearProfesion
        },
        {
            path: prefijo + "/modulos/seguridad/empresa/mostrar_empresa",
            component: Empresa
        },
        {
            path:
                prefijo + "/modulos/seguridad/empresa/crear_modificar_empresa",
            component: ModificarCrearEmpresa
        },
        {
            path: prefijo + "/modulos/seguridad/sucursal/mostrar_sucursal",
            component: Sucursal
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/sucursal/crear_modificar_sucursal",
            component: ModificarCrearSucursal
        },

        //Transaccion
        {
            path:
                prefijo + "/modulos/transaccion/factura_venta/mostrar_factura_venta",
            component: ListaFacturacionVenta
        },
        {
            path:
                prefijo + "/modulos/transaccion/factura_venta/crear_modificar_factura_venta",
            component: FacturacionVenta
        },
        {
            path:
                prefijo + "/modulos/transaccion/factura_compra/mostrar_factura_compra",
            component: ListarCompraCabecera
        },
        {
            path:
                prefijo + "/modulos/transaccion/factura_compra/crear_modificar_factura_compra",
            component: IndexFacturaCompra
        }
    ],
    mode: "history" //Evita que aparezca # en la ruta
});
