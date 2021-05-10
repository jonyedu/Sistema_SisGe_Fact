<style>
    body {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* da el tamaño a toda la tabla y quita los espacios entre las celdas */
    .tableStyleAll {
        width: 100%;
        /* border-collapse: collapse; */
    }

    /* Da el tamaño width a las cabecera */
    .sizeWidthCabecera {
        width: 50%;
    }

    /* Da el tamaño de la letra a la 2da parte cabecera */
    .sizeFont2da {
        font-size: 10px;
    }

    /* Stilo para dar el alto de las celdas 2da parte en la cabecera */
    .alturaCabecera2da {
        height: 20px;
    }

    /* Mover a la izquierda el texto */
    .textLeft {
        text-align: left;
    }

    .border th,
    td {
        border: 1px solid black;
    }

    /* Stilo para dar el alto de las celdas en la cabecera */
    .alturaCabecera {
        height: 30px;
    }

    /* Para poner el texto normal */
    .fontNormal {
        font-weight: normal;
    }
</style>



<!-- Cabecera  -->
<table class="tableStyleAll ">
    <tr>
        <!-- <th class="sizeWidthCabecera"><img src="{{ public_path('icons/logo/SisGeFact.jpg') }}" width="100px" height="100px" /></th> -->
        @php
        $rutaImg = $factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Ubicacion_Logo:'':'':'':'':'':'';
        @endphp
        @if($rutaImg !=null)
        <th class="sizeWidthCabecera"><img src="{{ $factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Ubicacion_Logo:'':'':'':'':'':''}}}}" alt="No hay logo" width="300px" height="100px"></th>
        @else
        <th class="sizeWidthCabecera"><img src="{{ public_path('icons/logo/no_tiene_logo.png') }}" width="300px" height="30px" /></th>
        @endif
        <td style="border: 1px solid black;align-items: left;" rowspan="2">
            <table style="width: 100%;">
                <tr>
                    <th class="textLeft">R.U.C.: <span style="margin-left:100px;">{{$factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Ruc:"":"":"":"":"":""}}</span></th>
                </tr>
                <tr>
                    <th style="font-size: 17px;height:40px;font-weight: normal;" class="textLeft">{{$factura}}</th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">No. <span style="margin-left:123px;" class="fontNormal">0000000{{$factura_compra!= null?$factura_compra->id:""}}</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">NÚMERO DE AUTORIZACIÓN <br><br><span class="sizeFont2da fontNormal">{{$factura_compra!= null?$factura_compra->no_autorizacion:""}}</span></th>
                    </th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">FECHA Y HORA DE <br> AUTORIZACIÓN <span style="margin-left:46px;" class="fontNormal">{{$factura_compra!= null?$factura_compra->updated_at:""}}</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">AMBIENTE: <span style="margin-left:73px;" class="fontNormal">Producción</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">EMISIÓN: <span style="margin-left:85px;" class="fontNormal">Normal</span></th>
                </tr>
                <tr>
                    <th rowspan="7" class="textLeft">CLAVE DE ACCESO</th>
                </tr>

            </table>
        </td>
    </tr>
    <tr>
        <th style="border: 1px solid black;" class="sizeWidthCabecera">
            <table style="width: 100%;">
                <tr>
                    <th class="alturaCabecera textLeft"><span class="fontNormal" style="margin-left:100px;">{{$factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Nombre:"":"":"":"":"":""}}</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">Dirección <br>Matríz: <span class="fontNormal" style="margin-left:76px;">{{$factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Direccion:"":"":"":"":"":""}}</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">Dirección <br>Sucursal: <span class="fontNormal" style="margin-left:60px;">{{$factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->Sucursal_Direccion:"":"":"":"":""}}</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">Contribuyente especial Nro <span class="fontNormal" style="margin-left:115px;">{{$factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Contribuyente_Especial:"":"":"":"":"":""}}</span></th>
                </tr>
                <tr>
                    <th class="alturaCabecera textLeft">OBLIGADO A LLEVAR CONTABILIDAD: <span class="fontNormal" style="margin-left:40px;">{{$factura_compra!=null?$factura_compra->usuario!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne!=null?$factura_compra->usuario->opcionPorAplicacionPerfilOne->moduloOne->sucursalOne->empresaOne->Empresa_Obligado_Contabilidad?'SI':'NO':"":"":"":"":"":""}}</span></th>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
        <th colspan="2" style="border: 1px solid black;">
            <table style="width: 100%;">
                <tr>
                    <th class="sizeFont2da alturaCabecera2da textLeft">Razón Social / Nombres y Apellidos: <span class="fontNormal" style="margin-left:75px;">{{$factura_compra!=null?$factura_compra->cabeceraCredito->clienteFact!=null?$factura_compra->cabeceraCredito->clienteFact->NOMBRESCLIENTEPRO!=""?$factura_compra->cabeceraCredito->clienteFact->NOMBRESCLIENTEPRO:$factura_compra->cabeceraCredito->clienteFact->NOMBRESCLIENTEPRO:"":""}}</span></th>
                </tr>
                <tr>
                    <th class="sizeFont2da alturaCabecera2da textLeft">RUC / CI:<span class="fontNormal" style="margin-left:25px;">{{$factura_compra!=null?$factura_compra->cabeceraCredito->clienteFact!=null?$factura_compra->cabeceraCredito->clienteFact->NOMBRESCLIENTEPRO!=""?$factura_compra->cabeceraCredito->clienteFact->cedula:$factura_compra->cabeceraCredito->clienteFact->cedula:"":""}}</span></th>
                    <th class="sizeFont2da alturaCabecera2da textLeft">Fecha Emisión: <span class="fontNormal" style="margin-left:5px;">{{$factura_compra!=null?$factura_compra->updated_at:""}} </span></th>
                    <th class="sizeFont2da alturaCabecera2da textLeft">Guía de Remisión:</th>
                </tr>
            </table>
        </th>
    </tr>

</table>
