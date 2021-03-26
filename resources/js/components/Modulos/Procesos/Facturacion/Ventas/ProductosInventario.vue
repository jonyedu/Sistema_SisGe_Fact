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
  <!-- aqui empieza el grid -->
   <bs-card shadow>

      <bs-grid :data-source="producto"
               :pageable="pagination"
               row-hover>
        <bs-grid-column field="Stock"
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
  <!-- aqui finaliza -->
  </div>
</template>
<script>
import { prefix } from "../../../../../variables";
export default {

  data: function() {
        return {
           srchvalue0: "deso",

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
            producto: new BsStore({
                idProperty: "id_producto",
                dataProperty: "producto_inventario",
                totalProperty: "total",
                name:null,
                pageSize: 10,
               
                sorts: [{ property: "Stock", direction: "asc" }],
                restProxy: {
                   
                   browse:'/modulos/administracion/producto/producto_por_id/{id}',
                  fetch:'/modulos/administracion/facturacion/productos_invo/{este}',
                  // save: { url: '/modulos/administracion/facturacion/productos_invo/', method: 'get' }, 
                  
                }
             
            }),
            item:{},
        };
    },
  methods: {
    onSearch(term) {
      this.srchvalue0 = term;
      this.producto.fetch(term);
        
       
       alert(term);


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
