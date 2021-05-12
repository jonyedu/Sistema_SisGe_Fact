<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content class="text-right">
                        
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            <bs-card shadow>
                <!-- aqui va el grid -->
                      <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <bs-grid
                                :data-source="
                                    arqueoCaja
                                ">
                                <bs-grid-column
                                    field="descripcion"
                                    label="descripcion"
                                    width="400"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="valor"
                                    label="valor"
                                    min-width="200"
                                >
                                </bs-grid-column>
                                
                                <bs-grid-column
                                    field="cantidad"
                                    label="cantidad"
                                    width="200"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="total"
                                    label="total"
                                    width="200"
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
                                           
                                            v-model="item.cantidad"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[3]"
                                        :item="item"
                                        :index="index"
                                    >
                                      <bs-text-field
                                           
                                            v-model="item.total"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                    
                                     
                                     
                                    
                                    
                                     
                                    
                                   
                                </template>
                            </bs-grid>
                        </div>
                <!-- fin -->
            </bs-card>
        </div>
       
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
export default {
    data: function() {
        return {

            prefijo: "",
            trueModalVisible:false,
            
            arqueoCaja: new BsArrayStore([], {
                                    idProperty: "index"
                                }),
            item:{},
        };
    },

    mounted: function() {
        this.prefijo = prefix;
        this.agregarDetalle()
    },
    beforeDestroy() {},
    methods: {
         agregarDetalle() {
           
             
            
            let that = this;
            let url = "";
               url =  "/modulos/transaccion/arque_caja/cargar_arque/";
            
         
            axios
                .get(url)
                .then(function(response) { 
                    console.log(response.data.arqueo);
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
                                 this.showNotificationProgress(
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
