require('./bootstrap');

import Vue from "vue";
import store from './vueX/store'
import router from "./router";
import VueRouter from "vue-router";
import App from "./components/App";
import { funcionesGlobales } from "./funciones.js";

import VueSelectSides from "vue-select-sides";
import "vue-select-sides/styles/themes/soft.scss";


//nuevas librerias
// main.js
import VueMdb, { AxiosPlugin, BsStore } from "vue-mdbootstrap";
Vue.use(VueMdb);
//Vue.use(BsStore);
Vue.use(AxiosPlugin);

//import Vuelidate from 'vuelidate';

import { required, email, minLength } from "vuelidate/lib/validators";
Vue.use(required);
Vue.use(email);
Vue.use(minLength);





//Fin nuevas librerias

Vue.prototype.$funcionesGlobales = funcionesGlobales;


Vue.use(VueRouter);

Vue.use(VueSelectSides, {
    locale: "es_ES"
  });
Vue.component("vue-select-sides", VueSelectSides);

//*********COMPONENTES GENERALES*********\\
Vue.component(
    "menuComponente",
    require("./components/componentesGenerales/MenuComponent.vue").default
);


// Factura
Vue.component(
    "inventario-producto",
    require("./components/Modulos/Transaccion/FacturaVenta/ProductosInventario.vue").default
);

Vue.component(
    "cliente-factura",
    require("./components/Modulos/Transaccion/FacturaVenta/ClienteFactura.vue").default
);

Vue.component(
    "forma-de-pago-factura",
    require("./components/Modulos/Transaccion/FacturaVenta/FormadePagoFactura.vue").default
);

Vue.component(
    "datos-factura-compra",
    require("./components/Modulos/Transaccion/FacturaCompra/Components/DatosFacturaCompra").default
);
Vue.component(
    "seleccionar-producto",
    require("./components/Modulos/Transaccion/FacturaCompra/Components/ListarProductos").default
);
Vue.component(
    "forma-pago",
    require("./components/Modulos/Transaccion/FacturaCompra/Components/FormadePago").default
);
//

/* Vue.component(
    "crear-modificar-producto",
    require("./components/Modulos/Administracion/Producto/CrearModificarProducto.vue").default
); */

new Vue({
    el: "#app",
    components: {
        App,
    },
    router,
    store,
})
