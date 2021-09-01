<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/*Este método constructor; hace que no se pueda acceder al resto de los
métodos del controlador sin estar autenticado en el sitio*/
    public function __construct(){
        $this->middleware('auth', ['except'=>'show']);
    }

    public function index()
    {
/*llamamos al método recetas, porque es el método del modelo User que relaciona
al usuario con las recetas se llama así (ver modelo User.php)*/
        $usuario = auth()->user()->id;

        $recetas = Receta::where('user_id', $usuario)->paginate(3);

//todas las recetas se van a guardar en la variable $recetas, la cual voy
//a mostrar en recetas.index, como se ve con el método compact.
        
        return view('recetas.index', compact('recetas', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Forma de obtener las categorías sin modelo
        //pluck, es como el SELECT columns de MySQL
      //  $categorias= DB::table('categoria_recetas')->get()->pluck('nombre','id');

        
//con modelo 
//trayendo con modelo no hay pluck, los campos se ponen entre corchetes como parametro
        $categorias=CategoriaReceta::all(['id', 'nombre']);

/*Al llamar al método create (al ir a recetas/create), la vista nos va a devolver
el listado de categorías, solo que en create.blade.php debemos elegir COMO y DONDE
Y lo que hacemos, es decirle que cada elemento del array categorías, lo traiga
como un elemento categoria (con un foreach) y luego llamamos a cada columna.
Ejemplo $categoria->nombre*/

        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd ($request['imagen']->store('upload-recetas', 'public'));

        //Validación del campo
        $data = $request->validate([
            'titulo'=>'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required|image'
        ]);

        //Obtener la ruta de la imagen para finalmente almacenarla en BBDD
        /*Lo que decimos es que cuando el campo 'imagen' del formulario
        envíe una señal via request, la vamos a almacenar en una carpeta
        llamada upload-recetas, y será pública.  */
        $rutaImagen=$request['imagen']->store('upload-recetas', 'public');


        //Resize imagen
        $img=Image::make( public_path("storage/{$rutaImagen}"))->fit(1000,550);
        $img->save();

        //Query para introducir datos en la BBDD SIN MODELO
     /*   DB::table('recetas')->insert(
            [
                'titulo'=>$data['titulo'],
                'ingredientes'=>$data['ingredientes'],
                'preparacion'=>$data['preparacion'],
                'imagen'=>$rutaImagen,
                'user_id'=>Auth::user()->id,
                'categoria_id'=>$data['categoria']

            ]);*/


/*Introducir en la base de datos CON MODELO. Auth toma al usuario autenticado
y recetas es el método a usar del MODELO asignado. En este caso
como estamos agregando recetas a la BBDD, usaremos el método recetas del modelo User.

¿Pero por qué de User y no de Receta? Bueno, porque 
el método recetas del modelo User, dice que un User hasMany(Recetas::class)
Y nosotros en el index, queremos ver las recetas de cada User.
*/
        auth()->user()->recetas()->create([
            'titulo'=>$data['titulo'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen'=>$rutaImagen,
            'categoria_id'=>$data['categoria']
        ]);


            //Redireccionar luego de agregar
            return redirect()->action('RecetaController@index');
//dd($request->all());
//dd Request , es lo que se envía hasta el store.
//All indica que se almacenará todo
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {

        return view('recetas.show', compact ('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //Recordemos que esta variable trae el ID y el nombre
        //de las categorías que vienen en el select
        $categorias=CategoriaReceta::all(['id','nombre']);

        return view('recetas.edit', compact('categorias', 'receta'));

            /*
RECORDAR: Todo lo que pasamos via COMPACT, se va a pasar a la vista
Ahí, en la vista, es que decidimos COMO y DONDE verlo. Por ejemplo, 
$receta->titulo, eso lo podemos escribir donde queramos y ahí lo veremos.
            Podemos pasar receta en el compact así de sencillo
            porque el método ya trae a $receta como parámetro */
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        $data = $request->validate([
            'titulo'=>'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required'
        ]);

        /*
        

/* 
Las recetas se escriben con la sintaxis de abajo, porque vemos que $receta
está pasada como parámetro, entonces podemos pedirle sus datos, como si fuera
que estamos escribiendo estos datos en HTML. 
$receta->titulo, por ejemplo.
*/

//Asignamos valores
        $receta->titulo= $data['titulo'];
        $receta->ingredientes= $data['ingredientes'];
        $receta->preparacion= $data['preparacion'];
        $receta->categoria_id= $data['categoria'];
//Si hacemos un vardump de receta, vemos que aparece $receta->categoria_id
//pero su valor viene en un campo llamado categoria.

        if(request('imagen')){

        $rutaImagen=$request['imagen']->store('upload-recetas', 'public');
        //Resize imagen
        $img=Image::make( public_path("storage/{$rutaImagen}"))->fit(1000,550);
        $img->save();

        //Asignamos la foto al objeto
        
        $receta->imagen=$rutaImagen;

    }
        $receta->save();

        return view('recetas.show', compact('receta'));

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Ejecutar el policy
        $this->authorize('delete', $receta);

        //Eliminar la receta
        $receta->delete();

        return redirect()->action('RecetaController@index');
    }
}
