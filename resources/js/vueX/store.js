import Vue from "vue";
import Vuex from "vuex"

//import emergencia_store from './modules/emergencia_store'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
       // emergencia_store
    },
    state:{
        laboratorio: null,
        producto: null,
        usuario: null,
        modulo: null,
        subModulo: null,
    },

    //una mutacion se va a realizar siempre y cuando sea llamada desde una acccion
    mutations:{
        addProducto(state ){
            state.producto = state.producto;
        },
        addLaboratorio(state ){
            state.laboratorio = state.laboratorio;
        },
        addUsuario(state ){
            state.usuario = state.usuario;
        },
        addModulo(state ){
            state.modulo = state.modulo;
        },
        addSubModulo(state ){
            state.subModulo = state.subModulo;
        },
    },
    //eventos actions del store
    actions:{
        addProductoAction(context ){
            context.commit('addProducto');
        },
        addLaboratorioAction(context ){
            context.commit('addLaboratorio');
        },
        addUsuarioAction(context ){
            context.commit('addUsuario');
        },
        addModuloAction(context ){
            context.commit('addModulo');
        },
        addSubModuloAction(context ){
            context.commit('addSubModulo');
        },
    },
    getters:{
        getProducto(state){
            return state.producto;
        },
        getLaboratorio(state){
            return state.laboratorio;
        },
        getUsuario(state){
            return state.usuario;
        },
        getModulo(state){
            return state.modulo;
        },
        getSubModulo(state){
            return state.subModulo;
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

