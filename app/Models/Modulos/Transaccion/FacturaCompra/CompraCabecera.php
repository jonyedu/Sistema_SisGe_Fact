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

    //public $timestamps = false;

    protected $fillable = [
        'id',
        'id_documento',
        'secuencia',
        'no_autorizacion',
        'id_proveedor',
        'fecha_compra',
        'sub_total_0',
        'sub_total_12',
        'totalapagar',
        'id_pago',
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
    public function usuario()
    {
        return $this->hasOne('App\Models\Modulos\Seguridad\Usuario\SegUsuario', 'codigo', 'usu_update');
    }
}
