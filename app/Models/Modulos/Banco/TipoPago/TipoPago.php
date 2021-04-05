<?php

namespace App\Models\Modulos\Banco\TipoPago;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'config_tipopago';
    /**
     * @var string
     */

    public $timestamps = false;

    protected $fillable = [
        'tipo_pago',
        'descripcion',
    ];
}
