<?php

namespace Database\Seeders;

use App\Models\Modulos\Banco\TipoPago\TipoPago;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPago::truncate();
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Efectivo',
            ],
            [
                'descripcion' => 'Efectivo',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Tarjetas',
            ],
            [
                'descripcion' => 'Tarjetas',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Cheque',
            ],
            [
                'descripcion' => 'Cheque',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Credito',
            ],
            [
                'descripcion' => 'Credito',
            ]
        );
    }
    public function run1()
    {
        TipoPago::truncate();
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Otros con Utilización del Sistema Financiero',
            ],
            [
                'descripcion' => 'Otros con Utilización del Sistema Financiero',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Sin Utilización del Sistema Financiero',
            ],
            [
                'descripcion' => 'Sin Utilización del Sistema Financiero',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Compensación de Deudas',
            ],
            [
                'descripcion' => 'Compensación de Deudas',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Tarjeta de Débito',
            ],
            [
                'descripcion' => 'Tarjeta de Débito',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Dinero Electrónico',
            ],
            [
                'descripcion' => 'Dinero Electrónico',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Tarjeta Prepago',
            ],
            [
                'descripcion' => 'Tarjeta Prepago',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Tarjeta de Crédito',
            ],
            [
                'descripcion' => 'Tarjeta de Crédito',
            ]
        );
        TipoPago::updateOrCreate(
            [
                'descripcion' => 'Endoso de Títulos',
            ],
            [
                'descripcion' => 'Endoso de Títulos',
            ]
        );
    }
}
