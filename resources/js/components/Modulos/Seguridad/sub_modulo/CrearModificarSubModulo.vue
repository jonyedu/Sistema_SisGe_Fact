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
                                            '/modulos/seguridad/sub_modulo/mostrar_sub_modulo'
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
                                    content="Guardar Sub modulo"
                                    placement="bottom"
                                >
                                    <bs-button
                                        mode="icon"
                                        icon="save"
                                        icon-size="sm"
                                        color="success"
                                        @click="guardarActualizarSubModulo()"
                                    >
                                    </bs-button>
                                </bs-tooltip>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de sub modulo</bs-card-header
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
                                                v-model="
                                                    subModuloForm.empresa_id
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
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="
                                                    subModuloForm.descripcion
                                                "
                                                :external-validator="
                                                    descripcionValidator
                                                "
                                            >
                                                <label>Descripción</label>
                                            </bs-text-field>
                                            <bs-combobox
                                                prepend-icon-outer="user"
                                                v-model="
                                                    subModuloForm.modulo_id
                                                "
                                                :data-source="cmb.modulos"
                                                floating-label
                                                outlined
                                                clear-button
                                                :external-validator="
                                                    moduloValidator
                                                "
                                            >
                                                <label>Modulo</label>
                                            </bs-combobox>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-combobox
                                                prepend-icon-outer="user"
                                                v-model="
                                                    subModuloForm.sucursal_id
                                                "
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
                                                v-model="subModuloForm.imagen"
                                                :external-validator="
                                                    imagenValidator
                                                "
                                            >
                                                <label>Imagen</label>
                                            </bs-text-field>
                                            <bs-text-area
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="subModuloForm.ruta"
                                            >
                                                <label>Ruta</label>
                                            </bs-text-area>
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
import { required } from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";
const moduloValidator = {
    empresa_id: { required },
    sucursal_id: { required },
    modulo_id: { required },
    descripcion: { required },
    imagen: { required },
    ruta: { required },
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
            subModuloForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        sub_modulo_id: "",
                        modulo_id: "",
                        empresa_id: "",
                        sucursal_id: "",
                        descripcion: "",
                        imagen: "",
                        ruta: ""
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url: "/modulos/seguridad/sub_modulo/guardar_sub_modulo",
                            method: "post"
                        },
                        update: {
                            url: "/modulos/seguridad/sub_modulo/modificar_sub_modulo",
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
                    schema: {
                        displayField: "Empresa_Nombre",
                        valueField: "Empresa_Id"
                    }
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
                    schema: {
                        displayField: "Sucursal_Nombre",
                        valueField: "Sucursal_Id"
                    }
                },
                modulos: {
                    proxy: new BsStore({
                        idProperty: "codigo",
                        dataProperty: "modulos",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/seguridad/modulo/cargar_modulo_combo_box"
                        }
                    }),
                    schema: {
                        displayField: "descripcion",
                        valueField: "codigo"
                    }
                },
            }
        };
    },
    validations: {
        subModuloForm: moduloValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getSubModulo != null) {
            var modulo = this.$store.getters.getSubModulo;
            this.subModuloForm.sub_modulo_id = modulo.codigo;
            this.subModuloForm.empresa_id = modulo.empresa;
            this.subModuloForm.sucursal_id = modulo.sucursal;
            this.subModuloForm.descripcion = modulo.descripcion;
            this.subModuloForm.imagen = modulo.imagen;
            this.subModuloForm.modulo_id = modulo.modulo;
            this.subModuloForm.ruta = modulo.route;
        }
    },
    beforeDestroy: function() {
        this.$store.state.subModulo = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        empresaValidator() {
            return {
                hasError: this.$v.subModuloForm.empresa_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.subModuloForm.empresa_id.$dirty,
                validators: {
                    required: this.$v.subModuloForm.empresa_id.required
                }
            };
        },
        sucursalValidator() {
            return {
                hasError: this.$v.subModuloForm.sucursal_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.subModuloForm.sucursal_id.$dirty,
                validators: {
                    required: this.$v.subModuloForm.sucursal_id.required
                }
            };
        },
        moduloValidator() {
            return {
                hasError: this.$v.subModuloForm.modulo_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.subModuloForm.modulo_id.$dirty,
                validators: {
                    required: this.$v.subModuloForm.modulo_id.required
                }
            };
        },
        descripcionValidator() {
            return {
                hasError: this.$v.subModuloForm.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.subModuloForm.descripcion.$dirty,
                validators: {
                    required: this.$v.subModuloForm.descripcion.required
                }
            };
        },
        imagenValidator() {
            return {
                hasError: this.$v.subModuloForm.imagen.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.subModuloForm.imagen.$dirty,
                validators: {
                    required: this.$v.subModuloForm.imagen.required
                }
            };
        },
        rutaValidator() {
            return {
                hasError: this.$v.subModuloForm.ruta.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.subModuloForm.ruta.$dirty,
                validators: {
                    required: this.$v.subModuloForm.ruta.required
                }
            };
        },
    },

    methods: {
        guardarActualizarSubModulo() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getSubModulo != null) {
                    this.subModuloForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Sub Modulo modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarSubModulo",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.subModuloForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Sub Modulo creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarSubModulo",
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
            this.subModuloForm.reset();
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
