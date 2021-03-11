<?php

namespace App\Models\Modulos\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class s_par_fact_ventas_cabecera extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_ventas_cabecera';
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
        'updated_at', 
        'pcip'
    ];
}
