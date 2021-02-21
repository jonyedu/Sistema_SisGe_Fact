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
    protected $table = 'SEG_OPCION_APLICACION';
    /**
     * @var string
     */
    public $timestamps = false;

    protected $connection = 'mysql_comercial';

    protected $fillable = [
        'empresa',
        'sucursal',
        'modulo',
        'codigo',
        'descripcion',
        'imagen',
        'tipo',
        'ejecutable',
        'usuario_ingreso',
        'fecha_ingreso',
        'usuario_modificacion',
        'fecha_modificacion',
        'pcname',
        'status',
        'route',
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
