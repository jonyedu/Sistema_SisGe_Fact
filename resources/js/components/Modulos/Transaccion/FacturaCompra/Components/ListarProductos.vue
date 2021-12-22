<template>
    <div class="my-demo-wrapper">
        <bs-card-body>
            <bs-card-content class="text-left">
                <form ref="myform" novalidate>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <bs-combobox
                                v-model="dataListarProducto.proveedor_id"
                                :data-source="cmb.proveedores"
                                floating-label
                                clear-button
                                :external-validator="proveedorValidator"
                                @change="getProductoPorProveedor()"
                            >
                                <label>Proveedor</label>
                            </bs-combobox>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <bs-grid
                                :data-source="
                                    dataListarProducto.productosCarrito
                                "
                                row-hover
                                sortable
                                :flip-on-small-screen="false"
                            >
                                <bs-grid-column
                                    field="cantidad"
                                    label="Cantidad"
                                    width="125"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="nombre"
                                    label="Producto"
                                    min-width="175"
                                >
                                </bs-grid-column>
                                <bs-grid-column
                                    field="precio"
                                    label="Precio"
                                    width="100"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="total"
                                    label="Total"
                                    width="100"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field=""
                                    label="Acciones"
                                    width="100"
                                ></bs-grid-column>
                                <template
                                    v-slot:datarow="{ columns, item, index }"
                                >
                                    <bs-grid-cell
                                        :column="columns[0]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                            @change="calcular12y0()"
                                            v-model="item.cantidad"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[1]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-combobox
                                            v-model="item.producto_id"
                                            :data-source="cmb.productos"
                                            clear-button
                                            @change="
                                                setDataProductoComboBox(index)
                                            "
                                        >
                                        </bs-combobox>
                                    </bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[2]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                            @change="calcular12y0()"
                                            v-model="item.precio"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[3]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <span
                                            @change="calcular12y0()"
                                            v-text="item.cantidad * item.precio"
                                        >
                                        </span>
                                    </bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[4]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-tooltip
                                            content="Eliminar productos"
                                            placement="bottom"
                                        >
                                            <bs-button
                                                icon="trash-alt"
                                                mode="icon"
                                                size="sm"
                                                color="danger"
                                                flat
                                                @click="quitarProducto(index)"
                                            ></bs-button>
                                        </bs-tooltip>
                                    </bs-grid-cell>
                                </template>
                            </bs-grid>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-3 ">
                                    <bs-button
                                        class="btn"
                                        icon-size="sm"
                                        icon="shopping-cart"
                                        @click="agregarDetalle()"
                                        color="primary"
                                        pill
                                        >Agregar detalle</bs-button
                                    >
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="col-lg-8 col-md-8 col-sm-12 mt-3 card-left">
                            <bs-card shadow style="height:90%">
                                <bs-text-area
                                    floating-label
                                    v-model="dataListarProducto.descripcion"
                                    :external-validator="descripcionValidator"
                                >
                                    <label>Descripción</label>
                                </bs-text-area>
                            </bs-card>
                        </div>
                        <div
                            class="col-lg-4 col-md-4 col-sm-12 mt-3 card-right"
                        >
                            <bs-card shadow>
                                <bs-list-view>
                                    <bs-list-tile>
                                        <bs-list-tile-content>
                                            <bs-list-tile-title
                                                >SubTotal 12%:
                                                <span class="float-right">{{
                                                    dataListarProducto.sub_total_12
                                                }}</span>
                                            </bs-list-tile-title>
                                            <bs-list-tile-title
                                                >SubTotal 0%:
                                                <span class="float-right">{{
                                                    dataListarProducto.sub_total_0
                                                }}</span>
                                            </bs-list-tile-title>
                                        </bs-list-tile-content>
                                    </bs-list-tile>
                                </bs-list-view>
                                <bs-divider></bs-divider>
                                <bs-list-view>
                                    <bs-list-tile>
                                        <bs-list-tile-content>
                                            <bs-list-tile-title
                                                >Total:
                                                <span class="float-right">{{
                                                    dataListarProducto.total
                                                }}</span>
                                            </bs-list-tile-title>
                                        </bs-list-tile-content>
                                    </bs-list-tile>
                                </bs-list-view>
                            </bs-card>
                        </div>
                    </div>
                </form>
            </bs-card-content>
        </bs-card-body>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>
<script>
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import {BsStore} from "vue-mdbootstrap";

