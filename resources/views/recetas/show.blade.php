@extends('layouts.app')

@section('content')
<article class='contenido-receta'>
    {{--$receta--}}

    <h1 class='text-center my-3'>{{$receta->titulo}}</h1>

    <div class="receta-meta">
        
            <p>
                <span class='font-weight-bold text-primary'>Categoría: </span>
                {{$receta->categoria->nombre}}
            </p>
            <p>
                <span class='font-weight-bold text-primary'>Autor: </span>
                {{$receta->user->name}}
            </p>
            <p>
                <span class='font-weight-bold text-primary'>Fecha: </span>
                <!--El siguiente código convierte el date format a lo que queramos-->
                {{\Carbon\Carbon::parse($receta->created_at)->format('d/m/Y')}}
            </p>
            
        
    </div>
    <div class="imagen-receta">
        <img src="/storage/{{$receta->imagen}}" alt="{{$receta->titulo}}" class='w-100'>
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

    <like-button></like-button>
    
</article>

@endsection