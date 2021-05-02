<?php

namespace App\Models\Modulos\Inventario\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_producto';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'nombrecorto',
        'descripcion',
        'posologia',
        'contraindicacion',
        'grupo_id',
        'laboratorio_id',
        'stock_maximo',
        'stock_minimo',
        'pvc',
        'generico',
        'refrigeracion',
        'iva',
        'imagen',
        'usu_created_update',
        'created_at',
        'updated_at',
        'pcip',
        'status'

    ];

    public function proveedor(){
        return $this->hasOne('App\Models\Modulos\Persona\Proveedor\Proveedor', 'id', 'laboratorio_id');
    }
    public function grupo(){
        return $this->hasOne('App\Models\Modulos\Inventario\Grupo\Grupo', 'id', 'grupo_id');
    }
    public function productoCosto(){
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\ProductoCosto','idproducto', 'id');
    }
    public function productoInventario(){
        return $this->hasOne('App\Models\Modulos\Inventario\Producto\ProductoInventario','id_producto', 'id');
    }
    public function productoInventarioMany(){
        return $this->hasMany('App\Models\Modulos\Inventario\Producto\ProductoInventario','id_producto', 'id');
    }
}
