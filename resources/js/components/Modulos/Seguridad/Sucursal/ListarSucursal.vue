<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                prefijo +
                                    '/modulos/seguridad/sucursal/crear_modificar_sucursal'
                            "
                        >
                            <bs-tooltip
                                content="Crear nuevas sucursales"
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
            <bs-card >
                <bs-grid
                    ref="gridsucursal"
                    :data-source="sucursales"
                    :pageable="{
                        //Configure los mensajes de texto de paginación. Las propiedades del objeto son:
                        messages: {
                            empty: 'No hay Artículos',
                            display: '{0}-{1} de {2} Artículos',
                            pager: 'Artículos por Página'
                        }
                        //Número de elementos por página. Cuando esté vacío, se utilizará el valor de BsStoreo BsArrayStore.
                        //pageSize:[10,15,25,80],
                        //Establece los valores de la lista del cuadro combinado de paginación.
                        //paging:[10,15,25,50]
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
                        field="Sucursal_Nombre"
                        label="Nombre"
                        width="200"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="Sucursal_Administrador"
                        label="Administrador"
                        width="200"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="Sucursal_Direccion"
                        label="Dirección"
                        width="200"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="Sucursal_EMail"
                        label="Email"
                        width="200"
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
                            :column="columns[2]"
                            :item="item"
                            :index="index"
                        >
                            <router-link
                                :to="
                                    prefijo +
                                        '/modulos/seguridad/sucursal/crear_modificar_sucursal'
                                "
                            >
                                <bs-tooltip
                                    content="Modificar sucursales"
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
                                content="Eliminar sucursales"
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
            <b>¿Desea eliminar la sucursal?</b><br />
            Al eliminar la sucursal, no podrá usarlo en las transacciones. <br />
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
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            prefijo: "",
            trueModalVisible: false,
            sucursales: new BsStore({
                idProperty: "Sucursal_Id",
                dataProperty: "sucursales",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "Sucursal_Nombre", direction: "asc" }],
                restProxy: {
                    browse: "/modulos/seguridad/sucursal/cargar_sucursal_table"
                }
            }),
            item: {}
        };
    },
    mounted: function() {
        this.prefijo = prefix;
    },
    beforeDestroy: function() {},
    methods: {
        btnClickModificar(item) {
            this.$store.state.sucursal = item;
        },
        abriModal(item) {
            this.trueModalVisible = true;
            this.item = item;
        },
        eliminar() {
            let that = this;
            let url =
                "/modulos/seguridad/sucursal/eliminar_sucursal/" +
                this.item.Sucursal_Id;
            axios
                .delete(url)
                .then(function() {
                    that.trueModalVisible = false;
                    that.$refs.gridsucursal.reload();
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Usted ha eliminado correctamente el sucursal." +
                            that.item.Sucursal_Nombre,
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
        }
    }
};
</script>

