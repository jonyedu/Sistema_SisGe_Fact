<template>
    <div class="content-wrapper">
        <div class="row row-cols-1 row-cols-md-2">
            <div
                class="col-lg-4 col-md-4 col-sm-12"
                v-for="(producto, index) of galleryProductos"
                :key="index"
            >
                <bs-card class="bg-light-grey text-white" shadow>
                    <bs-card-body class="bg-stylish-color">
                        <bs-card-content type="title">
                            <strong>{{ producto.nombrecorto }}</strong>
                        </bs-card-content>
                        <bs-card-content>
                            {{ producto.codigo }}
                            <br />${{ producto.pvc }}
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-media
                        :title="producto.stock>0?'Con stock':'Sin stock'"
                        :subtitle="producto.stock"
                    >
                        <bs-avatar
                            class="md-link"
                            :img-src="producto.imageSrc"
                            size="100%"
                            rounded
                            @click="openGallery1At(index)"
                            shadow
                        />
                    </bs-card-media>
                </bs-card>
            </div>
        </div>
        <bs-lightbox
            ref="lightbox1"
            :items="galleryProductos"
            :open.sync="showGalleryProducto"
        >
        </bs-lightbox>
    </div>
</template>
<script>

export default {
    data: function() {
        return {
            showGalleryProducto: false,
            galleryProductos: []
        };
    },

    mounted: function() {
        this.cargarProductoAll();
    },
    beforeDestroy: function() {},
    computed: {},

    methods: {
        openGallery1At(index) {
            if (index != null && index > -1) {
                this.$refs.lightbox1.openAt(index);
            } else {
                this.showGalleryProducto = true;
            }
        },
        cargarProductoAll() {
            var that = this;
            this.$http
                .get("api/catalogo/producto/cargar_productos_all")
                .then(function(response) {
                    var productos = response.data.productos;
                    if (productos.length > 0) {
                        productos.forEach(producto => {
                            let objeto = {};
                            var suma = 0;
                            objeto.codigo = producto.codigo;
                            objeto.title = producto.nombre;
                            objeto.nombrecorto = producto.nombrecorto;
                            objeto.pvc = producto.pvc;
                            objeto.imageSrc = producto.imagen;
                            objeto.thumbnail = producto.imagen;
                            if (producto.producto_inventario_many.length > 0) {
                                producto.producto_inventario_many.forEach(function(numero) {
                                    suma += numero.stock;
                                });
                            }
                            objeto.stock = suma.toString();
                            that.galleryProductos.push(objeto);
                        });
                    }
                })
                .catch(function(error) {});
        }
    }
};
</script>
