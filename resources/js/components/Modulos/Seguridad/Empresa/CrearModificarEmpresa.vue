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
                                            '/modulos/seguridad/empresa/mostrar_empresa'
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
                                    content="Guardar empresa"
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
                            >Mantenimiento de empresa</bs-card-header
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
                                                v-model="empresaForm.nombre"
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
                                                v-model="empresaForm.ruc"
                                                :external-validator="
                                                    rucValidator
                                                "
                                            >
                                                <label>Ruc</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="
                                                    empresaForm.representante
                                                "
                                                :external-validator="
                                                    representanteValidator
                                                "
                                            >
                                                <label>Representante</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="empresaForm.telefono"
                                                :external-validator="
                                                    telefonoValidator
                                                "
                                            >
                                                <label>Telefono</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="empresaForm.contador"
                                            >
                                                <label>Contador</label>
                                            </bs-text-field>
                                            <bs-date-time-field
                                                v-model="
                                                    empresaForm.inicio_actividades
                                                "
                                                prepend-icon-outer="user"
                                                clear-button
                                                floating-label
                                                value-format="YYYY-MM-DD HH:mm:ss"
                                                display-format="dddd, DD MMM YYYY HH:mm:ss"
                                                outlined
                                            >
                                                <label
                                                    >Inicio de
                                                    Actividades</label
                                                >
                                            </bs-date-time-field>
                                            <bs-date-time-field
                                                v-model="
                                                    empresaForm.inscripcion
                                                "
                                                prepend-icon-outer="user"
                                                clear-button
                                                floating-label
                                                value-format="YYYY-MM-DD HH:mm:ss"
                                                display-format="dddd, DD MMM YYYY HH:mm:ss"
                                                outlined
                                            >
                                                <label>Inscripción</label>
                                            </bs-date-time-field>
                                            <bs-switch
                                                class="ml-5"
                                                v-model="
                                                    empresaForm.obligado_contabilidad
                                                "
                                                color="primary"
                                                label-position="left"
                                                label-class="col-md-8"
                                            >
                                                Obligado a Contabilidad
                                            </bs-switch>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="
                                                    empresaForm.razon_social
                                                "
                                                :external-validator="
                                                    razonSocialValidator
                                                "
                                            >
                                                <label>Razón Social</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="
                                                    empresaForm.codigo_postal
                                                "
                                                :external-validator="
                                                    codigoPostalValidator
                                                "
                                            >
                                                <label>Codigo Postal</label>
                                            </bs-text-field>
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="empresaForm.email"
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
                                                v-model="empresaForm.direccion"
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
                                                v-model="
                                                    empresaForm.contador_ruc
                                                "
                                            >
                                                <label>Contador Ruc</label>
                                            </bs-text-field>
                                            <bs-date-time-field
                                                v-model="
                                                    empresaForm.constitucion
                                                "
                                                prepend-icon-outer="user"
                                                clear-button
                                                floating-label
                                                value-format="YYYY-MM-DD HH:mm:ss"
                                                display-format="dddd, DD MMM YYYY HH:mm:ss"
                                                outlined
                                            >
                                                <label>Constitución</label>
                                            </bs-date-time-field>
                                            <bs-date-time-field
                                                v-model="
                                                    empresaForm.actualizacion
                                                "
                                                prepend-icon-outer="user"
                                                clear-button
                                                floating-label
                                                value-format="YYYY-MM-DD HH:mm:ss"
                                                display-format="dddd, DD MMM YYYY HH:mm:ss"
                                                outlined
                                            >
                                                <label>Actualización</label>
                                            </bs-date-time-field>
                                        </div>
                                        <div
                                            class="col-lg-12 col-md-12 col-sm-12 mt-3 text-center"
                                        >
                                            <input
                                                type="file"
                                                ref="file"
                                                accept=".jpg, .png, .jpeg"
                                                @change="onFileSelected"
                                                style="display: none"
                                            />
                                            <bs-button
                                                @click="$refs.file.click()"
                                                color="primary"
                                                icon="cloud-upload-alt"
                                                icon-position="left"
                                            >
                                                Cargar Imagen
                                            </bs-button>
                                        </div>
                                        <div
                                            class="col-lg-12 col-md-12 col-sm-12 text-center"
                                        >
                                            <bs-avatar
                                                class="md-link"
                                                :img-src="empresaForm.fotoURL"
                                                size="100%"
                                                rounded
                                                @click="showSingleItem = true"
                                                :external-validator="
                                                    direccionValidator
                                                "
                                            >
                                            </bs-avatar>
                                        </div>
                                    </div>
                                </form>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                </div>
            </div>
        </div>
        <bs-lightbox
            :items="singleItem"
            :open.sync="showSingleItem"
            :show-counter="false"
            :show-nav-control="false"
            :show-thumbnail="false"
            :show-toolbar="true"
            :toolbar="buttons"
        >
        </bs-lightbox>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, email } from "vuelidate/lib/validators";

