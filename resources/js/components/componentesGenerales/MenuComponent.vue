<template>
    <nav class="mt-2">
        <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
        >
            <li
                class="nav-item has-treeview"
                v-for="(gestion, index) in menus"
                :key="index"
            >
                <a class="nav-link">
                    <i :class="gestion.imagen"></i>
                    <p>
                        {{
                            $funcionesGlobales.toCapitalFirstAllWords(
                                gestion.descripcion
                            )
                        }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul
                    class="nav nav-treeview"
                    v-for="(subMenu, index) in gestion.sub_modulo"
                    :key="index"
                >
                    <li class="nav-item" @click="changeMenu()">
                        <router-link
                            :to="$store.state.url_prefix + subMenu.route"
                            class="nav-link ml-3"
                            ><i :class="subMenu.imagen"> </i>
                            <p>
                                {{
                                    $funcionesGlobales.toCapitalFirstAllWords(
                                        subMenu.descripcion
                                    )
                                }}
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
        <bs-modal
            :open.sync="trueModalVisible"
            title="Productos sin Stock"
            max-width="85%"
        >
            <b>Existen productos que estan por acabar o no tienen stock.</b>
            <br />
            *Vaya al modulo de Inventario/Producto para revisar los productos o
            <br />
            *Vaya al modulo de Transaccion/Factura de Compra para aumentar el
            stock.

            <div v-for="(item, index) in sin_stock_array" :key="index">
                <small>
                    Nombre: {{
                        $funcionesGlobales.toCapitalFirstAllWords(item.nombre)
                    }}
                    - Stock: {{ item.stock!=null?item.stock:0 }}
                </small>
            </div>
            <template v-slot:footer>
                <bs-button
                    outlined
                    color="secondary"
                    @click="trueModalVisible = false"
                >
                    <router-link
                        :to="
                            $store.state.url_prefix +
                                '/modulos/inventario/producto/mostrar_producto'
                        "
                    >
                        Ir Producto
                    </router-link>
                </bs-button>
                <bs-button
                    outlined
                    color="secondary"
                    @click="trueModalVisible = false"
                >
                    <router-link
                        :to="
                            $store.state.url_prefix +
                                '/modulos/transaccion/factura_compra/crear_modificar_factura_compra'
                        "
                    >
                        Ir Fact. Compra
                    </router-link>
                </bs-button>
            </template>
        </bs-modal>
    </nav>
</template>
<script>
export default {
    props: {
        user: {
            type: Object
        }
    },
    data: function() {
        return {
            trueModalVisible: false,
            menus: [],
            sin_stock_array: []
        };
    },
    mounted: function() {
        this.cargarMenu();
        this.verificarStockProductoAll();
    },
    methods: {
        changeMenu() {
            $('[data-widget="pushmenu"]').PushMenu("collapse");
            $(document).on("shown.lte.pushmenu");
            //$('ul').Treeview('accordion')
        },
        cargarMenu() {
            let that = this;
            let url = this.$store.state.url_prefix + 
                "/modulos/seguridad/perfil_por_usuario/cargar_menu/" +
                this.$props.user.perfil;
            axios
                .get(url)
                .then(function(response) {
                    that.menus = response.data.menus;
                })
                .catch(error => {
                    that.showNotificationProgress(
                        "Error en cargarMenu",
                        "Por favor comuníquese con el administrador. " + error,
                        "error"
                    );
                });
        },
        verificarFacturaCaducadaAll() {
            let that = this;
            let url = this.$store.state.url_prefix + 
                "/modulos/inventario/producto/verificar_stock_producto_all";
            axios
                .get(url)
                .then(function(response) {
                    var productos = response.data.productos;
                    var sin_stock = false;
                    productos.forEach(producto => {
                        let object = {};
                        if (producto.stock <= producto.stock_minimo) {
                            sin_stock = true;
                            object.nombre = producto.nombre;
                            object.stock = producto.stock;
                            that.sin_stock_array.push(object);
                        }
                    });
                    if (sin_stock) {
                        that.trueModalVisible = true;
                        /* that.showNotificationProgress(
                            "Productos sin Stock",
                            "Existen productos que estan por acabar o no tienen stock, por favor verifique en el modulo de Inventario/Producto.",
                            "warning"
                        ); */
                    }
                })
                .catch(error => {
                    that.showNotificationProgress(
                        "Error en verificarStockProductoAll",
                        "Por favor comuníquese con el administrador. " + error,
                        "error"
                    );
                });
        },
        verificarStockProductoAll() {
            let that = this;
            let url = this.$store.state.url_prefix + 
                "/modulos/inventario/producto/verificar_stock_producto_all";
            axios
                .get(url)
                .then(function(response) {
                    var productos = response.data.productos;
                    var sin_stock = false;
                    productos.forEach(producto => {
                        let object = {};
                        if (producto.stock <= producto.stock_minimo) {
                            sin_stock = true;
                            object.nombre = producto.nombre;
                            object.stock = producto.stock;
                            that.sin_stock_array.push(object);
                        }
                    });
                    if (sin_stock) {
                        that.trueModalVisible = true;
                        /* that.showNotificationProgress(
                            "Productos sin Stock",
                            "Existen productos que estan por acabar o no tienen stock, por favor verifique en el modulo de Inventario/Producto.",
                            "warning"
                        ); */
                    }
                })
                .catch(error => {
                    that.showNotificationProgress(
                        "Error en verificarStockProductoAll",
                        "Por favor comuníquese con el administrador. " + error,
                        "error"
                    );
                });
        },
        showNotificationProgress(title, message, icon) {
            let options = {
                message: message,
                progressBar: true,
                progressBarValue: null,
                timeout: 5000
            };
            this.$notification[icon](options, title);
        }
    }
};
</script>
