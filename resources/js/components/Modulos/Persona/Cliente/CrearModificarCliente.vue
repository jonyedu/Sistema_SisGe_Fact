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
                                            '/modulos/persona/cliente/mostrar_cliente'
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
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de cliente</bs-card-header
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
                                                v-model="clienteForm.nombre"
                                                :external-validator="
                                                    nombreValidator
                                                "
                                            >
                                                <label>Nombre</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="clienteForm.cedula"
                                                :external-validator="
                                                    cedulaValidator
                                                "
                                            >
                                                <label>Cédula</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="clienteForm.direccion"
                                                :external-validator="
                                                    direccionValidator
                                                "
                                            >
                                                <label>Dirección</label>
                                            </bs-text-field>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="clienteForm.apellido"
                                                :external-validator="
                                                    direccionValidator
                                                "
                                            >
                                                <label>Apellido</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="address-card"
                                                floating-label
                                                outlined
                                                v-model="
                                                    clienteForm.telefono
                                                "
                                                :external-validator="
                                                    telefonoValidator
                                                "
                                            >
                                                <label>Telefono</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="phone-square-alt"
                                                floating-label
                                                outlined
                                                v-model="clienteForm.correo"
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
import { required, email } from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";

const clienteValidator = {
    nombre: { required},
    cedula: { required},
    direccion: { required},
    apellido: { required},
    telefono: { required},
    correo: { required, email},
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //variable que controla el progreso
            showLoader: false,
            //Objeto donde tendrá todas las variables del formulario
            clienteForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        cliente_id: 0,
                        nombre: "",
                        cedula: "",
                        direccion: "",
                        apellido: "",
                        telefono: "",
                        correo: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url: this.$store.state.url_prefix +
                                "/modulos/persona/cliente/guardar_modificar_cliente",
                            method: "post"
                        },
                        update: {
                            url: this.$store.state.url_prefix +
                                "/modulos/persona/cliente/guardar_modificar_cliente",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            emailErrorMsg: "Por favor ingrese una dirección de correo electrónico válida.",
        };
    },
    validations: {
        clienteForm: clienteValidator
    },

    mounted: function() {
        if (this.$store.getters.getCliente != null) {
            var cliente = this.$store.getters.getCliente;
            this.clienteForm.cliente_id = cliente.cliente_id;
            this.clienteForm.nombre = cliente.nombres;
            this.clienteForm.apellido = cliente.apellidos;
            this.clienteForm.cedula = cliente.cedula;
            this.clienteForm.telefono = cliente.telefono;
            this.clienteForm.direccion = cliente.direccion;
            this.clienteForm.correo = cliente.correo;
        }
    },
    beforeDestroy: function() {
        this.$store.state.cliente = null;
    },
    computed: {
        nombreValidator() {
            return {
                hasError: this.$v.clienteForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.clienteForm.nombre.$dirty,
                validators: {
                    required: this.$v.clienteForm.nombre.required,
                }
            };
        },
        cedulaValidator() {
            return {
                hasError: this.$v.clienteForm.cedula.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.clienteForm.cedula.$dirty,
                validators: {
                    required: this.$v.clienteForm.cedula.required,
                }
            };
        },
        direccionValidator() {
            return {
                hasError: this.$v.clienteForm.direccion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.clienteForm.direccion.$dirty,
                validators: {
                    required: this.$v.clienteForm.direccion.required,
                }
            };
        },
        apellidoValidator() {
            return {
                hasError: this.$v.clienteForm.apellido.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.clienteForm.apellido.$dirty,
                validators: {
                    required: this.$v.clienteForm.apellido.required,
                }
            };
        },
        telefonoValidator() {
            return {
                hasError: this.$v.clienteForm.telefono.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.clienteForm.telefono.$dirty,
                validators: {
                    required: this.$v.clienteForm.telefono.required,
                }
            };
        },
        correoValidator() {
            return {
                hasError: this.$v.clienteForm.correo.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    email: this.emailErrorMsg
                },
                dirty: this.$v.clienteForm.correo.$dirty,
                validators: {
                    required: this.$v.clienteForm.correo.required,
                    email: this.$v.clienteForm.correo.email
                }
            };
        }
    },

    methods: {
        guardarActualizar() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getCliente != null) {
                    this.clienteForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "cliente modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizar",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.clienteForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "cliente creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizar",
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
            this.clienteForm.reset();
            this.$v.$reset();
        }
    }
};
</script>

