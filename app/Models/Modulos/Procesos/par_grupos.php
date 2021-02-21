<?php

namespace App\Models\Modulos\Procesos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class par_grupos extends Model
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
        'Descripcion', 
        'Estado'
    ];

}
