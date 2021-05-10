<template>
    <div>
        <bs-alert color="success"> Total a Pagar : $ {{ sumatoria }} </bs-alert>
        <div class="auto" id="auto" style="display: none">
            holis {{ enviovuex }}
        </div>
        <div class="form-group">
            <bs-combobox
                v-model="forma.tipo_pagof"
                :data-source="products"
                prepend-icon="cash-register"
                floating-label
                @change="tipodepago()"
            >
                <label>-- Forma de pago --</label>
            </bs-combobox>
            <br />

            <div v-show="pagoefectivo">
                <bs-card shadow>
                    <bs-card-header class="bg-primary text-white"
                        >Detalle de la Compra</bs-card-header
                    >
                    <bs-card-body>
                        <bs-card-content>
                            <label>Total a Pagar $</label>
                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.total_recibido"
                            >
                                <label>Total Recibido</label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="wallet"
                                floating-label
                                autofocus
                                required
                                v-model="forma.cambio_pagarf"
                            >
                                <label>Cambio</label>
                            </bs-text-field>
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-footer class="bg-primary text-white"
                        >Detalle de la Compra</bs-card-footer
                    >
                </bs-card>
            </div>

            <div v-show="pagotarjeta">
                <bs-card shadow>
                    <bs-card-header class="bg-unique text-white"
                        >Pago Con Tarjeta</bs-card-header
                    >
                    <bs-card-body>
                        <bs-card-content>
                            <bs-combobox
                                v-model="forma.tarjetasf"
                                :data-source="tarjetas"
                                prepend-icon="cash-register"
                                floating-label
                            >
                                <label>-- Tarjetas --</label>
                            </bs-combobox>
                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.numero_tarjeta"
                            >
                                <label>Numero de Tarjeta</label>
                            </bs-text-field>
                            <bs-date-time-field
                                prepend-icon="address-book"
                                v-model="forma.caduca"
                                value-format="YYYY-MM-DD"
                                display-format="DD MMMM YYYY"
                                clear-button
                                floating-label
                                autofocus
                            >
                                <label>Fecha de Caducidad</label>
                            </bs-date-time-field>
                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.cliente"
                            >
                                <label>Nombre del Cliente</label>
                            </bs-text-field>
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-footer class="bg-unique text-white"
                        >Pago Con Tarjeta</bs-card-footer
                    >
                </bs-card>
            </div>

            <div v-show="pagocheque">
                <bs-card shadow>
                    <bs-card-header class="bg-indigo text-white"
                        >Pago Con Cheque</bs-card-header
                    >
                    <bs-card-body>
                        <bs-card-content>
                            <bs-date-time-field
                                prepend-icon="address-book"
                                v-model="forma.fecha_emision"
                                value-format="YYYY-MM-DD"
                                display-format="DD MMMM YYYY"
                                clear-button
                                floating-label
                                autofocus
                            >
                                <label>fecha de Emisión </label>
                            </bs-date-time-field>

                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.cantidad_pagarf"
                            >
                                <label>Cantidad</label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.nombref"
                            >
                                <label>Nombre</label>
                            </bs-text-field>
                            <bs-combobox
                                v-model="forma.banco"
                                :data-source="bancos"
                                prepend-icon="cash-register"
                                floating-label
                            >
                                <label>-- Bancos --</label>
                            </bs-combobox>
                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.numero_cuenta"
                            >
                                <label>Número de Cuenta</label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="money-bill-wave-alt"
                                floating-label
                                autofocus
                                required
                                v-model="forma.beneficiario"
                            >
                                <label>Beneficiario</label>
                            </bs-text-field>
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-footer class="bg-indigo text-white"
                        >Pago Con Cheque</bs-card-footer
                    >
                </bs-card>
            </div>

            <!-- FORMA DR PAGO -->
            <div v-show="pagocredito">
                <bs-card shadow>
                    <bs-card-header class="bg-indigo text-white"
                        >Pago Con Cheque</bs-card-header
                    >
                    <bs-card-body>
                        <bs-card-content>
                            <bs-combobox
                                v-model="forma.formacreditof"
                                :data-source="formapagocredito"
                                prepend-icon="cash-register"
                                floating-label
                                @change="calcularCredito"
                            >
                                <label>-- Meses --</label>
                            </bs-combobox>
                            <bs-list-view
                                v-for="(item,
                                index) in forma.creditofacturaventa"
                                :key="index"
                            >
                                <bs-list-tile>
                                    <bs-list-tile-leading
                                        class="text-info"
                                        icon="calendar-minus"
                                    >
                                    </bs-list-tile-leading>
                                    <bs-list-tile-content>
                                        <bs-list-tile-title
                                            class="font-weight-bold"
                                        >
                                            {{ item.fecha }} | Interes :
                                            {{ item.interes }}
                                        </bs-list-tile-title>
                                        <bs-list-tile-subtitle
                                            class="text-muted"
                                        >
                                            Fecha Pago {{ item.fecha }} | Total:
                                            {{ item.total }}
                                        </bs-list-tile-subtitle>
                                    </bs-list-tile-content>
                                </bs-list-tile>
                            </bs-list-view>
                        </bs-card-content>
                    </bs-card-body>
                    <!-- <bs-card-footer class="bg-indigo text-white"
                        >Pago Con Cheque</bs-card-footer
                    > -->
                </bs-card>
            </div>
            <!-- FIN DE FORMA DE PAGO -->
        </div>
    </div>
