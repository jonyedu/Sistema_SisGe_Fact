<template>
    <div class="my-demo-wrapper">
        <bs-card-body>
            <bs-card-content class="text-left">
                <form ref="myform" novalidate>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <!-- <bs-search-field
                                v-model="srchvalue0"
                                autofocus
                                @search="onSearch"
                            >
                            </bs-search-field> -->
                            <bs-combobox
                                v-model="productoForm.proveedor_id"
                                :data-source="cmb.proveedores"
                                floating-label
                                outlined
                                clear-button
                                :external-validator="proveedorValidator"
                                :minimum-items-for-search="3"
                                @change="getProductoPorProveedor()"
                            >
                                <label>Proveedor</label>
                            </bs-combobox>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-10">
                            <bs-tooltip
                                ref="msjProducto"
                                content="Seleccione un producto, para añadirlo"
                            >
                                <bs-combobox
                                    v-model="productoForm.producto_id"
                                    :data-source="cmb.productos"
                                    floating-label
                                    outlined
                                    clear-button
                                    :external-validator="productoValidator"
                                    :minimum-items-for-search="3"
                                    image-size="32"
                                    rounded-image
                                    show-image
                                    listbox-color="info-color"
                                    item-separator
                                >
                                    <template
                                        slot="optionItem"
                                        slot-scope="{ item }"
                                    >
                                        <bs-list-tile-title>
                                            <span>{{
                                                item.producto_inv != null
                                                    ? item.producto_inv.nombre
                                                    : ""
                                            }}</span>
                                            <span
                                                class="float-right font-weight-light small"
                                                >${{
                                                    item.costo_inv != null
                                                        ? item.costo_inv.precio
                                                        : ""
                                                }}</span
                                            >
                                        </bs-list-tile-title>
                                        <bs-list-tile-subtitle
                                            >Stock :
                                            {{
                                                item.Stock
                                            }}</bs-list-tile-subtitle
                                        >
                                    </template>
                                    <label>Productos</label>
                                </bs-combobox>
                            </bs-tooltip>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1">
                            <bs-text-field
                                floating-label
                                outlined
                                v-model="productoForm.cantidad"
                                :external-validator="cantidadValidator"
                            >
                                <label>Cantidad</label>
                            </bs-text-field>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 mt-3">
                            <bs-tooltip
                                content="Agregar Producto"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="shopping-cart"
                                    icon-size="sm"
                                    @click="agregarProducto()"
                                ></bs-button>
                            </bs-tooltip>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <bs-grid
                                :data-source="productosCarrito"
                                :pageable="pagination"
                                row-hover
                                sortable
                                :flip-on-small-screen="false"
                            >
                                <bs-grid-column
                                    field="nombre"
                                    label="Producto"
                                    min-width="175"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="imagen"
                                    label="Imagen"
                                    width="100"
                                    text-align="center"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="stock"
                                    label="Stock"
                                    width="120"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="precio"
                                    label="Precio"
                                    width="100"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="cantidad"
                                    label="Cantidad"
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
                                    ></bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[1]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-list-tile-leading
                                            :img-src="item.imagen"
                                            circle
                                        ></bs-list-tile-leading>
                                    </bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[2]"
                                        :item="item"
                                        :index="index"
                                    ></bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[3]"
                                        :item="item"
                                        :index="index"
                                    ></bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[4]"
                                        :item="item"
                                        :index="index"
                                    ></bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[5]"
                                        :item="item"
                                        :index="index"
                                    ></bs-grid-cell>
                                    <bs-grid-cell
                                        :column="columns[6]"
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
                                                @click="quitarProducto(item)"
                                            ></bs-button>
                                        </bs-tooltip>
                                    </bs-grid-cell>
                                </template>
                            </bs-grid>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 mt-3 card-left">
                            <bs-card shadow style="height:90%">
                                <bs-text-area
                                    floating-label
                                    outlined
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
                                                    sub_total_12
                                                }}</span>
                                            </bs-list-tile-title>
                                            <bs-list-tile-title
                                                >SubTotal 0%:
                                                <span class="float-right">{{
                                                    sub_total_0
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
                                                    sub_total_12 + sub_total_0
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
import { prefix } from "../../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength, numeric } from "vuelidate/lib/validators";

const productoValidator = {
    proveedor_id: { required },
    producto_id: { required },
    cantidad: { required, numeric }
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            sub_total_12: "",
            sub_total_0: "",
            pagination: {
                messages: {
                    display: "Displaying: {0}-{1} of {2} items"
                },
                pageSize: 5,
                paging: [5, 10, 15, 25, [-1, "All"]]
            },
            //variable que controla el progreso
            showLoader: false,
            //srchvalue0: null,
            srchvalue0: "ACEITE CON ACHIOTE  ILE 800GR",
            productoForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        proveedor_id: "",
                        producto_id: "",
                        cantidad: ""
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/inventario/producto/guardar_modificar_producto",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/inventario/producto/guardar_modificar_producto",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Objeto para almacenar el arreglo de cada combobox
            cmb: {
                proveedores: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "proveedores",
                        totalProperty: "total",
                        pageSize: 15,
                        restProxy: {
                            browse:
                                "/modulos/persona/proveedor/cargar_proveedor_all"
                        }
                    }),
                    schema: { displayField: "nombre", valueField: "id" }
                },
                productos: {
                    proxy: new BsStore({
                        idProperty: "id_producto",
                        dataProperty: "producto_inventario",
                        totalProperty: "total",
                        remoteSort: false,
                        restProxy: {
                            fetch:
                                "/modulos/transaccion/factura_compra/cargar_producto_por_proveedor/{id}"
                        }
                    }),
                    schema: {
                        displayField: "producto_inv.nombre",
                        valueField: "producto_inv.id",
                        imageField: "producto_inv.imagen"
                    }
                }
            },

            //variable para la tabla
            productosCarrito: new BsArrayStore([], {
                idProperty: "id"
            }),

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            numericErrorMsg: "Este campo debe ser numerico."
        };
    },
    validations: {
        productoForm: productoValidator
    },
    mounted: function() {},
    computed: {
        proveedorValidator() {
            return {
                hasError: this.$v.productoForm.proveedor_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.proveedor_id.$dirty,
                validators: {
                    required: this.$v.productoForm.proveedor_id.required
                }
            };
        },
        productoValidator() {
            return {
                hasError: this.$v.productoForm.producto_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.producto_id.$dirty,
                validators: {
                    required: this.$v.productoForm.producto_id.required
                }
            };
        },
        cantidadValidator() {
            return {
                hasError: this.$v.productoForm.cantidad.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    numeric: this.numericErrorMsg
                },
                dirty: this.$v.productoForm.cantidad.$dirty,
                validators: {
                    required: this.$v.productoForm.cantidad.required,
                    numeric: this.$v.productoForm.cantidad.numeric
                }
            };
        }
    },
    methods: {
        quitarProducto(item) {
            let index = null;
            for (let i = 0; i < this.cmb.productos.proxy._items.length; i++) {
                if (
                    this.cmb.productos.proxy._items.id_producto ==
                    item.producto_id
                ) {
                    index = i;
                    break;
                }
            }
            this.productosCarrito._items.splice(index, 1);
        },
        agregarProducto() {
            var that = this;
            let encontrado = false;
            let producto_id = "";
            let producto_nombre = "";
            let producto_imagen = "";
            let stock = "";
            let precio = "";
            let iva = "";
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                //Busca el producto que se desea agregar, en el arreglo de la tabla
                if (this.productosCarrito._items.length > 0) {
                    for (
                        let i = 0;
                        i < this.productosCarrito._items.length;
                        i++
                    ) {
                        let producto = this.productosCarrito._items[i];
                        if (producto.id == this.productoForm.producto_id) {
                            encontrado = true;
                            break;
                        }
                    }
                }
                //Si no existe en la tabla, se agrega los productos.
                if (!encontrado) {
                    //Se recorre el arreglo del combobox del productos, para sacar los datos y agregarlos en la tabla
                    for (
                        let i = 0;
                        i < this.cmb.productos.proxy._items.length;
                        i++
                    ) {
                        let producto = this.cmb.productos.proxy._items[i];
                        if (
                            producto.id_producto ==
                            this.productoForm.producto_id
                        ) {
                            producto_id = +producto.id_producto;
                            producto_nombre =
                                producto.producto_inv != null
                                    ? producto.producto_inv.nombre
                                    : 0;
                            producto_imagen =
                                producto.producto_inv != null
                                    ? producto.producto_inv.imagen
                                    : "";
                            stock = +producto.Stock;
                            iva =
                                producto.producto_inv != null
                                    ? producto.producto_inv.iva
                                    : "";
                            precio =
                                producto.costo_inv != null
                                    ? producto.costo_inv.precio
                                    : 0;
                            break;
                        }
                    }
                    //Si el stock es mayor 0, se agrega al carrito
                    if (stock > 0) {
                        this.productosCarrito._items.push({
                            id: producto_id,
                            nombre: producto_nombre,
                            imagen: producto_imagen,
                            stock: stock,
                            precio: precio,
                            cantidad: this.productoForm.cantidad,
                            iva: iva,
                            total: this.productoForm.cantidad * precio
                        });
                        this.lmpCampos();
                        this.showLoader = false;
                        this.calcular12y0();
                        this.showNotificationProgress(
                            "Exito al Procesar",
                            "Producto agregado correctamente.",
                            "success"
                        );
                    } else {
                        this.showNotificationProgress(
                            "Existe un error",
                            "El producto que intenta vender, no tiene stock disponible.",
                            "error"
                        );
                        this.showLoader = false;
                    }
                } else {
                    this.showNotificationProgress(
                        "Existe un error",
                        "El producto que intenta vender, ya se encuentra en la tabla.",
                        "error"
                    );
                    this.showLoader = false;
                }
            }
        },
        calcular12y0() {
            var sub_total_12 = 0;
            var sub_total_0 = 0;
            this.productosCarrito._items.forEach(function(data) {
                //tiene iva
                if (data.iva) {
                    sub_total_12 += data.total;
                    //no tiene iva
                } else {
                    sub_total_0 += data.total;
                }
            });
            this.sub_total_12 = sub_total_12;
            this.sub_total_0 = sub_total_0;
        },

        onSearch(term) {
            this.srchvalue0 = term;
            this.cmb.productos.proxy.fetch(term);
            this.$refs.msjProducto.active = true;
        },
        getProductoPorProveedor() {
            this.cmb.productos.proxy.fetch(this.productoForm.proveedor_id);
            this.$refs.msjProducto.active = true;
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
            this.productoForm.reset();
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
</style>
