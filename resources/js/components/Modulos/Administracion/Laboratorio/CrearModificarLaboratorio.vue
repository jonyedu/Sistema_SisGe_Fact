<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <div class="row">
                <div class="col-lg-12 offset-lg-12">
                    <bs-card shadow>
                        <bs-card-body>
                            <bs-card-content class="text-right">
                                <router-link
                                    :to="
                                        prefijo +
                                            '/modulos/administracion/laboratorio/mostrar_laboratorio'
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
                                    content="Guardar producto"
                                    placement="bottom"
                                >
                                    <bs-button
                                        mode="icon"
                                        icon="save"
                                        icon-size="sm"
                                        color="success"
                                        @click="guardarActualizarProducto()"
                                    >
                                    </bs-button>
                                </bs-tooltip>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de laboratorio</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <form ref="myform" novalidate>
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="laboratorioForm.id"
                                            >
                                                <label>Codigo</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="laboratorioForm.nombre"
                                                :external-validator="
                                                    nombreValidator
                                                "
                                            >
                                                <label>Nombre</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="
                                                    laboratorioForm.representante
                                                "
                                                :external-validator="
                                                    representanteValidator
                                                "
                                            >
                                                <label>Representante</label>
                                            </bs-text-field>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="
                                                    laboratorioForm.direccion
                                                "
                                                :external-validator="
                                                    direccionValidator
                                                "
                                            >
                                                <label>Dirección</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="phone-square-alt"
                                                floating-label
                                                outlined
                                                v-model="
                                                    laboratorioForm.telefono
                                                "
                                                :external-validator="
                                                    telefonoValidator
                                                "
                                            >
                                                <label>Teléfono</label>
                                            </bs-text-field>
                                            <bs-switch
                                                class="mt-3"
                                                v-model="laboratorioForm.estado"
                                                color="primary"
                                                label-position="left"
                                                label-class="col-md-4 ml-3"
                                            >
                                                Estado
                                            </bs-switch>
                                        </div>
                                    </div>
                                </form>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                </div>
            </div>
        </div>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

const laboratorioValidator = {
    //laboratorio_id: { required },
    //codigo: { required, minLength: minLength(3) },
    nombre: { required, minLength: minLength(5) },
    representante: { required, minLength: minLength(5) },
    direccion: { required, minLength: minLength(5) },
    telefono: { required, minLength: minLength(5) },
    //estado: { required }
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario
            laboratorioForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        laboratorio_id: 0,
                        codigo: "",
                        nombre: "",
                        representante: "",
                        direccion: "",
                        telefono: "",
                        estado: false
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/administracion/laboratorio/guardar_modificar_laboratorio",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/administracion/laboratorio/guardar_modificar_laboratorio",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres."

            //Objeto para almacenar el arreglo de cada combobox
        };
    },
    validations: {
        laboratorioForm: laboratorioValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getLaboratorio != null) {
            var producto = this.$store.getters.getLaboratorio;
            this.laboratorioForm.laboratorio_id = producto.id;
            this.laboratorioForm.codigo = producto.codigo;
            this.laboratorioForm.nombre = producto.nombre;
            this.laboratorioForm.representante = producto.representante;
            this.laboratorioForm.direccion = producto.direcion;
            this.laboratorioForm.telefono = producto.telefono;
            this.laboratorioForm.estado = Boolean(producto.estado);
        }
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        // codigoValidator() {
        //     return {
        //         hasError: this.$v.laboratorioForm.codigo.$error,
        //         messages: {
        //             required: this.requiredErrorMsg,
        //             minLength: this.minLengthErrorMsg
        //         },
        //         dirty: this.$v.laboratorioForm.codigo.$dirty,
        //         validators: {
        //             required: this.$v.laboratorioForm.codigo.required,
        //             minLength: this.$v.laboratorioForm.codigo.minLength
        //         }
        //     };
        // },
        nombreValidator() {
            return {
                hasError: this.$v.laboratorioForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.laboratorioForm.nombre.$dirty,
                validators: {
                    required: this.$v.laboratorioForm.nombre.required,
                    minLength: this.$v.laboratorioForm.nombre.minLength
                }
            };
        },
        representanteValidator() {
            return {
                hasError: this.$v.laboratorioForm.representante.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.laboratorioForm.representante.$dirty,
                validators: {
                    required: this.$v.laboratorioForm.representante.required,
                    minLength: this.$v.laboratorioForm.representante.minLength
                }
            };
        },
        direccionValidator() {
            return {
                hasError: this.$v.laboratorioForm.direccion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.laboratorioForm.direccion.$dirty,
                validators: {
                    required: this.$v.laboratorioForm.direccion.required,
                    minLength: this.$v.laboratorioForm.direccion.minLength
                }
            };
        },
        telefonoValidator() {
            return {
                hasError: this.$v.laboratorioForm.telefono.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.laboratorioForm.telefono.$dirty,
                validators: {
                    required: this.$v.laboratorioForm.telefono.required,
                    minLength: this.$v.laboratorioForm.telefono.minLength
                }
            };
        }
    },

    methods: {
        guardarActualizarProducto() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getLaboratorio != null) {
                    this.laboratorioForm.update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizarProducto",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.laboratorioForm.save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizarProducto",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                }
            }
        },
        showNotificationProgress(title, message, icon) {
            let options = {
                message: message,
                progressBar: true,
                progressBarValue: null,
                timeout: 5000
            };
            this.$notification[icon](options, title);
        },
        lmpCampos() {
            this.$refs.myform.reset();
            this.laboratorioForm.reset();
            this.$v.$reset();
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
