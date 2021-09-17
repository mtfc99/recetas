@extends('layouts.app')

@section('styles')

@endsection

@section('hero')
    <div class="hero-categorias">
        <form class='container h-100' action={{route('buscar.show')}}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class='display-4'>Encuentra una receta</p>

                    <input type="search" name='buscar' class='form-control'
                    placeholder="Buscar Receta">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')

<div class="container nuevas-recetas">
    <h2 class='titulo-categoria text-uppercase my-4'>
        Últimas Recetas
    </h2>
<div class="container">
    <div class="owl-carousel owl-theme">
        @foreach($nuevas as $nueva)
        <div class="card my-3 p-4">
            <img src="/storage/{{$nueva->imagen}}" class='card-img-top' alt="receta">
            <div class="card-body">
                <h3 class='mb-3'>{{ Str::title($nueva->titulo)}}</h3>
                <!--El helper "title" pone mayúsculas en cada 
                        palabra del string que estemos indicando
                    
                        El helper "words", muestra en pantalla la cantidad
                        de palabras que indiquemos del string que pasemos como 
                    parámetro.-->
                <p> {{ Str::words(strip_tags($nueva->preparacion), 20)}} </p>
                <a href="/recetas/{{$nueva->id}}" class='btn btn-primary font-weight-bold
                        text-uppercase'>Ver Receta</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

    <div class="container">
        <h2 class='titulo-categoria text-uppercase my-4'>Últimas Recetas por categoría</h2>
    </div>
    @foreach($recetas as $key => $value)
    <div class="container">

        <h2 class='titulo-categoria my-4'>{{ Str::title(str_replace("-", ' ',  $key))}}</h2>
        <div class="row">
            @foreach($value as $recetas)
            @foreach($recetas as $receta)
            <div class="col-md-4 my-4">
                <div class="card shadow">
                    <img class='card-img-top' src="/storage/{{$receta->imagen}}" alt="">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>{{ Str::title($receta->titulo)}}</h3>
                        </div>
                        <div class="card-text">
                            <p> <span class='text-primary'>Fecha de Creación: </span>
                                {{\Carbon\Carbon::parse($receta->created_at)->format('d/m/Y')}}</p>

                            <p><span class='text-primary'>Autor:</span> {{$receta->user->name}} </p>
                            <p class='text-muted'>
                                {{ Str::words(strip_tags($receta->preparacion), 10)}}
                            </p>
                            <div class="card-button">
                                <a href="/recetas/{{$receta->id}}" class='btn btn-primary font-weight-bold
                                        text-uppercase'>Ver Receta</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
    @endforeach

</div>
@endsection