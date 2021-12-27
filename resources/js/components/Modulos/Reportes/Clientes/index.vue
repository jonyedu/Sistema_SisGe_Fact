<template>
     <div class="content-wrapper">
        <div class="my-demo-wrapper">
                <bs-appbar shadow>
                    <bs-appbar-title title="Reporte Cliente"></bs-appbar-title>
                </bs-appbar> 
            <bs-card shadow>
                <bs-card-body>
                    <bs-card-content  >
                        <!-- <router-link
                            :to="
                                prefijo +
                                    '/modulos/inventario/grupo/crear_modificar_grupo'
                            "
                        > -->
                        <div class="row">
                             <div class="col-md-6 mb-3">
                         
                               <b> Fecha Inicio:</b>  <input type="date" name="" value="">
                                
                            </div>
                        </div>
                        <div class="row">
                              <div class="col-md-6 mb-3">
                          
                               <b>Fecha Fin: </b>     <input type="date" name="" value="">
                            </div>
                        </div>
                         
                         
                            <bs-tooltip
                                content="Crear nuevos grupo"
                                placement="bottom"
                            >
                                <div class="col-md-4 mb-3">
                                    <bs-menu placement="bottom-right">
                                    <bs-button color="primary" dropdown-toggle>Acciones</bs-button>
                                        <template v-slot:content>
                                        <bs-list-view>
                                            <bs-list-tile  >
                                            <bs-list-tile-title> <bs-button
                                                mode="icon"
                                                icon="folder-open"
                                                icon-size="sm"
                                            ></bs-button> &nbsp; Excel</bs-list-tile-title>
                                            </bs-list-tile> 
                                               <bs-divider></bs-divider>
                                            <bs-list-tile >
                                            <bs-list-tile-title><bs-button
                                                mode="icon"
                                                icon="folder-open"
                                                icon-size="sm"
                                            ></bs-button>&nbsp; PDF</bs-list-tile-title>
                                            </bs-list-tile>
                                             
                                            
                                            
                                        </bs-list-view>
                                        </template>
                                    </bs-menu>
                                </div>
                            </bs-tooltip>
                        </router-link>
                    </bs-card-content>
                </bs-card-body>
            </bs-card>
            
        </div>
     
    </div>
</template>