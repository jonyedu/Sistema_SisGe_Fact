<?php

namespace App\Models\Modulos\Seguridad\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'config_empresa';
    protected $connection = 'mysql_comercial';
    protected $primaryKey = 'Empresa_Id';

    //public $timestamps = false;

    protected $fillable = [
        'Empresa_Id',
        'Empresa_Nombre',
        'Empresa_Ciudad',
        'Empresa_Codigo_Postal',
        'Empresa_Correo_Electronico',
        'Empresa_Fax',
        'Empresa_Contribuyente_Especial',
        'Empresa_Representante',
        'Empresa_Notas',
        'Empresa_Ruc',
        'Empresa_Telefonos',
        'Empresa_Ubicacion_Logo',
        'Empresa_Ruta_Base',
        'Empresa_Direccion',
        'Empresa_Tipo',
        'Empresa_Dsn_Bases',
        'Empresa_Pais',
        'Empresa_Moneda',
        'Empresa_Contador',
        'Empresa_Contador_Ruc',
        'Empresa_Actividad',
        'Empresa_Razon_Social',
        'Empresa_Obligado_Contabilidad',
        'Empresa_Representante_Id',
        'Empresa_Representante_Id_Tipo',
        'Empresa_Inicio_Actividades',
        'Empresa_Constitucion',
        'Empresa_Inscripcion',
        'Empresa_Actualizacion',
        'Empresa_Parroquia',
        'Empresa_Provincia',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];

    /* protected $hidden = [
        'Empresa_Ubicacion_Logo',
    ];

    protected $appends = [
        'LOGO'
    ];

    public function getLOGOattribute()
    {
        return base64_encode($this->Empresa_Ubicacion_Logo);
    } */
}
