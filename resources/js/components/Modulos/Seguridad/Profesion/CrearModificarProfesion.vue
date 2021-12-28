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
                                            '/modulos/seguridad/profesion/mostrar_profesion'
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
                            >Mantenimiento de profesion</bs-card-header
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
                                                v-model="profesionForm.descripcion"
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
 
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required} from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";
import {BsStore} from "vue-mdbootstrap";


const profesionValidator = {
    descripcion: { required},

};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //variable que controla el progreso
            showLoader: false,
            //Objeto donde tendrá todas las variables del formulario
            profesionForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        profesion_id: 0,
                        descripcion: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url: this.$store.state.url_prefix +
                                "/modulos/seguridad/profesion/guardar_profesion",
                            method: "post"
                        },
                        update: {
                            url: this.$store.state.url_prefix +
                                "/modulos/seguridad/profesion/modificar_profesion",
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
        profesionForm: profesionValidator
    },

    mounted: function() {
        if (this.$store.getters.getProfesion != null) {
            var profesion = this.$store.getters.getProfesion;
            this.profesionForm.profesion_id = profesion.codigo;
            this.profesionForm.descripcion = profesion.descripcion;
        }
    },
    beforeDestroy: function() {
        this.$store.state.profesion = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        descripcionValidator() {
            return {
                hasError: this.$v.profesionForm.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.profesionForm.descripcion.$dirty,
                validators: {
                    required: this.$v.profesionForm.descripcion.required,
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
                if (this.$store.getters.getProfesion != null) {
                    this.profesionForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "profesion modificado correctamente.",
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
                    this.profesionForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "profesion creado correctamente.",
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
            this.profesionForm.reset();
            this.$v.$reset();
        }
    }
};
</script>
