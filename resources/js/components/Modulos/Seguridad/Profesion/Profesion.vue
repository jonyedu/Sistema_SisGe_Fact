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
                            <li><p style="margin-left:10px">Mantenimiento de Profesión del Usuario</p></li>
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
                                                            nuevoProfesion()
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
                                                    :rows-data="profesiones"
                                                    @handleModificarClick="
                                                        modificarProfesion
                                                    "
                                                    @handleAnularClick="
                                                        anularProfesionConfirmacion
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
        <modal
            :width="'70%'"
            :height="'auto'"
            :scrollable="true"
            style="z-index: 1200;"
            name="crearProfesion"
        >
            <crear-modificar-profesion
                :profesion-mod="profesionMod"
                @recargarProfesion="cargarProfesion"
                @cerrarModalCrearProfesion="cerrarModalCrearProfesion"
                ref="crearProfesion"
            ></crear-modificar-profesion>
        </modal>
        <FlashMessage></FlashMessage>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            prefijo: "",
            profesionMod: null,
            url_data: "",
            errores: {},
            form: {},
            profesiones: [],
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

            ]
        };
    },
    mounted: function() {
        this.cargarProfesion();
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
        cargarProfesion: function() {
            let that = this;
            let url =
                "/modulos/seguridad/profesion/cargar_profesion_table";
            var loader = that.$loading.show();
            axios
                .get(url)
                .then(function(response) {
                    let profesion = [];
                    for (let i = 0; i < response.data.profesiones.length; i++) {
                        let objeto = {
                            codigo:response.data.profesiones[i].codigo,
                            descripcion: that.$funcionesGlobales.toCapitalFirstAllWords(response.data.profesiones[i].descripcion),
                            abreviatura: response.data.profesiones[i].abreviatura,
                        };
                        profesion.push(objeto);
                    }
                    that.profesiones = profesion;
                    loader.hide();
                })
                .catch(error => {
                    loader.hide();
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar cargarProfesion",
                        message:
                            "Por favor comuníquese con el administrador. " +
                            error,
                        clickable: true,
                        time: 0,
                        icon: "/iconsflashMessage/error.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background:
                                    "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                });
        },
        modificarProfesion(value) {
            this.profesionMod = value;
            this.abrirModalCrearProfesion();
        },
        anularProfesionConfirmacion(value) {
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
                    that.anularProfesion(value.codigo);
                }
            });
        },
        anularProfesion(id) {
            let that = this;
            let url =
                "/modulos/seguridad/profesion/eliminar_profesion/" +
                id;
            var loader = that.$loading.show();
            axios
                .delete(url)
                .then(function(response) {
                    loader.hide();
                    that.cargarProfesion();
                    that.flashMessage.show({
                        status: "success",
                        title: "Proceso realizado exitosamente",
                        message:
                            "Dato anulado correctamente. ",
                        clickable: true,
                        time: 5000,
                        icon: "/iconsflashMessage/success.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background:
                                    "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                })
                .catch(error => {
                    //Errores
                    loader.hide();
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar anularProfesion",
                        message:
                            "Por favor comuníquese con el administrador. " +
                            error,
                        clickable: true,
                        time: 0,
                        icon: "/iconsflashMessage/error.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background:
                                    "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                });
        },
        cerrarModalCrearProfesion: function() {
            this.$modal.hide("crearProfesion");
            this.cargarProfesion();
        },
        nuevoProfesion: function() {
            this.profesionMod = null;
            this.abrirModalCrearProfesion();
        },
        abrirModalCrearProfesion: function() {
            this.$modal.show("crearProfesion");
        },

    }
};
</script>
