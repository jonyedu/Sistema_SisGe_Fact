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
                    <td class="sizeFontPiePaginaValor">{{$factura_compra->formapagoFactura!=null?$factura_compra->formapagoFactura->descripcion:""   }} </td>
                    <th class="sizeFontPiePaginaValor">{{$factura_compra->totalapagar}}</th>
                </tr>
            </table>
        </th>
        </th>
        <th style="width: 38%;">
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor" style="align-items: left;">SUBTOTAL 0%</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_compra->subtotaliva2}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">SUBTOTAL 12%</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_compra->subtotaliva1}}</th>
                </tr>
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor">TOTAL</th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor">${{$factura_compra->totalapagar}}</th>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
        <th>
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th class="sizeFontPiePagina">Información Adicional</th>
                </tr>
                <tr>
                    <td class="sizeFontPiePaginaValor">Dirección: <span class="fontNormal" style="margin-left:76px;" >{{$factura_compra->clienteFact->direccion}}</span></td>
                </tr>
            </table>
        </th>
    </tr>

</table>
