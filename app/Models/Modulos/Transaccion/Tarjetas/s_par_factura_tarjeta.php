<?php

namespace App\Models\Modulos\Transaccion\Tarjetas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class s_par_factura_tarjeta extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'config_tipopago';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'tipo_pago', 
        'descripcion',  
    ];
}
