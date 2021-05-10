<style>
    body {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* da el tamaño a toda la tabla y quita los espacios entre las celdas */
    .tableBodyAll {
        width: 100%;
        border-collapse: collapse;
    }

    /* configura el tamaño donde lista los productos */
    .configListProduct {
        font-size: 10px;
        text-align: right;
    }
</style>



<!-- Cabecera  -->
<table class="tableBodyAll border">
    <tr>
        <th>Código Principal</th>
        <th>Cantidad</th>
        <th>Descripción</th>
        <th>Precio Unitario</th>
        <th>Precio Total</th>
    </tr>
    @if ($factura_compra != null)
    
    <tr>
        <td style="font-size: 10px;text-align: center;">{{$factura_compra->id_factura}}</td>
        <td class="configListProduct">{{ 0 }}</td>
        <td style="font-size: 10px;text-align: left;">PAGO DE LA CUOTA REFERENTE A LA FECHA {{$factura_compra->fecha }}</td>
        <td class="configListProduct">${{$factura_compra->valor}}</td>
        <td class="configListProduct">${{$factura_compra->total}}</td>
    </tr>
   
   
    @endif

</table>
