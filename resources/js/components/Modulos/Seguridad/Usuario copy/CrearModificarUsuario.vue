<template>
    <div class="row m-3">
        <!-- <div class="col-lg-12 col-md-12 col-sm-12">
            <center>
                <h5 class="mt-4">Modulo</h5>
            </center>
        </div> -->

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="col-lg-12 col-md-12 col-sm-12 p-5">
                    <form>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre"
                                        ><span class="text-danger">(*)</span>
                                        Apellidos</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.apellido === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Apellido"
                                        v-model="form.apellido"
                                    />
                                    <small
                                        v-if="errores.apellido !== ''"
                                        class="text-danger"
                                        >{{ errores.apellido[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Nombres</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.nombre === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Nombre"
                                        v-model="form.nombre"
                                    />
                                    <small
                                        v-if="errores.nombre !== ''"
                                        class="text-danger"
                                        >{{ errores.nombre[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="tipo"
                                        ><span class="text-danger">(*)</span>
                                        Profesión</label
                                    >
                                    <v-select
                                        v-model="selectedProfesion"
                                        :value="form.id_profesion"
                                        :options="profesiones"
                                        placeholder="Profesión"
                                        label="display"
                                        @input="setSelectedProfesion"
                                        :class="
                                            errores.id_profesion === ''
                                                ? ''
                                                : 'style-chooser'
                                        "
                                    >
                                        <template slot="no-options"
                                            >No se ha encontrado ningun
                                            dato</template
                                        >
                                    </v-select>
                                    <small
                                        v-if="errores.id_profesion !== ''"
                                        class="text-danger"
                                        >{{ errores.id_profesion[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Usuario</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.usuario === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Usuario"
                                        v-model="form.usuario"
                                    />
                                    <small
                                        v-if="errores.usuario !== ''"
                                        class="text-danger"
                                        >{{ errores.usuario[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Contraseña</label
                                    >
                                    <input
                                        type="password"
                                        :class="
                                            errores.password === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Password"
                                        v-model="form.password"
                                    />
                                    <small
                                        v-if="errores.password !== ''"
                                        class="text-danger"
                                        >{{ errores.password[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Confirmar</label
                                    >
                                    <input
                                        type="password"
                                        :class="
                                            errores.password_confirmation === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Confirmar"
                                        v-model="form.password_confirmation"
                                    />
                                    <small
                                        v-if="
                                            errores.password_confirmation !== ''
                                        "
                                        class="text-danger"
                                        >{{
                                            errores.password_confirmation[0]
                                        }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="tipo"
                                        ><span class="text-danger">(*)</span>
                                        Perfil</label
                                    >
                                    <v-select
                                        v-model="selectedPerfil"
                                        :value="form.id_perfil"
                                        :options="perfiles"
                                        label="display"
                                        placeholder="Perfil"
                                        @input="setSelectedPerfil"
                                        :class="
                                            errores.id_perfil === ''
                                                ? ''
                                                : 'style-chooser'
                                        "
                                    >
                                        <template slot="no-options"
                                            >No se ha encontrado ningun
                                            dato</template
                                        >
                                    </v-select>
                                    <small
                                        v-if="errores.id_perfil !== ''"
                                        class="text-danger"
                                        >{{ errores.id_perfil[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Iniciales</label
                                    >
                                    <input
                                        type="text"
                                        :class="
                                            errores.iniciales === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Iniciales"
                                        v-model="form.iniciales"
                                    />
                                    <small
                                        v-if="errores.iniciales !== ''"
                                        class="text-danger"
                                        >{{ errores.iniciales[0] }}</small
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="abreviatura"
                                        ><span class="text-danger">(*) </span
                                        >Email</label
                                    >
                                    <input
                                        type="email"
                                        :class="
                                            errores.email === ''
                                                ? 'form-control'
                                                : 'form-control is-invalid'
                                        "
                                        placeholder="Email"
                                        v-model="form.email"
                                    />
                                    <small
                                        v-if="errores.email !== ''"
                                        class="text-danger"
                                        >{{ errores.email[0] }}</small
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-lg-12 col-md-12 col-sm-12 mt-4 pt-1"
                            >
                                <div class="form-inline">
                                    <button
                                        type="button"
                                        class="btn btn-success btn-block"
                                        @click="guardarActualizarUsuario()"
                                    >
                                        {{
                                            usuarioMod === null
                                                ? "Guardar"
                                                : "Modificar"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        usuarioMod: {
            type: Object
        }
    },
    data: function() {
        return {
            selectedProfesion: "",
            profesiones: [],

            selectedPerfil: "",
            perfiles: [],

            errores: {
                nombre: "",
                apellido: "",
                usuario: "",
                password: "",
                password_confirmation: "",
                id_perfil: "",
                id_profesion: "",
                iniciales: "",
                email: ""
            },
            form: {
                codigo: "",
                nombre: "",
                apellido: "",
                usuario: "",
                password: "",
                password_confirmation: "",
                id_perfil: "",
                id_profesion: "",
                iniciales: "",
                email: ""
            }
        };
    },
    mounted: function() {
        this.setSelectedProfesion();
        this.setSelectedPerfil();
        if (this.$props.usuarioMod !== null) {
            var usuario = this.$props.usuarioMod;
            this.form.codigo = usuario.codigo;
            this.form.apellido = usuario.apellido;
            this.form.nombre = usuario.nombre;
            this.selectedProfesion = usuario.profesion;
            this.form.id_profesion = usuario.id_profesion;
            this.form.usuario = usuario.usuario;
            //this.form.password = usuario.password;
            this.selectedPerfil = usuario.perfil;
            this.form.id_perfil = usuario.id_perfil;
            this.form.iniciales = usuario.iniciales;
            this.form.email = usuario.email;
        }
        /* let nombreModulo = this.$nombresModulo.datos_generales;
        let nombreFormulario = this.$nombresFormulario.datos_generales
            .generalidades.organizacion_bspi.crear_organizacion_bspi
            .nombre_formulario;
        this.$funcionesGlobales.registrarLogForm(
            nombreModulo,
            nombreFormulario,
            "Ingreso"
        ); */
    },
    beforeDestroy: function() {
        /* let nombreModulo = this.$nombresModulo.datos_generales;
        let nombreFormulario = this.$nombresFormulario.datos_generales
            .generalidades.organizacion_bspi.crear_organizacion_bspi
            .nombre_formulario;
        this.$funcionesGlobales.registrarLogForm(
            nombreModulo,
            nombreFormulario,
            "Salida"
        ); */
    },
    methods: {
        limpiarForm() {
            this.errores = {
                nombre: "",
                apellido: "",
                usuario: "",
                password: "",
                password_confirmation: "",
                id_perfil: "",
                id_profesion: "",
                iniciales: ""
            };
            this.form = {
                codigo: "",
                nombre: "",
                apellido: "",
                usuario: "",
                password: "",
                password_confirmation: "",
                id_perfil: "",
                id_profesion: "",
                iniciales: ""
            };
        },
        setSelectedProfesion(value) {
            let that = this;
            //var loader = that.$loading.show();
            let url = "/modulos/seguridad/profesion/cargar_profesion_combo_box";
            if (value != null) {
                this.form.id_profesion = value.id_profesion;
            }
            axios
                .get(url)
                .then(function(response) {
                    let profesiones = [];
                    response.data.profesiones.forEach(profesion => {
                        let objeto = {};
                        objeto.display = that.$funcionesGlobales.toCapitalFirstAllWords(
                            profesion.descripcion
                        );
                        objeto.id_profesion = profesion.codigo;
                        profesiones.push(objeto);
                    });
                    that.profesiones = profesiones;
                    //loader.hide();
                })
                .catch(error => {
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar setSelectedProfesion",
                        message:
                            "Por favor comuníquese con el administrador. " +
                            error,
                        clickable: true,
                        time: 0,
                        icon: "/iconsflashMessage/error.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                    //loader.hide();
                });
        },
        setSelectedPerfil(value) {
            let that = this;
            //var loader = that.$loading.show();
            let url = "/modulos/seguridad/perfil/cargar_perfil_combo_box";
            if (value != null) {
                this.form.id_perfil = value.id_perfil;
            }
            axios
                .get(url)
                .then(function(response) {
                    let perfiles = [];
                    response.data.perfiles.forEach(perfil => {
                        let objeto = {};
                        objeto.display = that.$funcionesGlobales.toCapitalFirstAllWords(
                            perfil.descripcion
                        );
                        objeto.id_perfil = perfil.codigo;
                        perfiles.push(objeto);
                    });
                    that.perfiles = perfiles;
                    //loader.hide();
                })
                .catch(error => {
                    that.flashMessage.show({
                        status: "error",
                        title: "Error al procesar setSelectedPerfil",
                        message:
                            "Por favor comuníquese con el administrador. " +
                            error,
                        clickable: true,
                        time: 0,
                        icon: "/iconsflashMessage/error.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                    //loader.hide();
                });
        },
        guardarActualizarUsuario: function() {
            let that = this;
            let url = "";
            let mensaje = "";
            if (this.$props.usuarioMod !== null) {
                url = "/modulos/seguridad/usuario/modificar_usuario";
                mensaje = "Datos actualizados correctamente.";
            } else {
                url = "/modulos/seguridad/usuario/guardar_usuario";
                mensaje = "Datos guardados correctamente.";
            }
            var loader = that.$loading.show();
            axios
                .post(url, this.form)
                .then(function(response) {
                    //Llamar metodo de parent para que actualice el grid.
                    loader.hide();
                    that.$emit("recargarUsuario");
                    that.$emit("cerrarModalCrearUsuario");
                    that.flashMessage.show({
                        status: "success",
                        title: "Proceso realizado exitosamente",
                        message: mensaje,
                        clickable: true,
                        time: 5000,
                        icon: "/iconsflashMessage/success.svg",
                        customStyle: {
                            flashMessageStyle: {
                                background: "linear-gradient(#e66465, #9198e5)"
                            }
                        }
                    });
                    that.limpiarForm();
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errores = {
                            nombre: "",
                            apellido: "",
                            usuario: "",
                            password: "",
                            password_confirmation: "",
                            id_perfil: "",
                            id_profesion: "",
                            iniciales: "",
                            email: "",
                        };
                        if (error.response.data.errors.apellido != null) {
                            that.errores.apellido =
                                error.response.data.errors.apellido;
                        }
                        if (error.response.data.errors.nombre != null) {
                            that.errores.nombre =
                                error.response.data.errors.nombre;
                        }
                        if (error.response.data.errors.id_profesion != null) {
                            that.errores.id_profesion =
                                error.response.data.errors.id_profesion;
                        }
                        if (error.response.data.errors.usuario != null) {
                            that.errores.usuario =
                                error.response.data.errors.usuario;
                        }
                        if (error.response.data.errors.password != null) {
                            that.errores.password =
                                error.response.data.errors.password;
                        }
                        if (
                            error.response.data.errors.password_confirmation !=
                            null
                        ) {
                            that.errores.password_confirmation =
                                error.response.data.errors.password_confirmation;
                        }
                        if (error.response.data.errors.id_perfil != null) {
                            that.errores.id_perfil =
                                error.response.data.errors.id_perfil;
                        }
                        if (error.response.data.errors.iniciales != null) {
                            that.errores.iniciales =
                                error.response.data.errors.iniciales;
                        }
                        if (error.response.data.errors.email != null) {
                            that.errores.email =
                                error.response.data.errors.email;
                        }
                        that.flashMessage.show({
                            status: "warning",
                            title: "Se requiere de su atención",
                            message: "Existen campos vacios.",
                            clickable: true,
                            time: 5000,
                            icon: "/iconsflashMessage/warning.svg",
                            customStyle: {
                                flashMessageStyle: {
                                    background:
                                        "linear-gradient(#e66465, #9198e5)"
                                }
                            }
                        });
                    } else {
                        that.flashMessage.show({
                            status: "error",
                            title: "Error al procesar guardarActualizarUsuario",
                            message:
                                "Por favor comuníquese con el administrador. " +
                                error,
                            clickable: true,
                            time: 0,
                            icon: "/iconsflashMessage/error.svg",
                            customStyle: {
                                flashMessageStyle: {
                                    background:
                                        "linear-gradient(#e66465, #9198e5)"
                                }
                            }
                        });
                    }
                    loader.hide();
                });
        }
    }
};
</script>
<style>
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    border-color: #dc3545;
    padding-right: 2.25rem;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>
