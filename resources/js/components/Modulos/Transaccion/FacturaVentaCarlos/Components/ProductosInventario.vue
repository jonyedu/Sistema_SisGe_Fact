<template>
    <div class="my-demo-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <bs-card-body>
                    <bs-alert color="success">
                        Total a Pagar : $ {{ sumatoria }}
                    </bs-alert>
                    <div class="auto" id="auto" style="display: none">
                        holis {{ envio }}
                    </div>
                    <bs-card-content class="text-right">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <bs-search-field
                                    v-model="srchvalue0"
                                    @search="onSearch"
                                >
                                </bs-search-field>
                            </div>
                            <bs-tooltip
                                content="Productos Agregados"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="shopping-cart"
                                    icon-size="sm"
                                    @click="modalproductos = true"
                                ></bs-button>
                            </bs-tooltip>
                        </div>
                    </bs-card-content>
                </bs-card-body>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <bs-card shadow>
                    <bs-grid :data-source="inventario_p" row-hover>
                        <bs-grid-column
                            field="producto_inv.nombre"
                            label="Producto"
                            min-width="175"
                        ></bs-grid-column>
                        <bs-grid-column
                            field="costo_inv.precio"
                            label="Valor"
                            width="120"
                        ></bs-grid-column>
                        <bs-grid-column
                            field="Stock"
                            label="Stock"
                            width="100"
                        ></bs-grid-column>
                        <bs-grid-column
                            label="Action"
                            width="100"
                            text-align="center"
                        ></bs-grid-column>
                        <template v-slot:datarow="{ columns, item, index }">
                            <bs-grid-cell
                                :column="columns[0]"
                                :item="item"
                                :index="index"
                            ></bs-grid-cell>
                            <bs-grid-cell
                                :column="columns[1]"
                                :item="item"
                                :index="index"
                            ></bs-grid-cell>
                            <bs-grid-cell
                                :column="columns[2]"
                                :item="item"
                                :index="index"
                            ></bs-grid-cell>

                            <bs-grid-cell
                                :column="columns[3]"
                                :item="item"
                                :index="index"
                            >
                                <bs-tooltip
                                    content="Mostrar Detalles"
                                    placement="bottom"
                                >
                                    <bs-button
                                        icon="camera-retro"
                                        mode="icon"
                                        icon-size="lg"
                                        color="secondary"
                                        flat
                                        @click="btnClickMostar(item)"
                                    ></bs-button>
                                </bs-tooltip>
                                <bs-tooltip
                                    content="Elegir Cantidad"
                                    placement="bottom"
                                >
                                    <bs-button
                                        icon="cart-arrow-down"
                                        mode="icon"
                                        icon-size="lg"
                                        color="secondary"
                                        flat
                                        @click="btnClickModificar(item)"
                                    ></bs-button>
                                </bs-tooltip>
                            </bs-grid-cell>
                        </template>
                    </bs-grid>

                    <!-- MODAL DEL PRODUCTO -->
                    <bs-modal
                        :open.sync="autoCloseModalVisible"
                        title="Cantidad de Producto"
                        max-width="85%"
                        :overlay-close="false"
                    >
                        {{ mensaje }}
                        <br />
                        <span COLOR="red">{{ mensaje2 }}</span>
                        <bs-text-field
                            placeholder="Placeholder"
                            floating-label
                            outlined
                            @keydown="calcular()"
                            v-model="cantidad"
                        >
                            <label>Ingrese una Cantidad </label>
                        </bs-text-field>
                        <template v-slot:footer>
                            <bs-button
                                outlined
                                color="secondary"
                                @click="autoCloseModalVisible = false"
                            >
                                Cancel
                            </bs-button>
                            <bs-button
                                outlined
                                color="secondary"
                                :disabled="validarRed"
                                @click="agregarProducto()"
                            >
                                Ok
                            </bs-button>
                        </template>
                    </bs-modal>
                    <!-- FIN DEL MODAL -->
                    <!-- aqui va el modal de la lista  -->
                    <bs-modal
                        :open.sync="modalproductos"
                        title="Productos Agregados"
                        max-width="85%"
                    >
                        <bs-list-view>
                            <bs-subheader>Summer Recipes</bs-subheader>
                            <template v-for="(item, idx) in ListaCompra">
                                <bs-list-tile :key="item.title" navigable>
                                    <bs-list-tile-leading
                                        :img-src="item.url"
                                        :size="{ height: 56, width: 85 }"
                                        center
                                    >
                                    </bs-list-tile-leading>
                                    <bs-list-tile-content multi-line>
                                        <bs-list-tile-title class="font-weight-bold">
                                            {{ item.name }}
                                        </bs-list-tile-title>
                                        <bs-list-tile-subtitle>
                                            Cantidad : # {{ item.cant }}

                                            <bs-tooltip
                                                content="Eliminar productos"
                                                placement="bottom"
                                            >
                                                <bs-button
                                                    icon="trash-alt"
                                                    mode="icon"
                                                    icon-size="lg"
                                                    color="secondary"
                                                    flat
                                                    @click="EliminarIndice(idx)"
                                                ></bs-button>
                                            </bs-tooltip>
                                        </bs-list-tile-subtitle>
                                    </bs-list-tile-content>
                                    <bs-list-tile-action
                                        class="rating text-grey-500"
                                        :center="false"
                                    >
                                        0{{ idx + 1 }}
                                    </bs-list-tile-action>
                                </bs-list-tile>
                                <bs-divider
                                    v-if="idx + 1 < ListaCompra.length"
                                    :key="item.name + idx"
                                    left-indent="118"
                                >
                                </bs-divider>
                            </template>
                        </bs-list-view>
                    </bs-modal>
                    <!-- aqui termina -->

                    <!-- MODAL DEL PRODUCTO IMAGEN -->

                    <bs-modal :open.sync="modalimagenproductos" max-width="50%">
                        <br />
                        <bs-card-media :title="mensaje">
                            <img :src="imagenp" alt="image" />
                        </bs-card-media>

                        <template v-slot:footer>
                            <bs-button
                                outlined
                                color="secondary"
                                @click="modalimagenproductos = false"
                            >
                                Cancel
                            </bs-button>

                            <!-- <bs-button
                                active
                            v-model="validarRed"

                                color="primary"

                            >
                                OK
                            </bs-button> -->
                        </template>
                    </bs-modal>
                    <!-- FIN DEL MODAL -->
                </bs-card>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 mt-3 card-left">
                <bs-card shadow style="height:90%">
                    <bs-text-area
                        floating-label
                        v-model="datos_inventario_factura.observacion"
                    >
                        <label>Descripción</label>
                    </bs-text-area>
                </bs-card>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mt-3 card-right">
                <bs-card shadow>
                    <bs-list-view>
                        <bs-list-tile>
                            <bs-list-tile-content>
                                <bs-list-tile-title
                                    >SubTotal 12%:
                                    <span class="float-right">{{
                                        datos_inventario_factura.sub_total_12
                                    }}</span>
                                </bs-list-tile-title>
                                <bs-list-tile-title
                                    >SubTotal 0%:
                                    <span class="float-right">{{
                                        datos_inventario_factura.sub_total_0
                                    }}</span>
                                </bs-list-tile-title>
                                <bs-list-tile-title
                                    >Descuento
                                    <span class="float-right"
                                        ><bs-text-field
                                            @change="calcular12y0()"
                                            v-model="
                                                datos_inventario_factura.descuento
                                            "
                                        >
                                        </bs-text-field
                                    ></span>
                                </bs-list-tile-title>
                                <bs-divider></bs-divider>
                                <bs-list-tile-title
                                    >Subtotal
                                    <span class="float-right">{{
                                        datos_inventario_factura.sub_total
                                    }}</span>
                                </bs-list-tile-title>
                                <bs-divider></bs-divider>
                                <bs-list-tile-title
                                    >Iva 12%
                                    <span class="float-right">{{
                                        datos_inventario_factura.iva_12
                                    }}</span>
                                </bs-list-tile-title>
                            </bs-list-tile-content>
                        </bs-list-tile>
                    </bs-list-view>
                    <bs-divider></bs-divider>
                    <bs-list-view>
                        <bs-list-tile>
                            <bs-list-tile-content>
                                <bs-list-tile-title
                                    >Total:
                                    <span class="float-right">{{
                                        datos_inventario_factura.total
                                    }}</span>
                                </bs-list-tile-title>
                            </bs-list-tile-content>
                        </bs-list-tile>
                    </bs-list-view>
                </bs-card>
            </div>
        </div>
    </div>
