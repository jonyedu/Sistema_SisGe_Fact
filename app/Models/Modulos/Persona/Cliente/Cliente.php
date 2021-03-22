<?php

namespace App\Models\Modulos\Persona\Cliente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
      /**
     * @var string
     */
    protected $table = 'par_cliente';
    /**
     * @var string
     */
   // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'direccion',
        'correo'
    ];
}
