<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasCredito extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_credito';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_factura', 
        'total', 
        'id_tiempo_pago', 
        'id_cliente', 
        'usu_created', 
        'usu_update', 
        'created_at', 
        'updated_at', 
        'pcip', 
        'status'
    ];
    protected $appends = [
        'ESTADOPRO'
    ];
    public function getESTADOPROattribute()
    {
        if ( $this->status == "1") {
            return "PENDIENTE";
        }
        else {
            return "CANCELADO";
        }

       
    }
     
    public function clienteFact()
    {
        return $this->hasOne('App\Models\Modulos\Persona\Cliente\Cliente', 'cliente_id', 'id_cliente');
    }
    public function tiempoCredito()
    {
        return $this->hasOne('App\Models\Modulos\Parametrizacion\FormaPago\FormaPago', 'id', 'id_tiempo_pago');
    }
    
    public function formapagoFactura()
    {
        return $this->hasOne('App\Models\Modulos\Banco\TipoPago\TipoPago', 'tipo_pago', 'formapago');
    }
     
    public function DetalleVenta()
    {
        return $this->hasMany('App\Models\Modulos\Transaccion\FacturaVenta\VentasCreditoDetalle', 'id_factura', 'id_factura');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Usuario\SegUsuario', 'codigo', 'usu_created');
    }
}
