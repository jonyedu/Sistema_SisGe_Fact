<?php

use App\DatosGenerales\Generalidades\IdentificacionesYUsuario;
use App\Models\Modulos\Admision\Paciente;
use Illuminate\Support\Facades\DB;

use App\Models\Modulos\Seguridad\Empresa\Empresa;

date_default_timezone_set("America/Guayaquil");
/* function getNumeroAleatorioUser()
{
    $numero = IdentificacionesYUsuario::select('USID_CODIGO')->where('ID_COD', '17-DIGITOS')->orderBy('FECHA', 'desc')->first();
    $numero_trabajar = 0;
    if (!isset($numero) || $numero == null || $numero == '') {
        $numero_trabajar = 1;
    } else {
        $numero_trabajar = $numero->USID_CODIGO + 1;
    }
    $ceros = "";
    for ($i = strlen($numero_trabajar); $i < 17; $i++) {
        $ceros = "0" . $ceros;
    }

    $numero_nuevo = $ceros . number_format($numero_trabajar, 0, ',', '');

    return $numero_nuevo;
} */

/* function calculaEdad($fechanacimiento)
{
    $fecha_naci = new DateTime($fechanacimiento);
    $dateFormat = $fecha_naci->format("d/m/Y");
    list($dia, $mes, $ano) = explode("/", $dateFormat);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
} */

function getImgenEmpresa()
{
    $logo = Empresa::select(  'Empresa_Nombre', 'Empresa_Direccion','Empresa_Correo_Electronico','Empresa_Telefonos','Empresa_Ubicacion_Logo')->first();
    return $logo;
}
function convertBase64ToBinary($data)
{
    $img  = file_get_contents($data);
    $binary = DB::raw('CONVERT(VARBINARY(MAX), 0x' . bin2hex($img) . ')');
    return $binary;
}

function convertImgToBinary($data)
{
    // Extensión de la imagen
    $type = pathinfo($data, PATHINFO_EXTENSION);

    // Cargando la imagen
    $data = file_get_contents($data);

    // Decodificando la imagen en base64
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}



function insertPathArray()
{
    $pathArray = [];
    //1pan_rosca
    $path = public_path() . '/imgProducto/1pan_rosca.png';
    array_push($pathArray, $path);
    //2dona_blanca
    $path = public_path() . '/imgProducto/2dona_blanca.png';
    array_push($pathArray, $path);
    //3protectores_kotex
    $path = public_path() . '/imgProducto/3protectores_kotex.png';
    array_push($pathArray, $path);
    //4GUANTES
    $path = public_path() . '/imgProducto/4GUANTES.png';
    array_push($pathArray, $path);
    //5detergente
    $path = public_path() . '/imgProducto/5detergente.png';
    array_push($pathArray, $path);
    //6PLATOS
    $path = public_path() . '/imgProducto/6PLATOS.png';
    array_push($pathArray, $path);
    //7pe-rosas-sandalo
    $path = public_path() . '/imgProducto/7pe-rosas-sandalo.png';
    array_push($pathArray, $path);
    //8COLA
    $path = public_path() . '/imgProducto/8COLA.png';
    array_push($pathArray, $path);
    //9VOLT
    $path = public_path() . '/imgProducto/9VOLT.png';
    array_push($pathArray, $path);
    //10BEBIDA
    $path = public_path() . '/imgProducto/10BEBIDA.png';
    array_push($pathArray, $path);

    return $pathArray;
}

function getNumeroAleatorio()
{
    $w_n01 = mt_rand(0, 9);
    $w_n02 = mt_rand(0, 9);
    $w_n03 = mt_rand(0, 9);
    $w_n04 = mt_rand(0, 9);
    $w_n05 = mt_rand(0, 9);
    $w_n06 = mt_rand(0, 9);
    $w_n07 = mt_rand(0, 9);
    $w_n08 = mt_rand(0, 9);
    $w_n09 = mt_rand(0, 9);
    $w_n10 = mt_rand(0, 9);
    $numero_aleatorio = $w_n01 . $w_n02 . $w_n03 . $w_n04 . $w_n05 . $w_n06 . $w_n07 . $w_n08 . $w_n09 . $w_n10;
    return $numero_aleatorio;
}
function getFecha()
{
    $dateTime = new DateTime();
    $fecha = $dateTime->format('Y-m-d');
    return $fecha;
}
function getFechaCoberturaSeguro()
{
    $dateTime = new DateTime();
    $fecha = $dateTime->format('d-m-Y');
    return $fecha;
}
function getTime()
{
    $dateTime = new DateTime();
    $time = $dateTime->format('H:i:s');
    return $time;
}
function getFullTime()
{
    $dateTime = new DateTime();
    $time = $dateTime->format('Y-m-d H:i:s');
    return $time;
}
function convertDatetimeADate($datetime)
{
    $date = strtotime($datetime);
    $date = date("Y-m-d", $date);
    return $date;
}
function addNumberToLeft($number, $length)
{
    return substr(str_repeat(0, $length) . $number, -$length);
}

function getNamePdf($persona, $no_documento)
{
    $persona = $persona;
    $no_documento = $no_documento;
    $fechaImpresion = date("Y-m-d H:i:s");
    $fechaImpresion = str_replace(':', '_', $fechaImpresion);
    $extension = '.pdf';
    $nombreArchivo = $persona . '-' . $no_documento . '-' . $fechaImpresion . $extension;
    return $nombreArchivo;
}
