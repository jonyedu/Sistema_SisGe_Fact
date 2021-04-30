<?php

namespace App\Http\Controllers\Publico\Catalogo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatologoController extends Controller
{
    public function index()
    {
        return view('Publico.Catalogo.Catalogo');
    }
}
