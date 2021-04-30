<template>
    <div class="form-group">
        <form ref="myform" novalidate>
            <bs-combobox
                v-model="dataFormaPago.forma_pago_id"
                :data-source="products"
                prepend-icon="cash-register"
                floating-label
                @change="tipodepago()"
                :external-validator="formaPagoValidator"
            >
                <label>-- Forma de pago --</label>
            </bs-combobox>
            <br />
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
                        >
                            <label>Total Recibido</label>
                        </bs-text-field>
                        <bs-text-field
                            prepend-icon="wallet"
                            floating-label
                            autofocus
                            required
                        >
                            <label>Cambio</label>
                        </bs-text-field>
                    </bs-card-content>
                </bs-card-body>
                <bs-card-footer class="bg-primary text-white"
                    >Detalle de la Compra</bs-card-footer
                >
            </bs-card>
            <div v-show="pagotarjeta">
                <bs-card shadow>
                    <bs-card-header class="bg-unique text-white"
                        >Pago Con Tarjeta</bs-card-header
                    >
                    <bs-card-body>
                        <bs-card-content>
                            <label>Total a Pagar $</label>
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
                            <label>Total a Pagar $</label>
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-footer class="bg-indigo text-white"
                        >Pago Con Cheque</bs-card-footer
                    >
                </bs-card>
            </div>
        </form>
    </div>
</template>
<script>
import { prefix } from "../../../../../variables";
import { validationMixin } from "vuelidate";
import { required} from "vuelidate/lib/validators";

const productoValidator = {
    forma_pago_id: { required },
};
export default {
    props: {
        dataFormaPago: {
            type: Object
        },
    },
    watch: {
        "dataFormaPago.forma_pago_id"(value) {
            this.$emit("actualizarData", "forma_pago_id", value);
        },
    },
    mixins: [validationMixin],
    data: function() {
        return {



            totalPagar: 0,
            srchvalue0: null,
            product8: 0,
            cantidad: 0,
            pagotarjeta: false,
            pagocheque: false,
            autoCloseModalVisible: false,
            prefijo: "",
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
            trueModalVisible: false,

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
        };
    },
    validations: {
        dataFormaPago: productoValidator
    },
    computed: {
        formaPagoValidator() {
            return {
                hasError: this.$v.dataFormaPago.forma_pago_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.dataFormaPago.forma_pago_id.$dirty,
                validators: {
                    required: this.$v.dataFormaPago.forma_pago_id.required
                }
            };
        },
    },
    methods: {
        tipodepago() {
            if (this.product8 == 2) {
                this.pagotarjeta = true;
                this.pagocheque = false;
            }
            if (this.product8 == 3) {
                this.pagotarjeta = false;
                this.pagocheque = true;
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
        },
        cargarLista: function(value) {}
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