const productoValidator = {
    proveedor_id: { required },
    descripcion: { required }
};
export default {
    props: {
        dataListarProducto: {
            type: Object
        }
    },
    watch: {
        "dataListarProducto.proveedor_id"(value) {
            this.$emit("actualizarData", "proveedor_id", value);
        },
        "dataListarProducto.producto_id"(value) {
            this.$emit("actualizarData", "producto_id", value);
        },
        "dataListarProducto.cantidad"(value) {
            this.$emit("actualizarData", "cantidad", value);
        },
        "dataListarProducto.descripcion"(value) {
            this.$emit("actualizarData", "descripcion", value);
        },
        "dataListarProducto.productosCarrito"(value) {
            this.$emit("actualizarData", "productosCarrito", value);
        },
        "dataListarProducto.sub_total_12"(value) {
            this.$emit("actualizarData", "sub_total_12", value);
        },
        "dataListarProducto.sub_total_0"(value) {
            this.$emit("actualizarData", "sub_total_0", value);
        },
        "dataListarProducto.total"(value) {
            this.$emit("actualizarData", "total", value);
        }
    },
    mixins: [validationMixin],
    data: function() {
        return {
            pagination: {
                messages: {
                    display: "Displaying: {0}-{1} of {2} items"
                },
                pageSize: 5,
                paging: [5, 10, 15, 25, [-1, "All"]]
            },
            //variable que controla el progreso
            showLoader: false,
            //Objeto para almacenar el arreglo de cada combobox
            cmb: {
                proveedores: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "proveedores",
                        totalProperty: "total",
                        pageSize: 15,
                        restProxy: {
                            browse: this.$store.stateicon="list" +
                                "/modulos/persona/proveedor/cargar_proveedor_all"
                        }
                    }),
                    schema: { displayField: "nombre", valueField: "id" }
                },
                productos: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "producto_inventario",
                        totalProperty: "total",
                        remoteSort: false,
                        restProxy: {
                            fetch: this.$store.stateicon="list" +
                                "/modulos/transaccion/factura_compra/cargar_producto_por_proveedor/{id}"
                        }
                    }),
                    schema: {
                        displayField: "nombre",
                        valueField: "id",
                        imageField: "imagen"
                    }
                }
            },

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio."
        };
    },
    validations: {
        dataListarProducto: productoValidator
    },
    mounted: function() {
        if (this.$store.getters.getFacturaCompra == null) {
            this.agregarDetalle();
        }
    },
    computed: {
        proveedorValidator() {
            return {
                hasError: this.$v.dataListarProducto.proveedor_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.dataListarProducto.proveedor_id.$dirty,
                validators: {
                    required: this.$v.dataListarProducto.proveedor_id.required
                }
            };
        },
        descripcionValidator() {
            return {
                hasError: this.$v.dataListarProducto.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.dataListarProducto.descripcion.$dirty,
                validators: {
                    required: this.$v.dataListarProducto.descripcion.required
                }
            };
        }
    },
    methods: {
        setDataProductoComboBox(index) {
            var producto_id = this.dataListarProducto.productosCarrito._items[index].producto_id;
            var dataProductoSelect = this.cmb.productos.proxy._items.find(producto => producto.id == producto_id);
            this.dataListarProducto.productosCarrito._items[index].iva =dataProductoSelect.iva;
            this.dataListarProducto.productosCarrito._items[index].precio =dataProductoSelect.pvc;
            this.calcular12y0();
        },
        setProductosCarrito() {
            this.showLoader = true;
            if (this.$store.getters.getFacturaCompra != null) {
                var factura_compra = this.$store.getters.getFacturaCompra;
                var compra_detalle = factura_compra.compra_detalle;

                var object = {};

                for (let i = 0; i < compra_detalle.length; i++) {
                    let i_pro_inv = null;
                    for (
                        let j = 0;
                        j < compra_detalle[i].producto_inventario.length;
                        j++
                    ) {
                        if (
                            compra_detalle[i].producto_inventario[j]
                                .id_factura == factura_compra.id &&
                            compra_detalle[i].producto_inventario[j]
                                .id_producto == compra_detalle[i].producto.id
                        ) {
                            i_pro_inv = i;
                            break;
                        }
                    }
                    object = {
                        index: 0,
                        factura_compra_cuerpo_id: compra_detalle[i].id,
                        producto_inventario_id:
                            compra_detalle[i].producto_inventario[i_pro_inv].id,
                        producto_id: compra_detalle[i].producto.id,
                        nombre: compra_detalle[i].producto.nombre,
                        imagen: compra_detalle[i].producto.imagen,
                        stock:
                            compra_detalle[i].producto_inventario[i_pro_inv]
                                .stock,
                        precio: compra_detalle[i].costo,
                        cantidad: compra_detalle[i].cantidad,
                        iva: compra_detalle[i].producto.iva,
                        total:
                            compra_detalle[i].cantidad * compra_detalle[i].costo
                    };
                    this.dataListarProducto.productosCarrito._items.push(
                        object
                    );
                }
            }
            this.showLoader = false;
        },
        agregarDetalle() {
            this.dataListarProducto.productosCarrito._items.push({
                index: 0,
                factura_compra_cuerpo_id: 0,
                producto_inventario_id: 0,
                producto_id: 0,
                nombre: "",
                imagen: "",
                stock: 0,
                precio: 0,
                cantidad: 0,
                iva: 0,
                total: 0
            });
        },
        quitarProducto(index) {
            this.dataListarProducto.productosCarrito._items.splice(index, 1);
            this.calcular12y0();
        },
        calcular12y0() {
            var sub_total_12 = 0;
            var sub_total_0 = 0;
            var total = 0;
            this.dataListarProducto.productosCarrito._items.forEach(function(
                data
            ) {
                data.total = data.cantidad * data.precio;
                //tiene iva
                if (data.iva) {
                    sub_total_12 += data.total;
                    //no tiene iva
                } else {
                    sub_total_0 += data.total;
                }
            });
            total = sub_total_12 + sub_total_0;
            this.dataListarProducto.sub_total_12 = sub_total_12.toFixed(4);
            this.dataListarProducto.sub_total_0 = sub_total_0.toFixed(4);
            this.dataListarProducto.total = total.toFixed(4);
        },
        getProductoPorProveedor() {
            this.cmb.productos.proxy.fetch(
                this.dataListarProducto.proveedor_id
            );
            //this.$refs.msjProducto.active = true;
        },
        btnClickModificar(item) {
            this.autoCloseModalVisible = true;
            this.Lista = item;
            this.mensaje =
                item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;

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
            this.dataListarProducto.proveedor_id = "";
            this.dataListarProducto.producto_id = "";
            this.dataListarProducto.cantidad = "";
            this.$v.$reset();
            this.cmb.productos.proxy._items = [];
        }
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;
}
.card-right {
    margin-left: auto;
}
.btn {
    margin-bottom: 16px;
    margin-right: 8px;
}
</style>
