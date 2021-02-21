<template>
    <div class="card">
        <center>
            <div class="card-body">
                <div v-if="url != ''">
                    <template v-if="tipoDocumento == 16">
                        <a
                            :href="url + '#view=fit'"
                            class="btn btn-dark"
                            target="_blank"
                            :style="'width: ' + ancho + ';'"
                            style="color:white;margin-bottom:5px;font-size:small;"
                            >Previsualizar En Nueva Pestaña</a
                        >
                        <iframe
                            :src="'data:application/pdf;base64,' +url + '#view=fit'"
                            frameborder="0"
                            :style="
                                'width: ' + ancho + ';height: ' + alto + ';'
                            "
                        ></iframe>
                    </template>
                    <template v-else-if="tipoDocumento == 17">
                        <a
                            :href="url + '#view=fit'"
                            class="btn btn-dark"
                            target="_blank"
                            :style="'width: ' + ancho + ';'"
                            style="color:white;margin-bottom:5px;font-size:small;"
                            >Previsualizar En Nueva Pestaña</a
                        >
                        <iframe
                            :src="'data:image/jpeg;base64,' +url + '#view=fit'"
                            frameborder="0"
                            :style="
                                'width: ' + ancho + ';height: ' + alto + ';'
                            "
                        ></iframe>

                    </template>
                </div>
            </div>
        </center>
    </div>
</template>
<script>
export default {
    props: {
        url: {
            type: String,
            required: true
        },
        size: {
            type: Array
        },
        tipoDocumento: {
            type: Number
        }
    },

    data: function() {
        return {
            extension: "",
            ancho:
                this.$props.size && this.$props.size[0]
                    ? this.$props.size[0]
                    : "100%",
            alto:
                this.$props.size && this.$props.size[1]
                    ? this.$props.size[1]
                    : "450px"
        };
    },
    mounted() {},
    methods: {
        llamarMetodoImprimir() {
            //window.open(this.$props.url);
            // abrir un PDF en una pestaña nueva
            window.open("http://" + this.$props.url, "_blank");

            // redirigir la pestaña actual a otra URL
            //window.location.href = 'http://ejemplo.com';
        }
    }
};
</script>
