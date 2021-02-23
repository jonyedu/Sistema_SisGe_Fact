<?php

namespace App\Models\Modulos\Administracion\Grupo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'par_grupos';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'Id',
        'Codigo',
        'nombrecorto',
        'Descripcion',
        'Estado'
    ];
}
