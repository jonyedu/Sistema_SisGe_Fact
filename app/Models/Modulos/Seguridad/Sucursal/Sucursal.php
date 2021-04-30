<?php

namespace App\Models\Modulos\Seguridad\Sucursal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'config_sucursales';
    protected $connection = 'mysql_comercial';

    //public $timestamps = false;

    protected $fillable = [
        'Sucursal_Id',
        'Empresa_Id',
        'Sucursal_Nombre',
        'Sucursal_Direccion',
        'Sucursal_Telefonos',
        'Sucursal_Administrador',
        'Sucursal_EMail',
        'Sucursal_Fax',
        'Sucursal_Actividad',
        'Sucursal_Actividad_Inicio',
        'Sucursal_Matriz',
        'Sucursal_Provincia',
        'Sucursal_Canton',
        'Sucursal_Parroquia',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];
    public function empresaOne()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Empresa\Empresa', 'Empresa_Id', 'Empresa_Id');
    }
}
