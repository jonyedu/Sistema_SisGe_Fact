<?php

use App\DatosGenerales\Generalidades\IdentificacionesYUsuario;
use App\Models\Modulos\Admision\Paciente;
use Illuminate\Support\Facades\DB;

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

function calculaEdad($idPaciente)
{
    if ($idPaciente > 0) {
        //Vamos a la tabla Paciente, para capturar la fecha de nacimiento, con la fecha de ingreso
        $paciente = Paciente::select('fecha_nacimiento', 'fecha_ingreso')
            ->where('id', $idPaciente)
            ->first();
        if ($paciente != null) {
            //Se transforma la fecha de nacimiento
            $fecha_naci = new DateTime($paciente->fecha_nacimiento);
            $dateFormatNac = $fecha_naci->format("d/m/Y");
            list($diaNac, $mesNac, $anoNac) = explode("/", $dateFormatNac);

            //Se transforma la fecha de registro
            $fecha_ingre = new DateTime($paciente->fecha_ingreso);
            $dateFormatIng = $fecha_ingre->format("d/m/Y");
            list($diaIng, $mesIng, $anoIng) = explode("/", $dateFormatIng);

            //Se obtiene la resta de la fecha de registro vs fecha de nacimiento
            /* $ano_diferencia = $anoIng - $anoNac;
            $mes_diferencia = $mesIng - $mesNac;
            $dia_diferencia = $diaIng - $diaNac; */
            //return $ano_diferencia . " años, " . $mes_diferencia . " meses y " . $dia_diferencia . " días";

            /* $ano_diferencia--;
            $mes_diferencia--;
            $dia_diferencia--;
 */
            //return $ano_diferencia . " años, " . $mes_diferencia . " meses y " . $dia_diferencia . " días";

            $ano = 0;

            //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
            if (($mesNac == $mesIng) && ($diaNac > $diaIng)) {
                $ano = ($anoIng - 1);
            }

            //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
            if ($mesNac > $mesIng) {
                $ano = ($anoIng - 1);
            }

            //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

            $edad = ($ano - $anoNac);
            return $edad;

        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function convertBase64ToBinary($data)
{
    $img  = file_get_contents($data);
    $binary = DB::raw('CONVERT(VARBINARY(MAX), 0x' . bin2hex($img) . ')');
    return $binary;
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

function prueba()
{
    return "hola";
}
