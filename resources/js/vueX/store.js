import Vue from "vue";
import Vuex from "vuex";

//import emergencia_store from './modules/emergencia_store'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        // emergencia_store
    },
    state: {
        ruta: "/sisgebefact",
        proveedor: null,
        producto: null,
        usuario: null,
        modulo: null,
        subModulo: null,
        perfil: null,
        empresa: null,
        sucursal: null,
        profesion: null,
        grupo: null,
        cliente: null,
        factura_compra: null,
        inventariofactura: null,
        datos_inventario_factura: {},
        clientefactura: null,
        formapagofactura: null
    },

    //una mutacion se va a realizar siempre y cuando sea llamada desde una acccion
    mutations: {
        addProveedor(state) {
            state.proveedor = state.proveedor;
        },
        addUsuario(state) {
            state.usuario = state.usuario;
        },
        addModulo(state) {
            state.modulo = state.modulo;
        },
        addSubModulo(state) {
            state.subModulo = state.subModulo;
        },
        addPerfil(state) {
            state.perfil = state.perfil;
        },
        addEmpresa(state) {
            state.empresa = state.empresa;
        },
        addSucursal(state) {
            state.sucursal = state.sucursal;
        },
        addProfesion(state) {
            state.profesion = state.profesion;
        },
        addGrupo(state) {
            state.grupo = state.grupo;
        },
        addCliente(state) {
            state.cliente = state.cliente;
        },
        addFacturaCompra(state) {
            state.factura_compra = state.factura_compra;
        },
        addFormapagofactura(state) {
            state.formapagofactura = state.formapagofactura;
        },
        addClientefactura(state) {
            state.clientefactura = state.clientefactura;
        },
        addInventariofactura(state) {
            state.inventariofactura = state.inventariofactura;
        },
        addDatoInventarioFactura(state) {
            state.datos_inventario_factura = state.datos_inventario_factura;
        },
    },
    //eventos actions del store
    actions: {
        addInventariofacturaAction(context) {
            context.commit("addInventariofactura");
        },
        addClientefacturaAction(context) {
            context.commit("addClientefactura");
        },
        addFormapagofacturaAction(context) {
            context.commit("addFormapagofactura");
        },
        addProductoAction(context) {
            context.commit("addProducto");
        },
        addProveedorAction(context) {
            context.commit("addProveedor");
        },
        addUsuarioAction(context) {
            context.commit("addUsuario");
        },
        addModuloAction(context) {
            context.commit("addModulo");
        },
        addSubModuloAction(context) {
            context.commit("addSubModulo");
        },
        addPerfilAction(context) {
            context.commit("addPerfil");
        },
        addEmpresaAction(context) {
            context.commit("addEmpresa");
        },
        addSucursalAction(context) {
            context.commit("addSucursal");
        },
        addProfesionAction(context) {
            context.commit("addProfesion");
        },
        addGrupoAction(context) {
            context.commit("addGrupo");
        },
        addClienteAction(context) {
            context.commit("addCliente");
        },
        addFacturaCompraAction(context) {
            context.commit("addFacturaCompra");
        },
        addDatoInventarioFacturaAction(context) {
            context.commit("addDatoInventarioFactura");
        },
    },
    getters: {
        getFormapagofactura(state) {
            return state.formapagofactura;
        },

        getClientefactura(state) {
            return state.clientefactura;
        },

        getInventariofactura(state) {
            return state.inventariofactura;
        },
        getProducto(state) {
            return state.producto;
        },
        getProveedor(state) {
            return state.proveedor;
        },
        getUsuario(state) {
            return state.usuario;
        },
        getModulo(state) {
            return state.modulo;
        },
        getSubModulo(state) {
            return state.subModulo;
        },
        getPerfil(state) {
            return state.perfil;
        },
        getEmpresa(state) {
            return state.empresa;
        },
        getSucursal(state) {
            return state.sucursal;
        },
        getProfesion(state) {
            return state.profesion;
        },
        getGrupo(state) {
            return state.grupo;
        },
        getCliente(state) {
            return state.cliente;
        },
        getFacturaCompra(state) {
            return state.factura_compra;
        },
        getDatosInventarioFactura(state) {
            return state.datos_inventario_factura;
        },
    }
});

/*
    VUEX: Se implementa cuando la aplicacion maneja muchos componentes,
    vueX permite declarar variables de forma global (Almacen centralizado), de tal manera que desde cualquier
    componente se puede gestionar los valores y a su ves consumir esos valores.

    Almacen centralizado es informacion de estados, estados que se pueden manejar o mutar de forma predecible,
    al decir precedible indicamos que necesitamos realizar ciertas reglas para poder manipular estos valores.

    State es en donde tenemos los datos de nuestra aplicación.
    Mutations son los únicos métodos reales que tienen permiso para mutar el estado.
    Actions son los métodos para ejecutar código asíncrono y desencadenar mutaciones.
    Getters son métodos para acceder el estado de almacenamiento y enviarlo a los componentes.

    https://www.youtube.com/watch?v=zJkPhjjOZ0A
    https://www.youtube.com/watch?v=sVlD7PCRj8Q
    https://marinaaisa.com/blog/vuex-que-es-cuando-utilizarlo

    #HakunaMatata ♥ JG

*/
