<?php

namespace App\Models\Modulos\Seguridad\SubModulo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SgOpcionAplicacion extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'seg_opcion_aplicacion';
    protected $primaryKey = 'codigo';
    /**
     * @var string
     */
    //public $timestamps = false;

    protected $connection = 'mysql_comercial';

    protected $fillable = [
        'codigo',
        'modulo',
        'descripcion',
        'imagen',
        'route',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];

    public function modulo()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Modulo\SgModulo', 'codigo', 'modulo');
    }

    public function perfilPorUsuario()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario', 'opcion_aplicacion', 'codigo');
    }
}
