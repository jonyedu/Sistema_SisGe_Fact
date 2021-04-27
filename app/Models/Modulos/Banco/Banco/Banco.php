<?php

namespace App\Models\Modulos\Banco\Banco;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'config_banco';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 'descripcion', 'usu_created', 'usu_update', 'created_at', 'updated_at', 'pcip', 'status'
    ];
}
