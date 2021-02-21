<?php

namespace App\Models\Modulos\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class s_par_fact_compra_cabecera extends Model
{
    use HasFactory;
      /**
     * @var string
     */
    protected $table = 's_par_fact_compra_cabecera';
    /**
     * @var string
     */
   // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_documento', 
        'secuencia', 
        'id_proveedor', 
        'fecha_compra', 
        'totalapagar',
         'id_pago', 
         'id_plazo', 
         'p_inicial' 
    ];
}
