<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasCreditoDetalle extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_credito_detalle';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_factura', 
        'fecha', 
        'interes', 
        'total', 
        'valor', 
        'usu_created', 
        'usu_update', 
        'created_at', 
        'updated_at', 
        'pcip', 'status'
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
    public function cabeceraCredito()
    {
        return $this->hasOne('App\Models\Modulos\Transaccion\FacturaVenta\VentasCredito', 'id_factura', 'id_factura');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Usuario\SegUsuario', 'codigo', 'usu_created');
    }
}
