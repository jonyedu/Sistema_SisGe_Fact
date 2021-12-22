<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                $store.state.url_prefix +
                                    '/modulos/transaccion/factura_venta/crear_modificar_factura_venta'
                            "
                        >
                            <bs-tooltip
                                content="Crear nuevos productos"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="plus"
                                    icon-size="sm"
                                ></bs-button>
                            </bs-tooltip>
                        </router-link>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <bs-grid
                    ref="gridProducto"
                    :data-source="productos"
                    :pageable="{
                        messages: {
                            empty: 'No hay Artículos',
                            display: '{0}-{1} de {2} Artículos',
                            pager: 'Artículos por Página'
                        }
                    }"
                    row-hover
                    sortable
                    :flip-on-small-screen="false"
                    :filterable="{ minlength: 2, operator: 'contains' }"
                >
                    <bs-grid-column
                        label="#"
                        text-align="right"
                        width="25"
                        row-numbering
                    ></bs-grid-column>
                    <bs-grid-column
                        field="DATE"
                        label="Fecha"
                        width="130"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="cliente.NOMBRESCLIENTEPRO"
                        label="Cliente"
                        width="300"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="secuencia"
                        label="Secuencia"
                        width="150"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="totalapagar"
                        label="Total"
                        width="75"
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
                            ><span> {{ index + 1 }} </span>
                        </bs-grid-cell>
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
                        ></bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[4]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell>

                        <bs-grid-cell
                            :column="columns[5]"
                            :item="item"
                            :index="index"
                        >
                            <router-link
                                :to="
                                    $store.state.url_prefix +
                                        '/modulos/transaccion/laboratorio/crear_modificar_laboratorio'
                                "
                            >
                                <bs-tooltip
                                    v-if="false"
                                    content="Modificar productos"
                                    placement="bottom"
                                >
                                    <bs-button
                                        icon="pen"
                                        mode="icon"
                                        size="sm"
                                        color="secondary"
                                        flat
                                        @click="btnClickModificar(item)"
                                    ></bs-button>
                                </bs-tooltip>
                            </router-link>
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
                                    @click="abriModal(item)"
                                ></bs-button>
                            </bs-tooltip>
                            <bs-tooltip
                                content="Imprimir Factura de Compra"
                                placement="bottom"
                            >
                                <bs-button
                                    icon="file-pdf"
                                    mode="icon"
                                    size="sm"
                                    color="red"
                                    flat
                                    @click="imprimirPdf(item)"
                                >
                                </bs-button>
                            </bs-tooltip>
                            <bs-tooltip
                                content="Enviar Factura al Proveedor"
                                placement="bottom"
                            >
                                <bs-button
                                    icon="file-import"
                                    mode="icon"
                                    size="sm"
                                    color="info"
                                    flat
                                    @click="enviarPdf(item)"
                                >
                                </bs-button>
                            </bs-tooltip>
                        </bs-grid-cell>
                    </template>
                </bs-grid>
            </bs-card>
        </div>
        <bs-modal
            :open.sync="trueModalVisible"
            :overlay-close="false"
            title="Confirmación al Eliminar"
            max-width="85%"
        >
            <b>¿Desea eliminar el producto?</b><br />
            Al eliminar el producto, no podrá usarlo en las transacciones.
            <br />
            Presiones Cancelar o presione ESC para salir.

            <template v-slot:footer>
                <bs-button
                    outlined
                    color="secondary"
                    @click="trueModalVisible = false"
                >
                    Cancelar
                </bs-button>
                <bs-button active color="primary" @click="eliminar()">
                    OK
                </bs-button>
            </template>
        </bs-modal>
    </div>
</template>

<script>
import {BsStore} from "vue-mdbootstrap";
export default {
    data: function() {
        return {
            trueModalVisible: false,
            productos: new BsStore({
                idProperty: "id",
                dataProperty: "factura",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "fecha", direction: "asc" }],
                restProxy: {
                    browse: this.$store.stateicon="list" +
                        "/modulos/transaccion/factura_venta/cargar_facturas_dia"
                }
            }),
            item: {}
        };
    },

    mounted: function() {
    },
    beforeDestroy() {},
    methods: {
        btnClickModificar(item) {
            this.$store.state.laboratorio = item;
            // console.log(item);
        },
        abriModal(item) {
            this.trueModalVisible = true;
            this.item = item;
        },
        eliminar() {
            let that = this;
            let url = this.$store.stateicon="list" +
                "/modulos/transaccion/factura_venta/eliminar_factura_venta/" +
                this.item.id;
            axios
                .delete(url)
                .then(function() {
                    that.trueModalVisible = false;
                    that.$refs.gridProducto.reload();
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Usted ha eliminado correctamente la factura de venta: " +
                            that.item.secuencia,
                        "success"
                    );
                })
                .catch(error => {
                    that.trueModalVisible = false;
                    that.showNotificationProgress(
                        "Error en eliminar",
                        "Por favor comuníquese con el administrador." + error,
                        "error"
                    );
                });
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
        imprimirPdf(item) {
            if (item.id > 0) {
                window.open(this.$store.state.url_prefix + "/modulos/reporte/factura_venta/cargar_pdf_factura_venta/" +
                    item.id   +
                    "/" +
                    true + "/" +
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
        enviarPdf(item) {
            if (item.id > 0) {
                window.open(this.$store.state.url_prefix + "/modulos/reporte/factura_venta/cargar_pdf_factura_venta/" +
                    item.id  +
                    "/" +
                    true + "/" +
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
}
</style>
