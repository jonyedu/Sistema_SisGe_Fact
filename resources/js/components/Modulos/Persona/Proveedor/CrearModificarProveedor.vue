<template>
    <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 offset-lg-12">
                    <bs-card shadow>
                        <bs-card-body>
                            <bs-card-content class="text-right">
                                <router-link
                                    :to="
                                        $store.state.url_prefix +
                                            '/modulos/persona/proveedor/mostrar_proveedor'
                                    "
                                >
                                    <bs-tooltip
                                        content="Volver hacia atras"
                                        placement="bottom"
                                    >
                                        <bs-button
                                            mode="icon"
                                            icon="list"
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
                            >Mantenimiento de proveedor</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <form ref="myform" novalidate>
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="proveedorForm.nombre"
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
                                                v-model="proveedorForm.apellido"
                                                :external-validator="
                                                    nombreValidator
                                                "
                                            >
                                                <label>Apellido</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="
                                                    proveedorForm.razon_social
                                                "
                                                :external-validator="
                                                    representanteValidator
                                                "
                                            >
                                                <label>Razón Social</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="proveedorForm.ruc"
                                                :external-validator="
                                                    rucValidator
                                                "
                                            >
                                                <label>Ruc</label>
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
                                                    proveedorForm.direccion
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
                                                v-model="proveedorForm.telefono"
                                                :external-validator="
                                                    telefonoValidator
                                                "
                                            >
                                                <label>Teléfono</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="phone-square-alt"
                                                floating-label
                                                outlined
                                                v-model="proveedorForm.cedula"
                                                :external-validator="
                                                    cedulaValidator
                                                "
                                            >
                                                <label>Cédula</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="phone-square-alt"
                                                floating-label
                                                outlined
                                                v-model="proveedorForm.correo"
                                                :external-validator="
                                                    correoValidator
                                                "
                                            >
                                                <label>Correo</label>
                                            </bs-text-field>
                                        </div>
                                    </div>
                                </form>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                </div>
            </div>
  
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength, email } from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";

const proveedorValidator = {
    nombre: { required, minLength: minLength(5) },
    razon_social: { required, minLength: minLength(5) },
    direccion: { required, minLength: minLength(5) },
    telefono: { required, minLength: minLength(5) },
    cedula: { required, minLength: minLength(10), maxLength: maxLength(10) },
    ruc: { required, minLength: minLength(13), maxLength: maxLength(13) },
    correo: { required, email},
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //variable que controla el progreso
            showLoader: false,
            //Objeto donde tendrá todas las variables del formulario
            proveedorForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        proveedor_id: 0,
                        codigo: "",
                        nombre: "",
                        apellido: "",
                        razon_social: "",
                        direccion: "",
                        telefono: "",
                        cedula: "",
                        ruc: "",
                        estado: false,
                        correo: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url: this.$store.state.url_prefix +
                                "/modulos/persona/proveedor/guardar_modificar_proveedor",
                            method: "post"
                        },
                        update: {
                            url: this.$store.state.url_prefix +
                                "/modulos/persona/proveedor/guardar_modificar_proveedor",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 10 caracteres.",
            maxLengthErrorMsg: "Este campo debe tener al menos 10 caracteres.",
            emailErrorMsg: "Por favor ingrese una dirección de correo electrónico válida.",

            //Objeto para almacenar el arreglo de cada combobox
        };
    },
    validations: {
        proveedorForm: proveedorValidator
    },

    mounted: function() {
        if (this.$store.getters.getProveedor != null) {
            var proveedor = this.$store.getters.getProveedor;
            this.proveedorForm.proveedor_id = proveedor.id;
            this.proveedorForm.codigo = proveedor.codigo;
            this.proveedorForm.nombre = proveedor.nombre;
            this.proveedorForm.apellido = proveedor.apellido;
            this.proveedorForm.razon_social = proveedor.razon_social;
            this.proveedorForm.direccion = proveedor.direccion;
            this.proveedorForm.telefono = proveedor.telefono;
            this.proveedorForm.cedula = proveedor.cedula;
            this.proveedorForm.ruc = proveedor.ruc;
            this.proveedorForm.correo = proveedor.correo;
            this.proveedorForm.estado = Boolean(proveedor.estado);
        }
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
        nombreValidator() {
            return {
                hasError: this.$v.proveedorForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.proveedorForm.nombre.$dirty,
                validators: {
                    required: this.$v.proveedorForm.nombre.required,
                    minLength: this.$v.proveedorForm.nombre.minLength
                }
            };
        },
        representanteValidator() {
            return {
                hasError: this.$v.proveedorForm.razon_social.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.proveedorForm.razon_social.$dirty,
                validators: {
                    required: this.$v.proveedorForm.razon_social.required,
                    minLength: this.$v.proveedorForm.razon_social.minLength
                }
            };
        },
        direccionValidator() {
            return {
                hasError: this.$v.proveedorForm.direccion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.proveedorForm.direccion.$dirty,
                validators: {
                    required: this.$v.proveedorForm.direccion.required,
                    minLength: this.$v.proveedorForm.direccion.minLength
                }
            };
        },
        telefonoValidator() {
            return {
                hasError: this.$v.proveedorForm.telefono.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.proveedorForm.telefono.$dirty,
                validators: {
                    required: this.$v.proveedorForm.telefono.required,
                    minLength: this.$v.proveedorForm.telefono.minLength
                }
            };
        },
        cedulaValidator() {
            return {
                hasError: this.$v.proveedorForm.cedula.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg,
                    maxLength: this.maxLengthErrorMsg
                },
                dirty: this.$v.proveedorForm.cedula.$dirty,
                validators: {
                    required: this.$v.proveedorForm.cedula.required,
                    minLength: this.$v.proveedorForm.cedula.minLength,
                    maxLength: this.$v.proveedorForm.cedula.maxLength
                }
            };
        },
        rucValidator() {
            return {
                hasError: this.$v.proveedorForm.ruc.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg,
                    maxLength: this.maxLengthErrorMsg
                },
                dirty: this.$v.proveedorForm.ruc.$dirty,
                validators: {
                    required: this.$v.proveedorForm.ruc.required,
                    minLength: this.$v.proveedorForm.ruc.minLength,
                    maxLength: this.$v.proveedorForm.ruc.maxLength
                }
            };
        },
        correoValidator() {
            return {
                hasError: this.$v.proveedorForm.correo.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    email: this.emailErrorMsg
                },
                dirty: this.$v.proveedorForm.correo.$dirty,
                validators: {
                    required: this.$v.proveedorForm.correo.required,
                    email: this.$v.proveedorForm.correo.email
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
                if (this.$store.getters.getProveedor != null) {
                    this.proveedorForm
                        .update()
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
                    this.proveedorForm
                        .save()
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
            this.proveedorForm.reset();
            this.$v.$reset();
        }
    }
};
</script>
