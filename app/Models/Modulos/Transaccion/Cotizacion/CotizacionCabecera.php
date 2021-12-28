<?php

namespace App\Models\Modulos\Transaccion\Cotizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionCabecera extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_cotizacion_cabecera';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';
    protected  $primaryKey = 'id';
    //public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_cliente', 
        'fecha', 
        'viva', 
        'subtotaliva1', 
        'iva', 
        'subtotaliva2', 
        'totalapagar', 
        'tipopago', 
        'formapago', 
        'caj', 
        'cambio', 
        'recibido', 
        'status', 
        'usu_created', 
        'usu_update', 
        'created_at',
        'updated_at', 'pcip'
    ];
    public function clienteFact()
    {
        return $this->hasOne('App\Models\Modulos\Persona\Cliente\Cliente', 'cliente_id', 'id_cliente');
    }
    public function formapagoFactura()
    {
        return $this->hasOne('App\Models\Modulos\Banco\TipoPago\TipoPago', 'tipo_pago', 'formapago');
    }
    public function tiempoCredito()
    {
        return $this->hasOne('App\Models\Modulos\Parametrizacion\FormaPago\FormaPago', 'id', 'id_tiempo_pago');
    }

    public function DetalleVenta()
    {
        return $this->hasMany('App\Models\Modulos\Transaccion\Cotizacion\CotizacionDetalle', 'id_facturac', 'id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Usuario\SegUsuario', 'codigo', 'usu_created');
    }
}
