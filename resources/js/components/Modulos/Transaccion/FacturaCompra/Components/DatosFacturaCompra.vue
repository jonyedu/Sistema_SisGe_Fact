<template>
    <div class="row">
        <div class="col-lg-12 offset-lg-12">
            <form ref="myform" novalidate>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-date-time-field
                            prepend-icon="address-book"
                            v-model="dataFacturaCompra.fmt_registro"
                            value-format="YYYY-MM-DD"
                            display-format="DD MMMM YYYY"
                            clear-button
                            floating-label
                            autofocus
                            :external-validator="fechaRegistroValidator"
                        >
                            <label class="col-md-3 col-xl-2 col-form-label">
                                Fecha Registro
                            </label>
                        </bs-date-time-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-switch
                            class="ml-5"
                            color="primary"
                            label-position="left"
                            v-model="band"
                            @change="consumidorfinal()"
                            clear-button
                        >
                            S/c
                        </bs-switch>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="address-book"
                            floating-label
                            required
                            :disabled="band"
                            v-model="dataFacturaCompra.no_documento"
                            clear-button
                            @input="consultarNoFactura()"
                            :external-validator="noDocumentoValidator"
                        >
                            <label># Documento</label>
                        </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                        <bs-combobox
                            v-model="dataFacturaCompra.tipo_documento_id"
                            :data-source="cmb.tipos_documentos"
                            floating-label
                            clear-button
                            :external-validator="tipoDocumentoValidator"
                        >
                            <label>Tipo Doc.</label>
                        </bs-combobox>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="address-book"
                            floating-label
                            required
                            :disabled="band"
                            v-model="dataFacturaCompra.cedula"
                            @input="consultarcedula()"
                            clear-button
                            :external-validator="cedulaValidator"
                        >
                            <label>Cédula de Identidad</label>
                        </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="address-book"
                            floating-label
                            required
                            :disabled="true"
                            v-model="dataFacturaCompra.nombre"
                            clear-button
                        >
                            <label>Nombre</label>
                        </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="address-book"
                            floating-label
                            required
                            :disabled="true"
                            v-model="dataFacturaCompra.apellido"
                            clear-button
                        >
                            <label>Apellido</label>
                        </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="address-book"
                            floating-label
                            required
                            :disabled="true"
                            v-model="dataFacturaCompra.representante"
                            clear-button
                        >
                            <label>Representante</label>
                        </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="phone-alt"
                            floating-label
                            required
                            :disabled="true"
                            v-model="dataFacturaCompra.telefono"
                            clear-button
                        >
                            <label>Teléfono</label>
                        </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <bs-text-field
                            prepend-icon="map-marker-alt"
                            floating-label
                            required
                            :disabled="true"
                            v-model="dataFacturaCompra.direccion"
                            clear-button
                        >
                            <label>Dirección</label>
                        </bs-text-field>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { prefix } from "../../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

