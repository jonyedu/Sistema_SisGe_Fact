<?php

namespace App\Models\Modulos\Transaccion\Cotizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionCabecera extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_cotizacion_cabecera';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_cliente', 
        'fecha', 
        'viva', 
        'subtotaliva1', 
        'iva', 
        'subtotaliva2', 
        'totalapagar', 
        'tipopago', 
        'formapago', 
        'caj', 
        'cambio', 
        'recibido', 
        'status', 
        'usu_created', 
        'usu_update', 
        'created_at',
        'updated_at', 'pcip'
    ];
}
