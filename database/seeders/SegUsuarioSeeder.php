<?php

namespace Database\Seeders;

use App\Models\Modulos\Seguridad\Usuario\SegUsuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SegUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SegUsuario::create([
            'empresa' => 1,
            'sucursal' => 1,
            'nombre' => 'Jonathan Eduardo',
            'apellido' => 'Mora Candelario',
            'usuario' => 'jonyedu19',
            'password' => Hash::make('jony,.123'),
            'email' =>  'jonathan_1308@hotmail.com',
            'perfil' => 2,
            'profesion' => 1,
            'abreviatura' => ".",
            'usr_ingreso' => 1,
            'fec_ingreso' => date("Y-m-d H:i:s"),
            'usr_modificacion' => 1,
            'fec_modificacion' => date("Y-m-d H:i:s"),
            'pc_name' => "192.168.1.196",
            'status' => 1,
            'PermitirAnular' => 1,
            'tipo_usuario' => 1,
        ]);
    }
}