const datosFacturaValidator = {
    fmt_registro: { required },
    no_documento: { required },
    tipo_documento_id: { required},
    cedula: { required, minLength: minLength(10), maxLength: maxLength(10)  },
};
export default {
    props: {
        dataFacturaCompra: {
            type: Object
        },
    },
    watch: {
        "dataFacturaCompra.proveedor_id"(value) {
            this.$emit("actualizarData", "proveedor_id", value);
        },
        "dataFacturaCompra.fmt_registro"(value) {
            this.$emit("actualizarData", "fmt_registro", value);
        },
        "dataFacturaCompra.tipo_documento_id"(value) {
            this.$emit("actualizarData", "tipo_documento_id", value);
        },
        "dataFacturaCompra.no_documento"(value) {
            this.$emit("actualizarData", "no_documento", value);
        },
        "dataFacturaCompra.cedula"(value) {
            this.$emit("actualizarData", "cedula", value);
        },
        "dataFacturaCompra.nombre"(value) {
            this.$emit("actualizarData", "nombre", value);
        },
        "dataFacturaCompra.apellido"(value) {
            this.$emit("actualizarData", "apellido", value);
        },
        "dataFacturaCompra.representante"(value) {
            this.$emit("actualizarData", "representante", value);
        },
        "dataFacturaCompra.direccion"(value) {
            this.$emit("actualizarData", "direccion", value);
        },
        "dataFacturaCompra.telefono"(value) {
            this.$emit("actualizarData", "telefono", value);
        },
    },
    mixins: [validationMixin],
    data: function() {
        return {
            band: false,
            cmb: {
                tipos_documentos: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "tiposDocumentos",
                        totalProperty: "total",
                        pageSize: 15,
                        restProxy: {
                            browse:"/modulos/parametrizacion/tipo_documento/cargar_tipo_documento_combo_box",
                        }
                    }),
                    schema: { displayField: "descripcion", valueField: "id" }
                },
            },
            trueModalVisible: false,
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 10 caracteres.",
            maxLengthErrorMsg: "Este campo debe tener al menos 10 caracteres."
        };
    },
    validations: {
        dataFacturaCompra: datosFacturaValidator
    },
    computed: {
        fechaRegistroValidator() {
            return {
                hasError: this.$v.dataFacturaCompra.fmt_registro.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.dataFacturaCompra.fmt_registro.$dirty,
                validators: {
                    required: this.$v.dataFacturaCompra.fmt_registro.required
                }
            };
        },
        noDocumentoValidator() {
            return {
                hasError: this.$v.dataFacturaCompra.no_documento.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.dataFacturaCompra.no_documento.$dirty,
                validators: {
                    required: this.$v.dataFacturaCompra.no_documento.required
                }
            };
        },
        tipoDocumentoValidator() {
            return {
                hasError: this.$v.dataFacturaCompra.tipo_documento_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.dataFacturaCompra.tipo_documento_id.$dirty,
                validators: {
                    required: this.$v.dataFacturaCompra.tipo_documento_id.required
                }
            };
        },
        cedulaValidator() {
            return {
                hasError: this.$v.dataFacturaCompra.cedula.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg,
                    maxLength: this.maxLengthErrorMsg,
                },
                dirty: this.$v.dataFacturaCompra.cedula.$dirty,
                validators: {
                    required: this.$v.dataFacturaCompra.cedula.required,
                    minLength: this.$v.dataFacturaCompra.cedula.minLength,
                    maxLength: this.$v.dataFacturaCompra.cedula.maxLength,
                }
            };
        },
    },
    methods: {
        consultarNoFactura() {
            //alert(this.dataFacturaCompra.no_documento.length);
            if (this.dataFacturaCompra.no_documento.length == 17) {
                let that = this;
                let url =
                    "/modulos/transaccion/factura_compra/consultar_no_factura/" +
                    this.dataFacturaCompra.no_documento;
                axios
                    .get(url)
                    .then(function(response) {
                        if (response.data.existe != null) {
                            that.showNotificationProgress(
                                "Facturación",
                                "El N° factura, ya existe en el sistema.",
                                "error"
                            );
                            that.lmpCampos();
                        } else {
                            that.dataFacturaCompra.proveedor_id = response.data.proveedor.id;
                            that.dataFacturaCompra.cedula =
                                response.data.proveedor.cedula;
                            that.dataFacturaCompra.nombre =
                                response.data.proveedor.nombre;
                            that.dataFacturaCompra.apellido =
                                response.data.proveedor.apellido;
                            that.dataFacturaCompra.direccion =
                                response.data.proveedor.direccion;
                            that.dataFacturaCompra.telefono =
                                response.data.proveedor.telefono;
                            that.dataFacturaCompra.representante =
                                response.data.proveedor.representante;
                        }
                    })
                    .catch(error => {});
            }
        },
        consultarcedula() {
            if (this.dataFacturaCompra.cedula.length == 10) {
                let that = this;
                let url =
                    "/modulos/persona/proveedor/cargar_proveedor_cedula/" +
                    this.dataFacturaCompra.cedula;
                axios
                    .get(url)
                    .then(function(response) {
                        if (response.data.proveedor == null) {
                            that.showNotificationProgress(
                                "Facturación",
                                "El Proveedor no existe en el sistema.",
                                "error"
                            );
                            that.lmpCampos();
                        } else {
                            that.dataFacturaCompra.proveedor_id = response.data.proveedor.id;
                            that.dataFacturaCompra.cedula =
                                response.data.proveedor.cedula;
                            that.dataFacturaCompra.nombre =
                                response.data.proveedor.nombre;
                            that.dataFacturaCompra.apellido =
                                response.data.proveedor.apellido;
                            that.dataFacturaCompra.direccion =
                                response.data.proveedor.direccion;
                            that.dataFacturaCompra.telefono =
                                response.data.proveedor.telefono;
                            that.dataFacturaCompra.representante =
                                response.data.proveedor.representante;
                        }
                    })
                    .catch(error => {});
            }
        },
        consumidorfinal() {
            if (this.band) {
                this.dataFacturaCompra.cedula = "9999999999";
                this.dataFacturaCompra.nombre = "CONSUMIDOR FINAL";
                this.dataFacturaCompra.apellido = ".";
                this.dataFacturaCompra.direccion = ".";
                this.dataFacturaCompra.telefono = "0";
            } else {
                this.lmpCampos();
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
            this.dataFacturaCompra.cedula = "";
            this.dataFacturaCompra.nombre = "";
            this.dataFacturaCompra.apellido = "";
            this.dataFacturaCompra.representante = "";
            this.dataFacturaCompra.telefono = "";
            this.dataFacturaCompra.direccion = "";
        }
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;

    .small-box {
        max-width: 480px;
    }
}
</style>
