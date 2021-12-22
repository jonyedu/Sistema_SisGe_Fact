<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                $store.state.url_prefix +
                                    '/modulos/inventario/producto/crear_modificar_producto'
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
                        field="nombre"
                        label="Nombre"
                        width="300"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="proveedor.razon_social"
                        label="Proveedor"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="grupo.descripcion"
                        label="Grupo"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="pvc"
                        label="PVC"
                        width="100"
                    ></bs-grid-column>
                    <!-- <bs-grid-column
                        field="producto_inventario_many"
                        label="Stock"
                        width="100"
                        text-align="center"
                    ></bs-grid-column> -->
                    <bs-grid-column
                        field="producto_inventario_many"
                        label="Stock"
                        width="100"
                        text-align="center"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="imagen"
                        label="Imagen"
                        width="100"
                        text-align="center"
                    ></bs-grid-column>
                    <!-- <bs-grid-column
                        field="stock_minimo"
                        label="Stock Min"
                        width="95"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="stock_maximo"
                        label="Stock Max"
                        width="95"
                    ></bs-grid-column> -->
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
                            <span>
                                {{ item.stock != null ? item.stock : 0 }}
                            </span>
                        </bs-grid-cell>
                        <!-- <bs-grid-cell
                            :column="columns[5]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[6]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell> -->
                        <bs-grid-cell
                            :column="columns[6]"
                            :item="item"
                            :index="index"
                        >
                            <bs-list-tile-leading
                                :img-src="item.imagen"
                                circle
                            ></bs-list-tile-leading>
                        </bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[7]"
                            :item="item"
                            :index="index"
                        >
                            <router-link
                                :to="
                                    $store.state.url_prefix +
                                        '/modulos/inventario/producto/crear_modificar_producto'
                                "
                            >
                                <bs-tooltip
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
                <bs-button active color="primary" @click="eliminarProducto()">
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
                dataProperty: "productos",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "nombre", direction: "asc" }],
                restProxy: {
                    browse: this.$store.state.url_prefix + "/modulos/inventario/producto/cargar_all_producto"
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
            this.$store.state.producto = item;
        },
        abriModal(item) {
            this.trueModalVisible = true;
            this.item = item;
        },
        eliminarProducto() {
            let that = this;
            let url = this.$store.state.url_prefix +
                "/modulos/inventario/producto/eliminar_producto/" +
                this.item.id;
            axios
                .delete(url)
                .then(function() {
                    that.trueModalVisible = false;
                    that.$refs.gridProducto.reload();
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Usted ha eliminado correctamente el producto." +
                            that.item.descripcion,
                        "success"
                    );
                })
                .catch(error => {
                    that.trueModalVisible = false;
                    that.showNotificationProgress(
                        "Error en eliminarProducto",
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
        }
    }
};
</script>
