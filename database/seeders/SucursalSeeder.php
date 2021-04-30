<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Sucursal\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::create([
            'Empresa_Id' => 1,
            'Sucursal_Nombre' => 'AgroAnimals',
            'Sucursal_Direccion' => 'Galapagos',
            'Sucursal_Telefonos' => '094949832',
            'Sucursal_Administrador' => '',
            'Sucursal_EMail' => '',
            'Sucursal_Fax'=> '',
            'Sucursal_Actividad'=> '',
            'Sucursal_Actividad_Inicio'=> date("Y-m-d H:i:s"),
            'Sucursal_Matriz'=> 0,
            'Sucursal_Provincia'=> '',
            'Sucursal_Canton'=> '',
            'Sucursal_Parroquia'=> '',
            'usu_created' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'usu_update' => 1,
            'updated_at' => date("Y-m-d H:i:s"),
            'pcip' => '192.168.1.196',
            'status' => 1,
        ]);
    }
}
