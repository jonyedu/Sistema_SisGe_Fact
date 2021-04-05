<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                prefijo +
                                    '/modulos/persona/cliente/mostrar_cliente'
                            "
                        >
                            <bs-tooltip
                                content="Volver hacia atras"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="reply"
                                    icon-size="sm"
                                >
                                </bs-button>
                            </bs-tooltip>
                        </router-link>

                        <bs-tooltip
                            content="Guardar cliente"
                            placement="bottom"
                        >
                            <bs-button
                                mode="icon"
                                icon="save"
                                icon-size="sm"
                                color="success"
                                @click="guardarActualizar()"
                            >
                            </bs-button>
                        </bs-tooltip>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <bs-appbar class="bg-indigo rounded-top">
                    <bs-appbar-title
                        title="Factura de Compra"
                        class="text-white"
                    >
                    </bs-appbar-title>
                    <!-- <bs-spacer></bs-spacer> -->
                </bs-appbar>
                <bs-tabs v-model="activeTab" variant="modern" color="indigo">
                    <bs-tab label="Datos de la Factura" icon="money-bill-alt">
                        <datos-factura-compra></datos-factura-compra>
                    </bs-tab>
                    <bs-tab label="Selección de Productos" icon="cart-plus">
                        <seleccionar-producto> </seleccionar-producto>
                    </bs-tab>
                    <bs-tab label="Formas de Pago" icon="credit-card">
                        <forma-de-pago-factura> </forma-de-pago-factura>
                    </bs-tab>
                </bs-tabs>
            </bs-card>
        </div>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
import ListarCompraCabecera from './ListarCompraCabecera.vue';
import ListarProducto from '../../Inventario/Producto/ListarProducto.vue';

export default {
  components: { ListarCompraCabecera, ListarProducto },
    mixins: [validationMixin],
    data: function() {
        return {
            activeTab: 0,
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres."

            //Objeto para almacenar el arreglo de cada combobox
        };
    },

    mounted: function() {
        this.prefijo = prefix;
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
        //Metodo para validar el campo nombre
    },

    methods: {
        showNotificationProgress(title, message, icon) {
            let options = {
                message: message,
                progressBar: true,
                progressBarValue: null,
                timeout: 5000
            };
            this.$notification[icon](options, title);
        }
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;

    .btn {
        margin-bottom: 16px;
        margin-right: 8px;
    }
}
</style>
