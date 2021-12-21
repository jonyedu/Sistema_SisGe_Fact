<template>
    <div class="my-demo-wrapper">
        <div class="row">
            <div v-if="false" class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <bs-card-body>
                    <bs-alert color="success">
                        Total a Pagar : $
                        <!-- {{ sumatoria }} -->
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
                <bs-grid
                    :data-source="productosCarrito"
                    row-hover
                    sortable
                    :flip-on-small-screen="false"
                >
                    <bs-grid-column
                        field="cantidad"
                        label="Cantidad"
                        width="125"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="nombre"
                        label="Producto"
                        min-width="175"
                    >
                    </bs-grid-column>
                    <bs-grid-column
                        field="precio"
                        label="Precio"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="total"
                        label="Total"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field=""
                        label="Acciones"
                        width="100"
                    ></bs-grid-column>
                    <template v-slot:datarow="{ columns, item, index }">
                        <bs-grid-cell
                            :column="columns[0]"
                            :item="item"
                            :index="index"
                        >
                            <bs-text-field
                                @change="calcular12y0()"
                                v-model="item.cantidad"
                            >
                            </bs-text-field>
                        </bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[1]"
                            :item="item"
                            :index="index"
                        >
                            <bs-combobox
                                v-model="item.producto_id"
                                :data-source="cmb.productos"
                                clear-button
                                @change="setDataProductoComboBox(item)"
                            >
                            </bs-combobox>
                        </bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[2]"
                            :item="item"
                            :index="index"
                        >
                            <bs-text-field
                                @change="calcular12y0()"
                                v-model="item.precio"
                            >
                            </bs-text-field>
                        </bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[3]"
                            :item="item"
                            :index="index"
                        >
                            <span
                                @change="calcular12y0()"
                                v-text="item.cantidad * item.precio"
                            >
                            </span>
                        </bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[4]"
                            :item="item"
                            :index="index"
                        >
                            <bs-tooltip
                                content="Eliminar productos"
                                placement="bottom"
                            >
                                <bs-button
                                    icon="trash-alt"
                                    mode="icon"
                                    size="sm"
                                    color="danger"
                                    flat
                                    @click="quitarProducto(index)"
                                ></bs-button>
                            </bs-tooltip>
                        </bs-grid-cell>
                    </template>
                </bs-grid>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 mt-3 ">
                        <bs-button
                            class="btn"
                            icon-size="sm"
                            icon="shopping-cart"
                            @click="agregarDetalle()"
                            color="primary"
                            pill
                            >Agregar detalle</bs-button
                        >
                    </div>
                </div>
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
                                            class="text-right"
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
import {BsArrayStore } from "vue-mdbootstrap";
export default {
    data: function() {
        return {
            //por mi controla
            productosCarrito: new BsArrayStore([], {
                idProperty: "index"
            }),
            cmb: {
                productos: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "producto_inventario",
                        totalProperty: "total",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/inventario/producto/cargar_producto_inventario_combo_box"
                        }
                    }),
                    schema: {
                        displayField: "nombre",
                        valueField: "id"
                    }
                }
            },

            active_btn: false,
            totalPagar: 0.0,
            srchvalue0: null,
            cantidad: 0,
            autoCloseModalVisible: false,
            modalproductos: false,
            modalimagenproductos: false,
            prefijo: "",
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
                sub_total_12: 0.0,
                sub_total_0: 0.0,
                descuento: 0.0,
                sub_total: 0.0,
                iva_12: 0.0,
                total: 0.0
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
                    // browse:"/modulos/administracion/facturacion/productos_invo/",
                    fetch:
                        "/modulos/transaccion/factura_venta/productos_invo/{id}"
                }
            }),
            item: {}
        };
    },
    mounted: function() {
        this.agregarDetalle();
        // this.$store.state.inventariofactura = this.ListaCompra;
    },
    computed: {
        envio() {
            //this.$store.state.inventariofactura = this.ListaCompra;
            this.$store.state.inventariofactura = this.productosCarrito._items;
            return this.$store.state.inventariofactura;
        },
        /* sumatoria() {
            let total_for = [];
            var element = 0;
            for (let index = 0; index < this.ListaCompra.length; index++) {
                element += this.ListaCompra[index]["tot"];
            }
            return (this.totalPagar = element.toFixed(2));
        }, */
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
        setDataProductoComboBox(item) {
            var dataProductoSelect = this.cmb.productos.proxy._items.find(
                producto => producto.id == item.producto_id
            );
            item.producto_inventario_id =dataProductoSelect.id;
            item.iva =dataProductoSelect.iva;
            item.precio = +dataProductoSelect.preciou;
            item.precio = item.precio.toFixed(2);
            item.total =dataProductoSelect.pvc * item.cantidad;
            this.calcular12y0();
            this.$store.state.inventariofactura = this.productosCarrito._items;
            this.$store.state.datos_inventario_factura = this.datos_inventario_factura;
        },
        agregarDetalle() {
            this.productosCarrito._items.push({
                producto_inventario_id:0,
                producto_id: 0,
                stock: 0,
                precio: 0,
                cantidad: 0,
                iva: 0,
                total: 0
            });
        },
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
            var sub_total_12 = 0.0;
            var sub_total_0 = 0.0;
            var descuento = 0.0;
            var sub_total = 0.0;
            var iva_12 = 0.0;
            var total = 0.0;
            this.productosCarrito._items.forEach(function(data) {
                data.total = data.cantidad * data.precio;
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

            this.datos_inventario_factura.sub_total_12 = sub_total_12.toFixed(
                2
            );
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
