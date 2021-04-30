<?php

namespace Database\Seeders;

use App\Models\Modulos\Inventario\Producto\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path() . '/imgProducto/1pan_rosca.jpg';

        // Extensión de la imagen
        $type = pathinfo($path, PATHINFO_EXTENSION);

        // Cargando la imagen
        $data = file_get_contents($path);

        // Decodificando la imagen en base64
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        Producto::truncate();
        $productos = [
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "PAN DE ROSCAS",
                'descripcion' => "PAN DE ROSCAS",
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "DONAS BLANCAS CON CHOCOLATE",
                'descripcion' => "DONAS BLANCAS CON CHOCOLATE",
                'pvc' => 0.2500,
                'iva' => 0,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "KOTEX PROTECTORES DIARIOS X 15",
                'descripcion' => "KOTEX PROTECTORES DIARIOS X 15",
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "GUANTES PARA LAVAR",
                'descripcion' => "GUANTES PARA LAVAR",
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "DETERGENTE AXION LAVAPLATOS LIMON 235G",
                'descripcion' => "DETERGENTE AXION LAVAPLATOS LIMON 235G",
                'pvc' => 0.8500,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "PLATOS DE VIDRIO",
                'descripcion' => "PLATOS DE VIDRIO",
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "JABON JHONSSON ROSAS Y SANDALO",
                'descripcion' => "JABON JHONSSON ROSAS Y SANDALO",
                'pvc' => 0.6700,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "COCA COLA SABOR ORIGINAL 3L",
                'descripcion' => "COCA COLA SABOR ORIGINAL 3L",
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "VOLT BEBIDA ENERGIZANTE ARANDANOS 400ML",
                'descripcion' => "VOLT BEBIDA ENERGIZANTE ARANDANOS 400ML",
                'pvc' => 0.4200,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "BEBIDA HIDRATANTE SPORADE BEBIDAS TROPICALES 475ML",
                'descripcion' => "BEBIDA HIDRATANTE SPORADE BEBIDAS TROPICALES 475ML",
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64,
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
        ];

        Producto::insert($productos);
    }
}
