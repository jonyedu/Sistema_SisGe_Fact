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
            'imagen' => 'fas fa-first-aid'
        ]);
        SgModulo::where('codigo', 2)->update([
            'imagen' => 'fas fa-hand-holding-medical'
        ]);
        SgModulo::where('codigo', 3)->update([
            'imagen' => 'fas fa-project-diagram'
        ]);
        SgModulo::where('codigo', 4)->update([
            'imagen' => 'fas fa-prescription-bottle-alt'
        ]);
        SgModulo::where('codigo', 5)->update([
            'imagen' => 'fas fa-key'
        ]);
        SgModulo::where('codigo', 6)->update([
            'imagen' => 'fas fa-user-nurse'
        ]);
        SgModulo::where('codigo', 7)->update([
            'imagen' => 'fas fa-hospital'
        ]);
        SgModulo::where('codigo', 8)->update([
            'imagen' => 'fas fa-chalkboard-teacher'
        ]);
        SgModulo::where('codigo', 9)->update([
            'imagen' => 'fas fa-chart-pie'
        ]);

    }
}