</template>
<script>
import { prefix } from "../../../../../variables";
export default {
    data: function() {
        return {
            mensajecambio: "",
            totalPagarf: 0,
            srchvalue0: null,
            product8: 0,
            tarjetasCredito: 0,
            bancosCredito: 0,
            cantidad: 0,
            total_for: [],
            pagoefectivo: false,
            pagotarjeta: false,
            pagocheque: false,
            pagocredito: false,
            autoCloseModalVisible: false,
            prefijo: "",
            forma: {
                formacreditof: 0,
                tipo_pagof: 0,
                //tarjetas
                tarjetasf: 0,
                numero_tarjeta: 0,
                caduca: "",
                cliente: "",
                //total a pagar
                total_pagarf: 0,
                total_recibido: 0,
                cambio_pagarf: 0,
                //cheque
                fecha_emision: "",
                cantidad_pagarf: 0,
                nombref: "",
                banco: 0,
                numero_cuenta: "",
                beneficiario: "",
                //credito
                creditofacturaventa: []
            },
            Lista: [],
            mensaje: "",
            products: {
                proxy: new BsStore({
                    idProperty: "tipo_pago",
                    dataProperty: "tipo",
                    totalProperty: "total",
                    remoteSort: false,
                    restProxy: {
                        browse: "/modulos/transaccion/factura_venta/config_tipo"
                    }
                }),
                schema: { displayField: "descripcion", valueField: "tipo_pago" }
            },
            tarjetas: {
                proxy: new BsStore({
                    idProperty: "TarCodigo",
                    dataProperty: "tipo",
                    totalProperty: "total",
                    remoteSort: false,
                    restProxy: {
                        browse:
                            "/modulos/transaccion/factura_venta/cargar_tarjeta"
                    }
                }),
                schema: { displayField: "TarNombre", valueField: "TarCodigo" }
            },
            bancos: {
                proxy: new BsStore({
                    idProperty: "id",
                    dataProperty: "tipo",
                    totalProperty: "total",
                    remoteSort: false,
                    restProxy: {
                        browse:
                            "/modulos/transaccion/factura_venta/cargar_banco"
                    }
                }),
                schema: { displayField: "descripcion", valueField: "id" }
            },
            formapagocredito: {
                proxy: new BsStore({
                    idProperty: "id",
                    dataProperty: "tipo",
                    totalProperty: "dias",
                    remoteSort: false,
                    restProxy: {
                        browse:
                            "/modulos/transaccion/factura_venta/cargar_forma"
                    }
                }),
                schema: { displayField: "descripcion", valueField: "id" }
            },
            trueModalVisible: false
        };
    },

    computed: {
        cambioTotal() {
            this.cambio_pagarf = this.total_for - this.forma.total_recibido;

            if (this.forma.total_recibido > this.total_for) {
                return (mensajecambio =
                    "El total recibido no puede ser menos a la cantidad ");
            } else {
                return (mensajecambio = "");
            }
        },

        enviovuex() {
            this.$store.state.formapagofactura = this.forma;
            return this.$store.state.formapagofactura;
        },
        sumatoria() {
            this.total_for = this.$store.getters.getInventariofactura;
            var element_sum = 0;

            var element = this.total_for.length;
            if (element > 0) {
                for (let index = 0; index < this.total_for.length; index++) {
                    element_sum += this.total_for[index]["tot"];
                }
                return (this.total_for = element_sum);
            }
        }
    },
    mounted() {
        return (this.total_for = this.$store.getters.getInventariofactura);
    },
    methods: {
        redondear(numero, digitos) {
            let base = Math.pow(10, digitos);
            let entero = Math.round(numero * base);
            return entero / base;
        },
        formatoFecha(fecha, formato) {
            const map = {
                dd: fecha.getDate(),
                mm: fecha.getMonth() + 1,
                yy: fecha.getFullYear().toString(),
                yyyy: fecha.getFullYear()
            };

            // return formato.replace(/yy|yyy|mm|dd/gi, matched => map[matched])
            return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched]);
        },

        calcularCredito() {
            var fecha = new Date();
            var fecha2 = new Date();
            //fecha.setMonth(fecha.getMonth() +1);
            // console.log('fechita.'+fecha);
            let arregloFecha = [];

            let that = this;
            var meses = 0;
            var interes = 0;
            var interesb = 0;
            that.forma.creditofacturaventa = [];
            let url =
                this.prefijo +
                "/modulos/transaccion/factura_venta/cargar_forma_id/" +
                this.forma.formacreditof;
            axios
                .get(url)
                .then(function(response) {
                    meses = response.data.tipo[0]["dias"];
                    interesb = response.data.tipo[0]["interes"];
                    interes = (that.total_for * interesb) / 100;
                    for (let index = 1; index < meses + 1; index++) {
                        let objeto = {};
                        fecha2 = new Date();
                        fecha = new Date();
                        var mes = fecha.getMonth();
                        var inde = index;
                        var total = Number(mes) + Number(inde);
                        fecha2.setMonth(total);
                        objeto.fecha = that.formatoFecha(fecha2, "dd-mm-yy");
                        objeto.valor = parseFloat(
                            that.total_for / meses
                        ).toFixed(2);
                        objeto.interes = interes;
                        objeto.total =
                            Number(
                                parseFloat(that.total_for / meses).toFixed(2)
                            ) + Number(interes);
                        //console.log(objeto);
                        that.forma.creditofacturaventa.push(objeto);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        tipodepago() {
            if (this.forma.tipo_pagof == 1) {
                this.pagotarjeta = false;
                this.pagocheque = false;
                this.pagocredito = false;
                this.pagoefectivo = true;
                this.forma.total_recibido = this.total_for;
            }
            if (this.forma.tipo_pagof == 2) {
                this.pagotarjeta = true;
                this.pagocheque = false;
                this.pagocredito = false;
                this.pagoefectivo = false;
            }
            if (this.forma.tipo_pagof == 3) {
                this.pagotarjeta = false;
                this.pagocheque = true;
                this.pagocredito = false;
                this.pagoefectivo = false;
                this.forma.cantidad_pagarf = this.total_for;
            }
            //pagocredito
            if (this.forma.tipo_pagof == 4) {
                this.pagotarjeta = false;
                this.pagocheque = false;
                this.pagocredito = true;
                this.pagoefectivo = false;
            }
        },
        consultarcedula() {
            let that = this;
            let url =
                this.prefijo +
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
                        that.cliente.cedula = "";
                        that.cliente.nombres = " ";
                        that.cliente.apellidos = "";
                        that.cliente.direccion = "";
                        that.cliente.telefono = "";
                        that.cliente.email = "";
                    } else {
                        that.cliente.id = response.data.clientes[0].id;
                        that.cliente.cedula = response.data.clientes[0].cedula;
                        that.cliente.nombres =
                            response.data.clientes[0].nombres;
                        that.cliente.apellidos =
                            response.data.clientes[0].apellidos;
                        that.cliente.direccion =
                            response.data.clientes[0].direccion;
                        that.cliente.telefono =
                            response.data.clientes[0].telefono;
                        that.cliente.email = response.data.clientes[0].correo;
                    }
                    //console.log(response.data.clientes[0].nombres);
                })
                .catch(error => {});
        },
        consumidorfinal() {
            if (this.cliente.band) {
                this.cliente.cedula = "9999999999";
                this.cliente.nombres = "CONSUMIDOR FINAL";
                this.cliente.apellidos = ".";
                this.cliente.direccion = ".";
                this.cliente.telefono = "0";
                this.cliente.email = "0";
            } else {
                this.cliente.cedula = "";
                this.cliente.nombres = " ";
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
            //  this.showNotificationProgress(
            //                 "Facturacion",
            //                 "Producto Agregado" ,
            //                 "success"
            //             );
        },
        btnClickModificar(item) {
            this.autoCloseModalVisible = true;
            this.Lista = item;
            this.mensaje =
                item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;
            // console.log(this.Lista);

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
        },
    }
};
</script>

