<template>
    <div class="content-wrapper">
    <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        <router-link
                            :to="
                                $store.state.url_prefix +
                                    '/modulos/transaccion/factura_arqueo/lista_arqueo'
                            "
                        >
                           <bs-tooltip
                                        content="Volver hacia atras"
                                        placement="bottom"
                                    >
                                        <bs-button
                                            mode="icon"
                                            icon="list"
                                            icon-size="sm"
                                        >
                                        </bs-button>
                                    </bs-tooltip>
                        </router-link>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
        <div class="my-demo-wrapper">
            <div class="my-demo-wrapper">
                <bs-alert color="purple" icon="coins">
                <h5>Arqueo de Caja!</h5>
               
                <hr />
                <p class="mb-0">
                   Total de ventas en Efectivo :  ${{  calculartotal }}
                </p>
                </bs-alert>
            </div>
            <bs-card shadow>
                <!-- aqui va el grid -->
                     
                            <bs-grid
                                :data-source="
                                    arqueoCaja
                                ">
                                <bs-grid-column
                                    field="descripcion"
                                    label="descripcion"
                                    width="300"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="valor"
                                    label="valor"
                                    min-width="100"
                                >
                                </bs-grid-column>
                                
                                <bs-grid-column
                                    field="cantidad"
                                    label="cantidad"
                                    width="100"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="total"
                                    label="total"
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
                                       
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[1]"
                                        :item="item"
                                        :index="index"
                                    >
                                       
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[2]"
                                        :item="item"
                                        :index="index"
                                    >
                                           <bs-text-field
                                              @change="calcular(index,item)"
                                            v-model="item.cantidad"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[3]"
                                        :item="item"
                                        :index="index"
                                    >
                                       
                                    </bs-grid-cell>
                                </template>
                            </bs-grid>
                        
                <!-- fin -->
            </bs-card>
             <div class="my-demo-wrapper text-center">
                
                <bs-button color="success"
                @click="grabarArque()">Grabar Arqueo</bs-button>
               
            </div>
        </div>
       
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            trueModalVisible:false,
            
            arqueoCaja: new BsArrayStore([], {
                                    idProperty: "index",
                                     pageSize: 15,
                                }),
            item:{},
        };
    },
    computed: {
        calculartotal()
        {
            var con = 0;
            for (let index = 0; index < this.arqueoCaja._items.length; index++) {
                con += this.arqueoCaja._items[index].total;
                 
            }
           // console.log(con);
            
            return con;

        },
    },
    mounted: function() {
        this.agregarDetalle()
    },
    beforeDestroy() {},
    methods: {
        grabarArque(){
             let that = this;
            let url = "";
               url =  this.$store.state.url_prefix + "/modulos/transaccion/arque_caja/cargar_grabar/";
             for (let index = 0; index < this.arqueoCaja._items.length; index++) {
                
                if (this.arqueoCaja._items[index].cantidad.length == 0) {
                     that.showNotificationProgress(
                                    "Facturación",
                                    "Debe tener tener una cantidad "  ,
                                    "error"
                                    );
                                    return; 
                }
                 
            }
         
            axios
                .post(url,{arqueo:this.arqueoCaja._items})
                .then(function(response) { 
                    
                    that.showNotificationProgress(
                                    "Facturación",
                                    "Arqueo Grabado de manera Exitosa"  ,
                                    "success"
                                    );
                })
                .catch(error => {
                    //Errores de validación
                  
                   
                    
                    if (error.response.data.hasOwnProperty("errors")) {
                        const errors = error.response.data.errors;
                       // console.log(error.response.data.errors);
                        for (let error in errors) {
                            if (errors.hasOwnProperty(error)) {
                               // console.log(errors[error][0]);                              
                                 that.showNotificationProgress(
                                    "Facturación",
                                    "Error en el sistema" +errors ,
                                    "error"
                                    );
                                    return; 
 
                            }
                        }
                    }
                    
                });

        },
        calcular(index,valor)
        {

           // console.log(valor);
            var total = valor.valor * valor.cantidad;
            valor.total = total;

        },
         agregarDetalle() {
           
             
            
            let that = this;
            let url = "";
               url = this.$store.state.url_prefix + "/modulos/transaccion/arque_caja/cargar_arque/";
            
         
            axios
                .get(url)
                .then(function(response) { 
                   
                   for (let index = 0; index < response.data.arqueo.length; index++) {
                        that.arqueoCaja._items.push(
                        {id:response.data.arqueo[index].id,
                        descripcion: response.data.arqueo[index].descripcion,
                        valor:response.data.arqueo[index].valor,
                        cantidad:0,
                        total:0.0, 
                        
                    });
                      
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
                                 that.showNotificationProgress(
                                    "Facturación",
                                    "Error en el sistema" +errors ,
                                    "error"
                                    );
                                    return; 
 
                            }
                        }
                    }
                    
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
        },
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;
}
</style>
