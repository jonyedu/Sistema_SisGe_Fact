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
    protected $primaryKey = 'cliente_id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'direccion',
        'correo',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status'


    ];
}
