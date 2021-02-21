<?php

namespace App\Http\Controllers\Modulos\Procesos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class par_grupos extends Controller
{
    //
    public function index()
    {
        return view('modulos.procesos.grupos');
    }
}