const empresaValidator = {
    nombre: { required },
    ruc: { required },
    representante: { required },
    telefono: { required },
    razon_social: { required },
    codigo_postal: { required },
    email: { required, email },
    direccion: { required }
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //Variable para abrir la imagen en modal
            buttons: { close: true },
            showSingleItem: false,
            singleItem: [
                {
                    //thumbnail: this.empresaForm!=undefined?this.empresaForm.fotoURL:"",
                    imageSrc: "",
                    title: ""
                }
            ],
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario
            empresaForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        empresa_id: 0,
                        nombre: "",
                        ruc: "",
                        representante: "",
                        telefono: "",
                        contador: "",
                        inicio_actividades: "",
                        inscripcion: "",
                        razon_social: "",
                        codigo_postal: "",
                        email: "",
                        direccion: "",
                        contador_ruc: "",
                        constitucion: "",
                        actualizacion: "",
                        file_base_64: null,
                        fotoURL: null,
                        obligado_contabilidad: false
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url: "/modulos/seguridad/empresa/guardar_empresa",
                            method: "post"
                        },
                        update: {
                            url: "/modulos/seguridad/empresa/modificar_empresa",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            emailErrorMsg:
                "Por favor ingrese una dirección de correo electrónico válida."
        };
    },
    validations: {
        empresaForm: empresaValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getEmpresa != null) {
            var empresa = this.$store.getters.getEmpresa;
            this.empresaForm.empresa_id = empresa.Empresa_Id;
            this.empresaForm.nombre = empresa.Empresa_Nombre;
            this.empresaForm.ruc = empresa.Empresa_Ruc;
            this.empresaForm.representante = empresa.Empresa_Representante;
            this.empresaForm.telefono = empresa.Empresa_Telefonos;
            this.empresaForm.contador = empresa.Empresa_Contador;
            this.empresaForm.inicio_actividades =
                empresa.Empresa_Inicio_Actividades;
            this.empresaForm.inscripcion = empresa.Empresa_Inscripcion;
            this.empresaForm.razon_social = empresa.Empresa_Razon_Social;
            this.empresaForm.codigo_postal = empresa.Empresa_Codigo_Postal;
            this.empresaForm.email = empresa.Empresa_Correo_Electronico;
            this.empresaForm.direccion = empresa.Empresa_Direccion;
            this.empresaForm.contador_ruc = empresa.Empresa_Contador_Ruc;
            this.empresaForm.constitucion = empresa.Empresa_Constitucion;
            this.empresaForm.actualizacion = empresa.Empresa_Actualizacion;
            this.empresaForm.fotoURL = empresa.Empresa_Ubicacion_Logo;
            this.empresaForm.file_base_64 = empresa.Empresa_Ubicacion_Logo;
            this.singleItem[0].imageSrc = empresa.Empresa_Ubicacion_Logo;
            this.empresaForm.obligado_contabilidad = empresa.Empresa_Obligado_Contabilidad?true:false;
        }
    },
    beforeDestroy: function() {
        this.$store.state.empresa = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        nombreValidator() {
            return {
                hasError: this.$v.empresaForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.empresaForm.nombre.$dirty,
                validators: {
                    required: this.$v.empresaForm.nombre.required
                }
            };
        },
        rucValidator() {
            return {
                hasError: this.$v.empresaForm.ruc.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.empresaForm.ruc.$dirty,
                validators: {
                    required: this.$v.empresaForm.ruc.required
                }
            };
        },
        representanteValidator() {
            return {
                hasError: this.$v.empresaForm.representante.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.empresaForm.representante.$dirty,
                validators: {
                    required: this.$v.empresaForm.representante.required
                }
            };
        },
        telefonoValidator() {
            return {
                hasError: this.$v.empresaForm.telefono.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.empresaForm.telefono.$dirty,
                validators: {
                    required: this.$v.empresaForm.telefono.required
                }
            };
        },
        codigoPostalValidator() {
            return {
                hasError: this.$v.empresaForm.codigo_postal.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.empresaForm.codigo_postal.$dirty,
                validators: {
                    required: this.$v.empresaForm.codigo_postal.required
                }
            };
        },
        razonSocialValidator() {
            return {
                hasError: this.$v.empresaForm.razon_social.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.empresaForm.razon_social.$dirty,
                validators: {
                    required: this.$v.empresaForm.razon_social.required
                }
            };
        },
        emailValidator() {
            return {
                hasError: this.$v.empresaForm.email.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    email: this.emailErrorMsg
                },
                dirty: this.$v.empresaForm.email.$dirty,
                validators: {
                    required: this.$v.empresaForm.email.required,
                    email: this.$v.empresaForm.email.email
                }
            };
        },
        direccionValidator() {
            return {
                hasError: this.$v.empresaForm.direccion.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.empresaForm.direccion.$dirty,
                validators: {
                    required: this.$v.empresaForm.direccion.required
                }
            };
        }
    },

    methods: {
        createBase64Image(fileObject) {
            const reader = new FileReader();
            reader.readAsDataURL(fileObject);
            reader.onload = e => {
                this.empresaForm.file_base_64 = e.target.result;
            };
        },
        onFileSelected(event) {
            if (event.target.files.length > 0) {
                if (
                    event.target.files[0]["type"] === "image/jpeg" ||
                    event.target.files[0]["type"] === "image/png" ||
                    event.target.files[0]["type"] === "image/jpg"
                ) {
                    this.empresaForm.logo = event.target.files[0];
                    this.empresaForm.fotoURL = URL.createObjectURL(
                        this.empresaForm.logo
                    );
                    this.createBase64Image(this.empresaForm.logo);
                    this.singleItem[0].title = event.target.files[0].name;
                    this.singleItem[0].imageSrc = this.empresaForm.fotoURL;
                } else {
                    this.showNotificationProgress(
                        "Advertencia al cargar la imagen",
                        "Solo imagenes de formato: .jpeg, .jpg, .png son permitidos!",
                        "warning"
                    );
                }
            }
        },
        guardarActualizar() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getEmpresa != null) {
                    this.empresaForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Empresa modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarEmpresa",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.empresaForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Empresa creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en guardarActualizarEmpresa",
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
            this.empresaForm.reset();
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
