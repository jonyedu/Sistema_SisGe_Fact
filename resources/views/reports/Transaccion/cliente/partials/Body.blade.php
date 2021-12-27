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
        <th>Cedula</th>
   
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo</th>
    </tr>
    @if ($proveedores != null)
    @forelse ($proveedores as $detalle)
    <tr>
        <td style="font-size: 10px;text-align: center;">{{$detalle->NOMBRESCLIENTEPRO}}</td>
        <td class="configListProduct">{{ $detalle->cedula}}</td>
   
        <td class="configListProduct">{{$detalle->direccion }}</td>
        <td class="configListProduct">{{$detalle->telefono }}</td>
        <td class="configListProduct">{{$detalle->correo }}</td>

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
