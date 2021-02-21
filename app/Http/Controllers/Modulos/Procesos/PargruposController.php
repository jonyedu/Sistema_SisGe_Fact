<?php

namespace App\Http\Controllers\Modulos\Procesos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PargruposController extends Controller
{
    //
    public function index()
    {
        return view('modulos.procesos.grupos');
    }
}
