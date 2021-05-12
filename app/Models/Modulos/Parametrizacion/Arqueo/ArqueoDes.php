<?php

namespace App\Models\Modulos\Parametrizacion\Arqueo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArqueoDes extends Model
{
    use HasFactory;
     /**
     * @var string
     */
    protected $table = 'config_arque_des';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 'descripcion','valor','usu_created', 'usu_update', 'created_at', 'updated_at', 'pcip', 'status'
    ];
}
