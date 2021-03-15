<?php

namespace App\Models\Modulos\Administracion\Producto;

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

    public function laboratorio(){
        return $this->hasOne('App\Models\Modulos\Administracion\Laboratorio\Laboratorio', 'id', 'laboratorio_id');
    }
    public function grupo(){
        return $this->hasOne('App\Models\Modulos\Administracion\Grupo\Grupo', 'Id', 'grupo_id');
    }
}
