<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasCabecera extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_ventas_cabecera';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';
    protected  $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_cliente',
        'secuencia',
        'no_autorizacion',
        'fecha',
        'viva',
        'iva',
        'sub_total_12',
        'sub_total_0',
        'descuento',
        'sub_total',
        'iva_12',
        'total',
        'tipopago',
        'formapago',
        'caj',
        'cambio',
        'recibido',
        'observacion',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];

    public $appends = [
        'DATE'
    ];

    public function getDATEattribute()
    {
        return convertDatetimeADate($this->fecha);
    }

    public function cliente()
    {
        return $this->hasOne('App\Models\Modulos\Persona\Cliente\Cliente', 'cliente_id', 'id_cliente');
    }
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
        return $this->hasMany('App\Models\Modulos\Transaccion\FacturaVenta\VentasDetalle', 'id_facturav', 'id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Usuario\SegUsuario', 'codigo', 'usu_created');
    }
}
