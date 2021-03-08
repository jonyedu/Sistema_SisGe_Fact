<template>
    <div class="row m-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <center>
                <h5 class="mt-4">Modulo</h5>
            </center>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="col-lg-12 col-md-12 col-sm-12 p-5">
                    <form>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre"
                                        ><span class="text-danger">(*)</span>
                                        Descripción</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.err_descripcion === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        id="cicloInicial"
                                        placeholder="Descripción del modulo"
                                        v-model="form.frm_descripcion"
                                    />
                                    <small
                                        v-if="errores.err_descripcion !== ''"
                                        id="correoHelp"
                                        class="text-danger"
                                        >{{ errores.err_descripcion[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura">Abreviatura</label>
                                    <input
                                        type="text"
                                        id="abreviatura"
                                        :class="
                                            errores.err_abreviatura === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Abreviatura"
                                        v-model="form.frm_abreviatura"
                                    />
                                </div>
                                <small
                                    v-if="errores.err_abreviatura !== ''"
                                    id="correoHelp"
                                    class="text-danger"
                                    >{{ errores.err_abreviatura[0] }}</small
                                >
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura">Imagen</label>
                                    <input
                                        type="text"
                                        id="imagen"
                                        :class="
                                            errores.err_imagen === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Imagen"
                                        v-model="form.frm_imagen"
                                    />
                                </div>
                                <small
                                    v-if="errores.err_imagen !== ''"
                                    id="correoHelp"
                                    class="text-danger"
                                    >{{ errores.err_imagen[0] }}</small
                                >
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="orden">Orden</label>
                                    <input
                                        type="number"
                                        id="orden"
                                        :class="
                                            errores.err_orden === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Orden"
                                        v-model="form.frm_orden"
                                    />
                                </div>
                                <small
                                    v-if="errores.err_orden !== ''"
                                    id="correoHelp"
                                    class="text-danger"
                                    >{{ errores.err_orden[0] }}</small
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
                                        @click="guardarActualizarModulo()"
                                    >
                                        {{
                                            moduloMod === null
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
        moduloMod: {
            type: Object
        }
    },
    data: function() {
        return {
            errores: {
                err_descripcion: "",
                err_abreviatura: "",
                err_orden: "",
                err_imagen: ""
            },
            form: {
                frm_codigo: "",
                frm_descripcion: "",
                frm_abreviatura: "",
                frm_orden: "",
                frm_imagen: ""
            }
        };
    },
    mounted: function() {
        if (this.$props.moduloMod !== null) {
            var modulo = this.$props.moduloMod;
            this.form.frm_codigo = modulo.codigo;
            this.form.frm_descripcion = modulo.descripcion;
            this.form.frm_abreviatura = modulo.abreviatura;
            this.form.frm_imagen = modulo.imagen;
            this.form.frm_orden = modulo.orden;
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
                err_descripcion: "",
                err_abreviatura: "",
                err_orden: ""
            };
            this.form = {
                frm_codigo: "",
                frm_descripcion: "",
                frm_abreviatura: "",
                frm_orden: ""
            };
        },
        guardarActualizarModulo: function() {
            let that = this;
            let url = "";
            let mensaje = "";
            //if()
            if (this.$props.moduloMod !== null) {
                url =
                    "/modulos/parametrizacion/modulo/modificar_modulo";
                mensaje = "Datos actualizados correctamente.";
            } else {
                url =
                    "/modulos/parametrizacion/modulo/guardar_modulo";
                mensaje = "Datos guardados correctamente.";
            }
            var loader = that.$loading.show();
            axios
                .post(url, this.form)
                .then(function(response) {
                    //Llamar metodo de parent para que actualice el grid.
                    loader.hide();
                    that.$emit("recargarModulo");
                    that.$emit("cerrarModalCrearModulo");
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
                        if (error.response.data.errors.frm_descripcion != null) {
                            that.errores.err_descripcion =
                                error.response.data.errors.frm_descripcion;
                        }
                        if (error.response.data.errors.frm_abreviatura != null) {
                            that.errores.err_abreviatura =
                                error.response.data.errors.frm_abreviatura;
                        }
                        if (error.response.data.errors.frm_orden != null) {
                            that.errores.err_orden =
                                error.response.data.errors.frm_orden;
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
