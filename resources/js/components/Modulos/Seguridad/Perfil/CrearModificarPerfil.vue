<template>
    <div class="row m-3">
        <!-- <div class="col-lg-12 col-md-12 col-sm-12">
            <center>
                <h5 class="mt-4">Modulo</h5>
            </center>
        </div> -->

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="col-lg-12 col-md-12 col-sm-12 p-5">
                    <form>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre"
                                        ><span class="text-danger">(*)</span>
                                        Descripción</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.descripcion === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Descripción del Perfil"
                                        v-model="form.descripcion"
                                    />
                                    <small
                                        v-if="errores.descripcion !== ''"
                                        id="correoHelp"
                                        class="text-danger"
                                        >{{ errores.descripcion[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Abreviatura</label
                                    >
                                    <input
                                        type="text"
                                        id="abreviatura"
                                        :class="
                                            errores.abreviatura === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Abreviatura"
                                        v-model="form.abreviatura"
                                    />
                                    <small
                                        v-if="errores.abreviatura !== ''"
                                        id="correoHelp"
                                        class="text-danger"
                                        >{{ errores.abreviatura[0] }}</small
                                    >
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
                                        @click="guardarActualizarPerfil()"
                                    >
                                        {{
                                            perfilMod === null
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
        perfilMod: {
            type: Object
        }
    },
    data: function() {
        return {
            errores: {
                descripcion: "",
                abreviatura: ""
            },
            form: {
                codigo: "",
                descripcion: "",
                abreviatura: ""
            }
        };
    },
    mounted: function() {
        if (this.$props.perfilMod !== null) {
            var perfil = this.$props.perfilMod;
            this.form.codigo = perfil.codigo;
            this.form.descripcion = perfil.descripcion;
            this.form.abreviatura = perfil.abreviatura;
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
                descripcion: "",
                abreviatura: "",
                orden: ""
            };
            this.form = {
                codigo: "",
                descripcion: "",
                abreviatura: "",
                orden: ""
            };
        },
        guardarActualizarPerfil: function() {
            let that = this;
            let url = "";
            let mensaje = "";
            if (this.$props.perfilMod !== null) {
                url = "/modulos/seguridad/perfil/modificar_perfil";
                mensaje = "Datos actualizados correctamente.";
            } else {
                url = "/modulos/seguridad/perfil/guardar_perfil";
                mensaje = "Datos guardados correctamente.";
            }
            var loader = that.$loading.show();
            axios
                .post(url, this.form)
                .then(function(response) {
                    //Llamar metodo de parent para que actualice el grid.
                    loader.hide();
                    that.$emit("recargarPerfil");
                    that.$emit("cerrarModalCrearPerfil");
                    that.flashMessage.show({
                        status: "success",
                        title: "Proceso realizado exitosamente",
                        message: mensaje,
                        clickable: true,
                        time: 5000,
                        icon: "/iconsflashMessage/success.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                    that.limpiarForm();
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        if (error.response.data.errors.descripcion != null) {
                            that.errores.descripcion =
                                error.response.data.errors.descripcion;
                        }
                        if (error.response.data.errors.abreviatura != null) {
                            that.errores.abreviatura =
                                error.response.data.errors.abreviatura;
                        }
                        that.flashMessage.show({
                            status: "warning",
                            title: "Se requiere de su atención",
                            message: "Existen campos vacios.",
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
                                "Error al procesar guardarActualizarPerfil",
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
