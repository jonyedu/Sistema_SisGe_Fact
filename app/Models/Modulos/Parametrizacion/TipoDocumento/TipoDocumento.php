<?php

namespace App\Models\Modulos\Parametrizacion\TipoDocumento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'config_tipo_documento';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'descripcion',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status'
    ];
}
