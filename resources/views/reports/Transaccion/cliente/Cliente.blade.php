<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{$nombre_reporte}} </title>


</head>

<body>
    <!-- Cabecera  -->
    @include('reports.Transaccion.cliente.partials.Header')
    <br>
    @include('reports.Transaccion.cliente.partials.Body')
    <br>
    
    @include('reports.Transaccion.cliente.partials.Footer')
     
</body>
