<template>
      <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
      <bs-appbar class="bg-indigo rounded-top">

        <bs-appbar-title
          title="Facturación"
          class="text-white">
        </bs-appbar-title>
        <bs-spacer></bs-spacer>

      </bs-appbar>
      <bs-tabs
        v-model="activeTab"
        variant="modern"
        color="indigo">
        <bs-tab label="Selección de Productos" icon="cart-plus">
        <inventario-producto>
        </inventario-producto>

        </bs-tab>
        <bs-tab label="Datos de Facturación" icon="money-bill-alt">
                    <div class="form-group">
                                             <bs-text-field


                                                prepend-icon="address-book"
                                                floating-label
                                                autofocus
                                                required>
                                                <label>Cédula de Identidad </label>
                                                </bs-text-field>
                                             <bs-switch

                                                        color="primary"
                                                        label-position="left"
                                                        label-class="col-md-4 ml-3"
                                                    >
                                                       S/c
                                                    </bs-switch>
                                                <bs-text-field


                                                prepend-icon="address-book"
                                                floating-label
                                                autofocus
                                                required>
                                                <label>Nombres </label>
                                                </bs-text-field>
                                                <bs-text-field
                                                prepend-icon="address-book"
                                                floating-label
                                                autofocus
                                                required>
                                                <label>Apellidos</label>
                                                </bs-text-field>
                                                <bs-text-field
                                                prepend-icon="phone-alt"
                                                floating-label
                                                autofocus
                                                required>
                                                <label>Teléfono</label>
                                                </bs-text-field>
                                                <bs-text-field
                                                prepend-icon="map-marker-alt"
                                                floating-label
                                                autofocus
                                                required>
                                                <label>Dirección</label>
                                                </bs-text-field>
                                                <bs-text-field
                                                prepend-icon="mail-bulk"
                                                floating-label
                                                autofocus
                                                required>
                                                <label>Correo Electronico</label>
                                                </bs-text-field>
                                                </div>
        </bs-tab>
        <bs-tab label="Formas de Pago" icon="credit-card">

        </bs-tab>
      </bs-tabs>
    </bs-card>
        </div>

        </div>
    </div>
</template>



<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

 ;
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            activeTab:0,
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres.",

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
        },

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
