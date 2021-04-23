<?php

namespace App\Models\Modulos\Transaccion\FacturaCompra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCabecera extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_fact_compra_cabecera';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_documento',
        'secuencia',
        'id_proveedor',
        'fecha_compra',
        'totalapagar',
        'id_pago',
        'id_plazo',
        'p_inicial',
        'observacion',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status'
    ];

    public function proveedor()
    {
        return $this->hasOne('App\Models\Modulos\Persona\Proveedor\Proveedor', 'id', 'id_proveedor');
    }
    public function tipoPago()
    {
        return $this->hasOne('App\Models\Modulos\Banco\TipoPago\TipoPago', 'tipo_pago', 'id_pago');
    }
    public function compraDetalle()
    {
        return $this->hasMany('App\Models\Modulos\Transaccion\FacturaCompra\CompraDetalle', 'id_facturac', 'id');
    }
}
