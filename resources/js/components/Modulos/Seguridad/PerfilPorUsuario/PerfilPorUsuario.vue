<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <bs-tooltip content="Actualizar" placement="bottom">
                            <bs-button
                                mode="icon"
                                icon="save"
                                icon-size="sm"
                                color="success"
                                @click="actualizarPerfilPorUsuario()"
                            >
                            </bs-button>
                        </bs-tooltip>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content>
                        <form ref="myform" novalidate>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <bs-combobox
                                        prepend-icon-outer="user"
                                        v-model="
                                            configurarPermisoForm.modulo_id
                                        "
                                        :data-source="cmb.modulos"
                                        floating-label
                                        outlined
                                        clear-button
                                        :external-validator="moduloValidator"
                                        @change="cargarPerfilPorUsuario()"
                                    >
                                        <label>Modulo</label>
                                    </bs-combobox>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <bs-combobox
                                        prepend-icon-outer="user"
                                        v-model="
                                            configurarPermisoForm.perfil_id
                                        "
                                        :data-source="cmb.perfiles"
                                        floating-label
                                        outlined
                                        clear-button
                                        :external-validator="perfilValidator"
                                        @change="cargarPerfilPorUsuario()"
                                    >
                                        <label>Perfil</label>
                                    </bs-combobox>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                                    <div class="ex-lib">
                                        <vue-select-sides
                                            type="mirror"
                                            order-by="asc"
                                            v-model="
                                                configurarPermisoForm.selectedPerfilPorModulo
                                            "
                                            :list="
                                                configurarPermisoForm.subModulos
                                            "
                                        ></vue-select-sides>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
        </div>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";
import {BsStore} from "vue-mdbootstrap";

const configurarPermisoValidator = {
    modulo_id: { required },
    perfil_id: { required }
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //variable que controla el progreso
            showLoader: false,
            //Objeto donde tendrá todas las variables del formulario
            configurarPermisoForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        modulo_id: "",
                        perfil_id: "",
                        selectedPerfilPorModulo: [],
                        subModulos: []
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        update: {
                            url: this.$store.state.url_prefix +
                                "/modulos/seguridad/perfil_por_usuario/actualizar_perfil_por_usuario",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Objeto para almacenar el arreglo de cada combobox
            cmb: {
                modulos: {
                    proxy: new BsStore({
                        idProperty: "codigo",
                        dataProperty: "modulos",
                        remoteSort: false,
                        restProxy: {
                            browse: this.$store.state.url_prefix +
                                "/modulos/seguridad/modulo/cargar_modulo_combo_box"
                        }
                    }),
                    schema: {
                        displayField: "descripcion",
                        valueField: "codigo"
                    }
                },
                perfiles: {
                    proxy: new BsStore({
                        idProperty: "codigo",
                        dataProperty: "perfiles",
                        remoteSort: false,
                        restProxy: {
                            browse: this.$store.state.url_prefix +
                                "/modulos/seguridad/perfil/cargar_perfil_combo_box"
                        }
                    }),
                    schema: {
                        displayField: "descripcion",
                        valueField: "codigo"
                    }
                }
            },
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio."
        };
    },
    validations: {
        configurarPermisoForm: configurarPermisoValidator
    },
    mounted: function() {
    },
    computed: {
        moduloValidator() {
            return {
                hasError: this.$v.configurarPermisoForm.modulo_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.configurarPermisoForm.modulo_id.$dirty,
                validators: {
                    required: this.$v.configurarPermisoForm.modulo_id.required
                }
            };
        },
        perfilValidator() {
            return {
                hasError: this.$v.configurarPermisoForm.perfil_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.configurarPermisoForm.perfil_id.$dirty,
                validators: {
                    required: this.$v.configurarPermisoForm.perfil_id.required
                }
            };
        }
    },
    beforeDestroy: function() {},
    methods: {
        cargarPerfilPorUsuario() {
            if (
                this.configurarPermisoForm.modulo_id != "" &&
                this.configurarPermisoForm.perfil_id != ""
            ) {
                let that = this;
                let url = this.$store.state.url_prefix +
                    "/modulos/seguridad/perfil_por_usuario/cargar_perfil_por_usuario/" +
                    this.configurarPermisoForm.modulo_id +
                    "/" +
                    this.configurarPermisoForm.perfil_id;
                this.showLoader = true;
                axios
                    .get(url)
                    .then(function(response) {
                        //Me carga todos los submenus en la parte izquierda
                        let subModulos = [];
                        for (
                            let i = 0;
                            i < response.data.subModulos.length;
                            i++
                        ) {
                            let objeto = {
                                value: response.data.subModulos[i].codigo,
                                label: that.$funcionesGlobales.toCapitalFirstAllWords(
                                    response.data.subModulos[i].descripcion
                                )
                            };
                            subModulos.push(objeto);
                        }
                        that.configurarPermisoForm.subModulos = subModulos;

                        //Solo me muestra los submenus que estan guardados en la tabla opcion por perfil
                        let perfilPorUsuarios = [];
                        for (
                            let i = 0;
                            i < response.data.perfilPorUsuarios.length;
                            i++
                        ) {
                            perfilPorUsuarios.push(
                                response.data.perfilPorUsuarios[i].sub_modulo
                                    .codigo
                            );
                        }
                        that.configurarPermisoForm.selectedPerfilPorModulo = perfilPorUsuarios;
                        that.showLoader = false;
                    })
                    .catch(error => {
                        that.showLoader = false;
                        that.showNotificationProgress(
                            "Error al procesar cargarPerfilPorUsuario",
                            "Por favor comuníquese con el administrador. " +
                                error,
                            "error"
                        );
                    });
            }
        },
        actualizarPerfilPorUsuario1() {
            let that = this;
            let url = this.$store.state.url_prefix +
                "/modulos/seguridad/perfil_por_usuario/actualizar_perfil_por_usuario";
            this.showLoader = true;
            axios
                .post(url, this.configurarPermisoForm)
                .then(function(response) {
                    //Llamar metodo de parent para que actualice el grid.
                    that.showLoader = false;
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Datos actualizados correctamente.",
                        "success"
                    );
                })
                .catch(error => {
                    that.showLoader = false;
                    that.showNotificationProgress(
                        "Error al procesar actualizarPerfilPorUsuario",
                        "Por favor comuníquese con el administrador. " + error,
                        "error"
                    );
                });
        },
        actualizarPerfilPorUsuario() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                this.configurarPermisoForm
                    .update()
                    .then(function(response) {
                        that.showLoader = false;
                        that.showNotificationProgress(
                            "Exito al Procesar",
                            "Sub Modulo modificado correctamente.",
                            "success"
                        );
                    })
                    .catch(function(error) {
                        that.showLoader = false;
                        that.showNotificationProgress(
                            "Error en actualizarPerfilPorUsuario",
                            "Por favor comuníquese con el administrador. " +
                                error,
                            "error"
                        );
                    });
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
        }
    }
};
</script>
