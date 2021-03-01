import Vue from "vue";
import Vuex from "vuex"

//import emergencia_store from './modules/emergencia_store'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
       // emergencia_store
    },
    state:{
        producto: null,

    },

    //una mutacion se va a realizar siempre y cuando sea llamada desde una acccion
    mutations:{
        addAmigo(state ){
            state.producto = state.producto;
        }
    },
    //eventos actions del store
    actions:{
        addAmigoAction(context ){
            context.commit('addAmigo');
        }
    },
    getters:{
        getProducto(state){
            return state.producto;
        }

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

