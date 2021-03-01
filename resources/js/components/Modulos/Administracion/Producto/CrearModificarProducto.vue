<template>
    <div class="content-wrapper">
        <div class="my-demo-wrapper">
            <div class="row">
                <div class="col-lg-12 offset-lg-12">
                    <bs-card shadow>
                        <bs-card-body>
                            <bs-card-content class="text-right">
                                <router-link
                                    :to="
                                        prefijo +
                                            '/modulos/administracion/producto/mostrar_producto'
                                    "
                                >
                                    <bs-button
                                        mode="icon"
                                        icon="reply"
                                        icon-size="sm"
                                    >
                                    </bs-button>
                                </router-link>
                                <bs-button
                                    mode="icon"
                                    icon="save"
                                    icon-size="sm"
                                    color="success"
                                    @click="guardarActualizarProducto()"
                                >
                                </bs-button>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de Producto</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="productoForm.nombre"
                                            :external-validator="
                                                nombreValidator
                                            "
                                        >
                                            <label>Nombres</label>
                                        </bs-text-field>
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="productoForm.descripcion"
                                            :external-validator="
                                                descripcionValidator
                                            "

                                        >
                                            <label>Descripción</label>
                                        </bs-text-field>
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="productoForm.codigo"
                                            :external-validator="
                                                codigoValidator
                                            "

                                        >
                                            <label>Codigo</label>
                                        </bs-text-field>
                                        <bs-combobox
                                            prepend-icon-outer="user"
                                            v-model="
                                                productoForm.laboratorio_id
                                            "
                                            :data-source="cmb.laboratorios"
                                            floating-label
                                            outlined
                                            :external-validator="
                                                laboratorioValidator
                                            "
                                        >
                                            <label>Laboratorio</label>
                                        </bs-combobox>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <bs-text-field
                                            prepend-icon-outer="user"
                                            floating-label
                                            outlined
                                            v-model="productoForm.nombre_corto"
                                            :external-validator="
                                                nombreCortoValidator
                                            "
                                        >
                                            <label>Nombre Corto</label>
                                        </bs-text-field>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="
                                                        productoForm.stock_minimo
                                                    "
                                                    :external-validator="
                                                        stockMinimoValidator
                                                    "
                                                >
                                                    <label>Mínimo</label>
                                                </bs-text-field>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="
                                                        productoForm.stock_maximo
                                                    "
                                                    :external-validator="
                                                        stockMaximoValidator
                                                    "
                                                >
                                                    <label>Máximo</label>
                                                </bs-text-field>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="productoForm.pvc"
                                                    :external-validator="
                                                        pvcValidator
                                                    "
                                                >
                                                    <label>PVC</label>
                                                </bs-text-field>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <bs-text-field
                                                    prepend-icon-outer="user"
                                                    floating-label
                                                    outlined
                                                    v-model="productoForm.iva"
                                                    :external-validator="
                                                        ivaValidator
                                                    "
                                                >
                                                    <label>IVA</label>
                                                </bs-text-field>
                                            </div>
                                        </div>
                                        <bs-combobox
                                            prepend-icon-outer="user"
                                            v-model="productoForm.grupo_id"
                                            :data-source="cmb.grupos"
                                            floating-label
                                            outlined
                                            :external-validator="
                                                grupoValidator
                                            "
                                        >
                                            <label>Grupo</label>
                                        </bs-combobox>
                                        <div class="form-group">
      <bs-combobox v-model="employee0" :data-source="peopleSrc">
        <label class="col-md-3 col-xl-2 col-form-label">Employee</label>
      </bs-combobox>
    </div>
    <div class="form-group">
      <bs-combobox :value="employee1" :data-source="peopleSrc" readonly>
        <label class="col-md-3 col-xl-2 col-form-label">State Readonly</label>
      </bs-combobox>
    </div>
    <div class="form-group">
      <bs-combobox :value="employee2" :data-source="peopleSrc" disabled>
        <label class="col-md-3 col-xl-2 col-form-label">State Disabled</label>
      </bs-combobox>
    </div>
                                    </div>
                                </div>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

