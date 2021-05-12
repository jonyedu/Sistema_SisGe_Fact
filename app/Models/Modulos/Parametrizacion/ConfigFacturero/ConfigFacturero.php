<?php

namespace App\Models\Modulos\Parametrizacion\ConfigFacturero;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigFacturero extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'config_facturero';
    protected $primaryKey = 'id';
    /**
     * @var string
     */
    // protected $connection = 'admin_db_sql';

    //public $timestamps = false;

    protected $fillable = [
        'id',
        'no_establecimiento',
        'no_facturero',
        'secuencia',
        'no_autorizacion',
        'usu_created',
        'usu_update',
        'created_at',
        'updated_at',
        'pcip',
        'status',
    ];

    protected $appends = [
        'NOFACTURA'
    ];
    public function getNOFACTURAattribute()
    {
        //convierto en array la $this->secuencia
        $array = str_split($this->secuencia);
        //obtnego el numero de la longitud de numero
        $sizeSecuencia = sizeOf($array);
        //reto para saber cuantos 0 debo agregar
        $faltante0 = 9 - $sizeSecuencia;
        //varibales para almacenar los 0 faltantes
        $resultado = '';
        //le aumento + 1 a la secuencia
        $this->secuencia = $this->secuencia + 1;
        //realizo el ciclo de los 0
        for ($i=0; $i < $faltante0 ; $i++) {
            $resultado = $resultado.'0';
        }
        //concateno el resultado, con la secuencia
        $this->secuencia = $resultado . $this->secuencia;
        //doy formato al 0
        return $this->no_establecimiento . '-' . $this->no_facturero . '-' . $this->secuencia;
    }
}
