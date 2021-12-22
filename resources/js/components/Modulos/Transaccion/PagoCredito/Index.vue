<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                $store.state.url_prefix +
                                    '/modulos/persona/proveedor/crear_modificar_proveedor'
                            "
                        >
                            <bs-tooltip
                                content="Crear nuevos productos"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="plus"
                                    icon-size="sm"
                                ></bs-button>
                            </bs-tooltip>
                        </router-link>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <bs-grid
                    ref="gridProducto"
                    :data-source="creditos"
                    :pageable="{
                        messages: {
                            empty: 'No hay Artículos',
                            display: '{0}-{1} de {2} Artículos',
                            pager: 'Artículos por Página'
                        },
                    }"
                    row-hover
                    sortable
                    :flip-on-small-screen="false"
                    :filterable="{ minlength: 2, operator: 'contains' }"
                > 
                     <bs-grid-column
                        field="cliente_fact.cedula"
                        label="cedula"
                        width="100"
                    ></bs-grid-column>
                    <bs-grid-column
                        field="cliente_fact.NOMBRESCLIENTEPRO"
                        label="Nombre"
                        width="100"
                    ></bs-grid-column>

                     <bs-grid-column
                        field="ESTADOPRO"
                        label="estado"
                        width="100"
                    ></bs-grid-column>
                      
                    <bs-grid-column
                        field=""
                        label="Acciones"
                        width="100"
                    ></bs-grid-column>
                    <template v-slot:datarow="{ columns, item, index }">
                       
                        <bs-grid-cell
                            :column="columns[0]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell>
                        <bs-grid-cell
                            :column="columns[1]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell>

                       <bs-grid-cell
                            :column="columns[2]"
                            :item="item"
                            :index="index"
                        ></bs-grid-cell>

                        <bs-grid-cell
                            :column="columns[7]"
                            :item="item"
                            :index="index"
                        >
                             
                                 
                           
                            <bs-tooltip
                                content="Cancelar Factura"
                                placement="bottom"
                            >
                                <bs-button
                                    icon="money-bill-alt"
                                    mode="icon"
                                    size="sm"
                                    color="success"
                                    flat
                                    @click="
                                        abriModal(item)
                                    "
                                ></bs-button>
                            </bs-tooltip>
                        </bs-grid-cell>
                    </template>
                </bs-grid>
            </bs-card>
        </div>
        <bs-modal
            :open.sync="trueModalVisible"
            :overlay-close="false"
            title="Pago de Cuotas"
               max-width="85%"
           
        >
                 <bs-grid :data-source="source0" 
               row-hover 
               sortable>
        <bs-grid-column field="fecha" 
                        label="Fecha" 
                        min-width="175"></bs-grid-column>
        <bs-grid-column field="interes" 
                        label="Interes" 
                        width="120" 
                        text-align="center"></bs-grid-column>
        <bs-grid-column field="valor" 
                        label="Valor" 
                        width="100"></bs-grid-column>
        <bs-grid-column field="total" 
                        label="Total" 
                        width="100"></bs-grid-column>
        <bs-grid-column field="ESTADOPRO" 
                        label="Estado" 
                        width="120"></bs-grid-column>
        
        <bs-grid-column label="Action" 
                        width="100" 
                        text-align="center"></bs-grid-column>
        
        <template v-slot:datarow="{ columns, item, index }">
          <bs-grid-cell :column="columns[0]" 
                        :item="item" 
                        :index="index"></bs-grid-cell>
          <bs-grid-cell :column="columns[1]" 
                        :item="item" 
                        :index="index"></bs-grid-cell>
          <bs-grid-cell :column="columns[2]" 
                        :item="item" 
                        :index="index"></bs-grid-cell>
          <bs-grid-cell :column="columns[3]" 
                        :item="item" 
                        :index="index"></bs-grid-cell>
          <bs-grid-cell :column="columns[4]" 
                        :item="item" 
                        :index="index"
                        :class="'bg-warning'"></bs-grid-cell>
         
          <bs-grid-cell :column="columns[6]" 
                        :item="item" 
                        :index="index">
           
            <bs-button icon="hand-holding-usd" 
                       mode="icon" 
                       size="sm" 
                       color="success" 
                      
                       @click="pagacuota(item)"></bs-button>
          </bs-grid-cell>
        </template>
      </bs-grid>


            <template v-slot:footer>
                <bs-button
                    outlined
                    color="secondary"
                    @click="trueModalVisible = false"
                >
                    Cancelar
                </bs-button>
                <bs-button
                    active
                    color="primary"
                    @click="eliminarProducto()"
                >
                    OK
                </bs-button>
            </template>
        </bs-modal>
    </div>
