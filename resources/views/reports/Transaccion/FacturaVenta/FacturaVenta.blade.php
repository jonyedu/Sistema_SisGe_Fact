<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{$nombreArchivo}} </title>


</head>

<body>
    <!-- Cabecera  -->
    @include('reports.Transaccion.FacturaVenta.partials.Header')
    <br>
    <!--  Cuerpo -->
    @include('reports.Transaccion.FacturaVenta.partials.Body')
    <br>
    @include('reports.Transaccion.FacturaVenta.partials.Footer')
</body>
