<template>
    <div class="row">
        <div class="col-lg-12 offset-lg-12">
            <form ref="myform" novalidate>
                <bs-switch
                    color="primary"
                    label-position="left"
                    label-class="col-md-4 ml-3"
                    v-model="proveedor.band"
                    @change="consumidorfinal()"
                    clear-button
                >
                    S/c
                </bs-switch>
                <bs-text-field
                    prepend-icon="address-book"
                    floating-label
                    autofocus
                    required
                    :disabled="proveedor.band"
                    v-model="proveedor.cedula"
                    @input="consultarcedula()"
                    clear-button
                >
                    <label>Cédula de Identidad </label>
                </bs-text-field>
                <bs-text-field
                    prepend-icon="address-book"
                    floating-label
                    required
                    :disabled="proveedor.band"
                    v-model="proveedor.nombre"
                    clear-button
                >
                    <label>Nombre</label>
                </bs-text-field>
                <bs-text-field
                    prepend-icon="address-book"
                    floating-label
                    required
                    :disabled="proveedor.band"
                    v-model="proveedor.apellido"
                    clear-button
                >
                    <label>Apellido</label>
                </bs-text-field>
                <bs-text-field
                    prepend-icon="address-book"
                    floating-label
                    required
                    :disabled="proveedor.band"
                    v-model="proveedor.representante"
                    clear-button
                >
                    <label>Representante</label>
                </bs-text-field>
                <bs-text-field
                    prepend-icon="phone-alt"
                    floating-label
                    required
                    :disabled="proveedor.band"
                    v-model="proveedor.telefono"
                    clear-button
                >
                    <label>Teléfono</label>
                </bs-text-field>
                <bs-text-field
                    prepend-icon="map-marker-alt"
                    floating-label
                    required
                    :disabled="proveedor.band"
                    v-model="proveedor.direccion"
                    clear-button
                >
                    <label>Dirección</label>
                </bs-text-field>
            </form>
        </div>
    </div>
</template>
<script>
import { prefix } from "../../../../../variables";
export default {
    data: function() {
        return {
            totalPagar: 0,
            srchvalue0: null,
            cantidad: 0,
            autoCloseModalVisible: false,
            prefijo: "",
            Lista: [],
            mensaje: "",
            //Objeto donde tendrá todas las variables del formulario
            proveedor: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        band: false,
                        proveedor_id: 0,
                        nombre: "",
                        representante: "",
                        direccion: "",
                        telefono: "",
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/persona/proveedor/guardar_modificar_proveedor",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/persona/proveedor/guardar_modificar_proveedor",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            trueModalVisible: false
        };
    },
    computed: {},
    methods: {
        consultarcedula() {
            if (this.proveedor.cedula.length == 10) {
                let that = this;
                let url =
                    this.prefijo +
                    "/modulos/persona/proveedor/cargar_proveedor_cedula/" +
                    this.proveedor.cedula;
                axios
                    .get(url)
                    .then(function(response) {
                        if (response.data.proveedor == null) {
                            that.showNotificationProgress(
                                "Facturacion",
                                "proveedor no registrado",
                                "error"
                            );
                            that.lmpCampos();
                            /* that.proveedor.cedula = "";
                            that.proveedor.nombre = " ";
                            that.proveedor.apellido = "";
                            that.proveedor.direccion = "";
                            that.proveedor.telefono = "";
                            that.proveedor.email = ""; */
                        } else {
                            that.proveedor.id = response.data.proveedor.id;
                            that.proveedor.cedula = response.data.proveedor.cedula;
                            that.proveedor.nombre =response.data.proveedor.nombre;
                            that.proveedor.apellido =response.data.proveedor.apellido;
                            that.proveedor.direccion = response.data.proveedor.direccion;
                            that.proveedor.telefono = response.data.proveedor.telefono;
                            that.proveedor.representante = response.data.proveedor.representante;
                        }
                    })
                    .catch(error => {});
            }
        },
        consumidorfinal() {
            if (this.proveedor.band) {
                this.proveedor.cedula = "9999999999";
                this.proveedor.nombre = "CONSUMIDOR FINAL";
                this.proveedor.apellido = ".";
                this.proveedor.direccion = ".";
                this.proveedor.telefono = "0";
            } else {
                /* this.proveedor.cedula = "";
                this.proveedor.nombre = " ";
                this.proveedor.apellido = "";
                this.proveedor.direccion = "";
                this.proveedor.telefono = "";
                this.proveedor.email = ""; */
                this.lmpCampos();
            }
        },
        calcular() {
            this.totalPagar = this.cantidad * this.Lista.costo_inv.precio;
        },
        onSearch(term) {
            this.srchvalue0 = term;
            this.inventario_p.fetch(term);
            this.showNotificationProgress(
                "Facturacion",
                "Producto Agregado",
                "success"
            );
        },
        btnClickModificar(item) {
            this.autoCloseModalVisible = true;
            this.Lista = item;
            this.mensaje =
                item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;
            console.log(this.Lista);

            //this.$store.state.producto = item;
        },
        showNotificationProgress(title, message, icon) {
            let options = {
                message: message,
                progressBar: true,
                progressBarValue: null,
                timeout: 5000
            };
            this.$notification[icon](options, title);
        },
        lmpCampos() {
            this.$refs.myform.reset();
            this.proveedorForm.reset();
            //this.$v.$reset();
        }
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;

    .small-box {
        max-width: 480px;
    }
}
</style>
