<?php

namespace App\Models\Modulos\Transaccion\Arqueo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arqueo extends Model
{
    use HasFactory;
     /**
     * @var string
     */
    protected $table = 's_par_fact_arqueo';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';
    protected  $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_arqueo', 
        'valor', 
        'cantidad', 
        'total', 
        'usu_created', 
        'usu_update', 
        'created_at', 
        'updated_at', 
        'pcip', 
        'status'

    ];
}
