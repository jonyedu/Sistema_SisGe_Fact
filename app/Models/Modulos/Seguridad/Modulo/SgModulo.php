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

    public $timestamps = false;

    protected $fillable = [
        'empresa',
        'sucursal',
        'codigo',
        'descripcion',
        'abreviatura',
        'usuario_ingreso',
        'fecha_ingreso',
        'usuario_modificacion',
        'fecha_modificacion',
        'pcname',
        'status',
        'imagen',


    ];
    public function subModulo()
    {
        return $this->hasMany('App\Models\Modulos\Seguridad\SubModulo\SgOpcionAplicacion', 'modulo', 'codigo');
    }
}
