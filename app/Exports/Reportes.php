<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class Reportes implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $fecha_desde;
    public $fecha_hasta;
    public $titulo;
    public $lista;


    public function __construct( $lista,$total,$fecha_desde, $fecha_hasta,$titulo)
    {    
        $this->lista = $lista;
        $this->fecha_desde = $fecha_desde;
        $this->fecha_hasta = $fecha_hasta;
        $this->titulo = $titulo;
        $this->total = $total;

       

    }
    public function view(): View
    {
        
        //Obtengo los detalles de los insumos-medicamentos, por cada hoja de gastos
       // $detalles_insumos_medicamentos = DB::connection('control_hospitalario_bi')->select("SpConsultarCirugiaHojaGastoDetalle " . $this->hoja_gasto_id);

        //convierto el arreglo a collection
      // $detalles_insumos_medicamentos = collect($this->lista);
      if ($this->titulo=="REPORTE DE VENTAS") {
          # code...
          return view('reports.Transaccion.Excel.ReporteVenta.reporte', [
            'factura' => $this->lista ,
            'total' =>$this->total,
            'nombre_reporte' =>$this->titulo 
        ]);
      }


      if ($this->titulo=="REPORTE DE PROVEEDORES") {
        # code...
        return view('reports.Transaccion.Excel.Persona.Proveedor', [
          'proveedores' =>  $this->lista ,
            
           'nombre_reporte' =>$this->titulo ,
      ]);
    }

    if ($this->titulo=="REPORTE DE CLIENTES") {
        # code...
        return view('reports.Transaccion.Excel.Cliente.Cliente', [
          'proveedores' =>  $this->lista ,
            
           'nombre_reporte' =>$this->titulo ,
      ]);
    }

    if ($this->titulo=="REPORTE DE COMPRAS") {
        # code...
        return view('reports.Transaccion.Excel.ReporteCompra.reporte', [
          'factura' => $this->lista ,
          'total' =>$this->total,
          'nombre_reporte' =>$this->titulo 
      ]);
    }

  







       
    }

    public function startCell(): string
    {
        return 'B2';
    }
     
}
