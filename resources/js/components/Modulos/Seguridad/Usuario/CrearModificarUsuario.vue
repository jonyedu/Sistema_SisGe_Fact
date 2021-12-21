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
                                            '/modulos/seguridad/usuario/mostrar_usuario'
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
                                    content="Guardar usuario"
                                    placement="bottom"
                                >
                                    <bs-button
                                        mode="icon"
                                        icon="save"
                                        icon-size="sm"
                                        color="success"
                                        @click="guardarActualizarUsuario()"
                                    >
                                    </bs-button>
                                </bs-tooltip>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de usuario</bs-card-header
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
                                                v-model="usuarioForm.apellido"
                                                :external-validator="
                                                    apellidoValidator
                                                "
                                            >
                                                <label>Apellido</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="usuarioForm.usuario"
                                                :external-validator="
                                                    usuarioValidator
                                                "
                                            >
                                                <label>Usuario</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="
                                                    usuarioForm.contrasenia
                                                "
                                                :external-validator="
                                                    contraseniaValidator
                                                "
                                                type="password"
                                            >
                                                <label>Contraseña</label>
                                            </bs-text-field>
                                            <bs-combobox
                                                clear-button
                                                prepend-icon-outer="user"
                                                v-model="
                                                    usuarioForm.profesion_id
                                                "
                                                :data-source="cmb.profesiones"
                                                floating-label
                                                outlined
                                                :external-validator="
                                                    profesionValidator
                                                "
                                                minimum-items-for-search="5"
                                            >
                                                <label>Profesión</label>
                                            </bs-combobox>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="usuarioForm.nombre"
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
                                                v-model="usuarioForm.email"
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
                                                v-model="
                                                    usuarioForm.contrasenia_confirmar
                                                "
                                                :external-validator="
                                                    contraseniaConfirmarValidator
                                                "
                                                type="password"
                                            >
                                                <label>Confirmar</label>
                                            </bs-text-field>
                                            <bs-combobox
                                                clear-button
                                                prepend-icon-outer="user"
                                                v-model="usuarioForm.perfil_id"
                                                :data-source="cmb.perfiles"
                                                floating-label
                                                outlined
                                                :external-validator="
                                                    perfilValidator
                                                "
                                            >
                                                <label>Perfil</label>
                                            </bs-combobox>
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
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import {BsModel} from "vue-mdbootstrap";
import {BsStore} from "vue-mdbootstrap";

const usuarioValidator = {
    apellido: { required },
    usuario: { required },
    contrasenia: { required, minLength: minLength(8) },
    profesion_id: { required },
    nombre: { required },
    email: { required, email },
    contrasenia_confirmar: { required, minLength: minLength(8), sameAs: sameAs('contrasenia') },
    perfil_id: { required }
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
            usuarioForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        usuario_id: 0,
                        apellido: "",
                        usuario: "",
                        contrasenia: "",
                        profesion_id: "",
                        nombre: "",
                        email: "",
                        contrasenia_confirmar: "",
                        perfil_id: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/seguridad/usuario/guardar_usuario",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/seguridad/usuario/modificar_usuario",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 8 caracteres.",
            emailErrorMsg: "Por favor ingrese una dirección de correo electrónico válida.",
            contraseniaConfirmarErrorMsg: "Las contraseñas deben ser idénticas.",

            //Objeto para almacenar el arreglo de cada combobox
            cmb: {
                //Combo Grupo
                profesiones: {
                    proxy: new BsStore({
                        idProperty: "codigo",
                        dataProperty: "profesiones",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/seguridad/profesion/cargar_profesion_combo_box"
                        }
                    }),
                    schema: { displayField: "descripcion", valueField: "codigo" }
                },
                //Combo Laboratorio
                perfiles: {
                    proxy: new BsStore({
                        idProperty: "codigo",
                        dataProperty: "perfiles",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/seguridad/perfil/cargar_perfil_combo_box"
                        }
                    }),
                    schema: { displayField: "descripcion", valueField: "codigo" }
                }
            }
        };
    },
    validations: {
        usuarioForm: usuarioValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getUsuario != null) {
            var usuario = this.$store.getters.getUsuario;
            this.usuarioForm.usuario_id = usuario.codigo;
            this.usuarioForm.apellido = usuario.apellido;
            this.usuarioForm.usuario = usuario.usuario;
            this.usuarioForm.profesion_id = usuario.profesion;
            this.usuarioForm.nombre = usuario.nombre;
            this.usuarioForm.email = usuario.email;
            this.usuarioForm.perfil_id = usuario.perfil;
        }
    },
    beforeDestroy: function() {
        this.$store.state.usuario = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        apellidoValidator() {
            return {
                hasError: this.$v.usuarioForm.apellido.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.usuarioForm.apellido.$dirty,
                validators: {
                    required: this.$v.usuarioForm.apellido.required,
                }
            };
        },
        usuarioValidator() {
            return {
                hasError: this.$v.usuarioForm.usuario.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.usuarioForm.usuario.$dirty,
                validators: {
                    required: this.$v.usuarioForm.usuario.required
                }
            };
        },
        contraseniaValidator() {
            return {
                hasError: this.$v.usuarioForm.contrasenia.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.usuarioForm.contrasenia.$dirty,
                validators: {
                    required: this.$v.usuarioForm.contrasenia.required,
                    minLength: this.$v.usuarioForm.contrasenia.minLength
                }
            };
        },
        profesionValidator() {
            return {
                hasError: this.$v.usuarioForm.profesion_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.usuarioForm.profesion_id.$dirty,
                validators: {
                    required: this.$v.usuarioForm.profesion_id.required
                }
            };
        },
        nombreValidator() {
            return {
                hasError: this.$v.usuarioForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.usuarioForm.nombre.$dirty,
                validators: {
                    required: this.$v.usuarioForm.nombre.required
                }
            };
        },
        emailValidator() {
            return {
                hasError: this.$v.usuarioForm.email.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    email: this.emailErrorMsg
                },
                dirty: this.$v.usuarioForm.email.$dirty,
                validators: {
                    required: this.$v.usuarioForm.email.required,
                    email: this.$v.usuarioForm.email.email
                }
            };
        },
        contraseniaConfirmarValidator() {
            return {
                hasError: this.$v.usuarioForm.contrasenia_confirmar.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    sameAsPassword: this.contraseniaConfirmarErrorMsg
                },
                dirty: this.$v.usuarioForm.contrasenia_confirmar.$dirty,
                validators: {
                    required: this.$v.usuarioForm.contrasenia_confirmar.required,
                    minLength: this.$v.usuarioForm.contrasenia_confirmar.minLength,
                    sameAsPassword: this.$v.usuarioForm.contrasenia_confirmar.sameAs,
                }
            };
        },
        perfilValidator() {
            return {
                hasError: this.$v.usuarioForm.perfil_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.usuarioForm.perfil_id.$dirty,
                validators: {
                    required: this.$v.usuarioForm.perfil_id.required
                }
            };
        }
    },

    methods: {
        guardarActualizarUsuario() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getUsuario != null) {
                    this.usuarioForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Usuario modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarUsuario",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.usuarioForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Usuario creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarUsuario",
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
            this.usuarioForm.reset();
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
