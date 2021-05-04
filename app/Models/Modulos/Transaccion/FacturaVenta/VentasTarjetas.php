<?php

namespace App\Models\Modulos\Transaccion\FacturaVenta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasTarjetas extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 's_par_factura_tarjeta';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    public $timestamps = false;

    protected $fillable = [
        'tarjetas', 
        'factura', 
        'orden', 
        'numero', 
        'numero_tarjeta', 
        'caduca', 
        'cliente', 
        'campo1', 
        'campo2', 
        'campo3', 
        'registro', 
        'usuario_ingreso', 
        'fecha_ingreso', 
        'usuario_modificacion', 
        'fecha_modificacion',
         'name_pc', 
         'status'
    ];

}
