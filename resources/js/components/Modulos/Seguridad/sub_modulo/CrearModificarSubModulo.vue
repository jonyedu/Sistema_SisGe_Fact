<template>
    <div class="row m-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <center>
                <h5 class="mt-4">SubModulo</h5>
            </center>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="col-lg-12 col-md-12 col-sm-12 p-5">
                    <form>
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre"
                                        ><span class="text-danger">(*)</span>
                                        Descripción</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.err_sub_descripcion === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        id="descripción"
                                        placeholder="Descripción del sub modulo"
                                        v-model="form.frm_sub_descripcion"
                                    />
                                    <small
                                        v-if="
                                            errores.err_sub_descripcion !== ''
                                        "
                                        id="correoHelp"
                                        class="text-danger"
                                        >{{
                                            errores.err_sub_descripcion[0]
                                        }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="tipo"
                                        ><span class="text-danger">(*)</span>
                                        Modulo</label
                                    >
                                    <v-select
                                        v-model="selectedSubModulo"
                                        :value="form.frm_id_modulo"
                                        :options="modulo"
                                        label="display"
                                        @input="setSelectedSubModulo"
                                    >
                                        <template slot="no-options"
                                            >No se ha encontrado ningun
                                            dato</template
                                        >
                                    </v-select>
                                    <small
                                        v-if="errores.err_id_modulo !== ''"
                                        id="tipoHelp"
                                        class="text-danger"
                                        >{{ errores.err_id_modulo[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura">Ejecutable</label>
                                    <input
                                        type="text"
                                        id="ejecutable"
                                        :class="
                                            errores.err_sub_ejecutable === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Ejecutable"
                                        v-model="form.frm_sub_ejecutable"
                                    />
                                </div>
                                <small
                                    v-if="errores.err_sub_ejecutable !== ''"
                                    id="correoHelp"
                                    class="text-danger"
                                    >{{ errores.err_sub_ejecutable[0] }}</small
                                >
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura">Imagen</label>
                                    <input
                                        type="text"
                                        id="imagen"
                                        :class="
                                            errores.err_sub_imagen === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Imagen"
                                        v-model="form.frm_sub_imagen"
                                    />
                                </div>
                                <small
                                    v-if="errores.err_sub_imagen !== ''"
                                    id="correoHelp"
                                    class="text-danger"
                                    >{{ errores.err_sub_imagen[0] }}</small
                                >
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="orden">Ruta</label>
                                    <input
                                        type="text"
                                        id="ruta"
                                        :class="
                                            errores.err_sub_ruta === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Ruta"
                                        v-model="form.frm_sub_ruta"
                                    />
                                </div>
                                <small
                                    v-if="errores.err_sub_ruta !== ''"
                                    id="correoHelp"
                                    class="text-danger"
                                    >{{ errores.err_sub_ruta[0] }}</small
                                >
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
                                        @click="guardarActualizarSubModulo()"
                                    >
                                        {{
                                            subModuloMod === null
                                                ? "Guardar"
                                                : "Modificar"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        subModuloMod: {
            type: Object
        }
    },
    data: function() {
        return {
            selectedSubModulo: "",
            modulo: [],
            errores: {
                err_mod_descripcion: "",
                err_sub_descripcion: "",
                err_sub_imagen: "",
                err_sub_ejecutable: "",
                err_sub_ruta: "",
                err_id_modulo: ""
            },
            form: {
                frm_id_modulo: "",
                frm_id_sub_modulo: "",
                frm_mod_descripcion: "",
                frm_sub_descripcion: "",
                frm_sub_imagen: "",
                frm_sub_tipo: "1",
                frm_sub_ejecutable: "",
                frm_sub_ruta: ""
            }
        };
    },
    mounted: function() {
        this.setSelectedSubModulo();
        if (this.$props.subModuloMod !== null) {
            var modulo = this.$props.subModuloMod;
            /* SubModulo */
            this.form.frm_id_sub_modulo = modulo.id_sub_modulo;
            this.form.frm_sub_descripcion = modulo.descripcion_sub_modulo;
            this.form.frm_sub_imagen = modulo.imagen_sub_modulo;
            this.form.frm_sub_ejecutable = modulo.ejecutable_sub_modulo;
            this.form.frm_sub_ruta = modulo.route_sub_modulo;
            /* Modulo */
            this.form.frm_id_modulo = modulo.id_modulo;
            this.selectedSubModulo = modulo.descripcion_modulo;
        }
        /* let nombreModulo = this.$nombresModulo.datos_generales;
        let nombreFormulario = this.$nombresFormulario.datos_generales
            .generalidades.organizacion_bspi.crear_organizacion_bspi
            .nombre_formulario;
        this.$funcionesGlobales.registrarLogForm(
            nombreModulo,
            nombreFormulario,
            "Ingreso"
        ); */
    },
    beforeDestroy: function() {
        /* let nombreModulo = this.$nombresModulo.datos_generales;
        let nombreFormulario = this.$nombresFormulario.datos_generales
            .generalidades.organizacion_bspi.crear_organizacion_bspi
            .nombre_formulario;
        this.$funcionesGlobales.registrarLogForm(
            nombreModulo,
            nombreFormulario,
            "Salida"
        ); */
    },
    methods: {
        limpiarForm() {
            this.errores = {
                err_mod_descripcion: "",
                err_sub_descripcion: "",
                err_sub_imagen: "",
                err_sub_ejecutable: "",
                err_sub_ruta: "",
                err_id_modulo: ""
            };
            this.form = {
                frm_id_modulo: "",
                frm_id_sub_modulo: "",
                frm_mod_descripcion: "",
                frm_sub_descripcion: "",
                frm_sub_imagen: "",
                frm_sub_tipo: "1",
                frm_sub_ejecutable: "",
                frm_sub_ruta: ""
            };
        },
        setSelectedSubModulo(value) {
            let that = this;
            var loader = that.$loading.show();
            let url = "/modulos/parametrizacion/modulo/cargar_modulo_combo_box";
            if (value != null) {
                this.form.frm_id_modulo = value.id_modulo;
            }
            axios
                .get(url)
                .then(function(response) {
                    let modulo = [];
                    response.data.modulo.forEach(modulos => {
                        let objeto = {};
                        objeto.display = that.$funcionesGlobales.toCapitalFirstAllWords(modulos.descripcion);
                        objeto.id_modulo = modulos.codigo;
                        modulo.push(objeto);
                    });
                    that.modulo = modulo;
                    loader.hide();
                })
                .catch(error => {
                    //Errores
                    that.$swal({
                        icon: "error",
                        title: "Existe un error",
                        text: error
                    });
                    loader.hide();
                });
        },
        guardarActualizarSubModulo: function() {
            let that = this;
            let url = "";
            let mensaje = "";
            //if()
            if (this.$props.subModuloMod !== null) {
                url = "/modulos/parametrizacion/sub_modulo/modificar_sub_modulo";
                mensaje = "Datos actualizados correctamente.";
            } else {
                url = "/modulos/parametrizacion/sub_modulo/guardar_sub_modulo";
                mensaje = "Datos guardados correctamente.";
            }
            var loader = that.$loading.show();
            axios
                .post(url, this.form)
                .then(function(response) {
                    //Llamar metodo de parent para que actualice el grid.
                    loader.hide();
                    that.$emit("recargarSubModulo");
                    that.$emit("cerrarModalCrearSubModulo");
                    that.$swal({
                        icon: "success",
                        title: "Proceso realizado exitosamente",
                        text: that.mensaje
                    });
                    that.limpiarForm();
                })
                .catch(error => {
                    //Errores de validación
                    if (error.response.status === 422) {
                        if (
                            error.response.data.errors.frm_mod_descripcion != null
                        ) {
                            that.errores.err_mod_descripcion =
                                error.response.data.errors.frm_mod_descripcion;
                        }
                        if (
                            error.response.data.errors.frm_id_modulo != null
                        ) {
                            that.errores.err_id_modulo =
                                error.response.data.errors.frm_id_modulo;
                        }
                        if (error.response.data.errors.frm_sub_ejecutable != null) {
                            that.errores.err_sub_ejecutable =
                                error.response.data.errors.frm_sub_ejecutable;
                        }
                        if (error.response.data.errors.frm_sub_imagen != null) {
                            that.errores.err_sub_imagen =
                                error.response.data.errors.frm_sub_imagen;
                        }
                        if (error.response.data.errors.frm_sub_ruta != null) {
                            that.errores.err_sub_ruta =
                                error.response.data.errors.frm_sub_ruta;
                        }
                        loader.hide();
                    }
                    loader.hide();
                    that.$swal({
                        icon: "error",
                        title: "Existen errores",
                        text: error
                    });
                });
        }
    }
};
</script>
