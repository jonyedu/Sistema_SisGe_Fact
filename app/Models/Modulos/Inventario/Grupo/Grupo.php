<?php

namespace App\Models\Modulos\Inventario\Grupo;

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
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Id',
        'Codigo',
        'nombrecorto',
        'Descripcion',
        'Estado',
        'usu_created_update',
        'created_at',
        'updated_at',
        'pcip',
    ];
}
