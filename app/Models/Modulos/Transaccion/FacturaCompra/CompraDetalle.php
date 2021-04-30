<?php

namespace App\Models\Modulos\Transaccion\FacturaCompra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_compra_detalle';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    //public $timestamps = false;

    protected $fillable = [
        'id',
        'id_facturac',
        'id_prod',
        'costo',
        'costimp',
        'cantidad',
        'total',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status'
    ];
    public function productoInventario()
    {
        return $this->hasMany('App\Models\Modulos\Inventario\Producto\ProductoInventario', 'id_factura', 'id_facturac');
    }
    public function producto()
    {
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\Producto', 'id', 'id_prod');
    }
    public function productoCosto()
    {
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\ProductoCosto', 'id', 'id_prod');
    }

}
