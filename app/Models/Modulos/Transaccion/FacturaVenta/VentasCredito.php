<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasCredito extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_credito';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 'id_factura', 'total', 'id_tiempo_pago', 'id_cliente', 'usu_created', 'usu_update', 'created_at', 'updated_at', 'pcip', 'status'
    ];
}
