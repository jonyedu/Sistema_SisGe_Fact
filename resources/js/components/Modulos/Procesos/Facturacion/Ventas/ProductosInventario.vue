<template>
  <div class="my-demo-wrapper">
   <bs-card-body>
   <bs-alert color="success">
                           Total a Pagar :  $
                        </bs-alert>
                    <bs-card-content class="text-right">
                    <div class="row">
                                                <div
                                                    class="col-lg-8 col-md-8 col-sm-8"
                                                >
                                    <bs-search-field 
                                                            v-model="srchvalue0" 
                                                            @search="onSearch">
                                                        </bs-search-field>
                                                
                                                    
                                                </div>
                   
                         
                            <bs-tooltip
                                content="Productos Agregados"
                                placement="bottom"
                            >
                                <bs-button
                                    mode="icon"
                                    icon="shopping-cart"
                                    icon-size="sm"
                                ></bs-button>
                            </bs-tooltip>
                       
                         </div>
                    </bs-card-content>
                </bs-card-body>
    <bs-card shadow>
    
      <bs-grid :data-source="inventario_p" 
               :pageable="pagination" 
               row-hover>
        <bs-grid-column field="producto_inventario.producto_inv.nombre" 
                        label="Producto" 
                        min-width="175"></bs-grid-column>
        <bs-grid-column field="Stock" 
                        label="Valor" 
                        width="120"></bs-grid-column>
        <bs-grid-column field="Stock" 
                        label="Stock" 
                        width="100"></bs-grid-column>
         <bs-grid-column label="Action" 
                        width="100" 
                        text-align="center"></bs-grid-column>
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
                            :column="columns[3]"
                            :item="item"
                            :index="index"
                        >
                             
                                <bs-tooltip
                                    content="Modificar productos"
                                    placement="bottom"
                                >
                                    <bs-button
                                        icon="pen"
                                        mode="icon"
                                        size="sm"
                                        color="secondary"
                                        flat
                                        @click="btnClickModificar(item)"
                                    ></bs-button>
                                </bs-tooltip>
                            

                           
                        </bs-grid-cell>
                    </template>
         
      </bs-grid>
    </bs-card>
  </div>
</template>
<script>
import { prefix } from "../../../../../variables";
export default {

  data: function() {
        return {
           srchvalue0: null,
           
            prefijo: "",
            Lista:[],
            trueModalVisible:false,
            pagination: {
              messages: {
                display: 'Displaying: {0}-{1} of {2} items',
              },
              pageSize: 5,
              paging: [5, 10, 15, 25, [-1, 'All']]
            },
            inventario_p: new BsStore({
                idProperty: "id_producto",
                dataProperty: "producto_inventario",
                totalProperty: "total",
                pageSize: 10,
                remoteFilter: false, // default is TRUE
                remotePaging: false, // default is TRUE
                remoteSort: false, // default is TRUE
                sorts: [{ property: "nombre", direction: "asc" }],
                restProxy: {
                    browse:
                   // "/modulos/administracion/producto/cargar_all_producto"
                   "/modulos/administracion/facturacion/productos_invo/gel"  
                }
            }),
            item:{},
        };
    },
  methods: {
    onSearch(term) {
        
      



 
       alert('este');
      
      // do something here...
    },
  }
}
</script>

<style lang="scss">
.my-demo-wrapper {
  padding: 24px;

  .small-box {
    max-width: 480px;
  }
}
</style>