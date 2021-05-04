<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasCheque extends Model
{
    use HasFactory;
     /**
     * @var string
     */
    protected $table = 's_par_fact_cheque';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'cheque_id', 
        'id_facturav', 
        'fecha_emision', 
        'cantidad', 
        'nombre', 
        'banco', 
        'numero_cuenta', 
        'beneficiario', 
        'usu_created',
        'usu_update', 
        'created_at', 
        'updated_at', 
        'pcip', 
        'status'
    ];
}
