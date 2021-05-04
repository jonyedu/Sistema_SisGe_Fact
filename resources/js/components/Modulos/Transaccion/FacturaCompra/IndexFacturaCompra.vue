<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                prefijo +
                                    '/modulos/transaccion/factura_compra/mostrar_factura_compra'
                            "
                        >
                            <bs-tooltip
                                content="Volver hacia atras"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="reply"
                                    icon-size="sm"
                                >
                                </bs-button>
                            </bs-tooltip>
                        </router-link>

                        <bs-tooltip
                            content="Guardar cliente"
                            placement="bottom"
                        >
                            <bs-button
                                mode="icon"
                                icon="save"
                                icon-size="sm"
                                color="success"
                                @click="guardarActualizar()"
                            >
                            </bs-button>
                        </bs-tooltip>
                        <bs-tooltip
                            content="Guardar cliente"
                            placement="bottom"
                        >
                            <bs-button
                                mode="icon"
                                icon="file-pdf"
                                icon-size="sm"
                                color="red"
                                @click="imprimirPdf()"
                            >
                            </bs-button>
                        </bs-tooltip>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <bs-appbar class="bg-indigo rounded-top">
                    <bs-appbar-title
                        title="Factura de Compra"
                        class="text-white"
                    >
                    </bs-appbar-title>
                </bs-appbar>
                <bs-tabs v-model="activeTab" variant="modern" color="indigo">
                    <bs-tab label="Datos de la Factura" icon="money-bill-alt">
                        <datos-factura-compra
                            ref="refDatosFacturaCompra"
                            :data-factura-compra="
                                factura_compra.datos_factura_compra
                            "
                            @actualizarData="actualizarDataFacturaCompra"
                        ></datos-factura-compra>
                    </bs-tab>
                    <bs-tab label="Selección de Productos" icon="cart-plus">
                        <seleccionar-producto
                            ref="refSeleccionaProducto"
                            :data-listar-producto="
                                factura_compra.listar_producto
                            "
                            @actualizarData="actualizarListarProductos"
                        >
                        </seleccionar-producto>
                    </bs-tab>
                    <bs-tab label="Formas de Pago" icon="credit-card">
                        <forma-pago
                            ref="refFormaPago"
                            :data-forma-pago="factura_compra.forma_pago"
                            @actualizarData="actualizarFormaPago"
                        >
                        </forma-pago>
                    </bs-tab>
                </bs-tabs>
            </bs-card>
        </div>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import ListarCompraCabecera from "./ListarCompraCabecera.vue";
import ListarProducto from "../../Inventario/Producto/ListarProducto.vue";

