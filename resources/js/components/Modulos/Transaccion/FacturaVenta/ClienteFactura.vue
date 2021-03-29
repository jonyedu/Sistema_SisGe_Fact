<template >
    <div>
         <div class="form-group">
                            <bs-text-field
                                prepend-icon="address-book"
                                floating-label
                                autofocus
                                required
                                  :disabled="cliente.band"
                                v-model="cliente.cedula"
                                @change="consultarcedula()"
                            >
                                <label>Cédula de Identidad </label>
                            </bs-text-field>
                            <bs-switch
                                color="primary"
                                label-position="left"
                                label-class="col-md-4 ml-3"
                                 v-model="cliente.band"
                                 
                                 @change="consumidorfinal()"
                            >
                                S/c
                            </bs-switch>
                            <bs-text-field
                                prepend-icon="address-book"
                                floating-label
                                autofocus
                                required
                                  :disabled="cliente.band"
                                 v-model="cliente.nombres"
                            >
                                <label>Nombres </label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="address-book"
                                floating-label
                                autofocus
                                required
                                  :disabled="cliente.band"
                                 v-model="cliente.apellidos"
                            >
                                <label>Apellidos</label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="phone-alt"
                                floating-label
                                autofocus
                                required
                                :disabled="cliente.band"
                                 v-model="cliente.telefono"
                                  
                            >
                                <label>Teléfono</label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="map-marker-alt"
                                floating-label
                                autofocus
                                required
                                  :disabled="cliente.band"
                                 v-model="cliente.direccion"
                            >
                                <label>Dirección</label>
                            </bs-text-field>
                            <bs-text-field
                                prepend-icon="mail-bulk"
                                floating-label
                                autofocus
                                required
                                  :disabled="cliente.band"
                                 v-model="cliente.email"
                            >
                                <label>Correo Electronico</label>
                            </bs-text-field>
                        </div>
    </div>
</template>
<script>
import { prefix } from "../../../../variables";
export default {

  data: function() {
        return {
            totalPagar:0,
            srchvalue0: null,
            cantidad:0,
            autoCloseModalVisible: false,
            prefijo: "",
            Lista:[],
            mensaje:"",
            cliente:{
                id:0,
                band:false,
                cedula:"",
                nombres:"",
                apellidos:"",
                telefono:"0",
                direccion:"",
                email:""
            },
            trueModalVisible:false,
            
            
        };
    },
    computed: {
      
      
    },
  methods: {
      consultarcedula(){
            let that = this;
            let url = this.prefijo +
                "/modulos/persona/cliente/cargar_cliente_cedula/" + this.cliente.cedula;
            axios
                .get(url)
                .then(function(response) {
                    if (response.data.total == 0){
                        that.showNotificationProgress("Facturacion","Cliente no registrado","error")
                         that.cliente.cedula=""
               that.cliente.nombres=" "
               that.cliente.apellidos=""
               that.cliente.direccion=""
               that.cliente.telefono=""
               that.cliente.email=""

                    }else{
                        that.cliente.id = response.data.clientes[0].id
                        that.cliente.cedula = response.data.clientes[0].cedula
                        that.cliente.nombres = response.data.clientes[0].nombres
                        that.cliente.apellidos = response.data.clientes[0].apellidos
                        that.cliente.direccion = response.data.clientes[0].direccion
                        that.cliente.telefono = response.data.clientes[0].telefono
                        that.cliente.email = response.data.clientes[0].correo
                    }
                    //console.log(response.data.clientes[0].nombres);
                    

                 
                })
                .catch(error => {
                    
                });

      },
      consumidorfinal(){
          if (this.cliente.band)
          {
                this.cliente.cedula="9999999999"
               this.cliente.nombres="CONSUMIDOR FINAL"
               this.cliente.apellidos="."
               this.cliente.direccion="."
               this.cliente.telefono="0"
               this.cliente.email="0"
              

          }else{
              this.cliente.cedula=""
               this.cliente.nombres=" "
               this.cliente.apellidos=""
               this.cliente.direccion=""
               this.cliente.telefono=""
               this.cliente.email=""
          }
      },
    calcular(){
        this.totalPagar = this.cantidad * this.Lista.costo_inv.precio;
    },
    onSearch(term) {
       this.srchvalue0 = term;
        this.inventario_p.fetch(term);
         this.showNotificationProgress(
                        "Facturacion",
                        "Producto Agregado" ,
                        "success"
                    );
    },
     btnClickModificar(item) {
       this.autoCloseModalVisible=true;
       this.Lista= item;
       this.mensaje = item.producto_inv.nombre + " Valor: " + item.costo_inv.precio;
       console.log(this.Lista);
       
            //this.$store.state.producto = item;
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
          cargarLista: function(value) {
          
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
