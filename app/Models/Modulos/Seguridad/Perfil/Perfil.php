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
    protected $table = 'SEG_PERFIL';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';

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
}
