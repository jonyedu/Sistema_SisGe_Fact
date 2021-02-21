<template>
    <div class="row justify-content-center">
        <div class="container">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <img
                        class="mt-5"
                        :src="icon"
                        width="25%"
                        height="50%"
                        alt="no carga"
                        style="margin:auto;"
                    />
                    <h1
                        class="mt-3"
                        for="titulo"
                        align="center"
                        v-text="titulo"
                    ></h1>
                    <p
                        class="mt-1"
                        for="mensaje"
                        align="center"
                        v-text="mensaje"
                    ></p>
                    <div
                        v-if="campoObservacion"
                        class="col-lg-12 col-md-12 col-sm-12 text-center mt-4 mb-5"
                    >
                        <div class="form-group row">
                            <textarea
                                type="text"
                                class="form-control"
                                placeholder="Motivo de la Suspención"
                                v-model="observacion"
                            />
                        </div>
                    </div>
                    <div
                        class="col-lg-12 col-md-12 col-sm-12 text-center mt-4 mb-5"
                    >
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="validarConfirmarCandelar(true)"
                        >
                            Aceptar
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="validarConfirmarCandelar(false)"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        /* mostrar el botón deshacer y rehacer */
        icon: {
            type: String,
            required: true
        },
        titulo: {
            type: String,
            required: true
        },
        mensaje: {
            type: String,
            required: true
        },
        campoObservacion: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        validarConfirmarCandelar(value) {
            if (value) {
                if (this.$props.campoObservacion) {
                    if (this.observacion == "") {
                        this.flashMessage.show({
                            status: "warning",
                            title: "Advertencia",
                            message:
                                "Necesita una observación, para poder suspender la cirugía.",
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
                        return;
                    }
                    if (this.observacion.length <= 30) {
                        this.flashMessage.show({
                            status: "warning",
                            title: "Advertencia",
                            message:
                                "La observación debe tener un máximo de 30 caracteres.",
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
                        return;
                    }
                }
            }
            this.$emit("Observacion", this.observacion);
            this.$emit("respuestaConfirmarCancelar", value);
        }
    },
    mounted: function() {},
    data: function() {
        return {
            respuestaConfirmarCancelar: false,
            observacion: ""
        };
    },
    computed: {}
};
</script>
