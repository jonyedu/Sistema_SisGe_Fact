import Vue from "vue";
import { prefix } from "./variables";
import VueRouter from "vue-router";


//Seguridad
import Usuario from "./components/Modulos/Seguridad/Usuario/Usuario";
import Modulo from "./components/Modulos/Seguridad/modulo/Modulo";
import Perfil from "./components/Modulos/Seguridad/Perfil/Perfil";
import SubModulo from "./components/Modulos/Seguridad/sub_modulo/SubModulo";
import PerfilPorUsuario from "./components/Modulos/Seguridad/PerfilPorUsuario/PerfilPorUsuario";
import Profesion from "./components/Modulos/Seguridad/Profesion/Profesion";

//Administracion
import Producto from "./components/Modulos/Administracion/Producto/ListarProducto";
import ModificarCrearProducto from "./components/Modulos/Administracion/Producto/CrearModificarProducto";


Vue.use(VueRouter);
let prefijo = prefix;
export default new VueRouter({
    routes: [

        //Seguridad
        {
            path:
                prefijo +
                "/modulos/seguridad/usuario/mostrar_usuario",
            component: Usuario
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/modulo/mostrar_modulo",
            component: Modulo
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/perfil/mostrar_perfil",
            component: Perfil
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/sub_modulo/mostrar_sub_modulo",
            component: SubModulo
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/perfil_por_usuario/mostrar_perfil_por_usuario",
            component: PerfilPorUsuario
        },
        {
            path:
                prefijo +
                "/modulos/seguridad/profesion/mostrar_profesion",
            component: Profesion
        },

        //Administracion
        {
            path:
                prefijo +
                "/modulos/administracion/producto/mostrar_producto",
            component: Producto
        },
        {
            path:
                prefijo +
                "/modulos/administracion/producto/crear_modificar_producto",
            component: ModificarCrearProducto
        },
    ],
    mode: "history" //Evita que aparezca # en la ruta
});
