<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $recetas=Receta::where('user_id', $perfil->user_id)->paginate(6);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('edit', $perfil);

        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar el policy
        $this->authorize('update', $perfil);


        //La validación de los datos.
        $data = $request->validate([
            'nombre' => 'required',
            'biografia' => 'required',
            'url' => 'required'
        ]);
        /*
Debemos fijarnos que en este momento hay que actualizar DOS tablas al mismo tiempo
la de usuario (que contiene nombre y URL y la de perfiles)
*/

        if (request('imagen')) {

            $rutaImagen = $request['imagen']->store('upload-perfiles', 'public');
            //Resize imagen
            $img = Image::make(public_path("storage/{$rutaImagen}"))->fit(600, 600);
            $img->save();

            //Asignamos la foto al objeto

            $array_imagen=['imagen'=>$rutaImagen];
        
        }
        //Asignar nombre y URL
        auth()->user()->url = $data['url'];
        //name=nombre de columna en tabla, nombre=nombre del input
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar URL y nombre porque estos campos no están en perfil, y ya
        //están asignados en el metodo update. 
        unset($data['url']);
        unset($data['nombre']);

        //Asignar biografia e imagen

        auth()->user()->perfil()->update(
            array_merge($data, $array_imagen ?? [])
        );

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
