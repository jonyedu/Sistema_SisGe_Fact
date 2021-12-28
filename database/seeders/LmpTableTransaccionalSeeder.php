<?php

namespace Database\Seeders;

use App\Models\Modulos\Inventario\Grupo\Grupo;
use App\Models\Modulos\Inventario\Producto\Producto;
use App\Models\Modulos\Inventario\Producto\ProductoCosto;
use App\Models\Modulos\Inventario\Producto\ProductoInventario;
use App\Models\Modulos\Inventario\Producto\ProductoInvVentasCompras;
use App\Models\Modulos\Persona\Cliente\Cliente;
use App\Models\Modulos\Persona\Proveedor\Proveedor;
use App\Models\Modulos\Transaccion\Arqueo\Arqueo;
use App\Models\Modulos\Transaccion\Cotizacion\CotizacionCabecera;
use App\Models\Modulos\Transaccion\Cotizacion\CotizacionDetalle;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraCabecera;
use App\Models\Modulos\Transaccion\FacturaCompra\CompraDetalle;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCabecera;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCheque;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCredito;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasCreditoDetalle;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasDetalle;
use App\Models\Modulos\Transaccion\FacturaVenta\VentasTarjetas;
use Illuminate\Database\Seeder;

class LmpTableTransaccionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::truncate();
        Grupo::truncate();
        Proveedor::truncate();
        Arqueo::truncate();
        CompraCabecera::truncate();
        CompraDetalle::truncate();
        CotizacionCabecera::truncate();
        CotizacionDetalle::truncate();
        VentasCredito::truncate();
        VentasCreditoDetalle::truncate();
        VentasCabecera::truncate();
        VentasDetalle::truncate();
        VentasTarjetas::truncate();
        Producto::truncate();
        ProductoCosto::truncate();
        ProductoInvVentasCompras::truncate();
        ProductoInventario::truncate();
        VentasCheque::truncate();
    }
}
