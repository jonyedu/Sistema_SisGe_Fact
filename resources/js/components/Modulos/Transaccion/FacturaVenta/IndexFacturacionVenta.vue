<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                prefijo +
                                    '/modulos/transaccion/factura_venta/mostrar_factura_venta'
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
                            content="Guardar cliente"
                            placement="bottom"
                        >
                            <bs-button
                                mode="icon"
                                icon="save"
                                icon-size="sm"
                                color="success"
                                @click="GrabarFactura()"
                            >
                            </bs-button>
                        </bs-tooltip>
                        <bs-tooltip
                            content="Imprimir Factura de Compra"
                            placement="bottom"
                        >
                            <bs-button
                                mode="icon"
                                icon="file-pdf"
                                icon-size="sm"
                                color="red"
                                @click="imprimirPdf()"
                            >
                            </bs-button>
                        </bs-tooltip>
                        <bs-tooltip
                            content="Enviar Factura al Cliente"
                            placement="bottom"
                        >
                            <bs-button
                                mode="icon"
                                icon="file-import"
                                icon-size="sm"
                                color="info"
                                @click="enviarPdf()"
                            >
                            </bs-button>
                        </bs-tooltip>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <bs-appbar class="bg-indigo rounded-top">
                    <bs-appbar-title :title="mensaje" class="text-white">
                    </bs-appbar-title>
                    <bs-switch
                        v-model="activo"
                        @change="validar()"
                        color="primary"
                        label-position="left"
                        label-class="col-md-4 ml-3"
                    >
                    </bs-switch>
                    <bs-spacer> </bs-spacer>
                </bs-appbar>
                <bs-tabs v-model="activeTab" variant="modern" color="indigo">
                    <bs-tab label="Datos de Facturación" icon="money-bill-alt">
                        <cliente-factura ref="clientefac"> </cliente-factura>
                    </bs-tab>
                    <bs-tab label="Selección de Productos" icon="cart-plus">
                        <inventario-producto ref="inventariofact">
                        </inventario-producto>
                    </bs-tab>
                    <bs-tab
                        label="Formas de Pago"
                        icon="credit-card"
                        v-show="activo"
                    >
                        <forma-de-pago-factura ref="formaspagofactura">
                        </forma-de-pago-factura>
                    </bs-tab>
                </bs-tabs>
                <div class="col-md text-center" v-if="false">
                    <bs-tooltip
                        content="Guardar Factura Venta"
                        placement="bottom"
                    >
                        <bs-button
                            color="success"
                            class="text-nowrap"
                            raised
                            outlined
                            pill
                            @click="GrabarFactura"
                        >
                            {{ mensaje }}
                        </bs-button>
                    </bs-tooltip>
                </div>
            </bs-card>
        </div>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //variable que controla el progreso
            showLoader: false,
            id_documento:0,
            activeTab: 0,
            mensaje: "Facturación",
            activo: true,

            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres."

            //Objeto para almacenar el arreglo de cada combobox
        };
    },

    mounted: function() {
        this.prefijo = prefix;
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
        //Metodo para validar el campo nombre
    },

    methods: {
        validar() {
            if (this.activo) {
                this.mensaje = "Facturación";
            } else {
                this.mensaje = "Cotización";
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
        GrabarFactura() {
            this.showLoader = true;
            let that = this;
            let url = "";
            let ListaProductos = [];
            let ListaCliente = [];
            let ListaMetodosPago = [];
            let datos_inventario_factura = {};

            ListaProductos = this.$store.getters.getInventariofactura;
            ListaCliente = this.$store.getters.getClientefactura;
            ListaMetodosPago = this.$store.getters.getFormapagofactura;
            datos_inventario_factura = this.$store.getters.getDatosInventarioFactura;

            //aqui valido si todo esta correcto nuevamente
            if (ListaCliente.id == 0) {
                this.showNotificationProgress(
                    "Facturación",
                    "Debe Seleccionar un cliente o elegir la opcion de consumidor final",
                    "error"
                );
                this.showLoader = false;
                return;
            }
            if (ListaCliente.no_documento == "") {
                this.showNotificationProgress(
                    "Facturación",
                    "Debe ingresar el numero de factura.",
                    "error"
                );
                this.showLoader = false;
                return;
            }
            if (ListaCliente.no_autorizacion == "") {
                this.showNotificationProgress(
                    "Facturación",
                    "Debe ingresar el numero de autorización.",
                    "error"
                );
                this.showLoader = false;
                return;
            }
            if (ListaProductos.length == 0) {
                this.showNotificationProgress(
                    "Facturación",
                    "Debe tener Agregado un producto al carrito",
                    "error"
                );
                this.showLoader = false;
                return;
            }
            if (datos_inventario_factura.observacion == "") {
                this.showNotificationProgress(
                    "Facturación",
                    "Debe tener una observación",
                    "error"
                );
                this.showLoader = false;
                return;
            }

            if (this.activo == true) {
                if (ListaMetodosPago.tipo_pagof == 0) {
                    this.showNotificationProgress(
                        "Facturación",
                        "Debe Seleccionar un un metodo de pago",
                        "error"
                    );
                    this.showLoader = false;
                    return;
                } else {
                    if (ListaMetodosPago.tipo_pagof == 1) {
                        if (ListaMetodosPago.total_recibido == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar el total Recibido",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                    }
                    if (ListaMetodosPago.tipo_pagof == 2) {
                        if (ListaMetodosPago.tarjetasf == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar la tarjetas",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                        if (ListaMetodosPago.numero_tarjeta == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Inresar el numero de tarjeta",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }

                        if (ListaMetodosPago.caduca == "") {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar la fecha de Inreso",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                        if (ListaMetodosPago.cliente == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe ingresar el nombre del cliente",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                    }

                    if (ListaMetodosPago.tipo_pagof == 3) {
                        if (ListaMetodosPago.fecha_emision == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar la Fecha de emisión",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                        if (ListaMetodosPago.cantidad_pagarf == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar la cantidad",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                        if (ListaMetodosPago.nombref == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar el nombre",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                        if (ListaMetodosPago.banco == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar el banco",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }

                        if (ListaMetodosPago.numero_cuenta == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe ingresar el numero de cuenta. máximo 16 caracteres",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }

                        if (ListaMetodosPago.beneficiario == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar el beneficiario",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                    }

                    if (ListaMetodosPago.tipo_pagof == 4) {
                        if (ListaMetodosPago.creditofacturaventa.length == 0) {
                            this.showNotificationProgress(
                                "Facturación",
                                "Debe Elegir los meses al cual se va dar crédito",
                                "error"
                            );
                            this.showLoader = false;
                            return;
                        }
                    }
                }
            }
            //fin
            this.errors = [];
            url = "/modulos/transaccion/factura_venta/guardar_factura/";

            axios
                .post(url, {
                    cotizacion: that.activo,
                    inventario: ListaProductos,
                    cliente: ListaCliente,
                    metodosp: ListaMetodosPago,
                    datos_inventario_factura: datos_inventario_factura,
                })
                .then(function(response) {
                    console.log(response.data.tipo);
                    if (that.activo == false) {
                        that.showNotificationProgress(
                            "Facturación",
                            "Cotización realizada con éxito",
                            "success"
                        );
                        that.id_documento = response.data.tipo;
                        that.showLoader = false;
                        //that.generarPdf(response.data.tipo);
                    } else {
                        that.showNotificationProgress(
                            "Facturación",
                            "Compra realizada con éxito",
                            "success"
                        );
                        that.id_documento = response.data.tipo;
                        that.showLoader = false;
                        //that.generarPdf(response.data.tipo);
                    }
                })
                .catch(error => {
                    //Errores de validación

                    console.log(error);

                    if (error.response.data.hasOwnProperty("errors")) {
                        const errors = error.response.data.errors;
                        // console.log(error.response.data.errors);
                        for (let error in errors) {
                            if (errors.hasOwnProperty(error)) {
                                // console.log(errors[error][0]);
                                that.showNotificationProgress(
                                    "Facturación",
                                    "Error en el sistema" + errors,
                                    "error"
                                );
                                that.showLoader = false;
                                return;
                            }
                        }
                    } else {
                        this.showNotificationProgress(
                            "Facturación",
                            "Error en el sistema" + error.response.data.errors,
                            "error"
                        );
                    }
                    that.showLoader = false;
                });
        },
        imprimirPdf() {
            if (this.id_documento > 0) {
                window.open("/modulos/reporte/factura_venta/cargar_pdf_factura_venta/" +
                    this.id_documento  +
                    "/" +
                    this.activo + "/" +
                            'false'
                );
            } else {
                this.showNotificationProgress(
                    "Advertencia",
                    "No existe factura de venta, para imprimir.",
                    "warning"
                );
            }
        },
        enviarPdf() {
            if (this.id_documento > 0) {
                window.open("/modulos/reporte/factura_venta/cargar_pdf_factura_venta/" +
                    this.id_documento  +
                    "/" +
                    this.activo + "/" +
                            'true'
                );
            } else {
                this.showNotificationProgress(
                    "Advertencia",
                    "No existe factura de venta, para imprimir.",
                    "warning"
                );
            }
        },
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
