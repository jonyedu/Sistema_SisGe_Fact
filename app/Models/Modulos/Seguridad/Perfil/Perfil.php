<?php

namespace App\Models\Modulos\Seguridad\Perfil;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'seg_perfil';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';
    protected $primaryKey = 'codigo';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'descripcion',
        'abreviatura',
        'usuario_ingreso',
        'fecha_ingreso',
        'usuario_modificacion',
        'fecha_modificacion',
        'pcname',
        'status',
    ];
    public function proveedor()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario', 'id', 'id');
    }
}
