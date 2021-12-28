<template>
    <div>
        <div class="form-group">
            <div class="auto" id="auto" style="display: none">
                holis {{ envio }}
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="address-book"
                        floating-label
                        autofocus
                        required
                        :disabled="cliente.band"
                        v-model="cliente.cedula"
                        @input="consultarcedula()"
                    >
                        <label>Cédula de Identidad </label>
                    </bs-text-field>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-switch
                        color="primary"
                        label-position="left"
                        label-class="col-md-4 ml-3"
                        v-model="cliente.band"
                        @change="consumidorfinal()"
                    >
                        S/c
                    </bs-switch>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="address-book"
                        floating-label
                        required
                        :disabled="true"
                        v-model="cliente.no_documento"
                        clear-button
                        @input="consultarNoFactura()"
                    >
                        <label># Documento</label>
                    </bs-text-field>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="address-book"
                        floating-label
                        required
                        :disabled="true"
                        v-model="cliente.no_autorizacion"
                        clear-button
                    >
                        <label># Aurorización</label>
                    </bs-text-field>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="address-book"
                        floating-label
                        required
                        :disabled="true"
                        v-model="cliente.nombres"
                    >
                        <label>Nombres </label>
                    </bs-text-field>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="address-book"
                        floating-label
                        required
                        :disabled="true"
                        v-model="cliente.apellidos"
                    >
                        <label>Apellidos</label>
                    </bs-text-field>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="phone-alt"
                        floating-label
                        required
                        :disabled="true"
                        v-model="cliente.telefono"
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
                        v-model="cliente.direccion"
                    >
                        <label>Dirección</label>
                    </bs-text-field>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <bs-text-field
                        prepend-icon="mail-bulk"
                        floating-label
                        required
                        :disabled="true"
                        v-model="cliente.email"
                    >
                        <label>Correo Electronico</label>
                    </bs-text-field>
                </div>
                <button
                    v-if="false"
                    type="button
                    "
                    :disabled="true"
                    style=" background-color: #4CAF50;
                    border: none;
                    color: white;
                    padding: 5px 22px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;"
                    @click="guardarCliente()"
                >
                    Registrar
                </button>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data: function() {
        return {
            active_btn: false,
            totalPagar: 0,
            srchvalue0: null,
            cantidad: 0,
            autoCloseModalVisible: false,
            Lista: [],
            mensaje: "",
            cliente: {
                id: 0,
                band: false,
                cedula: "",
                no_documento: "000-000-000000001",
                no_autorizacion: "",
                nombres: "",
                apellidos: "",
                telefono: "0",
                direccion: "",
                email: ""
            },
            trueModalVisible: false
        };
    },

    mounted: function() {
        this.getNoFactura();
    },
    computed: {
        validarCliente() {
            if ((this.cliente.band = true)) {
                // this.active_btn = false;
                return false;
            } else {
                return true;
            }
        },
        envio() {
            this.$store.state.clientefactura = this.cliente;
            return this.$store.state.clientefactura;
        }
    },
    methods: {
        consultarNoFactura() {
            if (this.cliente.no_documento.length == 17) {
                let that = this;
                let url = this.$store.state.url_prefix +
                    "/modulos/transaccion/factura_venta/consultar_no_factura/" +
                    this.cliente.no_documento;
                axios
                    .get(url)
                    .then(function(response) {
                        if (response.data.existe != null) {
                            that.showNotificationProgress(
                                "Facturación",
                                "El N° factura, ya existe en el sistema.",
                                "error"
                            );
                        }
                    })
                    .catch(error => {});
            }
        },
        getNoFactura() {
            let that = this;
            let url = this.$store.state.url_prefix +
                "/modulos/parametrizacion/config_facturero/get_no_factura";
            axios
                .get(url)
                .then(function(response) {
                    if (response.data.get_no_factura != null) {
                        that.cliente.no_documento = response.data.get_no_factura.NOFACTURA;
                        that.cliente.no_autorizacion = response.data.get_no_factura.no_autorizacion;
                    }
                })
                .catch(error => {});
        },
        /* guardarCliente() {
            let that = this;
            let url = "";
            this.errors = [];

            axios
                .post(url, this.cliente)
                .then(function(response) {
                    //that.arreglito.indexOf(response.data.lista);

                    // console.log( response.data.lista);

                    if (response.data.lista != 0) {
                        that.cliente.id = response.data.lista;
                        that.showNotificationProgress(
                            "Facturacion",
                            "Cliente registrado",
                            "success"
                        );
                    } else {
                        that.showNotificationProgress(
                            "Facturacion",
                            "Cliente ya se encuentra registrado",
                            "error"
                        );
                    }
                })
                .catch(error => {
                    //Errores de validación

                    if (error.response.data.hasOwnProperty("errors")) {
                        const errors = error.response.data.errors;
                        // console.log(error.response.data.errors);
                        for (let error in errors) {
                            if (errors.hasOwnProperty(error)) {
                                // console.log(errors[error][0]);

                                that.showNotificationProgress(
                                    "Facturacion",
                                    errors[error][0],
                                    "error"
                                );
                            }
                        }
                    }
                });
        }, */
        consultarcedula() {
            if (this.cliente.cedula.length == 10) {
                let that = this;
                let url =
                    this.$store.state.url_prefix +
                    "/modulos/persona/cliente/cargar_cliente_cedula/" +
                    this.cliente.cedula;
                axios
                    .get(url)
                    .then(function(response) {
                        if (response.data.total == 0) {
                            that.showNotificationProgress(
                                "Facturacion",
                                "Cliente no registrado",
                                "error"
                            );

                            that.cliente.nombres = "";
                            that.cliente.apellidos = "";
                            that.cliente.direccion = "";
                            that.cliente.telefono = "";
                            that.cliente.email = "";
                        } else {
                            that.cliente.id =
                                response.data.clientes[0].cliente_id;
                            that.cliente.cedula =
                                response.data.clientes[0].cedula;
                            that.cliente.nombres =
                                response.data.clientes[0].nombres;
                            that.cliente.apellidos =
                                response.data.clientes[0].apellidos;
                            that.cliente.direccion =
                                response.data.clientes[0].direccion;
                            that.cliente.telefono =
                                response.data.clientes[0].telefono;
                            that.cliente.email =
                                response.data.clientes[0].correo;
                        }
                    })
                    .catch(error => {});
            }
        },
        consumidorfinal() {
            if (this.cliente.band) {
                this.cliente.id = "1";
                this.cliente.cedula = "9999999999";
                this.cliente.nombres = "CONSUMIDOR FINAL";
                this.cliente.apellidos = ".";
                this.cliente.direccion = ".";
                this.cliente.telefono = "0";
                this.cliente.email = "0";
            } else {
                this.cliente.id = "0";
                this.cliente.cedula = "";
                this.cliente.nombres = "";
                this.cliente.apellidos = "";
                this.cliente.direccion = "";
                this.cliente.telefono = "";
                this.cliente.email = "";
            }
        },
        calcular() {
            this.totalPagar = this.cantidad * this.Lista.costo_inv.precio;
        },
        onSearch(term) {
            this.srchvalue0 = term;
            this.inventario_p.fetch(term);
            this.showNotificationProgress(
                "Facturacion",
                "Producto Agregado",
                "success"
            );
        },
        btnClickModificar(item) {
            this.autoCloseModalVisible = true;
            this.Lista = item;
            this.mensaje =
                item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;
            console.log(this.Lista);

            //this.$store.state.producto = item;
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

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;

    .small-box {
        max-width: 480px;
    }
}
</style>
