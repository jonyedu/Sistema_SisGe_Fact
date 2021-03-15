import Vue from "vue";
import { prefix } from "./variables";
import VueRouter from "vue-router";

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

//Modulo Administracion
import Producto from "./components/Modulos/Administracion/Producto/ListarProducto";
import ModificarCrearProducto from "./components/Modulos/Administracion/Producto/CrearModificarProducto";
import Laboratorio from "./components/Modulos/Administracion/Laboratorio/ListaLaboratorio";
import ModificarCrearLaboratorio from "./components/Modulos/Administracion/Laboratorio/CrearModificarLaboratorio";
import Grupo from "./components/Modulos/Administracion/Grupo/ListarGrupo";
import ModificarCrearGrupo from "./components/Modulos/Administracion/Grupo/CrearModificarGrupo";

//FACTURACION
import ListaFacturacionVenta from "./components/Modulos/Procesos/Facturacion/Ventas/ListaFacturacionV";
import FacturacionVenta from "./components/Modulos/Procesos/Facturacion/Ventas/FacturaVenta";
//

Vue.use(VueRouter);
let prefijo = prefix;
export default new VueRouter({
    routes: [
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

        //Administracion
        {
            path: prefijo + "/modulos/administracion/producto/mostrar_producto",
            component: Producto
        },
        {
            path:
                prefijo +
                "/modulos/administracion/producto/crear_modificar_producto",
            component: ModificarCrearProducto
        },
        {
            path:
                prefijo +
                "/modulos/administracion/laboratorio/mostrar_laboratorio",
            component: Laboratorio
        },
        {
            path:
                prefijo +
                "/modulos/administracion/laboratorio/crear_modificar_laboratorio",
            component: ModificarCrearLaboratorio
        },
        {
            path: prefijo + "/modulos/administracion/grupo/mostrar_grupo",
            component: Grupo
        },
        {
            path:
                prefijo + "/modulos/administracion/grupo/crear_modificar_grupo",
            component: ModificarCrearGrupo
        },
        //FACTURACION
        {
            path:
                prefijo + "/modulos/administracion/facturacion/ventas_diarias",
            component: ListaFacturacionVenta
        },
        {
            path:
                prefijo +
                "/modulos/administracion/facturacion/facturacion_ventas",
            component: FacturacionVenta
        }

        //FIN
    ],
    mode: "history" //Evita que aparezca # en la ruta
});