const productoValidator = {
    producto_id: { required},
    nombre: { required, minLength: minLength(5) },
    nombre_corto: { required},
    stock_maximo: { required},
    stock_minimo: { required},
    pvc: { required},
    iva: { required},
    descripcion: { required},
    codigo: { required},
    grupo_id: { required},
    laboratorio_id: { required},
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario
            productoForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        producto_id:0,
                        nombre: "",
                        nombre_corto: "",
                        stock_maximo: "",
                        stock_minimo: "",
                        pvc: "",
                        iva: "",
                        descripcion: "",
                        codigo: "",
                        grupo_id: "",
                        laboratorio_id: ""
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/administracion/producto/guardar_producto",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/administracion/producto/actualizar_producto",
                            method: "post"
                        }
                    }
                },
                null,
                "uid"
            ),
            //Variables para la validaciones
            requiredErrorMsg: "Este campo es obligatorio.",
            minLengthErrorMsg: "Este campo debe tener al menos 5 caracteres.",

            //Objeto para almacenar el arreglo de cada combobox
            cmb: {
                //Combo Grupo
                grupos: {
                    proxy: new BsStore({
                        idProperty: "Id",
                        dataProperty: "grupos",
                        totalProperty: "total",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/administracion/grupo/cargar_grupo_combo"
                        }
                    }),
                    schema: { displayField: "Codigo", valueField: "Id" }
                },
                //Combo Laboratorio
                laboratorios: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "laboratorios",
                        totalProperty: "total",
                        remoteSort: false,
                        restProxy: {
                            browse:
                                "/modulos/administracion/laboratorio/cargar_laboratorio_combo"
                        }
                    }),
                    schema: { displayField: "nombre", valueField: "id" }
                }
            }
        };
    },
    validations: {
        productoForm: productoValidator
    },

    mounted: function() {
        this.prefijo = prefix;
        if (this.$store.getters.getProducto != null) {
            var producto = this.$store.getters.getProducto;
            this.productoForm.producto_id = producto.id;
            this.productoForm.nombre = producto.nombre;
            this.productoForm.nombre_corto = producto.nombrecorto;
            this.productoForm.stock_maximo = producto.stock_maximo;
            this.productoForm.stock_minimo = producto.stock_minimo;
            this.productoForm.pvc = producto.pvc;
            this.productoForm.iva = producto.iva;
            this.productoForm.descripcion = producto.descripcion;
            this.productoForm.codigo = producto.codigo;
            this.productoForm.grupo_id = producto.grupo_id;
            this.productoForm.laboratorio_id = producto.laboratorio_id;
        }
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
        //Metodo para validar el campo nombre
        nombreValidator() {
            return {
                hasError: this.$v.productoForm.nombre.$error,
                messages: {
                    required: this.requiredErrorMsg,
                    minLength: this.minLengthErrorMsg
                },
                dirty: this.$v.productoForm.nombre.$dirty,
                validators: {
                    required: this.$v.productoForm.nombre.required,
                    minLength: this.$v.productoForm.nombre.minLength
                }
            };
        },
        nombreCortoValidator() {
            return {
                hasError: this.$v.productoForm.nombre_corto.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.nombre_corto.$dirty,
                validators: {
                    required: this.$v.productoForm.nombre_corto.required,
                }
            };
        },
        descripcionValidator() {
            return {
                hasError: this.$v.productoForm.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.descripcion.$dirty,
                validators: {
                    required: this.$v.productoForm.descripcion.required,
                }
            };
        },
        codigoValidator() {
            return {
                hasError: this.$v.productoForm.codigo.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.codigo.$dirty,
                validators: {
                    required: this.$v.productoForm.codigo.required,
                }
            };
        },
        stockMinimoValidator() {
            return {
                hasError: this.$v.productoForm.stock_minimo.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.stock_minimo.$dirty,
                validators: {
                    required: this.$v.productoForm.stock_minimo.required,
                }
            };
        },
        stockMaximoValidator() {
            return {
                hasError: this.$v.productoForm.stock_maximo.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.stock_maximo.$dirty,
                validators: {
                    required: this.$v.productoForm.stock_maximo.required,
                }
            };
        },
        pvcValidator() {
            return {
                hasError: this.$v.productoForm.pvc.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.pvc.$dirty,
                validators: {
                    required: this.$v.productoForm.pvc.required,
                }
            };
        },
        ivaValidator() {
            return {
                hasError: this.$v.productoForm.iva.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.iva.$dirty,
                validators: {
                    required: this.$v.productoForm.iva.required,
                }
            };
        },
        laboratorioValidator() {
            return {
                hasError: this.$v.productoForm.laboratorio_id.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.laboratorio_id.$dirty,
                validators: {
                    required: this.$v.productoForm.laboratorio_id.required,
                }
            };
        },
        grupoValidator() {
            return {
                hasError: this.$v.productoForm.grupo_id.$error,
                messages: {
                    required: this.requiredErrorMsg,
                },
                dirty: this.$v.productoForm.grupo_id.$dirty,
                validators: {
                    required: this.$v.productoForm.grupo_id.required,
                }
            };
        },
    },

    methods: {
        guardarActualizarProducto() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                if (this.$store.getters.getProducto != null) {
                    this.productoForm
                        .update()
                        .then(function(response) {
                            that.showNotificationProgress('Exito al Procesar', 'Producto modificado correctamente.', 'success');
                        })
                        .catch(function(error) {
                            that.showNotificationProgress('Error en GuardarActualizarProducto', 'Por favor comuníquese con el administrador. ' + error, 'error');
                        });
                } else {
                    this.productoForm
                        .save()
                        .then(function(response) {
                            that.showNotificationProgress('Exito al Procesar', 'Producto creado correctamente.', 'success');
                        })
                        .catch(function(error) {
                            that.showNotificationProgress('Error en GuardarActualizarProducto', 'Por favor comuníquese con el administrador. ' + error, 'error');
                        });
                }
            }
        },
        showNotificationProgress(title,message, icon) {
            let options = {
                message: message,
                progressBar: true,
                progressBarValue: null,
                timeout: 5000
            };
            this.$notification[icon](options, title);
        }
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
