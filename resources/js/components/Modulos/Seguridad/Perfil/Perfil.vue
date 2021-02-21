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
                            <li><p style="margin-left:10px">Mantenimiento de Perfil</p></li>
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
                                                            nuevoPerfil()
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
                                                    :rows-data="perfiles"
                                                    @handleModificarClick="
                                                        modificarPerfil
                                                    "
                                                    @handleAnularClick="
                                                        anularPerfilConfirmacion
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
            name="crearPerfil"
        >
            <crear-modificar-perfil
                :perfil-mod="perfilMod"
                @recargarPerfil="cargarPerfil"
                @cerrarModalCrearPerfil="cerrarModalCrearPerfil"
                ref="crearPerfil"
            ></crear-modificar-perfil>
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
            perfilMod: null,
            url_data: "",
            errores: {},
            form: {},
            perfiles: [],
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
        this.cargarPerfil();
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
        cargarPerfil: function() {
            let that = this;
            let url =
                "/modulos/seguridad/perfil/cargar_perfil_table";
            var loader = that.$loading.show();
            axios
                .get(url)
                .then(function(response) {
                    let perfiles = [];
                    for (let i = 0; i < response.data.perfiles.length; i++) {
                        let objeto = {
                            codigo:response.data.perfiles[i].codigo,
                            descripcion: that.$funcionesGlobales.toCapitalFirstAllWords(response.data.perfiles[i].descripcion),
                            abreviatura: response.data.perfiles[i].abreviatura,
                        };
                        perfiles.push(objeto);
                    }
                    that.perfiles = perfiles;
                    loader.hide();
                })
                .catch(error => {
                    loader.hide();
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar cargarPerfil",
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
        modificarPerfil(value) {
            this.perfilMod = value;
            this.abrirModalCrearPerfil();
        },
        anularPerfilConfirmacion(value) {
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
                    that.anularPerfil(value.codigo);
                }
            });
        },
        anularPerfil(id) {
            let that = this;
            let url =
                "/modulos/seguridad/perfil/eliminar_perfil/" +
                id;
            var loader = that.$loading.show();
            axios
                .delete(url)
                .then(function(response) {
                    loader.hide();
                    that.cargarPerfil();
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
                        title: "Error al procesar anularPerfil",
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
        cerrarModalCrearPerfil: function() {
            this.$modal.hide("crearPerfil");
            this.cargarPerfil();
        },
        nuevoPerfil: function() {
            this.perfilMod = null;
            this.abrirModalCrearPerfil();
        },
        abrirModalCrearPerfil: function() {
            this.$modal.show("crearPerfil");
        },

    }
};
</script>
