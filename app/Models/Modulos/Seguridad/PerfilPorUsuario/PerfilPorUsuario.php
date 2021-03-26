<?php

namespace App\Models\Modulos\Seguridad\PerfilPorUsuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilPorUsuario extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'SEG_OPCION_APLICACION_POR_PERFIL';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';

    protected $primaryKey = 'id';

    //public $timestamps = false;

    protected $fillable = [
        'id',
        'empresa',
        'sucursal',
        'perfil',
        'modulo',
        'opcion_aplicacion',
        'usu_created',
        'created_at',
        'usu_update',
        'updated_at',
        'pcip',
        'status',
    ];
    public function modulo()
    {
        return $this->hasMany('App\Models\Modulos\Seguridad\Modulo\SgModulo', 'codigo', 'modulo');
    }
    public function subModulo()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion', 'codigo', 'opcion_aplicacion');
    }
    public function perfil()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Perfil\Perfil', 'codigo', 'perfil');
    }
}
