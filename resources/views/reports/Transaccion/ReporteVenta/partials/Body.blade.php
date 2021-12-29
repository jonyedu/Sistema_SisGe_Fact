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
    <th>N° Factura</th>
    <th>Secuencia</th>
   

        <th>Cliente</th>
        <th>Ruc/Cedula</th>
         <th>Correo</th>
        <th>Sub Total</th>      
        <th>Total</th>
        <th>Tipo de Pago</th>
        <th>Fecha de Venta</th>
       



    </tr>
    @if ($factura != null)
    @forelse ($factura as $detalle)
    <tr>
    <td class="configListProduct">{{ $detalle->id}}</td>
    <td class="configListProduct">{{ $detalle->secuencia}}</td>
 

        <td style="font-size: 10px;text-align: center;">{{$detalle->clienteFact->NOMBRESCLIENTEPRO}}</td>
        <td class="configListProduct">{{$detalle->clienteFact->cedula}}</td>
        <td class="configListProduct">{{$detalle->clienteFact->correo}}</td>

        <td class="configListProduct">{{ $detalle->sub_total}}</td>
        <td class="configListProduct">{{ $detalle->total}}</td>
        <td class="configListProduct">{{$detalle->formapagoFactura->descripcion }}</td>
        <td class="configListProduct">{{ $detalle->fecha}}</td>

  


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
