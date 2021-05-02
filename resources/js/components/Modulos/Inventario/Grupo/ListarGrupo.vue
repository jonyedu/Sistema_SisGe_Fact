<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                prefijo +
                                    '/modulos/inventario/grupo/crear_modificar_grupo'
                            "
                        >
                            <bs-tooltip
                                content="Crear nuevos grupo"
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
            <bs-card>
                <bs-grid
                    ref="gridGrupo"
                    :data-source="grupos"
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
                        field="codigo"
                        label="Codigo"
                        min-width="400"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="descripcion"
                        label="Descripcion"
                        min-width="400"
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
                        >
                            <router-link
                                :to="
                                    prefijo +
                                        '/modulos/inventario/grupo/crear_modificar_grupo'
                                "
                            >
                                <bs-tooltip
                                    content="Modificar grupo"
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
                                content="Eliminar grupo"
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
            <b>¿Desea eliminar el grupo?</b><br />
            Al eliminar el grupo, no podrá usarlo en las transacciones. <br />
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
            grupos: new BsStore({
                idProperty: "Id",
                dataProperty: "grupos",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "descripcion", direction: "asc" }],
                restProxy: {
                    browse: "/modulos/inventario/grupo/cargar_grupo_table"
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
            this.$store.state.grupo = item;
        },
        abriModal(item) {
            this.trueModalVisible = true;
            this.item = item;
        },
        eliminar() {
            let that = this;
            let url =
                "/modulos/inventario/grupo/eliminar_grupo/" + this.item.id;
            axios
                .delete(url)
                .then(function() {
                    that.trueModalVisible = false;
                    that.$refs.gridGrupo.reload();
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Usted ha eliminado correctamente el grupo " +
                            that.item.Descripcion,
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