</template>

<script>
import {BsStore} from "vue-mdbootstrap";
export default {
    data: function() {
        return {
            trueModalVisible:false,
            creditos: new BsStore({
                idProperty: "id",
                dataProperty: "cliente",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "nombre", direction: "asc" }],
                restProxy: {
                    browse: this.$store.stateicon="list" +
                        "/modulos/transaccion/creditos_venta/cargar_ccreditos"
                }
            }),
            source0: new BsStore({
                    idProperty: 'id_factura',
                    dataProperty: 'cliente',
                    totalProperty: 'total',
                    pageSize: 10,
                    remoteFilter: false, // default is TRUE
                    remotePaging: false, // default is TRUE
                    remoteSort: false,   // default is TRUE
                    sorts: [{property: 'name', direction: 'asc'}],
                    restProxy: {
                    fetch: '/modulos/transaccion/creditos_venta/cargar_detalle/{id}'
                    }
                }),
            item:{},
        };
    },

    mounted: function() {
    },
    beforeDestroy() {},
    methods: {
        pagacuota(item){
              let that = this;
            let url = this.$store.stateicon="list" + "/modulos/transaccion/creditos_venta/update_cuota/";
              console.log(item);
            axios
                .post(url,item)
                .then(function(response) { 
                    //console.log(response.data.id_factura);
                   // that.generarPdf(response.data.id);
                    
                                
                   if (response.data.cliente!=0) 
                   {
                        that.showNotificationProgress(
                                    "Facturación",
                                    "Factura Cancelada con éxito" ,
                                    "success"
                                    );
                                    that.generarPdf(item.id);
                       
                   }else{
                       that.showNotificationProgress(
                                    "Facturación",
                                    "Factura ya ha sido Cancelada" ,
                                    "error"
                                    );
                                    that.generarPdf(item.id);

                   }
                         
                    
                    
                })
                .catch(error => {
                    //Errores de validación
                  
                    console.log(error);
                    
                    if (error.response.data.hasOwnProperty("errors")) {
                        const errors = error.response.data.errors;
                       // console.log(error.response.data.errors);
                        for (let error in errors) {
                            if (errors.hasOwnProperty(error)) {
                               // console.log(errors[error][0]);                              
                                 this.showNotificationProgress(
                                    "Facturación",
                                    "Error en el sistema" +errors ,
                                    "error"
                                    );
                                     that.generarPdf(response.data.id);
                                    return; 
 
                            }
                        }
                    }
                    
                });

                 this.source0.fetch(item.id_factura);


        },
         generarPdf(value){
              // alert(value);
                 let that = this;
            let url = "";
            
            this.errors = [];
            url =  this.$store.stateicon="list" + "/modulos/reporte/factura_credito/cargar_pdf_factura_credito/"+value;
            window.open(url, '_blank');
            //window.location.href =  url;
         
            //location.reload();
        },
        btnClickModificar(item) {
            this.$store.state.proveedor = item;
           // console.log(item);

        },
        abriModal(item ) {
            this.trueModalVisible=true;
            this.item = item;
            //console.log(item.id_factura);
            
              this.source0.fetch(item.id_factura);
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
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;
}
</style>
