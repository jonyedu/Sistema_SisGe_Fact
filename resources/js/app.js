require('./bootstrap');

import Vue from "vue";
import store from './vueX/store'
import VModal from "vue-js-modal";
import VueGoodTablePlugin from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
import router from "./router";
import VueRouter from "vue-router";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import VueSweetalert2 from "vue-sweetalert2";
import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Paintable from 'vue-paintable';
import VueHtml2Canvas from 'vue-html2canvas';
import RegeneratorRuntime from "regenerator-runtime";
import FlashMessage from '@smartweb/vue-flash-message';
import App from "./components/App";
import { funcionesGlobales } from "./funciones.js";
import swal from 'sweetalert2';
window.Swal = swal;
import VueSelectSides from "vue-select-sides";
import "vue-select-sides/styles/themes/soft.scss";
import VueGoogleCharts from 'vue-google-charts';


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


Vue.use(Loading);
Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VueGoodTablePlugin);
Vue.use(VModal);
Vue.use(VueFormWizard);
Vue.use(VueHtml2Canvas);
Vue.use(RegeneratorRuntime);
Vue.use(Paintable, {
    // optional methods
    setItem(key, image) {
      localStorage.setItem(key, image);
    },
    // you also can use async
    getItem(key) {
      return localStorage.getItem(key);
    },
    removeItem(key) {
      localStorage.removeItem(key);
    }
});
Vue.use(VueGoogleCharts);
Vue.use(FlashMessage);

Vue.component("v-select", vSelect);
Vue.use(VueSelectSides, {
    locale: "es_ES"
  });
Vue.component("vue-select-sides", VueSelectSides);

//*********COMPONENTES GENERALES*********\\
Vue.component(
    "menuComponente",
    require("./components/componentesGenerales/MenuComponent.vue").default
);
Vue.component(
    "vuetable-component",
    require("./components/componentesGenerales/VueTableComponent.vue").default
);
Vue.component(
    "vue-painttable",
    require("./components/componentesGenerales/VuePaintableComponent.vue").default
);
Vue.component(
    "vue-confirmar-cancelar",
    require("./components/componentesGenerales/VueConfirmarCancelarComponent.vue").default
);
Vue.component(
    "vue-firma",
    require("./components/componentesGenerales/VueFirmaComponent.vue").default
);
Vue.component(
    "vue-pdf-preview",
    require("./components/componentesGenerales/PdfPreviewVue.vue").default
);
//*********FIN COMPONENTES GENERALES*********\\

/* Vue.component(
    "prueba",
    require("./components/Prueba.vue").default
); */

//Modulo de Seguridad
Vue.component(
    "crear-modificar-modulo",
    require("./components/Modulos/Seguridad/modulo/CrearModificarModulo.vue").default
);
Vue.component(
    "crear-modificar-sub-modulo",
    require("./components/Modulos/Seguridad/sub_modulo/CrearModificarSubModulo.vue").default
);
Vue.component(
    "crear-modificar-perfil",
    require("./components/Modulos/Seguridad/Perfil/CrearModificarPerfil.vue").default
);
/* Vue.component(
    "crear-modificar-profesion",
    require("./components/Modulos/Seguridad/profesion/CrearModificarProfesion.vue").default
); */

Vue.component(
    "crear-modificar-usuario",
    require("./components/Modulos/Seguridad/Usuario/CrearModificarUsuario.vue").default
);

// inventario
Vue.component(
    "inventario-producto",
    require("./components/Modulos/Procesos/Facturacion/Ventas/ProductosInventario.vue").default
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
