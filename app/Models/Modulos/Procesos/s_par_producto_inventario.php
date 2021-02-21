<?php

namespace App\Models\Modulos\Procesos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class s_par_producto_inventario extends Model
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

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_factura',
        'id_producto',
        'stock',
        'status',
    ];
}
