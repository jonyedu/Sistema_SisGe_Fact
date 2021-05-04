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
        $pathArray = insertPathArray();
        $base64Array = [];

        foreach ($pathArray as $path) {
            $base64 = convertImgToBinary($path);
            array_push($base64Array, $base64);
        }

        Producto::truncate();
        $productos = [
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "PAN DE ROSCAS",
                'descripcion' => "PAN DE ROSCAS",
                'nombrecorto' => "PAN DE ROSCAS",
                'stock_minimo' => 10,
                'grupo_id' => 1,
                'laboratorio_id' => 1,
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64Array[0],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "DONAS BLANCAS CON CHOCOLATE",
                'descripcion' => "DONAS BLANCAS CON CHOCOLATE",
                'nombrecorto' => "DONAS BLANCAS CON CHOCOLATE",
                'stock_minimo' => 25,
                'grupo_id' => 1,
                'laboratorio_id' => 1,
                'pvc' => 0.2500,
                'iva' => 0,
                'imagen' => $base64Array[1],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "KOTEX PROTECTORES DIARIOS X 15",
                'descripcion' => "KOTEX PROTECTORES DIARIOS X 15",
                'nombrecorto' => "KOTEX PROTECTORES DIARIOS X 15",
                'stock_minimo' => 5,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64Array[2],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "GUANTES PARA LAVAR",
                'descripcion' => "GUANTES PARA LAVAR",
                'nombrecorto' => "GUANTES PARA LAVAR",
                'stock_minimo' => 25,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.8600,
                'iva' => 0,
                'imagen' => $base64Array[3],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "DETERGENTE AXION LAVAPLATOS LIMON 235G",
                'descripcion' => "DETERGENTE AXION LAVAPLATOS LIMON 235G",
                'nombrecorto' => "AXION LAVAPLATOS LIMON 235G",
                'stock_minimo' => 5,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.8500,
                'iva' => 0,
                'imagen' => $base64Array[4],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "PLATOS DE VIDRIO",
                'descripcion' => "PLATOS DE VIDRIO",
                'nombrecorto' => "PLATOS DE VIDRIO",
                'stock_minimo' => 10,
                'grupo_id' => 1,
                'laboratorio_id' => 1,
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64Array[5],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "JABON JHONSSON ROSAS Y SANDALO",
                'descripcion' => "JABON JHONSSON ROSAS Y SANDALO",
                'nombrecorto' => "JABON JHONSSON ROSAS Y SANDALO",
                'stock_minimo' => 15,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.6700,
                'iva' => 1,
                'imagen' => $base64Array[6],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "COCA COLA SABOR ORIGINAL 3L",
                'descripcion' => "COCA COLA SABOR ORIGINAL 3L",
                'nombrecorto' => "COCA COLA SABOR ORIGINAL 3L",
                'stock_minimo' => 30,
                'grupo_id' => 3,
                'laboratorio_id' => 1,
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64Array[7],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "VOLT BEBIDA ENERGIZANTE ARANDANOS 400ML",
                'descripcion' => "VOLT BEBIDA ENERGIZANTE ARANDANOS 400ML",
                'nombrecorto' => "VOLT BEBIDA ENERGIZANTE 400ML",
                'stock_minimo' => 5,
                'grupo_id' => 3,
                'laboratorio_id' => 1,
                'pvc' => 0.4200,
                'iva' => 0,
                'imagen' => $base64Array[8],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "BEBIDA HIDRATANTE SPORADE BEBIDAS TROPICALES 475ML",
                'descripcion' => "BEBIDA HIDRATANTE SPORADE BEBIDAS TROPICALES 475ML",
                'nombrecorto' => "SPORADE BEBIDAS 475ML",
                'stock_minimo' => 10,
                'grupo_id' => 3,
                'laboratorio_id' => 1,
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64Array[9],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
        ];

        Producto::insert($productos);
    }
    public function run1()
    {
        $pathArray = insertPathArray();
        $base64Array = [];

        foreach ($pathArray as $path) {
            // Extensión de la imagen
            $type = pathinfo($path, PATHINFO_EXTENSION);

            // Cargando la imagen
            $data = file_get_contents($path);

            // Decodificando la imagen en base64
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            array_push($base64Array, $base64);
        }




        Producto::truncate();
        $productos = [
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "PAN DE ROSCAS",
                'descripcion' => "PAN DE ROSCAS",
                'nombrecorto' => "PAN DE ROSCAS",
                'stock_minimo' => 10,
                'grupo_id' => 1,
                'laboratorio_id' => 1,
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64Array[0],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "DONAS BLANCAS CON CHOCOLATE",
                'descripcion' => "DONAS BLANCAS CON CHOCOLATE",
                'nombrecorto' => "DONAS BLANCAS CON CHOCOLATE",
                'stock_minimo' => 25,
                'grupo_id' => 1,
                'laboratorio_id' => 1,
                'pvc' => 0.2500,
                'iva' => 0,
                'imagen' => $base64Array[1],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "KOTEX PROTECTORES DIARIOS X 15",
                'descripcion' => "KOTEX PROTECTORES DIARIOS X 15",
                'nombrecorto' => "KOTEX PROTECTORES DIARIOS X 15",
                'stock_minimo' => 5,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64Array[2],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "GUANTES PARA LAVAR",
                'descripcion' => "GUANTES PARA LAVAR",
                'nombrecorto' => "GUANTES PARA LAVAR",
                'stock_minimo' => 25,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.8600,
                'iva' => 0,
                'imagen' => $base64Array[3],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "DETERGENTE AXION LAVAPLATOS LIMON 235G",
                'descripcion' => "DETERGENTE AXION LAVAPLATOS LIMON 235G",
                'nombrecorto' => "AXION LAVAPLATOS LIMON 235G",
                'stock_minimo' => 5,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.8500,
                'iva' => 0,
                'imagen' => $base64Array[4],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "PLATOS DE VIDRIO",
                'descripcion' => "PLATOS DE VIDRIO",
                'nombrecorto' => "PLATOS DE VIDRIO",
                'stock_minimo' => 10,
                'grupo_id' => 1,
                'laboratorio_id' => 1,
                'pvc' => 0.8600,
                'iva' => 1,
                'imagen' => $base64Array[5],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "JABON JHONSSON ROSAS Y SANDALO",
                'descripcion' => "JABON JHONSSON ROSAS Y SANDALO",
                'nombrecorto' => "JABON JHONSSON ROSAS Y SANDALO",
                'stock_minimo' => 15,
                'grupo_id' => 2,
                'laboratorio_id' => 1,
                'pvc' => 0.6700,
                'iva' => 1,
                'imagen' => $base64Array[6],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "COCA COLA SABOR ORIGINAL 3L",
                'descripcion' => "COCA COLA SABOR ORIGINAL 3L",
                'nombrecorto' => "COCA COLA SABOR ORIGINAL 3L",
                'stock_minimo' => 30,
                'grupo_id' => 3,
                'laboratorio_id' => 1,
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64Array[7],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "VOLT BEBIDA ENERGIZANTE ARANDANOS 400ML",
                'descripcion' => "VOLT BEBIDA ENERGIZANTE ARANDANOS 400ML",
                'nombrecorto' => "VOLT BEBIDA ENERGIZANTE 400ML",
                'stock_minimo' => 5,
                'grupo_id' => 3,
                'laboratorio_id' => 1,
                'pvc' => 0.4200,
                'iva' => 0,
                'imagen' => $base64Array[8],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
            [
                'codigo' => rand(1111111111111, 9999999999999),
                'nombre' => "BEBIDA HIDRATANTE SPORADE BEBIDAS TROPICALES 475ML",
                'descripcion' => "BEBIDA HIDRATANTE SPORADE BEBIDAS TROPICALES 475ML",
                'nombrecorto' => "SPORADE BEBIDAS 475ML",
                'stock_minimo' => 10,
                'grupo_id' => 3,
                'laboratorio_id' => 1,
                'pvc' => 0.3000,
                'iva' => 1,
                'imagen' => $base64Array[9],
                'usu_created_update' => 1,
                'pcip' => '192.168.1.196',
            ],
        ];

        Producto::insert($productos);
    }
}
