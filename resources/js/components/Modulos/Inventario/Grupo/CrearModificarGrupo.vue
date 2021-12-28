<template>
  <div class="content-wrapper">
    <div class="my-demo-wrapper">
      <div class="row">
        <div class="col-lg-12 offset-lg-12">
          <bs-card shadow>
            <bs-card-body>
              <bs-card-content class="text-right">
                <router-link
                  :to="$store.state.url_prefix + '/modulos/inventario/grupo/mostrar_grupo'"
                >
                  <bs-tooltip content="Volver hacia atras" placement="bottom">
                    <bs-button mode="icon" icon="list" icon-size="sm">
                    </bs-button>
                  </bs-tooltip>
                </router-link>

                <bs-tooltip content="Guardar perfi" placement="bottom">
                  <bs-button
                    mode="icon"
                    icon="save"
                    icon-size="sm"
                    color="success"
                    @click="guardarActualizar()"
                  >
                  </bs-button>
                </bs-tooltip>
              </bs-card-content>
            </bs-card-body>
          </bs-card>
          <bs-card shadow>
            <bs-card-header class="bg-indigo text-white"
              >Mantenimiento de grupo</bs-card-header
            >
            <bs-card-body>
              <bs-card-content>
                <form ref="myform" novalidate>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <bs-text-field
                        style="margin: auto"
                        prepend-icon-outer="user"
                        floating-label
                        outlined
                        v-model="grupoForm.codigo"
                        :external-validator="codigoValidator"
                      >
                        <label>Codigo</label>
                      </bs-text-field>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <bs-text-field
                        style="margin: auto"
                        prepend-icon-outer="user"
                        floating-label
                        outlined
                        v-model="grupoForm.descripcion"
                        :external-validator="descripcionValidator"
                      >
                        <label>Descripción</label>
                      </bs-text-field>
                    </div>
                  </div>
                </form>
              </bs-card-content>
            </bs-card-body>
          </bs-card>
        </div>
      </div>
    </div>
    <bs-mask-loader :show="showLoader"></bs-mask-loader>
  </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import { BsModel } from "vue-mdbootstrap";

const grupoValidator = {
  codigo: { required },
  descripcion: { required },
};
export default {
  mixins: [validationMixin],
  data: function () {
    return {
      //variable que controla el progreso
      showLoader: false,
      //Objeto donde tendrá todas las variables del formulario
      grupoForm: new BsModel(
        {
          //Aqui es donde se declará las variables para los txt, cmb, etc
          schema: {
            grupo_id: 0,
            codigo: "",
            descripcion: "",
          },
          //Variables para realizar las peticiones al servidor, save, update, fetch, delete
          proxy: {
            save: {
              url:
                this.$store.state.url_prefix +
                "/modulos/inventario/grupo/guardar_modificar_grupo",
              method: "post",
            },
            update: {
              url:
                this.$store.state.url_prefix +
                "/modulos/inventario/grupo/guardar_modificar_grupo",
              method: "post",
            },
          },
        },
        null,
        "uid"
      ),
      //Variables para la validaciones
      requiredErrorMsg: "Este campo es obligatorio.",
    };
  },
  validations: {
    grupoForm: grupoValidator,
  },

  mounted: function () {
    if (this.$store.getters.getGrupo != null) {
      var grupo = this.$store.getters.getGrupo;
      this.grupoForm.grupo_id = grupo.id;
      this.grupoForm.codigo = grupo.codigo;
      this.grupoForm.descripcion = grupo.descripcion;
    }
  },
  beforeDestroy: function () {
    this.$store.state.grupo = null;
  },
  computed: {
    //Metodo para validar el campo nombre
    codigoValidator() {
      return {
        hasError: this.$v.grupoForm.codigo.$error,
        messages: {
          required: this.requiredErrorMsg,
          minLength: this.minLengthErrorMsg,
        },
        dirty: this.$v.grupoForm.codigo.$dirty,
        validators: {
          required: this.$v.grupoForm.codigo.required,
        },
      };
    },
    descripcionValidator() {
      return {
        hasError: this.$v.grupoForm.descripcion.$error,
        messages: {
          required: this.requiredErrorMsg,
          minLength: this.minLengthErrorMsg,
        },
        dirty: this.$v.grupoForm.descripcion.$dirty,
        validators: {
          required: this.$v.grupoForm.descripcion.required,
        },
      };
    },
  },

  methods: {
    guardarActualizar() {
      var that = this;
      this.$v.$touch();
      if (!this.$v.$error) {
        this.showLoader = true;
        if (this.$store.getters.getGrupo != null) {
          this.grupoForm
            .update()
            .then(function (response) {
              that.showLoader = false;
              that.showNotificationProgress(
                "Exito al Procesar",
                "Grupo modificado correctamente.",
                "success"
              );
              that.lmpCampos();
            })
            .catch(function (error) {
              that.showLoader = false;
              that.showNotificationProgress(
                "Error en guardarActualizar",
                "Por favor comuníquese con el administrador. " + error,
                "error"
              );
            });
        } else {
          this.grupoForm
            .save()
            .then(function (response) {
              that.showLoader = false;
              that.showNotificationProgress(
                "Exito al Procesar",
                "Grupo creado correctamente.",
                "success"
              );
              that.lmpCampos();
            })
            .catch(function (error) {
              that.showLoader = false;
              that.showNotificationProgress(
                "Error en guardarActualizar",
                "Por favor comuníquese con el administrador. " + error,
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
        timeout: 5000,
      };
      this.$notification[icon](options, title);
    },
    lmpCampos() {
      this.$refs.myform.reset();
      this.grupoForm.reset();
      this.$v.$reset();
    },
  },
};
</script>

