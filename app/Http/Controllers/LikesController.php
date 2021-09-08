<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, Receta $receta)
    {
         //Almacena los likes de un usuario a una receta
         return auth()->user()->meGusta()->toggle($receta);
         /*
         Vemos que dice $receta como parámetro, porque el MG estará aplicado sobre 
         UNA RECETA, justamente. 
         Cuando creamos el controlador, asociamos el mismo al modelo (con el -m Receta)
         por lo que este $receta tendrá la información de la receta que estamos viendo.
         */
    }

}
