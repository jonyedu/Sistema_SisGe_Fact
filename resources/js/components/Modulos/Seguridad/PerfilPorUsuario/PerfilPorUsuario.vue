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
                            <li>
                                <p style="margin-left:10px">
                                    Mantenimiento de Perfil por Usuario
                                </p>
                            </li>
                        </ol>
                    </div>
                    &nbsp;
                    <!-- Seccion de los menu de botones: Historial clínico, Nueva, Guardar, etc y la Tabla Historial Clinico-->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="tipo"
                                                ><span class="text-danger"
                                                    >(*)</span
                                                >
                                                Modulo</label
                                            >
                                            <v-select
                                                v-model="selectedModulo"
                                                :value="form.id_modulo"
                                                :options="modulos"
                                                label="display"
                                                placeholder="Selecione el Modulo"
                                                @input="setSelectedModulo"
                                                :class="
                                                    errores.id_modulo === ''
                                                        ? ''
                                                        : 'style-chooser'
                                                "
                                            >
                                                <template slot="no-options"
                                                    >No se ha encontrado ningun
                                                    dato</template
                                                >
                                            </v-select>
                                            <small
                                                v-if="errores.id_modulo !== ''"
                                                class="text-danger"
                                                >{{
                                                    errores.id_modulo[0]
                                                }}</small
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="tipo"
                                                ><span class="text-danger"
                                                    >(*)</span
                                                >
                                                Perfil</label
                                            >
                                            <v-select
                                                v-model="selectedPerfil"
                                                :value="form.id_perfil"
                                                :options="perfiles"
                                                label="display"
                                                placeholder="Selecione el Perfil"
                                                @input="setSelectedPerfil"
                                                :class="
                                                    errores.id_perfil === ''
                                                        ? ''
                                                        : 'style-chooser'
                                                "
                                            >
                                                <template slot="no-options"
                                                    >No se ha encontrado ningun
                                                    dato</template
                                                >
                                            </v-select>
                                            <small
                                                v-if="errores.id_perfil !== ''"
                                                class="text-danger"
                                                >{{
                                                    errores.id_perfil[0]
                                                }}</small
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="ex-lib">
                                            <vue-select-sides
                                                type="mirror"
                                                order-by="asc"
                                                v-model="
                                                    form.selectedPerfilPorModulo
                                                "
                                                :list="form.subModulos"
                                            ></vue-select-sides>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-lg-12 col-md-12 col-sm-12 mt-4 pt-1"
                                    >
                                        <div class="form-inline">
                                            <button
                                                type="button"
                                                class="btn btn-success btn-block"
                                                @click="
                                                    actualizarPerfilPorUsuario()
                                                "
                                            >
                                                Actualizar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <FlashMessage></FlashMessage>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {
            selectedModulo: "",
            modulos: [],

            selectedPerfil: "",
            perfiles: [],



            errores: {
                id_modulo: "",
                id_perfil: ""
            },

            form: {
                id_modulo: "",
                id_perfil: "",
                id_sub_modulo: "",
                selectedPerfilPorModulo: [],
                subModulos: []
            },

            prefijo: ""
        };
    },
    mounted: function() {
        this.setSelectedModulo();
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
        setSelectedModulo(value) {
            this.errores = {
                id_modulo: "",
                id_perfil: ""
            };
            let that = this;
            //var loader = that.$loading.show();
            let url = "/modulos/seguridad/modulo/cargar_modulo_table";
            if (value != null) {
                this.form.id_modulo = value.id_modulo;
                this.form.id_sub_modulo = value.id_sub_modulo;
            }
            axios
                .get(url)
                .then(function(response) {
                    let modulos = [];
                    response.data.modulos.forEach(modulo => {
                        let objeto = {};
                        objeto.display = that.$funcionesGlobales.toCapitalFirstAllWords(
                            modulo.descripcion
                        );
                        objeto.id_modulo = modulo.codigo;
                        objeto.id_sub_modulo = modulo.sub_modulo.codigo;
                        modulos.push(objeto);
                    });
                    that.modulos = modulos;
                    //that.cargarSubModuloPorModulo();
                    that.setSelectedPerfil();
                })
                .catch(error => {
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar setSelectedModulo",
                        message:
                            "Por favor comuníquese con el administrador. " +
                            error,
                        clickable: true,
                        time: 0,
                        icon: "/iconsflashMessage/error.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                    //loader.hide();
                });
        },
        setSelectedPerfil(value) {
            this.errores = {
                id_modulo: "",
                id_perfil: ""
            };
            let that = this;
            //var loader = that.$loading.show();
            let url = "/modulos/seguridad/perfil/cargar_perfil_combo_box";
            if (value != null) {
                this.form.id_perfil = value.id_perfil;
            }
            axios
                .get(url)
                .then(function(response) {
                    let perfiles = [];
                    response.data.perfiles.forEach(perfil => {
                        let objeto = {};
                        objeto.display = that.$funcionesGlobales.toCapitalFirstAllWords(
                            perfil.descripcion
                        );
                        objeto.id_perfil = perfil.codigo;
                        perfiles.push(objeto);
                    });
                    that.perfiles = perfiles;
                    that.cargarPerfilPorUsuario();
                })
                .catch(error => {
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar setSelectedPerfil",
                        message:
                            "Por favor comuníquese con el administrador. " +
                            error,
                        clickable: true,
                        time: 0,
                        icon: "/iconsflashMessage/error.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                    //loader.hide();
                });
        },
        cargarPerfilPorUsuario() {
            if (this.form.id_modulo != "" && this.form.id_perfil != "") {
                let that = this;
                let url =
                    "/modulos/seguridad/perfil_por_usuario/cargar_perfil_por_usuario/" +
                    this.form.id_modulo +
                    "/" +
                    this.form.id_perfil;
                var loader = that.$loading.show();
                axios
                    .get(url)
                    .then(function(response) {
                        //Me carga todos los submenus en la parte izquierda
                        let subModulos = [];
                        for (
                            let i = 0;
                            i < response.data.subModulos.length;
                            i++
                        ) {
                            let objeto = {
                                value: response.data.subModulos[i].codigo,
                                label: that.$funcionesGlobales.toCapitalFirstAllWords(
                                    response.data.subModulos[i].descripcion
                                )
                            };
                            subModulos.push(objeto);
                        }
                        that.form.subModulos = subModulos;

                        //Solo me muestra los submenus que estan guardados en la tabla opcion por perfil
                        let perfilPorUsuarios = [];
                        for (
                            let i = 0;
                            i < response.data.perfilPorUsuarios.length;
                            i++
                        ) {
                            perfilPorUsuarios.push(
                                response.data.perfilPorUsuarios[i].sub_modulo
                                    .codigo
                            );
                        }
                        that.form.selectedPerfilPorModulo = perfilPorUsuarios;
                        loader.hide();
                    })
                    .catch(error => {
                        loader.hide();
                        that.flashMessage.show({
                            status: "error",
                            title: "Error al procesar cargarSubModuloPorModulo",
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
            }
        },
        actualizarPerfilPorUsuario() {
            let that = this;
            let url =
                "/modulos/seguridad/perfil_por_usuario/actualizar_perfil_por_usuario";
            var loader = that.$loading.show();
            axios
                .post(url, this.form)
                .then(function(response) {
                    //Llamar metodo de parent para que actualice el grid.
                    loader.hide();
                    that.flashMessage.show({
                        status: "success",
                        title: "Exito al procesar",
                        message:
                            "Datos actualizados correctamente.",
                        clickable: true,
                        time: 5000,
                        icon: "/iconsflashMessage/success.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                })
                .catch(error => {
                    //Errores de validación
                    if (error.response.status === 422) {
                        that.errores = {
                            id_modulo: "",
                            id_perfil: ""
                        };
                        if (error.response.data.errors.id_modulo != null) {
                            that.errores.id_modulo =
                                error.response.data.errors.id_modulo;
                        }
                        if (error.response.data.errors.id_perfil != null) {
                            that.errores.id_perfil =
                                error.response.data.errors.id_perfil;
                        }
                        loader.hide();
                        that.flashMessage.show({
                            status: "warning",
                            title:
                                "Advertencia al actualizar",
                            message:
                                "Necesita seleccionar el Modulo y el Perfil para actualiza.",
                            clickable: true,
                            time: 5000,
                            icon: "/iconsflashMessage/warning.svg",
                            customStyle: {
                                flashMessageStyle: {
                                    background:
                                        "linear-gradient(#e66465, #9198e5)"
                                }
                            }
                        });
                    } else {
                        that.flashMessage.show({
                            status: "error",
                            title:
                                "Error al procesar actualizarPerfilPorUsuario",
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
                    }
                    loader.hide();
                });
        }
    }
};
</script>
