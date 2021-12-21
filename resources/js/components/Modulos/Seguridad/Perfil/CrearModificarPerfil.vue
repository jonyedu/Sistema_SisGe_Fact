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
                                            '/modulos/seguridad/perfil/mostrar_perfil'
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
                                    content="Guardar perfi"
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
                            >Mantenimiento de Perfil</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <form ref="myform" novalidate>
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                style="margin: auto"
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="perfilForm.descripcion"
                                                :external-validator="
                                                    descripcionValidator
                                                "
                                            >
                                                <label>Descripción</label>
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
const perfilValidator = {
    descripcion: { required},

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
            perfilForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        perfil_id: 0,
                        descripcion: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/seguridad/perfil/guardar_perfil",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/seguridad/perfil/modificar_perfil",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
        };
    },
    validations: {
        perfilForm: perfilValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getPerfil != null) {
            var perfil = this.$store.getters.getPerfil;
            this.perfilForm.perfil_id = perfil.codigo;
            this.perfilForm.descripcion = perfil.descripcion;
        }
    },
    beforeDestroy: function() {
        this.$store.state.perfil = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        descripcionValidator() {
            return {
                hasError: this.$v.perfilForm.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.perfilForm.descripcion.$dirty,
                validators: {
                    required: this.$v.perfilForm.descripcion.required,
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
                if (this.$store.getters.getPerfil != null) {
                    this.perfilForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Perfil modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizar",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.perfilForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Perfil creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizar",
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
            this.perfilForm.reset();
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
