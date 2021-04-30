<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Empresa\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::updateOrCreate(
            [
                'Empresa_Nombre' => 'AgroAnimals',
            ],
            [
                'Empresa_Nombre' => 'AgroAnimals',
                'Empresa_Ciudad' => '',
                'Empresa_Codigo_Postal' => 593,
                'Empresa_Correo_Electronico' => 'admin@agroanimals.com.ec',
                'Empresa_Fax' => '',
                'Empresa_Contribuyente_Especial' => 425,
                'Empresa_Representante' => 'Jonathan Mora',
                'Empresa_Notas' => '',
                'Empresa_Ruc' => '0954776779001',
                'Empresa_Telefonos' => '0994949832',
                'Empresa_Ubicacion_Logo' => '',
                'Empresa_Ruta_Base' => '',
                'Empresa_Direccion' => 'Isla Galápago',
                'Empresa_Tipo' => 1,
                'Empresa_Dsn_Bases' => '',
                'Empresa_Pais' => '',
                'Empresa_Moneda' => '',
                'Empresa_Contador' => '',
                'Empresa_Contador_Ruc' => '',
                'Empresa_Actividad' => '',
                'Empresa_Razon_Social' => 'AgroAnimals',
                'Empresa_Obligado_Contabilidad' => false,
                'Empresa_Representante_Id' => '',
                'Empresa_Representante_Id_Tipo' => '',
                'Empresa_Inicio_Actividades' => date("Y-m-d H:i:s"),
                'Empresa_Constitucion' => date("Y-m-d H:i:s"),
                'Empresa_Inscripcion' => date("Y-m-d H:i:s"),
                'Empresa_Actualizacion' => date("Y-m-d H:i:s"),
                'Empresa_Parroquia' => '',
                'Empresa_Provincia' => '',
                'usu_created' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'usu_update' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'pcip' => '192.168.1.196',
                'status' => 1,
            ]
        );
    }
}
