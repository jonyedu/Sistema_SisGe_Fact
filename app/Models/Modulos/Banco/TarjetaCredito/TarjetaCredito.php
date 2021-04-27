<?php

namespace App\Models\Modulos\Banco\TarjetaCredito;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarjetaCredito extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'config_tarjetascredito';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'TarCodigo',
        'TarNombre',
        'TarPorcentajeDescuento',
        'TarPorcentajeRetencion',
        'TarLimitePiso',
        'TarRutaBoletin',
        'TarCodigoEstablecimiento',
        'TarCodigoCuenta',
        'TarCtaAuxiliar',
        'TarCodDepartamento'
    ];
}
