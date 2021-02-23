<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulos\Seguridad\Modulo\SgModulo;

class SgModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SgModulo::where('codigo', 1)->update([
            'imagen' => 'fas fa-landmark'
        ]);
        SgModulo::where('codigo', 2)->update([
            'imagen' => 'fas fa-tools'
        ]);
        SgModulo::where('codigo', 3)->update([
            'imagen' => 'fas fa-hand-holding-usd'
        ]);
        SgModulo::where('codigo', 4)->update([
            'imagen' => 'fas fa-print'
        ]);
        SgModulo::where('codigo', 5)->update([
            'imagen' => 'fas fa-gift'
        ]);
        SgModulo::where('codigo', 6)->update([
            'imagen' => 'fas fa-chart-pie'
        ]);
        SgModulo::where('codigo', 7)->update([
            'imagen' => 'fas fa-key'
        ]);

    }
}
