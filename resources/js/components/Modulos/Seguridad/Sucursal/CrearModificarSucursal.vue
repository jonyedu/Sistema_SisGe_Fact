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
                                            '/modulos/seguridad/sucursal/mostrar_sucursal'
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
                                    content="Guardar Sucursal"
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
                            >Mantenimiento de sucursal</bs-card-header
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
                                                v-model="sucursalForm.nombre"
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
                                                v-model="sucursalForm.telefono"
                                                :external-validator="
                                                    telefonoValidator
                                                "
                                            >
                                                <label>Telefono</label>
                                            </bs-text-field>
                                            <bs-combobox
                                                prepend-icon-outer="user"
                                                v-model="
                                                    sucursalForm.empresa_id
                                                "
                                                :data-source="cmb.empresas"
                                                floating-label
                                                outlined
                                                clear-button
                                                :external-validator="
                                                    empresaValidator
                                                "
                                            >
                                                <label>Empresa</label>
                                            </bs-combobox>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="sucursalForm.email"
                                                :external-validator="
                                                    emailValidator
                                                "
                                            >
                                                <label>Email</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="sucursalForm.direccion"
                                                :external-validator="
                                                    direccionValidator
                                                "
                                            >
                                                <label>Dirección</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="sucursalForm.direccion"
                                            >
                                                <label>Administrador</label>
                                            </bs-text-field>
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
import { required, email} from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";
const sucursalValidator = {
    nombre: { required },
    telefono: { required },
    empresa_id: { required },
    email: { required, email },
    direccion: { required },
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
            sucursalForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        sucursal_id: "",
                        nombre: "",
                        telefono: "",
                        empresa_id: "",
                        email: "",
                        direccion: "",
                        administrador: "",

                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/seguridad/sucursal/guardar_sucursal",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/seguridad/sucursal/modificar_sucursal",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
             //Objeto para almacenar el arreglo de cada combobox
            cmb: {
                //Combo Grupo
                empresas: {
                    proxy: new BsStore({
                        idProperty: "Empresa_Id",
                        dataProperty: "empresas",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/seguridad/empresa/cargar_empresa_combo_box"
                        }
                    }),
                    schema: {
                        displayField: "Empresa_Nombre",
                        valueField: "Empresa_Id"
                    }
                },
            },
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            emailErrorMsg: "Por favor ingrese una dirección de correo electrónico válida.",
        };
    },
    validations: {
        sucursalForm: sucursalValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getSucursal != null) {
            var sucursal = this.$store.getters.getSucursal;
            this.sucursalForm.sucursal_id = sucursal.Sucursal_Id;
            this.sucursalForm.nombre = sucursal.Sucursal_Nombre;
            this.sucursalForm.telefono = sucursal.Sucursal_Telefonos;
            this.sucursalForm.empresa_id = sucursal.Empresa_Id;
            this.sucursalForm.email = sucursal.Sucursal_EMail;
            this.sucursalForm.direccion = sucursal.Sucursal_Direccion;
            this.sucursalForm.administrador = sucursal.Sucursal_Administrador;
        }
    },
    beforeDestroy: function() {
        this.$store.state.sucursal = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        nombreValidator() {
            return {
                hasError: this.$v.sucursalForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.sucursalForm.nombre.$dirty,
                validators: {
                    required: this.$v.sucursalForm.nombre.required,
                }
            };
        },
        telefonoValidator() {
            return {
                hasError: this.$v.sucursalForm.telefono.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.sucursalForm.telefono.$dirty,
                validators: {
                    required: this.$v.sucursalForm.telefono.required
                }
            };
        },
        empresaValidator() {
            return {
                hasError: this.$v.sucursalForm.empresa_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.sucursalForm.empresa_id.$dirty,
                validators: {
                    required: this.$v.sucursalForm.empresa_id.required
                }
            };
        },
        emailValidator() {
            return {
                hasError: this.$v.sucursalForm.email.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    email: this.emailErrorMsg
                },
                dirty: this.$v.sucursalForm.email.$dirty,
                validators: {
                    required: this.$v.sucursalForm.email.required,
                    email: this.$v.sucursalForm.email.email
                }
            };
        },
        direccionValidator() {
            return {
                hasError: this.$v.sucursalForm.direccion.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.sucursalForm.direccion.$dirty,
                validators: {
                    required: this.$v.sucursalForm.direccion.required
                }
            };
        },
    },

    methods: {
        guardarActualizar() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getSucursal != null) {
                    this.sucursalForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Sucursal modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarSucursal",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.sucursalForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Sucursal creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarSucursal",
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
            this.sucursalForm.reset();
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
