<template>
    <div class="content-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                $store.state.url_prefix +
                                    '/modulos/seguridad/sub_modulo/crear_modificar_sub_modulo'
                            "
                        >
                            <bs-tooltip
                                content="Crear nuevos modulos"
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
                    ref="gridSubModulo"
                    :data-source="subModulos"
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
                        field="descripcion"
                        label="Descripción"
                        min-width="300"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="modulo.descripcion"
                        label="Modulo"
                        min-width="200"
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
                                    $store.state.url_prefix +
                                        '/modulos/seguridad/sub_modulo/crear_modificar_sub_modulo'
                                "
                            >
                                <bs-tooltip
                                    content="Modificar sub modulos"
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
                                content="Eliminar sub modulos"
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
  
        <bs-modal
            :open.sync="trueModalVisible"
            :overlay-close="false"
            title="Confirmación al Eliminar"
            max-width="85%"
        >
            <b>¿Desea eliminar el sub modulo?</b><br />
            Al eliminar el sub modulo, no podrá usarlo en las transacciones. <br />
            Presiones Cancelar o presione ESC para salir.

            <template v-slot:footer>
                <bs-button
                    outlined
                    color="secondary"
                    @click="trueModalVisible = false"
                >
                    Cancelar
                </bs-button>
                <bs-button active color="primary" @click="eliminarSubModulo()">
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
            subModulos: new BsStore({
                idProperty: "codigo",
                dataProperty: "subModulos",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "descripcion", direction: "asc" }],
                restProxy: {
                    browse: this.$store.state.url_prefix + "/modulos/seguridad/sub_modulo/cargar_sub_modulo_table"
                }
            }),
            item: {}
        };
    },
    mounted: function() {
    },
    beforeDestroy: function() {},
    methods: {
        btnClickModificar(item) {
            this.$store.state.subModulo = item;
        },
        abriModal(item) {
            this.trueModalVisible = true;
            this.item = item;
        },
        eliminarSubModulo() {
            let that = this;
            let url = this.$store.state.url_prefix +
                "/modulos/seguridad/sub_modulo/eliminar_sub_modulo/" +
                this.item.codigo;
            axios
                .delete(url)
                .then(function() {
                    that.trueModalVisible = false;
                    that.$refs.gridSubModulo.reload();
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Usted ha eliminado correctamente el modulo." +
                            that.item.descripcion,
                        "success"
                    );
                })
                .catch(error => {
                    that.trueModalVisible = false;
                    that.showNotificationProgress(
                        "Error en eliminarModulo",
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
