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
                                            clear-button
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
                                                    v-model="productoForm.pvc"
                                                    :external-validator="
                                                        pvcValidator
                                                    "
                                                >
                                                    <label>PVC</label>
                                                </bs-text-field>
                                            </div>
                                            <div
                                                class="col-lg-6 col-md-6 col-sm-6"
                                            >
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
                                            clear-button
                                            :external-validator="grupoValidator"
                                        >
                                            <label>Grupo</label>
                                        </bs-combobox>
                                        <!-- Inicio parte 1 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="employee0"
                                                :data-source="peopleSrc"
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Employee</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <div class="form-group">
                                            <bs-combobox
                                                :value="employee1"
                                                :data-source="peopleSrc"
                                                readonly
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >State Readonly</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <div class="form-group">
                                            <bs-combobox
                                                :value="employee2"
                                                :data-source="peopleSrc"
                                                disabled
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >State Disabled</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 2 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="employee3"
                                                :data-source="peopleSrc"
                                                clear-button
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Employee</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 3 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="states0"
                                                :data-source="statesUS"
                                                placeholder="Select some States"
                                                clear-button
                                                multiple
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >US States</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 4 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="states1"
                                                :data-source="statesCA"
                                                check-option-color="primary"
                                                check-option-position="right"
                                                placeholder="Select some States"
                                                clear-button
                                                multiple
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Canada States</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 5 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="employee4"
                                                :data-source="peopleSrc"
                                                circle-image
                                                show-image
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >First Employee</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="employee5"
                                                :data-source="peopleSrc"
                                                rounded-image
                                                show-image
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Second Employee</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 6 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="employee6"
                                                :data-source="peopleSrc"
                                                image-size="32"
                                                rounded-image
                                                show-image
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Employee</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 7 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="employee8"
                                                :data-source="peopleSrc"
                                                open-on-hover
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Employee</label
                                                >
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 8 -->
                                        <div class="form-group">
                                            <bs-combobox
                                                v-model="selectedProduct"
                                                :data-source="products"
                                                placeholder="Select product"
                                                listbox-color="blue-green"
                                                item-separator
                                            >
                                                <label
                                                    class="col-md-3 col-xl-2 col-form-label"
                                                    >Product</label
                                                >
                                                <template
                                                    slot="optionItem"
                                                    slot-scope="{ item }"
                                                >
                                                    <bs-list-tile-title>
                                                        <span>{{
                                                            item.ProductName
                                                        }}</span>
                                                        <span
                                                            class="float-right font-weight-light small"
                                                            >${{
                                                                item.UnitPrice
                                                            }}</span
                                                        >
                                                    </bs-list-tile-title>
                                                    <bs-list-tile-subtitle
                                                        >Stock :
                                                        {{
                                                            item.UnitsInStock
                                                        }}</bs-list-tile-subtitle
                                                    >
                                                </template>
                                            </bs-combobox>
                                        </div>
                                        <!-- Inicio parte 9 -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="product0"
                                                        :data-source="products"
                                                        floating-label
                                                    >
                                                        <label
                                                            >Select
                                                            Product</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="product1"
                                                        :data-source="products"
                                                        placeholder="Select Product"
                                                        floating-label
                                                    >
                                                        <label>Product</label>
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Inicio parte 10 -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="product2"
                                                        :data-source="products"
                                                        floating-label
                                                        filled
                                                    >
                                                        <label
                                                            >Select
                                                            Product</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="product3"
                                                        :data-source="products"
                                                        placeholder="Select Product"
                                                        floating-label
                                                        filled
                                                    >
                                                        <label>Product</label>
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Inicio parte 11 -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="product4"
                                                        :data-source="products"
                                                        floating-label
                                                        outlined
                                                    >
                                                        <label
                                                            >Select
                                                            Product</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="product5"
                                                        :data-source="products"
                                                        placeholder="Select Product"
                                                        floating-label
                                                        outlined
                                                    >
                                                        <label>Product</label>
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Inicio parte 12 -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        :data-source="products"
                                                        :value="product6"
                                                        flat
                                                        readonly
                                                    >
                                                        <label
                                                            class="col-md-3 col-xl-2 col-form-label"
                                                            >Product</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        :data-source="products"
                                                        :value="product7"
                                                        floating-label
                                                        flat
                                                        readonly
                                                    >
                                                        <label>Product</label>
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Inicio parte 13 -->
                                        <!-- <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="caState0"
                                                        :data-source="statesCA"
                                                        :persistent-help-text="
                                                            false
                                                        "
                                                        help-text="Select Canada State from the list"
                                                        floating-label
                                                    >
                                                        <label
                                                            >Canada State</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="caState1"
                                                        :data-source="statesCA"
                                                        help-text="Select Canada State from the list"
                                                        floating-label
                                                    >
                                                        <label
                                                            >Canada State</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="caState2"
                                                        :data-source="statesCA"
                                                        :persistent-help-text="
                                                            false
                                                        "
                                                        help-text="Select Canada State from the list"
                                                        filled
                                                        floating-label
                                                    >
                                                        <label
                                                            >Canada State</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="caState3"
                                                        :data-source="statesCA"
                                                        help-text="Select Canada State from the list"
                                                        filled
                                                        floating-label
                                                    >
                                                        <label
                                                            >Canada State</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="caState4"
                                                        :data-source="statesCA"
                                                        :persistent-help-text="
                                                            false
                                                        "
                                                        help-text="Select Canada State from the list"
                                                        outlined
                                                        floating-label
                                                    >
                                                        <label
                                                            >Canada State</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <bs-combobox
                                                        v-model="caState5"
                                                        :data-source="statesCA"
                                                        help-text="Select Canada State from the list"
                                                        outlined
                                                        floating-label
                                                    >
                                                        <label
                                                            >Canada State</label
                                                        >
                                                    </bs-combobox>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- Inicio parte 14 -->
                                        <!-- Inicio parte 15 -->
                                        <!-- Inicio parte 16 -->
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
    producto_id: { required },
    nombre: { required, minLength: minLength(5) },
    nombre_corto: { required },
    stock_maximo: { required },
    stock_minimo: { required },
    pvc: { required },
    iva: { required },
    descripcion: { required },
    codigo: { required },
    grupo_id: { required },
    laboratorio_id: { required }
};
export default {
    mixins: [validationMixin],
    data: function() {
        return {
            //Inicio parte 1
            employee0: null,
            employee1: 2,
            employee2: 3,
            peopleSrc: {
                proxy: new BsArrayStore(
                    [
                        { id: 1, name: "Sandra Adams" },
                        { id: 2, name: "Ali Connors" },
                        { id: 3, name: "Trevor Hansen" },
                        { id: 4, name: "Tucker Smith" },
                        { id: 5, name: "Britta Holt" },
                        { id: 6, name: "Jane Smith" },
                        { id: 7, name: "John Smith" },
                        { id: 8, name: "Sandra Williams" }
                    ],
                    {
                        idProperty: "id"
                    }
                ),
                schema: { displayField: "name", valueField: "id" }
            },

            //Inicio parte 2
            employee3: null,
            peopleSrc: {
                proxy: new BsArrayStore(
                    [
                        { id: 1, name: "Sandra Adams" },
                        { id: 2, name: "Ali Connors" },
                        { id: 3, name: "Trevor Hansen" },
                        { id: 4, name: "Tucker Smith" },
                        { id: 5, name: "Britta Holt" },
                        { id: 6, name: "Jane Smith" },
                        { id: 7, name: "John Smith" },
                        { id: 8, name: "Sandra Williams" }
                    ],
                    {
                        idProperty: "id"
                    }
                ),
                schema: { displayField: "name", valueField: "id" }
            },
            //Inicio parte 3
            states0: [],
            statesUS: {
                proxy: new BsStore({
                    idProperty: "id",
                    dataProperty: "laboratorios",
                    totalProperty: "total",
                    remoteSort: false,
                    remoteFilter: false,
                    filters: [
                        { property: "nombre", value: "id", operator: "eq" }
                    ],
                    restProxy: {
                        browse:
                            "/modulos/administracion/laboratorio/cargar_laboratorio_combo"
                    }
                })
            },
            //Inicio parte 4
            states1: [],
            statesCA: {
                proxy: new BsStore({
                    idProperty: "id",
                    dataProperty: "laboratorios",
                    totalProperty: "total",
                    remoteSort: false,
                    remoteFilter: false,
                    filters: [
                        { property: "nombre", value: "id", operator: "eq" }
                    ],
                    restProxy: {
                        browse:
                            "/modulos/administracion/laboratorio/cargar_laboratorio_combo"
                    }
                })
            },
            //Inicio parte 5
            employee4: null,
            employee5: null,
            peopleSrc: {
                proxy: new BsArrayStore(
                    [
                        {
                            id: 1,
                            name: "Sandra Adams",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/1.jpg"
                        },
                        {
                            id: 2,
                            name: "Ali Connors",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/2.jpg"
                        },
                        {
                            id: 3,
                            name: "Trevor Hansen",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/3.jpg"
                        },
                        {
                            id: 4,
                            name: "Tucker Smith",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/4.jpg"
                        },
                        {
                            id: 5,
                            name: "Britta Holt",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/5.jpg"
                        },
                        {
                            id: 6,
                            name: "Jane Smith",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/3.jpg"
                        },
                        {
                            id: 7,
                            name: "John Smith",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/2.jpg"
                        },
                        {
                            id: 8,
                            name: "Sandra Williams",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/4.jpg"
                        }
                    ],
                    {
                        idProperty: "id"
                    }
                ),
                schema: {
                    displayField: "name",
                    valueField: "id",
                    imageField: "avatar"
                }
            },
            //Inicio parte 6
            employee6: null,
            peopleSrc: {
                proxy: new BsArrayStore(
                    [
                        {
                            id: 1,
                            name: "Sandra Adams",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/1.jpg"
                        },
                        {
                            id: 2,
                            name: "Ali Connors",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/2.jpg"
                        },
                        {
                            id: 3,
                            name: "Trevor Hansen",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/3.jpg"
                        },
                        {
                            id: 4,
                            name: "Tucker Smith",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/4.jpg"
                        },
                        {
                            id: 5,
                            name: "Britta Holt",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/5.jpg"
                        },
                        {
                            id: 6,
                            name: "Jane Smith",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/3.jpg"
                        },
                        {
                            id: 7,
                            name: "John Smith",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/2.jpg"
                        },
                        {
                            id: 8,
                            name: "Sandra Williams",
                            avatar:
                                "http://vue-mdbootstrap.fajarconsultant.com/img/4.jpg"
                        }
                    ],
                    {
                        idProperty: "id"
                    }
                ),
                schema: {
                    displayField: "name",
                    valueField: "id",
                    imageField: "avatar"
                }
            },
            //Inicio parte 7
            employee8: null,
            peopleSrc: {
                proxy: new BsArrayStore(
                    [
                        { id: 1, name: "Sandra Adams" },
                        { id: 2, name: "Ali Connors" },
                        { id: 3, name: "Trevor Hansen" },
                        { id: 4, name: "Tucker Smith" },
                        { id: 5, name: "Britta Holt" },
                        { id: 6, name: "Jane Smith" },
                        { id: 7, name: "John Smith" },
                        { id: 8, name: "Sandra Williams" }
                    ],
                    {
                        idProperty: "id"
                    }
                ),
                schema: { displayField: "name", valueField: "id" }
            },
            //Inicio parte 8
            selectedProduct: null,
            products: {
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
            },
            //Inicio parte 9
            product0: null,
            product1: null,
            products: {
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
            },
            //Inicio parte 10
            product2: null,
            product3: null,
            products: {
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
            },
            //Inicio parte 11
            product4: null,
            product5: null,
            products: {
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
            },
            //Inicio parte 12
            product6: 3,
            product7: 43,
            products: {
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
            },
            //Inicio parte 13
            caState0: null,
            caState1: null,
            caState2: null,
            caState3: null,
            caState4: null,
            caState5: null,
            statesCA: {
                proxy: new BsStore({
                    idProperty: "id",
                    dataProperty: "laboratorios",
                    totalProperty: "total",
                    remoteSort: false,
                    remoteFilter: false,
                    filters: [
                        { property: "nombre", value: "id", operator: "eq" }
                    ],
                    restProxy: {
                        browse:
                            "/modulos/administracion/laboratorio/cargar_laboratorio_combo"
                    }
                })
            },
            //Inicio parte 14
            //Inicio parte 15

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
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.nombre_corto.$dirty,
                validators: {
                    required: this.$v.productoForm.nombre_corto.required
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
        ivaValidator() {
            return {
                hasError: this.$v.productoForm.iva.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.iva.$dirty,
                validators: {
                    required: this.$v.productoForm.iva.required
                }
            };
        },
        laboratorioValidator() {
            return {
                hasError: this.$v.productoForm.laboratorio_id.$error,
                messages: {
                    required: this.requiredErrorMsg
                },
                dirty: this.$v.productoForm.laboratorio_id.$dirty,
                validators: {
                    required: this.$v.productoForm.laboratorio_id.required
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
        guardarActualizarProducto() {
            var that = this;
            this.$v.$touch();
            if (!this.$v.$error) {
                if (this.$store.getters.getProducto != null) {
                    this.productoForm
                        .update()
                        .then(function(response) {
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto modificado correctamente.",
                                "success"
                            );
                        })
                        .catch(function(error) {
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
                            that.showNotificationProgress(
                                "Exito al Procesar",
                                "Producto creado correctamente.",
                                "success"
                            );
                        })
                        .catch(function(error) {
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
