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
    @forelse ($factura_compra->compraDetalle as $detalle)
    <tr>
        <td style="font-size: 10px;text-align: center;">{{$detalle->producto->codigo}}</td>
        <td class="configListProduct">{{$detalle->cantidad}}</td>
        <td style="font-size: 10px;text-align: left;">{{$detalle->producto->nombre}}</td>
        <td class="configListProduct">${{$detalle->costo}}</td>
        <td class="configListProduct">${{$detalle->total}}</td>
    </tr>
    @empty
    <tr>
        <td style="color: white;">0</td>
        <td style="color: white;">0</td>
        <td style="color: white;">0</td>
        <td style="color: white;">0</td>
        <td style="color: white;">0</td>
    </tr>
    @endforelse
    @endif

</table>
