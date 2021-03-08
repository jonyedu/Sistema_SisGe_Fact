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
    protected $table = 'seg_profesion';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'descripcion',
        'abreviatura',
        'usu_created_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];
}
