<?php

namespace App\Models\Modulos\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class s_par_fact_compra_detalle extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_compra_detalle';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_facturac',
        'id_prod',
        'costo',
        'costimp',
        'cantidad',
        'total',
        'fecha_caducidad',
        'pagado',
    ];
}
