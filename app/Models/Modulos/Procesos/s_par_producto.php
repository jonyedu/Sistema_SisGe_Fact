<?php

namespace App\Models\Modulos\Procesos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class s_par_producto extends Model
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

    public $timestamps = false;

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
    ];
}
