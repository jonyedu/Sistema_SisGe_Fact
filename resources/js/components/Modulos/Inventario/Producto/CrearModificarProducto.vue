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
                                            '/modulos/inventario/producto/mostrar_producto'
                                    "
                                >
                                    <bs-tooltip
                                        content="Volver hacia atras"
                                        placement="bottom"
                                    >
                                        <bs-button
                                            mode="icon"
                                            icon="reply"
                                            icon-size="sm"
                                        >
                                        </bs-button>
                                    </bs-tooltip>
                                </router-link>

                                <bs-tooltip
                                    content="Guardar producto"
                                    placement="bottom"
                                >
                                    <bs-button
                                        mode="icon"
                                        icon="save"
                                        icon-size="sm"
                                        color="success"
                                        @click="guardarActualizarProducto()"
                                    >
                                    </bs-button>
                                </bs-tooltip>
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                    <bs-card shadow>
                        <bs-card-header class="bg-indigo text-white"
                            >Mantenimiento de Producto</bs-card-header
                        >
                        <bs-card-body>
                            <bs-card-content>
                                <form ref="myform" novalidate>
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
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
                                                v-model="
                                                    productoForm.descripcion
                                                "
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
                                                    productoForm.proveedor_id
                                                "
                                                :data-source="cmb.proveedores"
                                                floating-label
                                                outlined
                                                clear-button
                                                :external-validator="
                                                    proveedorValidator
                                                "
                                                :minimum-items-for-search="3"
                                            >
                                                <label>Proveedor</label>
                                            </bs-combobox>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12"
                                        >
                                            <bs-text-field
                                                prepend-icon-outer="user"
                                                floating-label
                                                outlined
                                                v-model="
                                                    productoForm.nombre_corto
                                                "
                                                :external-validator="
                                                    nombreCortoValidator
                                                "
                                            >
                                                <label>Nombre Corto</label>
                                            </bs-text-field>
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-sm-6"
                                                >
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
                                                <div
                                                    class="col-lg-6 col-md-6 col-sm-6"
                                                >
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
                                                <div
                                                    class="col-lg-6 col-md-6 col-sm-6"
                                                >
                                                    <bs-text-field
                                                        prepend-icon-outer="user"
                                                        floating-label
                                                        outlined
                                                        v-model="
                                                            productoForm.pvc
                                                        "
                                                        :external-validator="
                                                            pvcValidator
                                                        "
                                                    >
                                                        <label>PVC</label>
                                                    </bs-text-field>
                                                </div>
                                                <div
                                                    class="col-lg-6 col-md-6 col-sm-6 mt-3"
                                                >
                                                    <bs-switch
                                                        v-model="
                                                            productoForm.iva
                                                        "
                                                        color="primary"
                                                        label-position="left"
                                                        label-class="col-md-4 ml-3"
                                                    >
                                                        IVA
                                                    </bs-switch>
                                                </div>
                                            </div>
                                            <bs-combobox
                                                prepend-icon-outer="user"
                                                v-model="productoForm.grupo_id"
                                                :data-source="cmb.grupos"
                                                floating-label
                                                outlined
                                                clear-button
                                                :external-validator="
                                                    grupoValidator
                                                "
                                            >
                                                <label>Grupo</label>
                                            </bs-combobox>
                                        </div>

                                    
                                        <div
                                            class="col-lg-12 col-md-12 col-sm-12 mt-3 text-center"
                                        >
                                            <input
                                                type="file"
                                                ref="file"
                                                accept=".jpg, .png, .jpeg"
                                                @change="onFileSelected"
                                                style="display: none"
                                            />
                                            <bs-button
                                                @click="$refs.file.click()"
                                                color="primary"
                                                icon="cloud-upload-alt"
                                                icon-position="left"
                                            >
                                                Cargar Imagen
                                            </bs-button>
                                        </div>
                                        <div
                                            class="col-lg-12 col-md-12 col-sm-12 text-center"
                                        >
                                            <bs-avatar
                                                class="md-link"
                                                :img-src="productoForm.fotoURL"
                                                size="100%"
                                                rounded
                                                @click="showSingleItem = true"
                                            >
                                            </bs-avatar>
                                        </div>
                                    </div>
                                </form>
                                    <!-- aqui va el grio de costo -->
                                     <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <bs-grid
                                :data-source="
                                    productosCarrito
                                "
                                row-hover
                                sortable
                                :flip-on-small-screen="false"
                            >
                                <bs-grid-column
                                    field="costo"
                                    label="costo"
                                    width="125"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field="factor"
                                    label="factor"
                                    min-width="175"
                                >
                                </bs-grid-column>
                                
                                <bs-grid-column
                                    field="costoi"
                                    label="costoi"
                                    width="100"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="preciou"
                                    label="preciou"
                                    width="100"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="precio"
                                    label="precio"
                                    width="100"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="precioi"
                                    label="precioi"
                                    width="100"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="utili"
                                    label="utili"
                                    width="100"
                                ></bs-grid-column>
                                 <bs-grid-column
                                    field="rentabilidad"
                                    label="rentabilidad"
                                    width="100"
                                ></bs-grid-column>
                                <bs-grid-column
                                    field=""
                                    label="Acciones"
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
                                        <bs-text-field
                                           
                                            v-model="item.costo"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[1]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.factor"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[2]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.costoi"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[3]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.preciou"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[4]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.precio"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[5]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.precioi"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[6]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.utili"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                     <bs-grid-cell
                                        :column="columns[7]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-text-field
                                           
                                            v-model="item.rentabilidad"
                                        >
                                        </bs-text-field>
                                    </bs-grid-cell>
                                    
                                     
                                    
                                    <bs-grid-cell
                                        :column="columns[9]"
                                        :item="item"
                                        :index="index"
                                    >
                                        <bs-tooltip
                                            content="Eliminar productos"
                                            placement="bottom"
                                        >
                                            <bs-button
                                                icon="trash-alt"
                                                mode="icon"
                                                size="sm"
                                                color="danger"
                                                flat
                                             
                                            ></bs-button>
                                        </bs-tooltip>
                                    </bs-grid-cell>
                                </template>
                            </bs-grid>
                        </div>
                                        <!-- aqui finaliza -->
                            </bs-card-content>
                        </bs-card-body>
                    </bs-card>
                </div>
            </div>
        </div>
        <bs-lightbox
            :items="singleItem"
            :open.sync="showSingleItem"
            :show-counter="false"
            :show-nav-control="false"
            :show-thumbnail="false"
            :show-toolbar="true"
            :toolbar="buttons"
        >
        </bs-lightbox>
        <bs-mask-loader :show="showLoader"></bs-mask-loader>
    </div>
