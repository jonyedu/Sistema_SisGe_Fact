<template>
     <div class="content-wrapper">
        <div class="my-demo-wrapper">
                <bs-appbar shadow>
                    <bs-appbar-title title="Reporte Compras"></bs-appbar-title>
                </bs-appbar> 
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content  >
                        <!-- <router-link
                            :to="
                                prefijo +
                                    '/modulos/inventario/grupo/crear_modificar_grupo'
                            "
                        > -->
                        <div class="row">
                             <div class="col-md-6 mb-3">
                         
                               <b> Fecha Inicio:</b>  <input type="date" 
                               name="" v-model="fecha_desde">
                                
                            </div>
                        </div>
                        <div class="row">
                              <div class="col-md-6 mb-3">
                          
                               <b>Fecha Fin: </b>     <input type="date" 
                               name=""   v-model="fecha_hasta">
                            </div>
                        </div>
                         
                         
                            <bs-tooltip
                                content="Crear nuevos grupo"
                                placement="bottom"
                            >
                                <div class="col-md-4 mb-3">
                                    <bs-menu placement="bottom-right">
                                    <bs-button color="primary" dropdown-toggle>Acciones</bs-button>
                                        <template v-slot:content>
                                        <bs-list-view>
                                            <bs-list-tile  >
                                            <bs-list-tile-title> <bs-button
                                                mode="icon"
                                                icon="folder-open"
                                                icon-size="sm"
                                                @click="consultarPdf(2)"

                                            ></bs-button> &nbsp; Excel</bs-list-tile-title>
                                            </bs-list-tile> 
                                               <bs-divider></bs-divider>
                                            <bs-list-tile >
                                            <bs-list-tile-title><bs-button
                                                mode="icon"
                                                icon="folder-open"
                                                icon-size="sm"
                                                @click="consultarPdf(1)"

                                            ></bs-button>&nbsp; PDF</bs-list-tile-title>
                                            </bs-list-tile>
                                             
                                            
                                            
                                        </bs-list-view>
                                        </template>
                                    </bs-menu>
                                </div>
                            </bs-tooltip>
                        </router-link>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            
        </div>
     
    </div>
</template>
<script>
export default {
    data() {
        return {
            fecha_desde:"",
            fecha_hasta:"",
        }
    },
    methods: {
         consultarPdf(value){
            // console.log(value);
             
            window.open(
                         
                            "/modulos/reporte/factura_compra/cargar_pdf_factura_compra_fecha/" +this.fecha_desde +
                            "/" + this.fecha_hasta +"/" + value
                        );
              

            },
    },
}
</script>