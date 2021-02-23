<template>
    <div class="my-demo-wrapper">
        <div class="row">
            <div class="col-lg-8 offset-lg-3">
                <bs-card shadow>
                    <bs-card-body>
                        <bs-card-content>
                            <form ref="myform" novalidate>
                                <div class="form-group">
                                    <bs-text-field
                                        v-model="user.fullName"
                                        :external-validator="fullNameValidator"
                                        prepend-icon="user"
                                        floating-label
                                        autofocus
                                        required
                                    >
                                        <label>Full Name</label>
                                    </bs-text-field>
                                </div>
                                <div class="form-group">
                                    <bs-text-field
                                        v-model="user.email"
                                        :external-validator="emailValidator"
                                        type="email"
                                        prepend-icon="envelope"
                                        floating-label
                                        required
                                    >
                                        <label>Email</label>
                                    </bs-text-field>
                                </div>
                                <div class="form-group">
                                    <bs-radio-group
                                        v-model="user.education"
                                        :external-validator="educationValidator"
                                        :items="educations"
                                        color="indigo"
                                        required
                                    >
                                        <label class="col-12 col-form-label">
                                            Last Education
                                        </label>
                                    </bs-radio-group>
                                </div>
                                <div class="form-group">
                                    <bs-text-area
                                        v-model="user.address"
                                        :external-validator="addressValidator"
                                        prepend-icon="house-user"
                                        floating-label
                                        required
                                        clear-button
                                    >
                                        <label>Address</label>
                                    </bs-text-area>
                                </div>
                                <div class="form-group">
                                    <bs-combobox
                                        v-model="user.country"
                                        :data-source="countrySrc"
                                        :external-validator="countryValidator"
                                        floating-label
                                        required
                                    >
                                        <label>Country</label>
                                    </bs-combobox>
                                </div>
                            </form>
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-footer class="bg-white text-right">
                        <bs-button
                            color="primary"
                            class="mr-2"
                            active
                            @click="doSave"
                        >
                            Submit
                        </bs-button>
                        <bs-button color="primary" outlined @click="doReset">
                            Reset
                        </bs-button>
                    </bs-card-footer>
                </bs-card>
            </div>
        </div>
    </div>
</template>

<script>
const userValidator = {
    fullName: { required, minLength: minLength(5) },
    email: { required, email },
    education: { required },
    address: { required },
    country: { required }
};
export default {
    props: {
        moduloMod: {
            type: Object
        }
    },
    data: function() {

        return {

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
                url = "/modulos/parametrizacion/modulo/modificar_modulo";
                mensaje = "Datos actualizados correctamente.";
            } else {
                url = "/modulos/parametrizacion/modulo/guardar_modulo";
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
                        if (
                            error.response.data.errors.frm_descripcion != null
                        ) {
                            that.errores.err_descripcion =
                                error.response.data.errors.frm_descripcion;
                        }
                        if (
                            error.response.data.errors.frm_abreviatura != null
                        ) {
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
