<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <div class="row">
                <div class="col-lg-12 offset-lg-12">
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de Producto</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="form.nombre"
                                        >
                                            <label>Nombres</label>
                                        </bs-text-field>
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="form.descripcion"
                                            stockMaximoValidator
                                        >
                                            <label>Descripción</label>
                                        </bs-text-field>
                                        <bs-combobox
                                            prepend-icon-outer="user"
                                            v-model="form.laboratorio_id"
                                            :data-source="laboratorios"
                                            floating-label
                                            outlined
                                        >
                                            <label>Laboratorio</label>
                                        </bs-combobox>
                                    </div>
                                    <div class="col-lg-6">
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="form.nombre_corto"
                                        >
                                            <label>Nombre Corto</label>
                                        </bs-text-field>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="form.stock_minimo"
                                                >
                                                    <label>Mínimo</label>
                                                </bs-text-field>
                                            </div>
                                            <div class="col-lg-4">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="form.stock_maximo"
                                                    stockMaximoValidator
                                                >
                                                    <label>Máximo</label>
                                                </bs-text-field>
                                            </div>
                                            <div class="col-lg-4">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="form.stock_maximo"
                                                >
                                                    <label>PVC</label>
                                                </bs-text-field>
                                            </div>
                                        </div>
                                        <bs-combobox
                                            prepend-icon-outer="user"
                                            v-model="form.grupo_id"
                                            :data-source="grupos"
                                            floating-label
                                            outlined
                                        >
                                            <label>Grupo</label>
                                        </bs-combobox>
                                    </div>
                                </div>
                            </bs-card-content>
                        </bs-card-body>
                        <bs-card-footer class="text-right">
                            <router-link
                                :to="
                                    prefijo +
                                        '/modulos/administracion/producto/mostrar_producto'
                                "
                                ><bs-button>regresar</bs-button></router-link
                            ><bs-button color="success"
                                >guardar</bs-button
                            ></bs-card-footer
                        >
                    </bs-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            prefijo: "",
            form: {
                data:{},
                nombre: "",
                nombre_corto: "",
                stock_maximo: "",
                stock_minimo: "",
                pvc: "",
                descripcion: "",
                grupo_id: 0,
                laboratorio_id: 0
            },

            grupos: {
                proxy: new BsStore({
                    idProperty: "Id",
                    dataProperty: "grupos",
                    totalProperty: "total",
                    remoteSort: false,
                    restProxy: {
                        browse:
                            "/modulos/administracion/grupo/cargar_grupo_combo"
                    }
                }),
                schema: { displayField: "Codigo", valueField: "Id" }
            },
            laboratorios: {
                proxy: new BsStore({
                    idProperty: "id",
                    dataProperty: "laboratorios",
                    totalProperty: "total",
                    remoteSort: false,
                    restProxy: {
                        browse:
                            "/modulos/administracion/laboratorio/cargar_laboratorio_combo"
                    }
                }),
                schema: { displayField: "nombre", valueField: "id" }
            }
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
        this.form.data= this.$route.query.item.descripcion;
    },

    methods: {}
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;

    .btn {
        margin-bottom: 16px;
        margin-right: 8px;
    }
}
</style>
