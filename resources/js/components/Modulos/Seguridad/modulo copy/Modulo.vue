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
                            <li><p style="margin-left:10px">Mantenimiento del Modulo</p></li>
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
                                                            nuevoModulo()
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
                                                    :rows-data="modulos"
                                                    @handleModificarClick="
                                                        modificarModulo
                                                    "
                                                    @handleAnularClick="
                                                        anularModuloConfirmacion
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
            name="crearModulo"
        >
            <crear-modificar-modulo
                :modulo-mod="moduloMod"
                @recargarModulo="cargarModulo"
                @cerrarModalCrearModulo="cerrarModalCrearModulo"
                ref="crearModulo"
            ></crear-modificar-modulo>
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
            moduloMod: null,
            url_data: "",
            errores: {},
            form: {},
            modulos: [],
            columns: [
                {
                    label: "Descripción",
                    field: "descripcion",
                    type: "String"
                },
                {
                    label: "Abreviatura",
                    field: "abreviatura",
                    type: "String"
                },
                {
                    label: "Orden",
                    field: "orden",
                    type: "String"
                }

            ]
        };
    },
    mounted: function() {
        this.cargarModulo();
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
        cargarModulo: function() {
            let that = this;
            let url =
                "/modulos/parametrizacion/modulo/cargar_modulo_table";
            var loader = that.$loading.show();
            axios
                .get(url)
                .then(function(response) {
                    let modulos = [];
                    for (let i = 0; i < response.data.modulo.length; i++) {
                        let objeto = {
                            codigo:response.data.modulo[i].codigo,
                            descripcion: that.$funcionesGlobales.toCapitalFirstAllWords(response.data.modulo[i].descripcion),
                            abreviatura: response.data.modulo[i].abreviatura,
                            imagen: response.data.modulo[i].imagen,
                            orden:response.data.modulo[i].orden,
                        };
                        modulos.push(objeto);
                    }
                    that.modulos = modulos;
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
        modificarModulo(value) {
            this.moduloMod = value;
            this.abrirModalCrearModulo();
        },
        anularModuloConfirmacion(value) {
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
                    that.anularModulo(value.codigo);
                }
            });
        },
        anularModulo(id) {
            let that = this;
            let url =
                "/modulos/parametrizacion/modulo/eliminar_modulo/" +
                id;
            var loader = that.$loading.show();
            axios
                .delete(url)
                .then(function(response) {
                    loader.hide();
                    that.cargarModulo();
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
        cerrarModalCrearModulo: function() {
            this.$modal.hide("crearModulo");
            this.cargarModulo();
        },
        nuevoModulo: function() {
            this.moduloMod = null;
            this.abrirModalCrearModulo();
        },
        abrirModalCrearModulo: function() {
            this.$modal.show("crearModulo");
        },

    }
};
</script>
