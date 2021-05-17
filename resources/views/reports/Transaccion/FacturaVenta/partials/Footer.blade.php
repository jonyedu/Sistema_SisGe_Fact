<style>
    body {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* da el tamaño a toda la tabla y quita los espacios entre las celdas */
    .piePaginaStyle {
        /* width: 100%; */
        border-collapse: collapse;
    }

    /* Da el tamaño de la letra a la 2da parte cabecera */
    .sizeFontPiePagina {
        font-size: 11px;
    }

    .sizeFontPiePaginaValor {
        font-size: 9px;
        font-weight: normal;
    }
</style>



<!-- Pie de Pagina  -->
<table class="tableStyleAll ">
    <tr>
        <!-- <th>
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th class="sizeFontPiePagina">Información Adicional</th>
                </tr>
                <tr>
                    <td class="sizeFontPiePaginaValor">Dirección: <span class="fontNormal" style="margin-left:76px;">{{$factura_venta->clienteFact->direccion}}</span></td>
                </tr>
            </table>
        </th> -->
        <th>
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th class="sizeFontPiePagina">Información Adicional</th>
                </tr>
                <tr>
                    <td  class="sizeFontPiePaginaValor">Dirección: <span class="fontNormal" style="margin-left:76px;">{{$factura_venta->clienteFact->direccion}}</span></td>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;color:white" class="sizeFontPiePaginaValor">null</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;color:white" class="sizeFontPiePaginaValor">null</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;color:white" class="sizeFontPiePaginaValor">null</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;color:white" class="sizeFontPiePaginaValor">null</th>
                </tr>
            </table>
        </th>
        <th style="width: 38%;">
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor" style="align-items: left;">SUBTOTAL 12%</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_venta->sub_total_12}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">SUBTOTAL 0%</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_venta->sub_total_0}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">DESCUENTO</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_venta->descuento}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">SUBTOTAL</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_venta->sub_total}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">IVA 12%</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_venta->iva_12}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">TOTAL</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_venta->total}}</th>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
        <th style="width: 60%;">
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th class="sizeFontPiePagina" colspan="2">Forma de Pago</th>
                </tr>
                <tr>
                    <th class="sizeFontPiePagina">Forma de Pago</th>
                    <th class="sizeFontPiePagina">Total</th>
                </tr>
                <tr>
                    <td class="sizeFontPiePaginaValor">{{$factura_venta->formapagoFactura!=null?$factura_venta->formapagoFactura->descripcion:"" }} </td>
                    <th class="sizeFontPiePaginaValor">{{$factura_venta->total}}</th>
                </tr>
            </table>
        </th>
    </tr>

</table>
