<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-left">
                            <li>
                                <router-link
                                    :to="prefijo"
                                    style="margin-top:-9px"
                                    class="nav-link"
                                    >Home</router-link
                                >
                            </li>
                            <li><p>/</p></li>
                            <li><p style="margin-left:10px">Mantenimiento de SubModulo</p></li>
                        </ol>
                    </div>
                    &nbsp;
                    <!-- Seccion de los menu de botones: Historial clínico, Nueva, Guardar, etc y la Tabla Historial Clinico-->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-lg-12 col-md-12 col-sm-12 text-right"
                                    >
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="float-right">
                                                    <button
                                                        class="btn btn-primary"
                                                        @click="
                                                            nuevoSubModulo()
                                                        "
                                                    >
                                                        Nuevo
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div
                                                class="col-lg-12 col-md-12 col-sm-12"
                                            >
                                                <vuetable-component
                                                    :anular-button="true"
                                                    :modificar-button="true"
                                                    :info-button="false"
                                                    :columns-data="columns"
                                                    :rows-data="subModulos"
                                                    @handleModificarClick="
                                                        modificarSubModulo
                                                    "
                                                    @handleAnularClick="
                                                        anularSubModuloConfirmacion
                                                    "
                                                ></vuetable-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seccion donde muestra la lista de los pacientes que tienen una cita -->
        <modal
            :width="'70%'"
            :height="'auto'"
            :scrollable="true"
            style="z-index: 1200;"
            name="crearSubModulo"
        >
            <crear-modificar-sub-modulo
                :sub-modulo-mod="subModuloMod"
                @recargarSubModulo="cargarSubModulo"
                @cerrarModalCrearSubModulo="cerrarModalCrearSubModulo"
                ref="crearSubModulo"
            ></crear-modificar-sub-modulo>
        </modal>
        <!-- Fin Seccion donde muestra la lista de los pacientes que tienen una cita -->
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            prefijo: "",
            subModuloMod: null,
            url_data: "",
            errores: {},
            form: {},
            subModulos: [],
            columns: [
                {
                    label: "Modulo",
                    field: "descripcion_modulo",
                    type: "String"
                },
                {
                    label: "Descripción",
                    field: "descripcion_sub_modulo",
                    type: "String"
                },
                {
                    label: "Imagen",
                    field: "imagen_sub_modulo",
                    type: "String"
                },
            ]
        };
    },
    mounted: function() {
        this.cargarSubModulo();
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
    beforeDestroy: function() {
        /* let nombreModulo = this.$nombresModulo.datos_generales;
        let nombreFormulario = this.$nombresFormulario.datos_generales
            .generalidades.organizacion_bspi.organizacion_bspi
            .nombre_formulario;
        this.$funcionesGlobales.registrarLogForm(
            nombreModulo,
            nombreFormulario,
            "Salida"
        ); */
    },
    methods: {
        cargarSubModulo: function() {
            let that = this;
            let url =
                "/modulos/parametrizacion/sub_modulo/cargar_sub_modulo_table";
            var loader = that.$loading.show();
            axios
                .get(url)
                .then(function(response) {
                    let subModulo = [];
                    for (let i = 0; i < response.data.subModulo.length; i++) {
                        let objeto = {
                            id_modulo:response.data.subModulo[i].MOD_CODIGO,
                            descripcion_modulo: that.$funcionesGlobales.toCapitalFirstAllWords(response.data.subModulo[i].MOD_DESCRIPCION),
                            id_sub_modulo:response.data.subModulo[i].SUB_CODIGO,
                            descripcion_sub_modulo: that.$funcionesGlobales.toCapitalFirstAllWords(response.data.subModulo[i].SUB_DESCRIPCION),
                            imagen_sub_modulo: response.data.subModulo[i].SUB_IMAGEN,
                            ejecutable_sub_modulo: response.data.subModulo[i].SUB_EJECUTABLE,
                            route_sub_modulo: response.data.subModulo[i].SUB_ROUTE,
                        };
                        subModulo.push(objeto);
                    }
                    that.subModulos = subModulo;
                    loader.hide();
                })
                .catch(error => {
                    //Errores
                    loader.hide();
                    that.$swal({
                        icon: "error",
                        title: "Existe un error",
                        text: error
                    });
                });
        },
        modificarSubModulo(value) {
            this.subModuloMod = value;
            this.abrirModalCrearSubModulo();
        },
        anularSubModuloConfirmacion(value) {
            let that = this;
            this.$swal({
                title: "¿Desea anular el elemento seleccionado?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar"
            }).then(result => {
                if (result.value) {
                    that.anularSubModulo(value.id_sub_modulo);
                }
            });
        },
        anularSubModulo(id) {
            let that = this;
            let url =
                "/modulos/parametrizacion/sub_modulo/eliminar_sub_modulo/" +
                id;
            var loader = that.$loading.show();
            axios
                .delete(url)
                .then(function(response) {
                    loader.hide();
                    that.cargarSubModulo();
                    that.$swal({
                        icon: "success",
                        title: "Proceso realizado exitosamente",
                        text: "Dato anulado correctamente."
                    });
                })
                .catch(error => {
                    //Errores
                    loader.hide();
                    that.$swal({
                        icon: "error",
                        title: "Existe un error",
                        text: error
                    });
                });
        },
        cerrarModalCrearSubModulo: function() {
            this.$modal.hide("crearSubModulo");
            this.cargarSubModulo();
        },
        nuevoSubModulo: function() {
            this.subModuloMod = null;
            this.abrirModalCrearSubModulo();
        },
        abrirModalCrearSubModulo: function() {
            this.$modal.show("crearSubModulo");
        },

    }
};
</script>
