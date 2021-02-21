<template>
    <div class="row justify-content-center">
        <div class="container">
            <div class="container-fluid">
                <div class="col-sm-12 mt-2">
                    <div class="">
                        <div class="" style="height: 70px"></div>
                        <div class="flex flex-y">
                            <span
                                class="col-md-5 text-center"
                                style="margin: auto"
                            >
                                <vue-painttable
                                    @getOutput="frmimg.imgFirma = $event"
                                    @RespuestaImgFirma="guardarFirmaPorAtencion"
                                    :hidePaintable="true"
                                    :isFirstPaintable="isFirstPaintable"
                                    :disableNavigation="true"
                                    :showUndoRedo="false"
                                    :showLineWidth="false"
                                    :rutaImagen="rutaSello"
                                    :width="800"
                                    :height="800"
                                    ref="paintFirma"
                                ></vue-painttable>
                            </span>
                            <span class="col-md-12 text-center"
                                >______________________________________________</span
                            >
                            <span class="col-md-12 text-center"
                                >FIRMA DEL ANESTESIÓLOGO:</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object
        },
        tipoServicio: {
            type: Number
        },
        idAtencion: {
            type: Number
        },
        idVisita: {
            type: Number
        },
        idTipoDocumento: {
            type: Number
        }
    },
    data: function() {
        return {
            finProceso: 0,
            validarImgFirma: 0,
            isFirstPaintable: "firmaAnestesiologo",
            //rutaSello: "/sello/sello.png",
            rutaSello: "",
            frmimg: {
                imgFirma: ""
            }
        };
    },
    mounted: function() {},
    methods: {
        consultarSello() {
            let that = this;
            if (this.$props.user.codigo > 0) {
                var loader = that.$loading.show();
                let url =
                    "/modulos/cirugia/anestesia/cargar_sello/" +
                    this.$props.user.codigo;
                axios
                    .get(url)
                    .then(function(response) {
                        if (response.data.sello != null) {
                            if (response.data.sello.seguridad_medico != null) {
                                if (
                                    response.data.sello.seguridad_medico
                                        .medico != null
                                ) {
                                    if (
                                        response.data.sello.seguridad_medico
                                            .medico.medico_sellos != null
                                    ) {
                                        that.rutaSello =
                                            "data:image/jpeg;base64," +
                                            response.data.sello.seguridad_medico
                                                .medico.medico_sellos
                                                .IMAGEN_SELLO;
                                    }
                                }
                            }
                        }
                        loader.hide();
                    })
                    .catch(error => {
                        that.flashMessage.show({
                            status: "error",
                            title: "Error al procesar consultarSello",
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
                        loader.hide();
                    });
            }
        },
        guardarFirmaPorAtencion(value) {
            if (value) {
                let that = this;
                let url = "";
                let formNew = {
                    tipo_servicio: that.$props.tipoServicio,
                    id_atencion: that.$props.idAtencion, //id de revision de sistema
                    id_visita: that.$props.idVisita,
                    id_tipo_documento: that.$props.idTipoDocumento,
                    imgFirma: that.frmimg.imgFirma
                };
                url = "/modulos/cirugia/anestesia/guardar_firma_atencion";
                var loader = that.$loading.show();
                axios
                    .post(url, formNew)
                    .then(function(response) {
                        loader.hide();
                        that.flashMessage.show({
                            status: "success",
                            title: "Proceso realizado exitosamente",
                            message: "Usted a completado con exito el proceso.",
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
                        that.finProceso = 1;
                        that.$emit("FinProceso", that.finProceso);
                    })
                    .catch(error => {
                        that.flashMessage.show({
                            status: "error",
                            title: "Error al procesar guardarFirmaPorAtencion",
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
                        loader.hide();
                    });
            }
        },
        validarForm() {
            if (this.frmimg.imgFirma == "") {
                this.flashMessage.show({
                    status: "warning",
                    title: "Advertencia al finalizar con el proceso",
                    message: "Usted debe firmar porfavor.",
                    clickable: true,
                    time: 5000,
                    icon: "/iconsflashMessage/warning.svg",
                    customStyle: {
                        flashMessageStyle: {
                            background: "linear-gradient(#e66465, #9198e5)"
                        }
                    }
                });
                return false;
            }
            return true;
        }
    }
};
</script>
