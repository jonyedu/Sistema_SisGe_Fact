<template>
    <div class="my-demo-wrapper">
        <bs-card-body>
            <bs-alert color="success">
                Total a Pagar : $ {{ totalPagar }}
            </bs-alert>
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
        <bs-card shadow>
            <bs-grid
                :data-source="inventario_p"
                :pageable="pagination"
                row-hover
            >
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
                                icon="photo-video"
                                mode="icon"
                                icon-size="lg"
                                color="secondary"
                                flat
                                @click="btnClickModificar(item)"
                            ></bs-button>
                        </bs-tooltip>
                        <bs-tooltip
                            content="Modificar productos"
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
            <bs-modal
                :open.sync="autoCloseModalVisible"
                title="Cantidad de Producto"
                max-width="85%"
            >
                {{ mensaje }}
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
                        active
                        color="primary"
                        @click="agregarProducto()"
                    >
                        OK
                    </bs-button>
                </template>
            </bs-modal>
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
        </bs-card>
    </div>
</template>
<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            totalPagar: 0,
            srchvalue0: null,
            cantidad: 0,
            autoCloseModalVisible: false,
            modalproductos: false,
            prefijo: "",
            Lista: [],
            // adjuntar:{
            //   id_pro_f:0,
            //   precio_f:0,
            //   cantidad_f:0,
            //   totalPagar_f:0,
            // },

            adjuntar: [],
            ListaCompra: [],
            mensaje: "",
            trueModalVisible: false,
            pagination: {
                messages: {
                    display: "Displaying: {0}-{1} of {2} items"
                },
                pageSize: 5,
                paging: [5, 10, 15, 25, [-1, "All"]]
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
    computed: {},
    methods: {
        agregarProducto() {
            if (this.adjuntar.length == 0) {
                this.adjuntar.push({
                    url:
                        "https://vue-mdbootstrap.fajarconsultant.com/img/crunchy-croissants.jpg",
                    id: this.Lista.producto_inv.id,
                    precio: this.Lista.costo_inv.precio,
                    cant: this.cantidad,
                    tot: this.totalPagar,
                    name: this.Lista.producto_inv.nombre
                });
                //        this.adjuntar.id_pro_f = this.Lista.producto_inv.id;
                // this.adjuntar.precio_f = this.Lista.costo_inv.precio;
                // this.adjuntar.cantidad_f = this.cantidad;
                // this.adjuntar.totalPagar_f = this.totalPagar;
                this.ListaCompra = this.adjuntar;
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
                    url:
                        "https://vue-mdbootstrap.fajarconsultant.com/img/crunchy-croissants.jpg",
                    id: this.Lista.producto_inv.id,
                    precio: this.Lista.costo_inv.precio,
                    cant: this.cantidad,
                    tot: this.totalPagar,
                    name: this.Lista.producto_inv.nombre
                });
                this.ListaCompra = this.adjuntar;
            }

            console.log(this.adjuntar);
            this.autoCloseModalVisible = false;
            // if(!this.adjuntar.includes(this.Lista.producto_inv.id)){
            //       //Si no está un, entonces lo insertamos
            //          this.adjuntar.id_pro_f = this.Lista.producto_inv.id;
            // this.adjuntar.precio_f = this.Lista.costo_inv.precio;
            // this.adjuntar.cantidad_f = this.cantidad;
            // this.adjuntar.totalPagar_f = this.totalPagar;
            // this.ListaCompra= this.adjuntar;
            //   }
            //   else{
            //       //De lo contrario
            //     this.showNotificationProgress(
            //                   "Facturacion",
            //                   "El producto ya esta Agregado" ,
            //                   "error"
            //               );
            //   }
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
