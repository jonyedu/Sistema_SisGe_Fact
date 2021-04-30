<template>
    <div class="my-demo-wrapper">
        <div class="row row-cols-1 row-cols-md-2">
            <div
                class="col-lg-4 col-md-4 col-sm-12"
                v-for="(producto, index) of galleryProductos"
                :key="index"
            >
                <bs-card class="bg-stylish-color text-white" shadow>
                    <bs-card-body>
                        <bs-card-content type="title">
                            <strong>{{ producto.title }}</strong>
                        </bs-card-content>
                        <bs-card-content>
                            {{
                                $funcionesGlobales.toCapitalFirstWords(
                                    producto.descripcion
                                )
                            }}
                            <br />
                            ${{ producto.pvc }}
                        </bs-card-content>
                    </bs-card-body>
                    <bs-card-media
                        title="Image Title"
                        subtitle="Image SubTitle"
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
        <div class="col">
            <bs-card class="bg-stylish-color text-white" shadow>
                <bs-card-body>
                    <bs-card-content type="title">
                        Content Title
                    </bs-card-content>
                    <bs-card-content>
                        Some quick example text to build on the card title and
                        make up the bulk of the card's content.
                    </bs-card-content>
                </bs-card-body>
                <bs-card-media title="Image Title" subtitle="Image SubTitle">
                    <img
                        src="https://picsum.photos/id/225/600/300.jpg"
                        alt="image"
                    />
                </bs-card-media>
            </bs-card>
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
                    that.galleryProductos = response.data.productos;
                })
                .catch(function(error) {});
        }
    }
};
</script>
