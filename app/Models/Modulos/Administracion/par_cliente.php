<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class par_cliente extends Model
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
