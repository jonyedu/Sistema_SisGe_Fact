<style>
        /* Colores
            * #B3B3B3 =  Gris
            * #97EA8B = Verde
            * #F6FD75 = Amarillo
            * #85CAEF = Celeste
            * #FFFFFF = Blanco
            * #CBDDE6 = Celeste bajo
         */

        #header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;

        }

        /* Estilo para configurar el tamaño de todas las tablas */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Estilo para configurar el encabezado, nombre de la institucion, ciudad, etc */
        .configTableCabecera span {
            font-size: 9pt;
            color: #000000;
            font-weight: bold;
            border: hidden;
        }

        /* Estilo para configurar el borde, el fondo, tamña de la letra */
        .configTableCaberaAll th {
            background-color: #97EA8B;
            font-size: 7pt;
            font-weight: bold;
            border: 1px solid black;
        }

        /* Estilo para configurar los bordes de los items  */
        .configBorderItem td {
            border: 1px solid black;
        }

        /* Estilo para configurar el texto a 2 ANTECEDENTES PERSONALES */
        .configTextItem2 td {
            text-align: left;
            font-size: 7pt;
            font-weight: bold;
        }

        .topCabecera {
            margin-top: 58px;
        }
    </style>
  @php
        
        $rutaImg = getImgenEmpresa();
        @endphp
<header id="header">
        <table class="configTableCabecera">
            <tr>
                <th align="left" width="40px" ROWSPAN=4><img  src="data:image/jpeg;base64,'{{ $rutaImg->LOGO }}'" borde="0" width="102px" height="100px" /></th>
                <th align="center"><span> {{ $rutaImg->Empresa_Nombre }}</span></th>
            </tr>
            <tr>
                <th align="center"><span>{{ $rutaImg->Empresa_Direccion }}</span></th>
            </tr>
            <tr>
                <th align="center"><span>{{ $rutaImg->Empresa_Correo_Electronico }}</span></th>
            </tr>
            <tr>
                <th align="center"><span>Reportes de {{ $nombre_reporte }}</span></th>
            </tr>
        </table>
        <hr width="100%">
    </header>
     
            
           
<!-- Cabecera  -->
 
        <!-- <th class="sizeWidthCabecera"><img src="{{ public_path('icons/logo/SisGeFact.jpg') }}" width="100px" height="100px" /></th> -->
       
       
