<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasDetalle extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_ventas_detalle';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    protected $fillable = [
        'id',
        'id_facturav',
        'id_producto',
        'iva',
        'factor',
        'valor',
        'cantidad',
        'total',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];
    public function producto()
    {
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\Producto', 'id', 'id_producto');
    }
}
