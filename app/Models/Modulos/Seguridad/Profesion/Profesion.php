<?php

namespace App\Models\Modulos\Seguridad\Profesion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'tbProfesionUsuario';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'descripcion',
        'abreviatura',
        'status',
    ];
}
