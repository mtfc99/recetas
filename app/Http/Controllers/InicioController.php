<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){

        //Obtener las últimas recetas
       // $nuevas = Receta::orderBy('id', 'DESC')->get();
        $nuevas = Receta::latest()->limit(5)->get();

        //Obtener las categorías

        $categorias = CategoriaReceta::all(); //almacena todas las categorías en la variable $categorias
        $recetas = []; //creamos un array vacío, donde almacenaremos las recetas de cada categoría.
        //Como vemos en el foreach, por cada categoría se creará un array.

        foreach ($categorias as $categoria){
            $recetas [Str::slug($categoria->nombre)][]=Receta::where('categoria_id', $categoria->id)->limit(3)->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