</template>
<script>
import {BsStore} from "vue-mdbootstrap";
export default {
    data: function() {
        return {
            active_btn: false,
            totalPagar: 0.0,
            srchvalue0: null,
            cantidad: 0,
            autoCloseModalVisible: false,
            modalproductos: false,
            modalimagenproductos: false,
            imagenp: "",
            Lista: [],

            adjuntar: [],
            ListaCompra: [],
            mensaje: "",
            mensaje2: "",
            trueModalVisible: false,
            pagination: {
                messages: {
                    display: "Displaying: {0}-{1} of {2} items"
                },
                pageSize: 5,
                paging: [5, 10, 15, 25, [-1, "All"]]
            },
            datos_inventario_factura: {
                observacion: "",
                sub_total_12: 0.00,
                sub_total_0: 0.00,
                descuento: 0.00,
                sub_total: 0.00,
                iva_12: 0.00,
                total: 0.00
            },
            inventario_p: new BsStore({
                idProperty: "id_producto",
                dataProperty: "producto_inventario",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                // sorts: [{ property: "nombre", direction: "asc" }],
                restProxy: {
                    fetch: this.$store.state.url_prefix +
                        "/modulos/transaccion/factura_venta/productos_invo/{id}"
                }
            }),
            item: {}
        };
    },
    mounted: function() {
        // this.$store.state.inventariofactura = this.ListaCompra;
    },
    computed: {
        envio() {
            this.$store.state.inventariofactura = this.ListaCompra;
            return this.$store.state.inventariofactura;
        },
        sumatoria() {
            let total_for = [];
            var element = 0;
            for (let index = 0; index < this.ListaCompra.length; index++) {
                element += this.ListaCompra[index]["tot"];
            }
            return (this.totalPagar = element.toFixed(2));
        },
        subTotal0() {
            var element = 0;
            for (let index = 0; index < this.ListaCompra.length; index++) {
                element += this.ListaCompra[index]["tot"];
            }
            return (this.totalPagar = element.toFixed(2));
        },
        validarRed() {
            if (this.cantidad > this.Lista.Stock) {
                this.mensaje2 = "El Stock es mayor a la cantidad";
                //  return "El Stock es mayo a la cantidad";
                return true;
            } else if (this.cantidad == 0 || this.cantidad == "") {
                this.mensaje2 = "No puede elegir un valor 0";
                return true;
            } else {
                this.mensaje2 = "";
                return false;
            }
        }
    },
    methods: {
        EliminarIndice(index) {
            this.ListaCompra.splice(index, 1);
        },
        agregarProducto() {
            if (this.adjuntar.length == 0) {
                this.adjuntar.push({
                    url: this.Lista.producto_inv.imagen,
                    id: this.Lista.producto_inv.id,
                    precio: this.Lista.costo_inv.precio,
                    cant: this.cantidad,
                    tot: this.cantidad * this.Lista.costo_inv.precio,
                    name: this.Lista.producto_inv.nombre,
                    iva: this.Lista.producto_inv.iva,
                    idfac: this.Lista.id,
                    idfacCompra: this.Lista.id_factura,
                    total: this.cantidad * this.Lista.costo_inv.precio
                });
                //        this.adjuntar.id_pro_f = this.Lista.producto_inv.id;
                // this.adjuntar.precio_f = this.Lista.costo_inv.precio;
                // this.adjuntar.cantidad_f = this.cantidad;
                // this.adjuntar.totalPagar_f = this.totalPagar;
                this.ListaCompra = this.adjuntar;
                this.$store.state.datos_inventario_factura = this.datos_inventario_factura;
                /* this.$store.state.datos_inventario_factura.sub_total_12 = this.datos_inventario_factura.sub_total_12;
                this.$store.state.datos_inventario_factura.sub_total_0 = this.datos_inventario_factura.sub_total_0;
                this.$store.state.datos_inventario_factura.descuento = this.datos_inventario_factura.descuento;
                this.$store.state.datos_inventario_factura.sub_total = this.datos_inventario_factura.sub_total;
                this.$store.state.datos_inventario_factura.iva_12 = this.datos_inventario_factura.iva_12;
                this.$store.state.datos_inventario_factura.total = this.datos_inventario_factura.total; */
                console.log(this.$store.state.datos_inventario_factura);
                console.log(this.datos_inventario_factura);
                // return;
            } else {
                for (let i = 0; i < this.adjuntar.length; i++) {
                    if (this.adjuntar[i].id == this.Lista.producto_inv.id) {
                        this.showNotificationProgress(
                            "Facturacion",
                            "El producto ya esta Agregado",
                            "error"
                        );
                        return;
                    }
                }

                this.adjuntar.push({
                    url: this.Lista.producto_inv.imagen,
                    id: this.Lista.producto_inv.id,
                    precio: this.Lista.costo_inv.precio,
                    cant: this.cantidad,
                    tot: this.cantidad * this.Lista.costo_inv.precio,
                    name: this.Lista.producto_inv.nombre,
                    iva: this.Lista.producto_inv.iva,
                    idfac: this.Lista.id,
                    idfacCompra: this.Lista.id_factura,
                    total: this.cantidad * this.Lista.costo_inv.precio
                });
                this.ListaCompra = this.adjuntar;
            }

            /* this.adjuntar.push({
                url: this.Lista.producto_inv.imagen,
                id: this.Lista.producto_inv.id,
                precio: this.Lista.costo_inv.precio,
                cant: this.cantidad,
                tot: this.cantidad * this.Lista.costo_inv.precio,
                name: this.Lista.producto_inv.nombre,
                iva: this.Lista.producto_inv.iva,
                idfac: this.Lista.id,
                idfacCompra: this.Lista.id_factura
            }); */
            this.ListaCompra = this.adjuntar;
            this.calcular12y0();

            this.autoCloseModalVisible = false;
        },
        calcular12y0() {
            var sub_total_12 = 0.00;
            var sub_total_0 = 0.00;
            var descuento = 0.00;
            var sub_total = 0.00;
            var iva_12 = 0.00;
            var total = 0.00;
            this.adjuntar.forEach(function(data) {
                //tiene iva
                if (data.iva) {
                    sub_total_12 += +data.total;
                    //no tiene iva
                } else {
                    sub_total_0 += +data.total;
                }
            });
            descuento = +this.datos_inventario_factura.descuento;
            sub_total = +(sub_total_12 + sub_total_0) - descuento;
            iva_12 = sub_total_12 * 0.12;
            total = sub_total + iva_12;

            this.datos_inventario_factura.sub_total_12 = sub_total_12.toFixed(2);
            this.datos_inventario_factura.sub_total_0 = sub_total_0.toFixed(2);
            this.datos_inventario_factura.sub_total = sub_total.toFixed(2);
            this.datos_inventario_factura.iva_12 = iva_12.toFixed(2);
            this.datos_inventario_factura.total = total.toFixed(2);
        },
        calcular() {
            // this.totalPagar = this.cantidad * this.Lista.costo_inv.precio;
        },
        async onSearch(term) {
            var that = this;
            this.srchvalue0 = term;
            this.inventario_p.fetch(term);
        },
        btnClickModificar(item) {
            this.autoCloseModalVisible = true;
            this.Lista = item;
            this.mensaje =
                item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;
        },
        btnClickMostar(item) {
            this.modalimagenproductos = true;
            // this.Lista= item;
            this.imagenp = item.producto_inv.imagen;
            this.mensaje =
                item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;
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

    .card-right {
        margin-left: auto;
    }
}
</style>