</template>

<script>
import { prefix } from "../../../../variables";
import { validationMixin } from "vuelidate";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

const productoValidator = {
    producto_id: { required },
    nombre: { required, minLength: minLength(5) },
    nombre_corto: { required, maxLength: maxLength(30) },
    stock_maximo: { required },
    stock_minimo: { required },
    pvc: { required },
    descripcion: { required },
    codigo: { required },
    grupo_id: { required },
    proveedor_id: { required }
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //aqui

           productosCarrito: new BsArrayStore([], {
                                idProperty: "index"
                            }),
                  
            //fin
            id_producto: 10,
            //Variable para abrir la imagen en modal
            buttons: { close: true },
            showSingleItem: false,
            imageLoaded: false,
            image: {
                size: "",
                height: "",
                width: ""
            },
            singleItem: [
                {
                    //thumbnail: this.productoForm!=undefined?this.productoForm.fotoURL:"",
                    imageSrc: "",
                    title: ""
                }
            ],
            //variable que controla el progreso
            showLoader: false,
            //Variables para obtener el index
            prefijo: "",
            //Objeto donde tendrá todas las variables del formulario
            productoForm: new BsModel(
                {
                    //Aqui es donde se declará las variables para los txt, cmb, etc
                    schema: {
                        producto_id: 0,
                        nombre: "",
                        nombre_corto: "",
                        stock_maximo: "",
                        stock_minimo: "",
                        pvc: "",
                        iva: false,
                        descripcion: "",
                        codigo: "",
                        grupo_id: "",
                        proveedor_id: "",
                        logo: "",
                        fotoURL: "",
                        file_base_64: ""
                    },
                    //Variables para realizar las peticiones al servidor, save, update, fetch, delete
                    proxy: {
                        save: {
                            url:
                                "/modulos/inventario/producto/guardar_modificar_producto",
                            method: "post"
                        },
                        update: {
                            url:
                                "/modulos/inventario/producto/guardar_modificar_producto",
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
            maxLengthErrorMsg: "Este campo debe tener al menos 30 caracteres.",

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
                                "/modulos/inventario/grupo/cargar_grupo_combo_box"
                        }
                    }),
                    schema: { displayField: "Codigo", valueField: "Id" }
                },
                //Combo proveedor
                proveedores: {
                    proxy: new BsStore({
                        idProperty: "id",
                        dataProperty: "proveedores",
                        totalProperty: "total",
                        /* filters: [
                            {
                                property: "nombre",
                                value: "id",
                                operator: "contains"
                            }
                        ], */
                        pageSize: 15,
                        restProxy: {
                            browse:
                                "/modulos/persona/proveedor/cargar_proveedor_all"
                        }
                    }),
                    schema: { displayField: "nombre", valueField: "id" }
                }
            }
        };
    },
    watch: {
        imageLoaded(value) {
            this.validarDimensionFile();
        }
    },
    validations: {
        productoForm: productoValidator
    },
    created() {
       
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
            this.productoForm.proveedor_id = producto.laboratorio_id;
            this.productoForm.fotoURL = producto.imagen;
            this.productoForm.file_base_64 = producto.imagen;
            this.singleItem[0].imageSrc = producto.imagen;
             this.agregarDetalle();
        }else
        {
           this.productosCarrito._items.push({producto_id:0,
                        costo: 0,
                        factor:1,
                        costoi: 0,
                        preciou: 0,
                        precio: 0,
                        precioi: 0,
                        utili: 0,
                        rentabilidad: 0,
                        
                    });  
        }
       
    },
    beforeDestroy: function() {
        this.$store.state.producto = null;
    },
    computed: {
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
                    maxLength: this.maxLengthErrorMsg
                },
                dirty: this.$v.productoForm.nombre_corto.$dirty,
                validators: {
                    required: this.$v.productoForm.nombre_corto.required,
                    maxLength: this.$v.productoForm.nombre_corto.maxLength
                }
            };
        },
        descripcionValidator() {
            return {
                hasError: this.$v.productoForm.descripcion.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.descripcion.$dirty,
                validators: {
                    required: this.$v.productoForm.descripcion.required
                }
            };
        },
        codigoValidator() {
            return {
                hasError: this.$v.productoForm.codigo.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.codigo.$dirty,
                validators: {
                    required: this.$v.productoForm.codigo.required
                }
            };
        },
        stockMinimoValidator() {
            return {
                hasError: this.$v.productoForm.stock_minimo.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.stock_minimo.$dirty,
                validators: {
                    required: this.$v.productoForm.stock_minimo.required
                }
            };
        },
        stockMaximoValidator() {
            return {
                hasError: this.$v.productoForm.stock_maximo.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.stock_maximo.$dirty,
                validators: {
                    required: this.$v.productoForm.stock_maximo.required
                }
            };
        },
        pvcValidator() {
            return {
                hasError: this.$v.productoForm.pvc.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.pvc.$dirty,
                validators: {
                    required: this.$v.productoForm.pvc.required
                }
            };
        },
        proveedorValidator() {
            return {
                hasError: this.$v.productoForm.proveedor_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.proveedor_id.$dirty,
                validators: {
                    required: this.$v.productoForm.proveedor_id.required
                }
            };
        },
        grupoValidator() {
            return {
                hasError: this.$v.productoForm.grupo_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.grupo_id.$dirty,
                validators: {
                    required: this.$v.productoForm.grupo_id.required
                }
            };
        }
    },

    methods: {
        agregarDetalle() {
           
            var id_pr = this.productoForm.producto_id;
             console.log(id_pr);
            
            let that = this;
            let url = "";
               url =  "/modulos/inventario/producto/cargar_costo/"+ id_pr;
            
         
            axios
                .get(url)
                .then(function(response) { 
                    //console.log(response.data.productos.costo);
                    if (response.data.productos.length == 0) {
                         that.productosCarrito._items.push({producto_id:id_pr,
                        costo: 0,
                        factor:0,
                        costoi: 0,
                        preciou: 0,
                        precio: 0,
                        precioi: 0,
                        utili: 0,
                        rentabilidad: 0,
                        
                    });
                        
                    } else {
                        
                   
                    that.productosCarrito._items.push({producto_id:response.data.productos.idproducto,
                        costo: response.data.productos.costo,
                        factor:response.data.productos.factor,
                        costoi: response.data.productos.costoi,
                        preciou: response.data.productos.preciou,
                        precio: response.data.productos.precio,
                        precioi: response.data.productos.precioi,
                        utili: response.data.productos.utili,
                        rentabilidad: response.data.productos.rentabilidad,
                        
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
        createBase64Image(fileObject) {
            const reader = new FileReader();
            reader.readAsDataURL(fileObject);
            reader.onload = e => {
                this.productoForm.file_base_64 = e.target.result;
            };
        },
        onFileSelected(event) {
            if (event.target.files.length > 0) {
                if (
                    event.target.files[0]["type"] === "image/jpeg" ||
                    event.target.files[0]["type"] === "image/png" ||
                    event.target.files[0]["type"] === "image/jpg"
                ) {
                    this.productoForm.logo = event.target.files[0];
                    this.productoForm.fotoURL = URL.createObjectURL(
                        this.productoForm.logo
                    );
                    this.singleItem[0].title = event.target.files[0].name;
                    this.singleItem[0].imageSrc = this.productoForm.fotoURL;
                    //Inicio
                    let reader = new FileReader();

                    reader.readAsDataURL(event.target.files[0]);
                    reader.onload = evt => {
                        let img = new Image();
                        img.onload = () => {
                            this.image.width = img.width;
                            this.image.height = img.height;
                            this.imageLoaded = true;
                        };
                        img.src = evt.target.result;
                    };

                    //Fin
                } else {
                    this.showNotificationProgress(
                        "Advertencia al cargar la imagen",
                        "Solo imagenes de formato: .jpeg, .jpg, .png son permitidos!",
                        "warning"
                    );
                }
            }
        },
        validarDimensionFile() {
            if (this.imageLoaded) {
                if (this.image.width == 350 && this.image.height == 350) {
                    this.createBase64Image(this.productoForm.logo);
                    this.image.width = "";
                    this.image.height = "";
                    this.imageLoaded = false;
                } else {
                    this.image.width = "";
                    this.image.height = "";
                    this.imageLoaded = false;
                    this.productoForm.logo = "";
                    this.productoForm.fotoURL = "";
                    this.singleItem[0].title = "";
                    this.singleItem[0].imageSrc = "";
                    this.showNotificationProgress(
                        "Advertencia al cargar la imagen",
                        "La imagen debe ser una dimensión de 350x350.",
                        "warning"
                    );
                }
            }
        },
        guardarActualizarProducto() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                this.showLoader = true;
                if (this.$store.getters.getProducto != null) {
                    this.productoForm
                        .update()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto modificado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizarProducto",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                } else {
                    this.productoForm
                        .save()
                        .then(function(response) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto creado correctamente.",
                                "success"
                            );
                            that.lmpCampos();
                        })
                        .catch(function(error) {
                            that.showLoader = false;
                            that.showNotificationProgress(
                                "Error en GuardarActualizarProducto",
                                "Por favor comuníquese con el administrador. " +
                                    error,
                                "error"
                            );
                        });
                }
            }
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
        lmpCampos() {
            this.$refs.myform.reset();
            this.productoForm.reset();
            this.$v.$reset();
        }
    }
};
</script>
