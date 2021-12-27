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

<br>
<br><br>
<br>

<!-- Cabecera  -->
<table class="configTableCaberaAll configBorderItem topCabecera">
    <tr>
        <th>Nombres</th>
        <th>Ruc</th>
   
        <th>Direccion</th>
        <th>Razón Social</th>      
        <th>Correo</th>
        <th>Tipo de Pago</th>
        <th>Fecha de Compra</th>
        <th>Total de Factura</th>



    </tr>
    @if ($factura != null)
    @forelse ($factura as $detalle)
    <tr>
        <td style="font-size: 10px;text-align: center;">{{$detalle->proveedor->FULLNAME}}</td>
        <td class="configListProduct">{{ $detalle->proveedor->ruc}}</td>
        <td class="configListProduct">{{ $detalle->proveedor->direccion}}</td>
        <td class="configListProduct">{{ $detalle->proveedor->razon_social}}</td>
        <td class="configListProduct">{{$detalle->proveedor->correo }}</td>
 
        <td class="configListProduct">{{ $detalle->tipo_pago}}</td>
        <td class="configListProduct">{{$detalle->fecha_compra}}</td>
        <td class="configListProduct">{{$detalle->totalapagar}}</td>


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
