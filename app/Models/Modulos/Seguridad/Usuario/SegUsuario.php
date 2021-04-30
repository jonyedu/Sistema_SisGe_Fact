<?php

namespace App\Models\Modulos\Seguridad\Usuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class SegUsuario extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    /**
     * @var string
     */
    protected $table = 'SEG_USUARIO';
    protected $primaryKey = 'codigo';
    /**
     * @var string
     */
    protected $connection = 'mysql_comercial';

    public $timestamps = false;

    protected $fillable = [
        'empresa',
        'sucursal',
        'codigo',
        'nombre',
        'apellido',
        'usuario',
        'password',
        'email',
        'perfil',
        'profesion',
        'abreviatura',
        'usr_ingreso',
        'fec_ingreso',
        'usr_modificacion',
        'fec_modificacion',
        'pc_name',
        'status',
        'PermitirAnular',
        'tipo_usuario'
    ];

    public function perfil()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Perfil\Perfil', 'codigo', 'perfil');
    }
    public function opcionPorAplicacionPerfil()
    {
        return $this->hasMany('App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario', 'perfil', 'perfil');
    }
    public function opcionPorAplicacionPerfilOne()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\PerfilPorUsuario\PerfilPorUsuario', 'perfil', 'perfil');
    }

    public function profesion()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Profesion\Profesion', 'codigo', 'profesion');
    }

    public function seguridadMedico()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Usuario\SeguridadMedico', 'id', 'codigo');
    }

    protected $appends = [
        'FULLNAME'
    ];

    public function getFULLNAMEattribute()
    {
        return $this->nombre . " " . $this->apellido;
    }
}
