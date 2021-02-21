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
                            <li><p style="margin-left:10px">Mantenimiento de Usuarios</p></li>
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
                                                            nuevoUsuario()
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
                                                    :rows-data="usuarios"
                                                    @handleModificarClick="
                                                        modificarUsuario
                                                    "
                                                    @handleAnularClick="
                                                        anularUsuarioConfirmacion
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
            name="crearUsuario"
        >
            <crear-modificar-usuario
                :usuario-mod="usuarioMod"
                @recargarPerfil="cargarUsuario"
                @cerrarModalCrearUsuario="cerrarModalCrearUsuario"
                ref="crearUsuario"
            ></crear-modificar-usuario>
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
            usuarioMod: null,
            url_data: "",
            errores: {},
            form: {},
            usuarios: [],
            columns: [
                {
                    label: "Nombre y Apellido",
                    field: "fullName",
                    type: "String"
                },
                {
                    label: "Usuario",
                    field: "usuario",
                    type: "String"
                },
                {
                    label: "Perfil",
                    field: "perfil",
                    type: "String"
                },
            ]
        };
    },
    mounted: function() {
        this.cargarUsuario();
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
        cargarUsuario: function() {
            let that = this;
            let url =
                "/modulos/seguridad/usuario/cargar_usuario_table";
            var loader = that.$loading.show();
            axios
                .get(url)
                .then(function(response) {
                    let usuarios = [];
                    for (let i = 0; i < response.data.usuarios.length; i++) {
                        let objeto = {
                            codigo:response.data.usuarios[i].codigo,
                            nombre: response.data.usuarios[i].nombre,
                            apellido: response.data.usuarios[i].apellido,
                            usuario: response.data.usuarios[i].usuario,
                            password:response.data.usuarios[i].password,
                            id_perfil: response.data.usuarios[i].perfil!=null? response.data.usuarios[i].perfil.codigo:"",
                            perfil: response.data.usuarios[i].perfil!=null? that.$funcionesGlobales.toCapitalFirstAllWords(response.data.usuarios[i].perfil.descripcion):"",
                            id_profesion: response.data.usuarios[i].profesion!=null?response.data.usuarios[i].profesion.codigo:"",
                            profesion: response.data.usuarios[i].profesion!=null?that.$funcionesGlobales.toCapitalFirstAllWords(response.data.usuarios[i].profesion.descripcion):"",
                            iniciales: response.data.usuarios[i].abreviatura,
                            email: response.data.usuarios[i].email,
                            fullName: that.$funcionesGlobales.toCapitalFirstAllWords(response.data.usuarios[i].FULLNAME),
                        };
                        usuarios.push(objeto);
                    }
                    that.usuarios = usuarios;
                    loader.hide();
                })
                .catch(error => {
                    loader.hide();
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar cargarUsuario",
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
        modificarUsuario(value) {
            this.usuarioMod = value;
            this.abrirModalCrearUsuario();
        },
        anularUsuarioConfirmacion(value) {
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
                    that.anularUsuario(value.codigo);
                }
            });
        },
        anularUsuario(id) {
            let that = this;
            let url =
                "/modulos/seguridad/usuario/eliminar_usuario/" +
                id;
            var loader = that.$loading.show();
            axios
                .delete(url)
                .then(function(response) {
                    loader.hide();
                    that.cargarUsuario();
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
                        title: "Error al procesar anularUsuario",
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
        cerrarModalCrearUsuario: function() {
            this.$modal.hide("crearUsuario");
            this.cargarUsuario();
        },
        nuevoUsuario: function() {
            this.usuarioMod = null;
            this.abrirModalCrearUsuario();
        },
        abrirModalCrearUsuario: function() {
            this.$modal.show("crearUsuario");
        },

    }
};
</script>
