<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){

        //Obtener las últimas recetas

       // $nuevas = Receta::orderBy('id', 'DESC')->get();
        $nuevas = Receta::latest()->get();

        return view('inicio.index', compact('nuevas'));
    }
}