export default {
    components: { ListarCompraCabecera, ListarProducto },
    mixins: [validationMixin],
    watch: {
        activeTab(value) {
            if (value && this.activeTabSetCarrito == false) {
                this.activeTabSetCarrito = true;
                this.$refs.refSeleccionaProducto.setProductosCarrito();
            }
        }
    },
    data: function() {
        return {
            activeTab: 0,
            activeTabSetCarrito: false,
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres.",

            //Objeto para almacenar los datos de las variables de cada componente hijo
            factura_compra: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        datos_factura_compra: {
                            factura_compra_cabecera_id: "",
                            proveedor_id: 0,
                            fmt_registro: null,
                            tipo_documento_id: "",
                            no_documento: "",
                            no_autorizacion: "",
                            cedula: "",
                            nombre: "",
                            apellido: "",
                            razon_social: "",
                            direccion: "",
                            telefono: ""
                        },
                        listar_producto: {
                            proveedor_id: "",
                            producto_id: "",
                            cantidad: "",
                            descripcion: "",
                            sub_total_12: "",
                            sub_total_0: "",
                            total: "",
                            //variable para la tabla de carrito
                            productosCarrito: new BsArrayStore([], {
                                idProperty: "index"
                            })
                        },
                        forma_pago: {
                            forma_pago_id: ""
                        }
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/transaccion/factura_compra/guardar_modificar_factura_compra",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/transaccion/factura_compra/guardar_modificar_factura_compra",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            )
        };
    },

    mounted: function() {
        this.prefijo = prefix;
        this.setFacturaCompra();
    },
    beforeDestroy: function() {
        this.$store.state.factura_compra = null;
    },
    computed: {
        //Metodo para validar el campo nombre
    },

    methods: {
        async setFacturaCompra() {
            if (this.$store.getters.getFacturaCompra != null) {
                this.showLoader = true;
                var factura_compra = this.$store.getters.getFacturaCompra;

                //Datos de factura compra
                this.factura_compra.datos_factura_compra.factura_compra_cabecera_id =
                    factura_compra.id;
                this.factura_compra.datos_factura_compra.tipo_documento_id = factura_compra.id_documento;
                this.factura_compra.datos_factura_compra.no_autorizacion = factura_compra.no_autorizacion;
                this.factura_compra.datos_factura_compra.no_documento =
                    factura_compra.secuencia;
                this.factura_compra.datos_factura_compra.fmt_registro =
                    factura_compra.fecha_compra;
                //Proveedor
                this.factura_compra.datos_factura_compra.proveedor_id =
                    factura_compra.proveedor.id;
                this.factura_compra.datos_factura_compra.cedula =
                    factura_compra.proveedor.cedula;
                this.factura_compra.datos_factura_compra.nombre =
                    factura_compra.proveedor.nombre;
                this.factura_compra.datos_factura_compra.apellido =
                    factura_compra.proveedor.apellido;
                this.factura_compra.datos_factura_compra.razon_social =
                    factura_compra.proveedor.razon_social;
                this.factura_compra.datos_factura_compra.direccion =
                    factura_compra.proveedor.direccion;
                this.factura_compra.datos_factura_compra.telefono =
                    factura_compra.proveedor.telefono;
                //Listar Producto
                this.factura_compra.listar_producto.proveedor_id =
                    factura_compra.proveedor.id;
                this.factura_compra.listar_producto.total =
                    factura_compra.totalapagar;
                this.factura_compra.listar_producto.descripcion =
                    factura_compra.observacion;
                //forma de pago
                this.factura_compra.forma_pago.forma_pago_id = factura_compra.id_pago;

                await this.$refs.refSeleccionaProducto.cmb.productos.proxy.fetch(
                    factura_compra.proveedor.id
                );

                /* var compra_detalle = factura_compra.compra_detalle;

                var object = {};

                for (let i = 0; i < compra_detalle.length; i++) {
                    let i_pro_inv = null;
                    for (
                        let j = 0;
                        j < compra_detalle[i].producto_inventario.length;
                        j++
                    ) {
                        if (
                            compra_detalle[i].producto_inventario[j].id_factura ==
                                factura_compra.id &&
                            compra_detalle[i].producto_inventario[j].id_producto ==
                                compra_detalle[i].producto.id
                        ) {
                            i_pro_inv = i;
                            break;
                        }
                    }
                    this.factura_compra.listar_producto.producto_id = 180;
                    object = {
                        factura_compra_cuerpo_id:
                            compra_detalle[i].producto_inventario[i_pro_inv].id,
                        id: compra_detalle[i].producto.id,
                        nombre: compra_detalle[i].producto.nombre,
                        imagen: compra_detalle[i].producto.imagen,
                        stock:
                            compra_detalle[i].producto_inventario[i_pro_inv].stock,
                        precio: compra_detalle[i].costo,
                        cantidad: compra_detalle[i].cantidad,
                        iva: compra_detalle[i].producto.iva,
                        total: compra_detalle[i].cantidad * compra_detalle[i].costo
                    };
                    this.factura_compra.listar_producto.productosCarrito._items.push(
                        object
                    );
                }
                //this.$refs.refSeleccionaProducto.prueba2(); */
                this.showLoader = false;
            }
        },
        actualizarDataFacturaCompra(field, value) {
            this.factura_compra.datos_factura_compra[field] = value;
            if (field == "proveedor_id") {
                this.actualizarListarProductos(field, value);
            }
        },
        actualizarListarProductos(field, value) {
            this.factura_compra.listar_producto[field] = value;
        },
        actualizarFormaPago(field, value) {
            this.factura_compra.forma_pago[field] = value;
        },
        guardarActualizar() {
            var that = this;
            this.$refs.refDatosFacturaCompra.$v.$touch();
            this.$refs.refSeleccionaProducto.$v.$touch();
            this.$refs.refFormaPago.$v.$touch();
            if (
                !this.$refs.refDatosFacturaCompra.$v.$error &&
                !this.$refs.refSeleccionaProducto.$v.$error &&
                !this.$refs.refFormaPago.$v.$error
            ) {
                this.showLoader = true;
                if (this.$store.getters.getFacturaCompra != null) {
                    this.factura_compra
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizarProducto",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.factura_compra
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizarProducto",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                }
            } else {
                that.showNotificationProgress(
                    "Erro de validación",
                    "Existen campos requerido, por favor revise antes de guardar.",
                    "warning"
                );
            }
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
            this.activeTab = 0;
            this.$refs.refDatosFacturaCompra.$refs.myform.reset();
            this.$refs.refSeleccionaProducto.$refs.myform.reset();
            this.$refs.refFormaPago.$refs.myform.reset();
            this.factura_compra.datos_factura_compra = {
                factura_compra_cabecera_id: "",
                proveedor_id: 0,
                fmt_registro: null,
                tipo_documento_id: "",
                no_documento: "",
                cedula: "",
                nombre: "",
                apellido: "",
                razon_social: "",
                direccion: "",
                telefono: ""
            };
            this.factura_compra.listar_producto = {
                proveedor_id: "",
                producto_id: "",
                cantidad: "",
                descripcion: "",
                sub_total_12: "",
                sub_total_0: "",
                total: "",
                productosCarrito: new BsArrayStore([], {
                    idProperty: "index"
                })
            };
            this.factura_compra.forma_pago = {
                forma_pago_id: ""
            };
            this.$refs.refDatosFacturaCompra.$v.$reset();
            this.$refs.refSeleccionaProducto.$v.$reset();
            this.$refs.refFormaPago.$v.$reset();
        },
        imprimirPdf() {
            if (
                this.factura_compra.datos_factura_compra
                    .factura_compra_cabecera_id != ""
            ) {
                window.open(
                    "/modulos/reporte/factura_compra/cargar_pdf_factura_compra/" +
                        this.factura_compra.datos_factura_compra
                            .factura_compra_cabecera_id
                );
            } else {
                this.showNotificationProgress(
                    "Advertencia",
                    "No existe factura de compra, para imprimir.",
                    "warning"
                );
            }
        }
    }
};
</script>
