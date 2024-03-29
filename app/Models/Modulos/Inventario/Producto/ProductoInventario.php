<?php

namespace App\Models\Modulos\Inventario\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoInventario extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_producto_inventario';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';
    protected $primaryKey = 'id';

    //public $timestamps = false;

    protected $fillable = [
        'id',
        'id_factura',
        'id_producto',
        'stock',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];
    public function ProductoInv()
    {
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\Producto', 'id', 'id_producto');
    }
    public function costoInv()
    {
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\ProductoCosto','idproducto', 'id_producto');
    }

}
