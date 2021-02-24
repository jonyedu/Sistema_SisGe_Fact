<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-grid
                    :data-source="source0"
                    :pageable="{
                        messages: {
                            empty: 'No hay Items',
                            //display: 'items'
                            pager: 'Items por Página'
                        }
                    }"
                    row-hover
                    sortable
                    :flip-on-small-screen="false"
                >
                    <bs-grid-toolbar slot="toolbar">
                        <div class="row justify-content-end">
                            <div class="col-lg-6">
                                <bs-grid-tool-search
                                    autofocus
                                    :placeholder="'Busqueda'"
                                    field="text"
                                    operator="contains"
                                ></bs-grid-tool-search>
                            </div>
                        </div>
                    </bs-grid-toolbar>
                    <bs-grid-column
                        label="#"
                        text-align="right"
                        width="50"
                        row-numbering
                    ></bs-grid-column>
                    <bs-grid-column
                        field="descripcion"
                        label="Descripcion"
                        width="300"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="laboratorio.nombre"
                        label="Laboratorio"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="grupo.codigo"
                        label="Grupo"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="pvc"
                        label="PVC"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="stock_minimo"
                        label="Stock Min"
                        width="95"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="stock_maximo"
                        label="Stock Max"
                        width="95"
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
                                    prefijo +
                                        '/modulos/administracion/producto/crear_modificar_producto?item='+item
                                "
                            >
                                <bs-button
                                    icon="pen"
                                    mode="icon"
                                    size="sm"
                                    color="secondary"
                                    flat
                                ></bs-button>
                            </router-link>

                            <bs-button
                                icon="trash-alt"
                                mode="icon"
                                size="sm"
                                color="danger"
                                flat
                                @click="btnClick(item, 'Delete Item')"
                            ></bs-button>
                        </bs-grid-cell>
                    </template>
                </bs-grid>
            </bs-card>
        </div>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            prefijo: "",
            source0: new BsStore({
                idProperty: "id",
                dataProperty: "productos",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "nombre", direction: "asc" }],
                restProxy: {
                    browse:
                        "/modulos/administracion/producto/cargar_all_producto",
                    delete: { url: "/modulos/administracion/producto/eliminar_producto", method: "delete" },
                    save: { url: "/modulos/administracion/producto/guardar_producto", method: "post" },
                    update: { url: "/modulos/administracion/producto/actualizar_producto", method: "put" }
                }
            })
        };
    },

    mounted: function() {
        //this.cargarModulo();
        /* let nombreModulo = this.$nombresModulo.datos_generales;
        let nombreFormulario = this.$nombresFormulario.datos_generales
            .generalidades.organizacion_bspi.organizacion_bspi
            .nombre_formulario;
        this.$funcionesGlobales.registrarLogForm(
            nombreModulo,
            nombreFormulario,
            "Ingreso"
        ); */
        this.prefijo = prefix;
    },
    beforeDestroy() {
    },
    methods: {
        btnClick(item, title) {
            this.$notification.info("Current item: " + item.descripcion, title);
        }
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;
}
</style>
