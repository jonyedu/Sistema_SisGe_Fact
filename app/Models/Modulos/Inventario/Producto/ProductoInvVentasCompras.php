<?php

namespace App\Models\Modulos\Inventario\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoInvVentasCompras extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_producto_inv_ventas_compras';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_compra',
        'id_venta',
        'id_producto',
        'cantidad',
    ];
}
