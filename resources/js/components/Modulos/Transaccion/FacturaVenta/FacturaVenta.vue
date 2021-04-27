<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <bs-card shadow>
                <bs-appbar class="bg-indigo rounded-top">
                    <bs-appbar-title title="Facturación" class="text-white">
                    </bs-appbar-title>
                    <bs-spacer></bs-spacer>
                </bs-appbar>
                <bs-tabs v-model="activeTab" variant="modern" color="indigo">
                    <bs-tab label="Selección de Productos" icon="cart-plus">
                        <inventario-producto ref="inventariofact"> </inventario-producto>
                    </bs-tab>
                    <bs-tab label="Datos de Facturación" icon="money-bill-alt">
                       <cliente-factura ref="clientefac">
                       </cliente-factura>
                    </bs-tab>
                    <bs-tab label="Formas de Pago" icon="credit-card"> 
                    <forma-de-pago-factura ref="formaspagofactura">
                    </forma-de-pago-factura>
                    </bs-tab>
                </bs-tabs>
                <div class="col-md text-center">
                    <bs-tooltip content="Tooltip on bottom side" placement="bottom">
                   <bs-button 
                    color="success" 
                    class="text-nowrap" 
                    raised 
                    outlined 
                    pill
                    @click  ="GrabarFactura">
                    Facturación
                    </bs-button>
                    </bs-tooltip>
                </div>
                
            </bs-card>
        </div>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    data: function() {
        return {
            activeTab: 0,
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario

            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres."

            //Objeto para almacenar el arreglo de cada combobox
        };
    },

    mounted: function() {
        this.prefijo = prefix;
      
        
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
        //Metodo para validar el campo nombre
    },

    methods: {
        showNotificationProgress(title, message, icon) {
            let options = {
                message: message,
                progressBar: true,
                progressBarValue: null,
                timeout: 5000
            };
            this.$notification[icon](options, title);
        },
        GrabarFactura(){
                 let that = this;
            let url = "";
            let ListaProductos=[];
            let ListaCliente=[];
            let ListaMetodosPago=[];

            ListaProductos = this.$store.getters.getInventariofactura;
            ListaCliente = this.$store.getters.getClientefactura;
            ListaMetodosPago = this.$store.getters.getFormapagofactura;

            //aqui valido si todo esta correcto nuevamente

            if (ListaProductos.length==0) 
            {
                 this.showNotificationProgress(
                                "Facturación",
                                "Debe tener Agregado un producto al carrito" ,
                                "error"
                            );
                            return;
            }
            if (ListaCliente.id==0) 
            {
                 this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar un cliente, Registrarlo o elegir la opcion de consumidor final" ,
                                "error"
                            );
                            return;
            }
             if (ListaMetodosPago.tipo_pagof==0) 
            {
                 this.showNotificationProgress(
                                "Facturación",
                                "Debe Seleccionar un un metodo de pago" ,
                                "error"
                            );
                            return;
            }
            //fin
            this.errors = [];
            url =  "/modulos/transaccion/factura_venta/guardar_factura/";

         
            axios
                .post(url,{inventario:ListaProductos,
                            cliente:ListaCliente,
                            metodosp:ListaMetodosPago})
                .then(function(response) { 
                    console.log(response.data);
                    
                    
                    
                })
                .catch(error => {
                    //Errores de validación
                  

                    if (error.response.data.hasOwnProperty("errors")) {
                        const errors = error.response.data.errors;
                       // console.log(error.response.data.errors);
                        for (let error in errors) {
                            if (errors.hasOwnProperty(error)) {
                               // console.log(errors[error][0]);                              
                                
 
                            }
                        }
                    }
                    
                });
        },
    }
};
</script>

<style lang="scss">
.my-demo-wrapper {
    padding: 24px;

    .btn {
        margin-bottom: 16px;
        margin-right: 8px;
    }
}
</style>
