<?php

namespace App\Models\Modulos\Seguridad\Modulo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SgModulo extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'SEG_MODULO';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';
    protected $primaryKey = 'codigo';

    //public $timestamps = false;

    protected $fillable = [
        'codigo',
        'empresa',
        'sucursal',
        'descripcion',
        'imagen',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];

    public function subModulo()
    {
        return $this->hasMany('App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion', 'modulo', 'codigo');
    }
    public function sucursalOne()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Sucursal\Sucursal', 'Sucursal_Id', 'sucursal');
    }
}
