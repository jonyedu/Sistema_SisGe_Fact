<?php

namespace App\Models\Modulos\Transaccion\FacturaCompra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCreditos extends Model
{
    use HasFactory;
      /**
     * @var string
     */
    protected $table = 's_par_fact_compra_creditos';
    /**
     * @var string
     */
   // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_factura',
        'plazo',
        'fecha_pago',
        'valor',
        'estado'
    ];
}
