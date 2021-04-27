<template>
   <div>
     <bs-alert color="success">
                           Total a Pagar :  $ {{ sumatoria }}

                           
                        </bs-alert>
                         <div class="auto" id="auto" style="display: none">
                                        holis {{enviovuex}}
                                        </div>
   <div class="form-group">
      <bs-combobox 
         v-model="forma.tipo_pagof" 
         :data-source="products" 
         prepend-icon="cash-register" 
         floating-label
         @change="tipodepago()">
         <label>-- Forma de pago --</label>
      </bs-combobox>
      <br>

      <div v-show="pagoefectivo">
         <bs-card shadow>
            <bs-card-header class="bg-primary text-white">Detalle de la Compra</bs-card-header>
            <bs-card-body>
               <bs-card-content
                  >
                  <label>Total a Pagar $</label>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.total_pagarf"
                     >
                     <label>Total Recibido</label>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="wallet"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.cambio_pagarf"
                     >
                     <label>Cambio</label>
                  </bs-text-field>
               </bs-card-content>
            </bs-card-body>
            <bs-card-footer class="bg-primary text-white">Detalle de la Compra</bs-card-footer>
         </bs-card>
      </div>


      <div v-show="pagotarjeta">
         <bs-card shadow>
            <bs-card-header class="bg-unique text-white">Pago Con Tarjeta</bs-card-header>
            <bs-card-body>
               <bs-card-content
                  >
                  <bs-combobox 
                     v-model="forma.tarjetasf"
                     :data-source="tarjetas" 
                     prepend-icon="cash-register" 
                     floating-label
                     @change="">
                     <label>-- Tarjetas --</label>
                  </bs-combobox>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.numero_tarjeta"
                     >
                     <label>Numero de Tarjeta</label>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.caduca"
                     >
                     <label>Fecha de Caducidad</label>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.cliente"
                     >
                     <label>Nombre del Cliente</label>
                  </bs-text-field>
               </bs-card-content>
            </bs-card-body>
            <bs-card-footer class="bg-unique text-white">Pago Con Tarjeta</bs-card-footer>
         </bs-card>
      </div>

      <div v-show="pagocheque"  >
         <bs-card  shadow>
            <bs-card-header class="bg-indigo text-white" >Pago Con Cheque</bs-card-header>
            <bs-card-body>
               <bs-card-content
                  >
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.fecha_emision"
                     >
                     <label>fecha de Emisión  </label>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.cantidad_pagarf"
                     >
                     <label>Cantidad</label>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.nombref"
                     >
                     <label>Nombre</label>
                  </bs-text-field>
                  <bs-combobox 
                     v-model="forma.banco"
                     :data-source="bancos" 
                     prepend-icon="cash-register" 
                     floating-label
                     @change="">
                     <label>-- Bancos --</label>
                  </bs-combobox>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.numero_cuenta"
                     >
                     <label>Número de Cuenta</label>
                  </bs-text-field>
                  <bs-text-field
                     prepend-icon="money-bill-wave-alt"
                     floating-label
                     autofocus
                     required 
                     v-model="forma.beneficiario"
                     >
                     <label>Beneficiario</label>
                  </bs-text-field>
               </bs-card-content>
            </bs-card-body>
            <bs-card-footer class="bg-indigo text-white">Pago Con Cheque</bs-card-footer>
         </bs-card>
      </div>
   </div>
</div>
</div>
</template>
<script>
import { prefix } from "../../../../variables";
export default {

  data: function() {
        return {
            totalPagarf:0,
            srchvalue0: null,
            product8:0,
            tarjetasCredito:0,
            bancosCredito:0,
            cantidad:0,
            total_for:[],
            pagoefectivo:false,
            pagotarjeta:false,
            pagocheque:false,
            autoCloseModalVisible: false,
            prefijo: "",
            forma:{
              
              tipo_pagof:0,
              tarjetasf:0,
              factura:0,
              numero:0,
              numero_tarjeta:0,
              caduca:"",
              cliente:0,
              total_pagarf:0,
              cambio_pagarf:0,
              id_facturav:0,
              fecha_emision:"",
              cantidad_pagarf:0,
              nombref:'',
              banco:0,
              numero_cuenta:'',
              beneficiario:'',


            },
            Lista:[],
            mensaje:"",
            products: {
                proxy: new BsStore({
                idProperty: 'tipo_pago',
                dataProperty: 'tipo',
                totalProperty: 'total',
                remoteSort: false,
                restProxy: {
                    browse: '/modulos/transaccion/factura_venta/config_tipo'
                }
                }),
                schema: { displayField: 'descripcion', valueField: 'tipo_pago' }
            },
            tarjetas: {
                proxy: new BsStore({
                idProperty: 'TarCodigo',
                dataProperty: 'tipo',
                totalProperty: 'total',
                remoteSort: false,
                restProxy: {
                    browse: '/modulos/transaccion/factura_venta/cargar_tarjeta'
                }
                }),
                schema: { displayField: 'TarNombre', valueField: 'TarCodigo' }
            },
            bancos: {
                proxy: new BsStore({
                idProperty: 'id',
                dataProperty: 'tipo',
                totalProperty: 'total',
                remoteSort: false,
                restProxy: {
                    browse: '/modulos/transaccion/factura_venta/cargar_banco'
                }
                }),
                schema: { displayField: 'descripcion', valueField: 'id' }
            },
            trueModalVisible:false,
            
            
        };
    },
    watch: {
      
    },
    computed: {
      enviovuex(){
          this.$store.state.formapagofactura = this.forma;
          return this.$store.state.formapagofactura;
      },
       sumatoria(){

        // return  this.total_for= this.$store.getters.getInventariofactura;
        //  if (this.total_pagarf !=null ) {
        this.total_for= this.$store.getters.getInventariofactura;
        var element_sum=0;
            
         var element=this.total_for.length;
         if (element>0) {
                for (let index = 0; index < this.total_for.length; index++) {
                element_sum += this.total_for[index].['tot'];
            } 
         }

        //  for (let index = 0; index < this.total_for.length; index++) {
        //      element += this.ListaCompra[index].['tot'];
        // } 
        //return this.total_pagarf.length;
         return this.total_for = element_sum;
        //  }
        //  else{
        //    return 0;
        //  }
        
       
      
      },
    },
    mounted() {
       return  this.total_for= this.$store.getters.getInventariofactura;
     //console.log(this.$refs.inventariofact);
    //this.totalPagarf =  this.$refs.inventariofact.totalPagar;
    },
  methods: {
      tipodepago(){
         if(this.forma.tipo_pagof==1){
            this.pagotarjeta=false;
            this.pagocheque=false;
            this.pagoefectivo=true;
            
          }
          if(this.forma.tipo_pagof==2){
            this.pagotarjeta=true;
            this.pagocheque=false;
             this.pagoefectivo=false;
            
          }
          if(this.forma.tipo_pagof==3){
             this.pagotarjeta=false;
            this.pagocheque=true;
              this.pagoefectivo=false;
            
          }
      },
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
        //  this.showNotificationProgress(
        //                 "Facturacion",
        //                 "Producto Agregado" ,
        //                 "success"
        //             );
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
