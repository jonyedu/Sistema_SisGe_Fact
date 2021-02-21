<template>
    <nav class="mt-2">
        <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
        >
            <li
                class="nav-item has-treeview"
                v-for="(gestion, index) in menus"
                :key="index"
            >
                <a class="nav-link">
                    <i :class="gestion.imagen"></i>
                    <p>
                        {{
                            $funcionesGlobales.toCapitalFirstAllWords(
                                gestion.descripcion
                            )
                        }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul
                    class="nav nav-treeview"
                    v-for="(subMenu, index) in gestion.sub_modulo"
                    :key="index"
                >
                    <li class="nav-item" @click="changeMenu()">
                        <router-link
                            :to="prefijo + subMenu.route"
                            class="nav-link ml-3"
                            ><i :class="subMenu.imagen"> </i>
                            <p>
                                {{
                                    $funcionesGlobales.toCapitalFirstAllWords(
                                        subMenu.descripcion
                                    )
                                }}
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>
<script>
import { prefix } from "../../variables";
export default {
    props: {
        user: {
            type: Object
        }
    },
    data: function() {
        return {
            prefijo: "",
            menus: [],
        };
    },
    mounted: function() {
        this.cargarMenu();
        this.prefijo = prefix;
    },
    methods: {
        changeMenu(){
            $('[data-widget="pushmenu"]').PushMenu('collapse')
            $(document).on('shown.lte.pushmenu')
            //$('ul').Treeview('accordion')
        },
        cargarMenu() {
            let that = this;
            let url = "/modulos/seguridad/perfil_por_usuario/cargar_menu/" + this.$props.user.perfil;
            axios
                .get(url)
                .then(function(response) {
                    that.menus = response.data.menus;
                })
                .catch(error => {
                    that.$swal({
                        icon: "error",
                        title: "Existe un error",
                        text: error
                    });
                });
        },
    }
};
</script>
