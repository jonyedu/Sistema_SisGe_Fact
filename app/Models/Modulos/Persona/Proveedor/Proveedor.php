<?php

namespace App\Models\Modulos\Persona\Proveedor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'par_laboratorio';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'representante',
        'direcion',
        'telefono',
        'estado'
    ];
}
