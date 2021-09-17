@extends('layouts.app')

@section('content')
<article class='contenido-receta bg-white p-5 shadow'>
    {{--$receta--}}

    <h1 class='text-center my-3'>{{Str::title($receta->titulo)}}</h1>

    <div class="receta-meta">
        
            <p>
                <span class='font-weight-bold text-primary'>Categoría: </span>
                <a class='text-dark' href="{{route('categorias.show', ['categoriaReceta'=>$receta->categoria->id])}}">
                    {{$receta->categoria->nombre}}
                </a>
            </p>
            <p>
                <span class='font-weight-bold text-primary'>Autor: </span>
                <a class='text-dark' href="{{route('perfiles.show',['perfil'=>$receta->user->id])}}">
                    {{$receta->user->name}}
                </a>
            </p>

            <p>
                <span class='font-weight-bold text-primary'>Fecha: </span>
                <!--El siguiente código convierte el date format a lo que queramos-->
                {{\Carbon\Carbon::parse($receta->created_at)->format('d/m/Y')}}
            </p>
            
        
    </div>
    <div class="imagen-receta">
        <img class='shadow my-3' src="/storage/{{$receta->imagen}}" alt="{{$receta->titulo}}" class='w-100'>
    </div>

    <div class="ingredientes">
        <h2 class='my-3 text-align:start text-primary'>Ingredientes</h2>
        <p>
            {!! $receta->ingredientes !!}
        </p>
    </div>
    <div class="preparacion">
        <h2 class='my-3 text-align:start text-primary'>Preparación</h2>
        <p>
            {!! $receta->preparacion !!}
        </p>
    </div>
</article>

@endsection