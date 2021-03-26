<?php

namespace App\Models\Modulos\Inventario\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCosto extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_producto_costo';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'idproducto',
        'factor',
        'costo',
        'costoi',
        'preciou',
        'precio',
        'precioi',
        'utili',
        'rentabilidad',
        'status',
    ];
}
