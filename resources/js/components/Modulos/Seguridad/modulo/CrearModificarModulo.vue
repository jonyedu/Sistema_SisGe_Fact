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
                                            '/modulos/seguridad/modulo/mostrar_modulo'
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
                                    content="Guardar modulo"
                                    placement="bottom"
                                >
                                    <bs-button
                                        mode="icon"
                                        icon="save"
                                        icon-size="sm"
                                        color="success"
                                        @click="guardarActualizarModulo()"
                                    >
                                    </bs-button>
                                </bs-tooltip>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de modulo</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <form ref="myform" novalidate>
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-combobox
                                                prepend-icon-outer="user"
                                                v-model="moduloForm.empresa_id"
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
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="moduloForm.descripcion"
                                                :external-validator="
                                                    descripcionValidator
                                                "
                                            >
                                                <label>Descripción</label>
                                            </bs-text-field>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-combobox
                                                prepend-icon-outer="user"
                                                v-model="moduloForm.sucursal_id"
                                                :data-source="cmb.sucursales"
                                                floating-label
                                                outlined
                                                clear-button
                                                :external-validator="
                                                    sucursalValidator
                                                "
                                            >
                                                <label>Sucursal</label>
                                            </bs-combobox>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="moduloForm.imagen"
                                                :external-validator="
                                                    imagenValidator
                                                "
                                            >
                                                <label>Imagen</label>
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
import { required} from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";
import {BsStore} from "vue-mdbootstrap";

const moduloValidator = {
    empresa_id: { required },
    sucursal_id: { required },
    descripcion: { required},
    imagen: { required },

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
            moduloForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        modulo_id: 0,
                        empresa_id: "",
                        sucursal_id: "",
                        descripcion: "",
                        imagen: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/seguridad/modulo/guardar_modulo",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/seguridad/modulo/modificar_modulo",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",

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
                    schema: { displayField: "Empresa_Nombre", valueField: "Empresa_Id" }
                },
                //Combo Laboratorio
                sucursales: {
                    proxy: new BsStore({
                        idProperty: "Sucursal_Id",
                        dataProperty: "sucursales",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/seguridad/sucursal/cargar_sucursal_combo_box"
                        }
                    }),
                    schema: { displayField: "Sucursal_Nombre", valueField: "Sucursal_Id" }
                }
            }
        };
    },
    validations: {
        moduloForm: moduloValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getModulo != null) {
            var modulo = this.$store.getters.getModulo;
            this.moduloForm.modulo_id = modulo.codigo;
            this.moduloForm.empresa_id = modulo.empresa;
            this.moduloForm.sucursal_id = modulo.sucursal;
            this.moduloForm.descripcion = modulo.descripcion;
            this.moduloForm.imagen = modulo.imagen;
        }
    },
    beforeDestroy: function() {
        this.$store.state.modulo = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        empresaValidator() {
            return {
                hasError: this.$v.moduloForm.empresa_id.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.moduloForm.empresa_id.$dirty,
                validators: {
                    required: this.$v.moduloForm.empresa_id.required,
                }
            };
        },
        sucursalValidator() {
            return {
                hasError: this.$v.moduloForm.sucursal_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.moduloForm.sucursal_id.$dirty,
                validators: {
                    required: this.$v.moduloForm.sucursal_id.required
                }
            };
        },
        descripcionValidator() {
            return {
                hasError: this.$v.moduloForm.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.moduloForm.descripcion.$dirty,
                validators: {
                    required: this.$v.moduloForm.descripcion.required,
                }
            };
        },
        imagenValidator() {
            return {
                hasError: this.$v.moduloForm.imagen.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.moduloForm.imagen.$dirty,
                validators: {
                    required: this.$v.moduloForm.imagen.required
                }
            };
        },
    },

    methods: {
        guardarActualizarModulo() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getModulo != null) {
                    this.moduloForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "modulo modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarModulo",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.moduloForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "modulo creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarModulo",
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
            this.moduloForm.reset();
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
