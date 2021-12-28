<template>
    <div class="content-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                $store.state.url_prefix +
                                    '/modulos/persona/cliente/crear_modificar_cliente'
                            "
                        >
                            <bs-tooltip
                                content="Crear nuevos clientes"
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
                    ref="gridcliente"
                    :data-source="clientes"
                    :pageable="{
                        messages: {
                            empty: 'No hay Artículos',
                            display: '{0}-{1} de {2} Artículos',
                            pager: 'Artículos por Página'
                        },
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
                        field="nombres"
                        label="Nombre"
                        width="150"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="apellidos"
                        label="Apellido"
                        width="150"
                    ></bs-grid-column>
                     <bs-grid-column
                        field="cedula"
                        label="Cédula"
                        width="100"
                    ></bs-grid-column>
                     <bs-grid-column
                        field="telefono"
                        label="Teléfono"
                        width="100"
                    ></bs-grid-column>
                     <bs-grid-column
                        field="direccion"
                        label="Dirección"
                        width="200"
                    ></bs-grid-column>
                   <bs-grid-column
                        field="correo"
                        label="Correo"
                        width="150"
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
                        ></bs-grid-cell>
                           <bs-grid-cell
                            :column="columns[6]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell>

                        <bs-grid-cell
                            :column="columns[7]"
                            :item="item"
                            :index="index"
                        >
                            <router-link
                                :to="
                                    $store.state.url_prefix +
                                        '/modulos/persona/cliente/crear_modificar_cliente'
                                "
                            >
                                <bs-tooltip
                                    content="Modificar clientes"
                                    placement="bottom"
                                >
                                    <bs-button
                                        v-if="item.cliente_id != 1"
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
                                content="Eliminar clientes"
                                placement="bottom"
                            >
                                <bs-button
                                    v-if="item.cliente_id != 1"
                                    icon="trash-alt"
                                    mode="icon"
                                    size="sm"
                                    color="danger"
                                    flat
                                    @click="
                                        abriModal(item)
                                    "
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
            <b>¿Desea eliminar el cliente?</b><br />
            Al eliminar el cliente, no podrá usarlo en las transacciones. <br> Presiones Cancelar o presione ESC para salir.

            <template v-slot:footer>
                <bs-button
                    outlined
                    color="secondary"
                    @click="trueModalVisible = false"
                >
                    Cancelar
                </bs-button>
                <bs-button
                    active
                    color="primary"
                    @click="eliminarcliente()"
                >
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
            trueModalVisible:false,
            clientes: new BsStore({
                idProperty: "cliente_id",
                dataProperty: "clientes",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "nombres", direction: "asc" }],
                restProxy: {
                    browse: this.$store.state.url_prefix +
                        "/modulos/persona/cliente/cargar_cliente_all"
                }
            }),
            item:{},
        };
    },

    mounted: function() {
    },
    beforeDestroy() {},
    methods: {
        btnClickModificar(item) {
            this.$store.state.cliente = item;
           // console.log(item);

        },
        abriModal(item ) {
            this.trueModalVisible=true;
            this.item = item;
        },
        eliminarcliente() {
            let that = this;
            let url = this.$store.state.url_prefix +
                "/modulos/persona/cliente/eliminar_cliente/" +
                this.item.cliente_id;
            axios
                .delete(url)
                .then(function() {
                    that.trueModalVisible = false;
                    that.$refs.gridcliente.reload();
                    that.showNotificationProgress(
                        "Exito al procesar",
                        "Usted ha eliminado correctamente el cliente." + that.item.nombres,
                        "success"
                    );
                })
                .catch(error => {
                    that.trueModalVisible = false;
                    that.showNotificationProgress(
                        "Error en eliminarcliente",
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
    }
};
</script>
